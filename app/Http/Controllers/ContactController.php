<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Contact;
use App\SharedContact;
use Storage;
use Exception;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }

    /**
     * Contact List
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $ids = $user->contacts()->pluck('id');
        $shared_ids = $user->sharedContacts()->pluck('contact_id');
        $contact_ids = $ids->merge($shared_ids);
        $contacts = Contact::whereIn('id', $contact_ids)->get();
        return view('index', compact('contacts'));
    }
    
    /**
     * Show Add Contact Form
     *
     * @return \Illuminate\View\View
     */
    public function add()
    {
        return view('add');
    }
    
    /**
     * Add New Contact
     *
     * @param ContactRequest $request
     * @return \Illuminate\View\View
     */
    public function store(ContactRequest $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            if($request->has('file')) {
                $file = $request->file('file');
                $file_name = uniqid().'.'.$file->getClientOriginalExtension();
                Storage::disk('public')->put($file_name, file_get_contents($file->getRealPath()), 'public');
                $data['image_path'] = Storage::url($file_name);
            }
            Contact::create($data);
            return redirect()->route('contacts')->with('success', 'Contact Added Successfully.');
        } catch (Exception $ex) {
            return redirect()->route('contacts')->with('error', $ex->getMessage());
        }
    }
    
    /**
     * Show Contact Details
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\View\View
     * @throws Exception
     */
    public function show(Request $request, $id)
    {
        try {
            $contact = Contact::find($id);
            if(!$contact) {
                throw new Exception('You have not permission to access this contact.', 400);
            }
            return view('show', compact('contact'));
        } catch (Exception $ex) {
            return redirect()->route('contact-show', $id)->with('error', $ex->getMessage());
        }
    }
    
    /**
     * Share contact with other system users
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function share(Request $request)
    {
        try {
            $this->validate($request, [
                'user_ids' => 'required|array',
                'contact_id' => 'required'
            ]);
            $users = $request->user_ids;
            foreach($users as $user) {
                $data = [
                    'user_id' => $user,
                    'contact_id' => $request->contact_id
                ];
                SharedContact::firstOrCreate($data);
            }
            return redirect()->route('contacts')->with('success', 'Contact shared successfully.');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
    
    /**
     * Show share contact form
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function shareForm($id)
    {
        $user = request()->user();
        $users = \App\User::whereNotIn('id', [$user->id])->get(['id', 'name']);
        return view('share', compact('users', 'id'));
    }
    
    /**
     * Show add cantact form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function edit(Request $request, $id)
    {
        try {
            $user = $request->user();
            $contact = $user->contacts()->find($id);
            if(!$contact) {
                throw new Exception('You have not permission to edit this contact.', 400);
            }
            $hasShared = SharedContact::where('contact_id', $id)->count();
            if($hasShared > 0) {
                throw new Exception('You can not edit shared contact.', 400);
            }
            return view('edit', compact('contact'));
        } catch (Exception $ex) {
            return redirect()->route('contact-show', $id)->with('error', $ex->getMessage());
        }
    }
    
    /**
     * Show add cantact form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function update(ContactRequest $request, $id)
    {
        try {
            $data = $request->all();
            $user = $request->user();
            $contact = $user->contacts()->find($id);
            if($request->has('file')) {
                $file = $request->file('file');
                $file_name = uniqid().'.'.$file->getClientOriginalExtension();
                Storage::disk('public')->put($file_name, file_get_contents($file->getRealPath()), 'public');
                $data['image_path'] = Storage::url($file_name);
                if($contact->image_path){
                    Storage::disk('public')->delete(str_replace('/storage/', '', $contact->image_path));
                }
            }
            $contact->update($data);
            return redirect()->route('contact-show', $id)->with('success', 'Contact updated successfuly.');
        } catch (Exception $ex) {
            return redirect()->route('contact-show', $id)->with('error', $ex->getMessage());
        }
    }
    
    /**
     * Delete Contact
     *
     * @param Request $request
     * @return \Illuminate\View\View
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        try {
            $user = $request->user();
            $contact = $user->contacts()->find($request->contact_id);
            if(!$contact) {
                throw new Exception('You have not permission to delete this contact.', 400);
            }
            $hasShared = SharedContact::where('contact_id', $request->contact_id)->count();
            if($hasShared > 0) {
                throw new Exception('You can not delete shared contact.', 400);
            }
            $contact->delete();
            return redirect()->route('contacts')->with('success', 'Contact deleted successfully.');
        } catch (Exception $ex) {
            return redirect()->route('contacts')->with('error', $ex->getMessage());
        }
    }
}

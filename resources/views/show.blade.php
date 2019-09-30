@section('style')

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('errors')
            <div class="card">
                <div class="card-header">
                    <span>Contact Details</span>
                    <a href="{{ route('contact-edit', $contact->id) }}" class="btn btn-sm btn-info float-right">Edit Profile</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="profile-img">
                                @if($contact->image_path)
                                <img src="{{ asset('public/'.$contact->image_path) }}" alt="{{ $contact->image_path ?? 'default-profile.jpeg' }}">
                                @else
                                <img src="{{ asset('public/assets/img/default-profile.jpg') }}" alt="default-profile.jpg">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>{{ $contact->first_name }} {{ $contact->last_name }}</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>User Id</label>
                                </div>
                                <div class="col-md-8">
                                    <span>{{ $contact->id }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>First Name</label>
                                </div>
                                <div class="col-md-8">
                                    <span>{{ $contact->first_name }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Middle Name</label>
                                </div>
                                <div class="col-md-8">
                                    <span>{{ $contact->middle_name ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Last Name</label>
                                </div>
                                <div class="col-md-8">
                                    <span>{{ $contact->last_name }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Primary Number</label>
                                </div>
                                <div class="col-md-8">
                                    <span>{{ $contact->primary_number }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Secondary Number</label>
                                </div>
                                <div class="col-md-8">
                                    <span>{{ $contact->secondary_number ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-8">
                                    <span>{{ $contact->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

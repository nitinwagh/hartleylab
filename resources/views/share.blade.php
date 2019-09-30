@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('errors')
            <div class="card">
                <div class="card-header">Share Contact</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('contact-share') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group required">
                                    <input type="hidden" name="contact_id" value="{{ $id }}" />
                                    <label class="control-label" for="First Name">Select User</label>:
                                    <select name="user_ids[]" class="form-control @error('user_ids') is-invalid @enderror" multiple="true">
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <button class="btn btn-primary">Share</button>
                                <a href="{{ route('contacts') }}" class="btn btn-default">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


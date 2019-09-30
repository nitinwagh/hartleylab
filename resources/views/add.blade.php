@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Contact</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('contact-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group required">
                                    <label class="control-label" for="First Name">First Name</label>:
                                    <input type="text" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" name="first_name" required />
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="Middle Name">Middle Name</label>:
                                    <input type="text" value="{{ old('middle_name') }}" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" />
                                    @error('middle_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="Last Name">Last Name</label>:
                                    <input type="text" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" name="last_name" required />
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="Primary Number">Primary Number</label>:
                                    <input type="text" value="{{ old('primary_number') }}" class="form-control @error('primary_number') is-invalid @enderror" name="primary_number" required />
                                    @error('primary_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="Secondary Number">Secondary Number</label>:
                                    <input type="text" value="{{ old('secondary_number') }}" class="form-control @error('secondary_number') is-invalid @enderror" name="secondary_number" />
                                    @error('secondary_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group required">
                                    <label class="control-label" for="email">Email</label>:
                                    <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" required />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="profile image">Profile Image</label>:
                                    <input type="file" class="form-control file @error('file') is-invalid @enderror" name="file" />
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <hr>
                                <button class="btn btn-primary">Submit</button>
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

@section('script')
<script>
    $(document).ready( function () {
        $('#fileUpload').click(function(){
            $('#file').trigger('click');
        });
        $('#file').change(function(){
            var fileName = $('#file')[0].files[0];
            $('#selectedFile').text(fileName.name);
        });
    });
</script>
@endsection

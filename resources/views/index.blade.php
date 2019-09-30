@section('style')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('errors')
            <div class="card">
                <div class="card-header">
                    <span>Contacts</span>
                    <a href="{{ route('contact-add') }}" class="btn btn-sm btn-primary float-right">Add New</a>
                </div>
                <div class="card-body">
                    <div class="responsive">
                        <table class="table" id="contactTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Primary Number</th>
                                    <th>Secondary Number</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                                    <td>{{ $contact->primary_number }}</td>
                                    <td>{{ $contact->secondary_number ?? '-' }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>
                                        <i class="fa fa-address-card redirect link" style="color:blue" data-url="{{ route('contact-show', $contact->id) }}" aria-hidden="true"></i>
                                        <i class="fa fa-share-alt link redirect" style="color:greenyellow" data-url="{{ route('contact-show-share', $contact->id) }}" aria-hidden="true"></i>
                                        <i class="fa fa-times link delete-record" style="color:red" aria-hidden="true" data-id="{{ $contact->id }}"></i>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" id="deleteForm" action="{{ route('contact-delete') }}">
        @csrf
        <input type="hidden" id="contact_id" name="contact_id">
    </form>
</div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function(){
    $('#contactTable').DataTable({
        "columnDefs": [
            { 
                "targets": [0, -1], //first and last column orderable disabled
                "orderable": false, //set not orderable
            }
        ],
        "order": [], //Initial no order.
    });
    
    $('.delete-record').click(function(e){
        e.preventDefault();
        $('#contact_id').val($(this).data('id'));
        $('#deleteForm').submit();
    });
    
    $('.redirect').click(function(){
        window.location.href = $(this).data('url');
    });
});
</script>
@endsection

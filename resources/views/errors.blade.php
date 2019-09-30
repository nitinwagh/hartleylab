@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show">
    <strong>Success!</strong> {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show">
    <strong>Error!</strong> {{ session()->get('error') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif
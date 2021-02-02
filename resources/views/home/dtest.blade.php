
@extends('layouts.app')
@section('style')

@endsection

@section('content')

    
<div class="container">
    <h1></h1>
    <table class="table table-bordered data-table" id="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@endsection

@section('script')
<script>
    $(function () {
    
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index1') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
<!-- jQuery-Datatable -->
<script src="{{ asset('plugins/datatables-jquery/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script>

@endsection

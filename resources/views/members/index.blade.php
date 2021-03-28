@extends('layouts.app')
@section('content')
@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$name="name".$lang;
$address1="address1".$lang;
$address2="address2".$lang;


@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Books&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-search"></i> Search Members&nbsp;</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h5> <i class="fa fa-search"> Search Members</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right">
            <h4><a href="{{ route('create_member') }}" class="btn btn-info btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; New</a></h4>  
        </div>
    </div>
    
</div>

<!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
            <div class="form-row">   
            <div class="table-responsive"style="overflow-x: auto;">               
            <table  class="table display nowrap table-hover" width="100%" cellspacing="0" id="member_datatable">
                    <thead class="js-tbl-header">
                        <tr class="js-tr">
                            <th scope="col">Member ID</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Title</th>
                            <th scope="col" style="width: 15%">Name</th>
                            <th scope="col" style="width: 15%">Address1</th>
                            <th scope="col" style="width: 15%">Addresss2</th>
                            <th scope="col">NIC</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Status</th>
                            <th scope="col"style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                    <!-- @push('scripts')
                    
                    @endpush -->
                    </tbody>
            </table>
        </div>
        </div>               

    </div>
</div>
{{-- end main --}}




@endsection

@section('script')
<script>

$(document).ready(function()
{
    load_datatable();

});

function load_datatable()
{

    $('#member_datatable').DataTable({
        columnDefs: [
        {"targets": [0],
        "visible": false,
        "searchable": false},
        ],
        responsive: true,
        processing: true,
        serverSide: false,
        ordering: false,
        searching: true,

    ajax:{
        type: "GET",
        dataType : 'json',
        url: "{{ route('members.index') }}",
    },
    // pageLength: 15,
    
    columns:[
        {data: "id",name: "ResourceID",orderable: true},
        {data: "images",name: "images",orderable: false},
        {data: "title<?php echo $lang; ?>",name: "title"},
        {data: "<?php echo $name; ?>",name: "name"},
        {data: "<?php echo $address1; ?>",name: "address1"},
        {data: "<?php echo $address2; ?>",name: "address2"},
        {data: "nic",name: "nic",orderable: true},
        {data: "mobile",name: "mobile",orderable: false},
        {data: "gender",name: "gender",orderable: false},
        {data: "status",name: "status",orderable: false},
        {data: "action",name: "action",orderable: false}
    ],
    "createdRow": function( row, data, dataIndex ) {
        if ( data['status'] == "Removed" ) {        
            $('td', row).addClass('font-weight-bold');
            }
        }
    });
}

</script>

@endsection

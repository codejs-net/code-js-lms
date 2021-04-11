@extends('layouts.app')
@section('content')
@php
$lang = session()->get('db_locale');
$name="name".$lang;
$address1="address1".$lang;
$address2="address2".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Staff&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-search"></i> Search Centers&nbsp;</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-10 col-sm-6 text-left p-2"> 
            <h5> <i class="fa fa-search ml-4 pl-2"> Search centers</i></h5>
        </div>  
        <div class="col-md-2 col-sm-6 text-right p-2">
            <a href="{{ route('create_center') }}" class="btn btn-info btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; New</a>
        </div>
    </div>
    
</div>

<!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
            <div class="form-row">   
            <div class="table-responsive"style="overflow-x: auto;">               
            <table  class="table display nowrap table-hover" width="100%" cellspacing="0" id="center_datatable">
                    <thead class="js-tbl-header">
                        <tr class="js-tr">
                            <th scope="col">{{__('Center id')}}</th>
                            <th scope="col" style="width: 15%">{{__('Name')}}</th>
                            <th scope="col" style="width: 10%">{{__('Address1')}}</th>
                            <th scope="col" style="width: 10%">{{__('Addresss2')}}</th>
                            <th scope="col">{{__('Telephone')}}</th>
                            <th scope="col">{{__('Fax')}}</th>
                            <th scope="col">{{__('Email')}}</th>
                            <th scope="col"style="width: 10%">{{__('Action')}}</th>
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

<!-- --------------------------start  modal delete------------------------------- -->
   
<div class="modal fade" id="center_delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Remove Library Center</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="post" action="{{ route('delete_center')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="delete_center_id" name="delete_center_id">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h5 id="modallabel">Are you sure Remove center </h5>
                        </div>
                        <div class="col-md-8">
                            <h5><label type="text"  id="delete_center_name"></label></h5>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i> &nbsp; Delete</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- ---------------------end delete Model------------------------------------- -->

@include('members.show_modal')
@endsection

@section('script')
<script>

$(document).ready(function()
{
    load_datatable();

    // start member delete function
    $('#center_delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var m_id = button.data('sid') 
        var m_name = button.data('sname')
        document.getElementById("delete_center_id").value= m_id; 
        document.getElementById("delete_center_name").innerHTML = m_name;
        })
    // end member delete function

    

});

function load_datatable()
{

    $('#center_datatable').DataTable({
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
        url: "{{ route('center.index') }}",
    },
    // pageLength: 15,
    
    columns:[
        {data: "id",name: "id",orderable: true},
        {data: "<?php echo $name; ?>",name: "name"},
        {data: "<?php echo $address1; ?>",name: "address1"},
        {data: "<?php echo $address2; ?>",name: "address2"},
        {data: "telephone",name: "telephone",orderable: false},
        {data: "fax",name: "fax",orderable: false},
        {data: "email",name: "email",orderable: false},
        {data: "action",name: "action",orderable: false}
    ],
    });
}

</script>

@endsection

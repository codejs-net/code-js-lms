@extends('layouts.app')
@section('content')
@php
$locale = session()->get('locale');
$lang="_".$locale;
$designation="designetion".$lang;
$title="title".$lang;
$name="name".$lang;
$address1="address1".$lang;
$address2="address2".$lang;


@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Staff&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-search"></i> Search Staff&nbsp;</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-10 col-sm-6 text-left p-2"> 
            <h5> <i class="fa fa-search ml-4 pl-2"> Search Staff</i></h5>
        </div>  
        <div class="col-md-2 col-sm-6 text-right p-2">
            <a href="{{ route('create_member') }}" class="btn btn-info btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; New</a>
        </div>
    </div>
    
</div>

<!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
            <div class="form-row">   
            <div class="table-responsive"style="overflow-x: auto;">               
            <table  class="table display nowrap table-hover" width="100%" cellspacing="0" id="staff_datatable">
                    <thead class="js-tbl-header">
                        <tr class="js-tr">
                            <th scope="col">Staff ID</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Title</th>
                            <th scope="col">Designation</th>
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

<!-- --------------------------start  modal delete------------------------------- -->
   
<div class="modal fade" id="member_delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Remove Library Staff</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="post" action="{{ route('delete_staff')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="delete_member_id" name="delete_member_id">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h5 id="modallabel">Are you sure Remove Staff </h5>
                        </div>
                        <div class="col-md-8">
                            <h5><label type="text"  id="delete_member_name"></label></h5>
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
    $('#member_delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var m_id = button.data('mid') 
        var m_name = button.data('mname')
        document.getElementById("delete_member_id").value= m_id; 
        document.getElementById("delete_member_name").innerHTML = m_name;
        })
    // end member delete function

    $('#member_show').on('show.bs.modal', function (event) {
       
       var button = $(event.relatedTarget) ;
       var m_id = button.data('mid');
       
       $("#show_member_id").val(m_id);
       $("#show_table_tbody").empty();
       var op='';
       // -------------------------------------------
       $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('show_staff')}}", 
            data: { m_id: m_id, },
            success:function(data){
              
               

            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            }
        })
        // -------------------------------------------

       
   });

});

function load_datatable()
{

    $('#staff_datatable').DataTable({
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
        url: "{{ route('staff.index') }}",
    },
    // pageLength: 15,
    
    columns:[
        {data: "id",name: "ResourceID",orderable: true},
        {data: "images",name: "images",orderable: false},
        {data: "title<?php echo $lang; ?>",name: "title"},
        {data: "designetion<?php echo $lang; ?>",name: "designetion"},
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

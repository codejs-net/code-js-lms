@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$name="name".$lang;
$address1="address1".$lang;
$address2="address2".$lang;
$title="title".$lang;
$gender="gender".$lang;

@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
      <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Support&nbsp;</a></li>
      <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-info"></i> Member Support&nbsp;</a></li>
  </ol>
  </nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a href="{{ route('member_catagory.index') }}" class="btn btn-sm btn-outline-success ml-2" type="button">Member Category</a>
            {{-- <a href="{{ route('titles.index') }}"class="btn btn-sm btn-outline-success ml-2" type="button">Titles</a> --}}
            <a href="{{ route('member_guarantor.index') }}"class="btn btn-sm btn-outline-success ml-2" type="button">Guarantors</a>
        </form>
    </nav>
    </div> 
</div>

        <!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
        <div class="row text-center">
            <div class="col-md-10 col-sm-6 text-center"> 
                <h5> <i class="fa fa-object-group"></i>&nbsp;Member Guarantor</h5>
            </div>  
            <div class="col-md-2 col-sm-6 text-right">
                <h5>
                    @can('member_support_data-create')
                    <a class="btn btn-sm btn-outline-primary " data-toggle="modal" data-target="#data_create" ><i class="fa fa-plus" ></i>&nbsp;New</a>
                    @endcan
                    @can('member_support_data-import')
                    <a class="btn btn-sm btn-outline-primary bg-indigo " data-toggle="modal" data-target="#data_import" ><i class="fa fa-file-excel-o" ></i>&nbsp;Import</a>
                    @endcan
                </h5>   
            </div>
        </div>
        <div class="form-row">
        <div class="table-responsive">               
            <table class="table table-hover table-bordered" id="guarantor_datatable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" style="width: 20%">Name</th>
                            <th scope="col" style="width: 20%">Address1</th>
                            <th scope="col" style="width: 20%">Address2</th>
                            <th scope="col">NIC</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                   
                    </tbody>
            </table>
           
           
        </div>
         
        </div>               
    </div>
</div>






<!--show Modal -->
<div class="modal fade" id="data_show" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Show Support Data</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
                <div class="modal-body">
                
                    <div class="row form-group">
                        
                        <div class="col-md-12">
                            <h5><span>ID : &nbsp;</span><span class="badge badge-info" id="id_show"></span></h5>
                            <h5 class="text-indigo"><span>Category : &nbsp;</span><span id="name_show"></span></h5>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                   
                </div>
        
        </div>
    </div>
</div>
<!-- end show model -->
@include('member_support.member_guarantor.create')
@include('member_support.member_guarantor.edit')

<!--Delete Modal -->
<div class="modal fade" id="gurantor_delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Delete Support Data</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('delete_member_guarantor')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="id_delete" name="id_delete">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h5><label type="text"  id="name_delete"></label></h5>
                        </div>
                        <div class="col-md-8">
                            <h6 id="modallabel">Are you sure Remove Support Data ? </h6>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> &nbsp; Delete</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- end Delete model -->

<!--import Modal -->
<div class="modal fade" id="data_import" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Import Guarantor Data</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" method="POST" enctype="multipart/form-data" action="{{ route('import_member_guarantor') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="modal-body">

                <div class="custom-file form-group text-center m-3">
                    <div class="col-md-10">
                        <input type="file" class="form-control-file custom-file-input" id="file" name="file" required>
                        <label class="custom-file-label " for="customFile">Choose Excel file</label>
                    </div>
                    <div class="col-md-2">
                   
                </div>
            </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> &nbsp; Import Data</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- end import model -->

@endsection
@section('script')
<script>

$(document).ready(function()
{
    load_datatable();

    $('#data_show').on('show.bs.modal', function (event) {
       
       var button = $(event.relatedTarget) 
       var d_id = button.data('detail_id') 
       var d_name = button.data('detail_name')
       $('#id_show').html(d_id);
       $('#name_show').html(d_name);
   });

    $('#gurantor_edit').on('show.bs.modal', function (event) {
       
        var dataid = $(event.relatedTarget) 
        var g_id =dataid.data('gid');
       
       // -------------------------------------------
       $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('edit_member_guarantor')}}", 
            data: { g_id: g_id, },
            success:function(data){
                $('#guarnt_id').val(data.id);
                $('#name_update_si').val(data.name_si);
                $('#name_update_ta').val(data.name_ta);
                $('#name_update_en').val(data.name_en);
                $('#Address1_update_si').val(data.address1_si);
                $('#Address1_update_ta').val(data.address1_ta);
                $('#Address1_update_en').val(data.address1_en);
                $('#Address2_update_si').val(data.address2_si);
                $('#Address2_update_ta').val(data.address2_ta);
                $('#Address2_update_en').val(data.address2_en);
                $('#nic_update').val(data.nic);
                $('#Mobile_update').val(data.mobile);
                $('#description_update').val(data.description);

                $('input:radio[name="title_update"][value="'+data.titleid+'"]').prop('checked', true);
                $('input:radio[name="gender_update"][value="'+data.genderid+'"]').prop('checked', true);
              
            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            }
        })
        // -------------------------------------------

        @if($locale=="si")
        $("#name_update_si").prop('required',true);
        @elseif($locale=="ta")
        $("#name_update_ta").prop('required',true);
        @elseif($locale=="en")
        $("#name_update_en").prop('required',true);
        @endif

    });

    $('#gurantor_delete').on('show.bs.modal', function (event) {
       
       var button = $(event.relatedTarget) 
       var d_id = button.data('gid') 
       var d_name = button.data('gname')
       $('#id_delete').val(d_id);
       $('#name_delete').html(d_name);
   });

   $('#data_create').on('show.bs.modal', function (event) {
       
        @if($locale=="si")
            $("#name_si").prop('required',true);
            $("#Address1_si").prop('required',true);
            $("#Address2_si").prop('required',true);
        @elseif($locale=="ta")
            $("#name_ta").prop('required',true);
            $("#Address1_ta").prop('required',true);
            $("#Address2_ta").prop('required',true);
        @elseif($locale=="en")
            $("#name_en").prop('required',true);
            $("#Address1_en").prop('required',true);
            $("#Address2_en").prop('required',true);
        @endif
   });

});

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


function load_datatable()
{

    $('#guarantor_datatable').DataTable({
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
        url: "{{ route('member_guarantor.index') }}",
    },
    
    columns:[
        {data: "id",name: "ResourceID",orderable: true},
        {data: "<?php echo $name; ?>",name: "name"},
        {data: "<?php echo $address1; ?>",name: "address1"},
        {data: "<?php echo $address2; ?>",name: "address2"},
        {data: "nic",name: "nic",orderable: true},
        {data: "mobile",name: "mobile",orderable: false},
        {data: "action",name: "action",orderable: false}
    ]

    });
}
</script>

@endsection

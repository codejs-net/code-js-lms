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
      <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
      <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Support&nbsp;</a></li>
      <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-info"></i> Resource Support&nbsp;</a></li>
  </ol>
  </nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
        <a href="{{ route('resource_catagory.index') }}" class="btn btn-sm btn-outline-primary ml-2" type="button"><i class="fa fa-cube"></i>&nbsp;Category</a>
            <a href="{{ route('resource_type.index') }}"class="btn btn-sm btn-outline-primary ml-2" type="button"><i class="fa fa-object-group"></i>&nbsp;Type</a>
            <a href="{{ route('resource_dd_class.index') }}"class="btn btn-sm btn-outline-success ml-2" type="button"><i class="fa fa-tasks"></i>&nbsp;DD Class</a>
            <a href="{{ route('resource_dd_devision.index') }}"class="btn btn-sm btn-outline-success ml-2" type="button"><i class="fa fa-tasks"></i>&nbsp;DD Devision</a>
            <a href="{{ route('resource_dd_section.index') }}"class="btn btn-sm btn-outline-success ml-2" type="button"><i class="fa fa-tasks"></i>&nbsp;DD Section</a>
            <a href="{{ route('resource_language.index') }}"class="btn btn-sm btn-outline-warning ml-2" type="button"><i class="fa fa-language"></i>&nbsp;Language</a>
            <a href="{{ route('resource_publisher.index') }}"class="btn btn-sm btn-outline-warning ml-2" type="button"><i class="fa fa-building-o"></i>&nbsp;Publisher</a>
            <a href="{{ route('resource_creator.index') }}"class="btn btn-sm btn-outline-secondary ml-2" type="button"><i class="fa fa-user"></i>&nbsp;Creator</a>
            <a href="{{ route('resource_dd_donate.index') }}"class="btn btn-sm btn-outline-secondary ml-2" type="button"><i class="fa fa-user-o"></i>&nbsp;Donates</a>
            <a href="{{ route('resource_rack.index') }}"class="btn btn-sm btn-outline-info ml-2" type="button"><i class="fa fa-fa fa-location-arrow"></i>&nbsp;Rack/Cupboard</a>
            <a href="{{ route('resource_floor.index') }}"class="btn btn-sm btn-outline-info ml-2" type="button"><i class="fa fa-fa fa-location-arrow"></i>&nbsp;Floor</a>
        </form>
    </nav>
    </div> 
</div>

        <!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
        <div class="row text-center">
            <div class="col-md-10 col-sm-6 text-center"> 
                <h5> <i class="fa fa-object-group"></i>&nbsp;Resource Creator</h5>
            </div>  
            <div class="col-md-2 col-sm-6 text-right">
                <h5>
                    @can('resource_support_data-create')
                    <a class="btn btn-sm btn-outline-primary " data-toggle="modal" data-target="#data_create" ><i class="fa fa-plus" ></i>&nbsp;New</a>
                    @endcan
                    @can('resource_support_data-import')
                    <a class="btn btn-sm btn-outline-primary bg-indigo " data-toggle="modal" data-target="#data_import" ><i class="fa fa-file-excel-o" ></i>&nbsp;Import</a>
                    @endcan
                </h5>   
            </div>
        </div>
        <div class="form-row">
        <div class="table-responsive">               
            <table class="table table-hover table-bordered" id="creator_datatable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" style="width: 20%">Name</th>
                            <th scope="col" style="width: 20%">Address1</th>
                            <th scope="col" style="width: 20%">Address2</th>
                            <th scope="col">Gender</th>
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
                            {{-- <h5 class="text-indigo"><span>name : &nbsp;</span><span id="name_show"></span></h5> --}}
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
@include('resource_support.resource_creator.create')
@include('resource_support.resource_creator.edit')

<!--Delete Modal -->
<div class="modal fade" id="data_delete" tabindex="-1" role="dialog"  aria-hidden="true">
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
            
            <form method="POST" action="{{ route('delete_resource_creator')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="id_delete" name="id_delete">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h5><label type="text"  id="name_delete"></label></h5>
                        </div>
                        <div class="col-md-8">
                            <h6 id="modallabel">Are you sure Remove Creator ? </h6>
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
                    <h5 class="modal-title" id="modaltitle">Import Creator Data</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" method="POST" enctype="multipart/form-data" action="{{ route('import_resource_creator') }}"class="needs-validation"  novalidate>
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
       
       $('#id_show').html($(event.relatedTarget).data('id'));
      
   });

    $('#data_edit').on('show.bs.modal', function (event) {
       
        var c_id = $(event.relatedTarget).data('id') 
       
       // -------------------------------------------
       $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('edit_resource_creator')}}", 
            data: { c_id: c_id, },
            success:function(data){
                $('#creator_id').val(data.id);
                $('#name_update_si').val(data.name_si);
                $('#name_update_ta').val(data.name_ta);
                $('#name_update_en').val(data.name_en);
                $('#Address1_update_si').val(data.address1_si);
                $('#Address1_update_ta').val(data.address1_ta);
                $('#Address1_update_en').val(data.address1_en);
                $('#Address2_update_si').val(data.address2_si);
                $('#Address2_update_ta').val(data.address2_ta);
                $('#Address2_update_en').val(data.address2_en);
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

    $('#data_delete').on('show.bs.modal', function (event) {
       
       var button = $(event.relatedTarget) 
       var d_id = button.data('id') 
       var d_name = button.data('name')
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

    $('#creator_datatable').DataTable({
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
        url: "{{ route('resource_creator.index') }}",
    },
    
    columns:[
        {data: "id",name: "ID",orderable: true},
        {data: "<?php echo $name; ?>",name: "name"},
        {data: "<?php echo $address1; ?>",name: "address1"},
        {data: "<?php echo $address2; ?>",name: "address2"},
        {data: "<?php echo $gender; ?>",name: "gender"},
        {data: "mobile",name: "mobile",orderable: false},
        {data: "action",name: "action",orderable: false}
    ]

    });
}
</script>

@endsection

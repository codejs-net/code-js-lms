@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Support&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-info"></i> Resource Support&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <a href="{{ route('resource_catagory.index') }}" class="btn btn-outline-success btn-sm ml-2" type="button">Resource Category</a>
            <a href="{{ route('resource_type.index') }}"class="btn btn-outline-success btn-sm ml-2" type="button">Resource Type</a>
            <a href="{{ route('resource_dd_class.index') }}"class="btn btn-outline-success btn-sm ml-2" type="button">Resource DD Class</a>
            <a href="{{ route('resource_dd_devision.index') }}"class="btn btn-outline-success btn-sm ml-2" type="button">Resource DD Devision</a>
            <a href="{{ route('resource_dd_section.index') }}"class="btn btn-outline-success btn-sm ml-2" type="button">Resource DD Section</a>
            <a href="{{ route('resource_creator.index') }}"class="btn btn-outline-success btn-sm ml-2" type="button">Resource Creator</a>
            <a href="{{ route('resource_language.index') }}"class="btn btn-outline-success btn-sm ml-2" type="button">Resource Language</a>
            <a href="{{ route('resource_publisher.index') }}"class="btn btn-outline-success btn-sm ml-2" type="button">Resource Publisher</a>
            <a href="{{ route('resource_dd_donate.index') }}"class="btn btn-outline-success btn-sm ml-2" type="button">Resource Donates</a>
        </form>
    </nav>
    </div>
    
    
</div>

        <!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
        <div class="row text-center">
            <div class="col-md-10 col-sm-6 text-center"> 
                <h4> <i class="fa fa-object-group"></i>&nbsp;Resource Category</h4>
            </div>  
            <div class="col-md-2 col-sm-6 text-right">
                <h4>
                    <a class="btn btn-sm btn-outline-primary " data-toggle="modal" data-target="#data_create" ><i class="fa fa-plus" ></i>&nbsp;New</a>
                    @can('data-import')
                    <a class="btn btn-sm btn-outline-primary bg-indigo" data-toggle="modal" data-target="#data_import" ><i class="fa fa-file-excel-o" ></i>&nbsp;Import</a>
                    @endcan
                </h4>   
            </div>
        </div>
        <div class="form-row">
        <div class="table-responsive">               
            <table class="table table-hover table-bordered" id="book_datatable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" style="width: 30%">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                    @foreach ($details as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->$category }}</td>
                           
                            <td>
                               
                            <a class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#data_show" data-detail_id="{{ $data->id }}" data-detail_name="{{ $data->$category }}"><i class="fa fa-eye" ></i>&nbsp;Show</a>
                            @can('support_data-edit')
                            <a class="btn btn-sm btn-outline-info " data-toggle="modal" data-target="#data_update" data-detail_id="{{ $data->id }}" data-detail_name_si="{{ $data->category_si }}" data-detail_name_ta="{{ $data->category_ta }}" data-detail_name_en="{{ $data->category_en }}"><i class="fa fa-pencil" ></i>&nbsp;Edit</a>
                            @endcan
                            @can('support_data-delete')
                            <a class="btn btn-sm btn-outline-danger " data-toggle="modal" data-target="#data_delete" data-detail_id="{{ $data->id }}" data-detail_name="{{ $data->$category }}"><i class="fa fa-trash" ></i>&nbsp;Delete</a>
                            @endcan
                            
                            </td>
                        </tr>
                        @endforeach
                   
                    </tbody>
            </table>
           
            {!! $details->render( "pagination::bootstrap-4") !!}
           
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
                    <h4 class="modal-title" id="modaltitle">Show Support Data</h4>
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

<!--Create Modal -->
<div class="modal fade" id="data_create" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h4 class="modal-title" id="modaltitle">Create Support Data</h4>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('resource_catagory.store') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="row form-group">
                        <label for="book_detail">Category</label>
                        <input type="text" class="form-control mb-1" id="name_si" name="name_si" value="" placeholder="Name in Sinhala" >   
                        <input type="text" class="form-control mb-1" id="name_ta" name="name_ta" value="" placeholder="Name in Tamil" >
                        <input type="text" class="form-control mb-1" id="name_ta" name="name_ta" value="" placeholder="Name in English" >           
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> &nbsp; Save</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- end Create model -->
<!--Update Modal -->
<div class="modal fade" id="data_update" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h4 class="modal-title" id="modaltitle">Update Support Data - <span id="to_updateName"></span></h4>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('update_resource_cat') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="row form-group">
                        <label for="book_detail">Category</label>
                        <input type="hidden" id="id_update" name="id_update">
                        <input type="text" class="form-control mb-1" id="name_update_si" name="name_update_si" value="" placeholder="Name in Sinhala" >   
                        <input type="text" class="form-control mb-1" id="name_update_ta" name="name_update_ta" value="" placeholder="Name in Tamil" >
                        <input type="text" class="form-control mb-1" id="name_update_en" name="name_update_en" value="" placeholder="Name in English" >          
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> &nbsp; Update</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- end update model -->

<!--Delete Modal -->
<div class="modal fade" id="data_delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h4 class="modal-title" id="modaltitle">Delete Support Data</h4>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('delete_resource_cat')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="id_delete" name="id_delete">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h4><label type="text"  id="name_delete"></label></h4>
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
                    <h4 class="modal-title" id="modaltitle">Import Support Data</h4>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" method="POST" enctype="multipart/form-data" action="{{ route('import_resource_cat') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="modal-body">

                <div class="custom-file form-group text-center m-3">
                    <div class="col-md-10">
                        <input type="file" class="form-control-file custom-file-input" id="file" name="file" required>
                        <label class="custom-file-label " for="customFile">Choose Excel file</label>
                    </div>
                    <div class="col-md-2">
                    @can('code-import')
                    @endcan
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
<!-- end Create model -->

@endsection
@section('script')
<script>

$(document).ready(function()
{
    $('#data_show').on('show.bs.modal', function (event) {
       
       var button = $(event.relatedTarget) 
       var d_id = button.data('detail_id') 
       var d_name = button.data('detail_name')
       $('#id_show').html(d_id);
       $('#name_show').html(d_name);
   });

    $('#data_update').on('show.bs.modal', function (event) {
       
        var button = $(event.relatedTarget) 
        var d_id = button.data('detail_id') 
        var d_name_si = button.data('detail_name_si');
        var d_name_ta = button.data('detail_name_ta');
        var d_name_en = button.data('detail_name_en');
        $('#id_update').val(d_id);
        $('#name_update_si').val(d_name_si);  $('#name_update_ta').val(d_name_ta);  $('#name_update_en').val(d_name_en);
        $('#to_updateName').html(d_id);

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
       var d_id = button.data('detail_id') 
       var d_name = button.data('detail_name')
       $('#id_delete').val(d_id);
       $('#name_delete').html(d_name);
   });

   $('#data_create').on('show.bs.modal', function (event) {
       
        @if($locale=="si")
        $("#name_si").prop('required',true);
        @elseif($locale=="ta")
        $("#name_ta").prop('required',true);
        @elseif($locale=="en")
        $("#name_en").prop('required',true);
        @endif
   });

});

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


</script>

@endsection

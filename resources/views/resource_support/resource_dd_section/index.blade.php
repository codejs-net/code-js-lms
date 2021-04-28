@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$db_locale = session()->get('db_locale');
$section="section".$db_locale;
$devision="devision".$db_locale;
$class="class".$db_locale;

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
                <h5> <i class="fa fa-object-group"></i>&nbsp;Resource Dewey Decimal Section</h5>
            </div>  
            <div class="col-md-2 col-sm-6 text-right">
                <h5>
                    <a class="btn btn-sm btn-outline-primary " data-toggle="modal" data-target="#data_create" ><i class="fa fa-plus" ></i>&nbsp;New</a>
                    @can('data-import')
                    <a class="btn btn-sm btn-outline-primary bg-indigo " data-toggle="modal" data-target="#data_import" ><i class="fa fa-file-excel-o" ></i>&nbsp;Import</a>
                    @endcan
                </h5>   
            </div>
        </div>
        <div class="form-row">
        <div class="table-responsive">
              
            <table class="table table-hover table-bordered" id="book_datatable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" style="width: 20%">DD Class</th>
                            <th scope="col" style="width: 20%">DD Devision</th>
                            <th scope="col">Section Code</th>
                            <th scope="col" style="width: 20%">DD Section</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                    @foreach ($details as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->ddclass->$class }}</td>
                            <td>{{ $data->dddevision->$devision }}</td>
                            <td>{{ $data->section_code }}</td>
                            <td>{{ $data->$section }}</td>
                           
                            <td>
                               
                            <a class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#data_show" data-detail_id="{{ $data->id }}" ><i class="fa fa-eye" ></i>&nbsp;Show</a>
                            @can('support_data-edit')
                            <a class="btn btn-sm btn-outline-info " data-toggle="modal" data-target="#data_update" data-detail_id="{{ $data->id }}" data-ddclass_id="{{ $data->dd_class_id }}"><i class="fa fa-pencil" ></i>&nbsp;Edit</a>
                            @endcan
                            @can('support_data-delete')
                            <a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#data_delete" data-detail_id="{{ $data->id }}" data-detail_name="{{ $data->$section }}"><i class="fa fa-trash" ></i>&nbsp;Delete</a>
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
                    <h5 class="modal-title" id="modaltitle">Show Support Data</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
                <div class="modal-body">
                
                    <div class="row form-group">
                        
                        <div class="col-md-2">
                            <label><span>ID </span></label>
                            <label><span>DD Class </span></label>
                            <label><span>DD Devision </span></label>
                            <label><span>DD Section </span></label>
                        </div>
                        <div class="col-md-10 text-indigo">
                            <label><span id="id_show"></span></label></br>
                            <label><span id="class_show"></span></label></br>
                            <label><span id="devision_show"></span></label></br>
                            <label><span id="section_show"></span></label></br>
                        </div>
                            
                       
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn  btn-sm btn-secondary" data-dismiss="modal">Close</button>
                   
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
                    <h5 class="modal-title" id="modaltitle">Create Support Data</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('resource_dd_section.store') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="row form-group">
                        <label for="category">DD Class</label>
                        <select class="form-control mb-3"name="ddclass" id="ddclass" value=""required>
                            <option value="" disabled selected>DD Class</option>
                        </select>
                        <label for="category">DD Devision</label>
                        <select class="form-control mb-3"name="dddevision" id="dddevision" value=""required>
                            <option value="" disabled selected>DD Devision</option>
                        </select>
                        <label for="category">Section Code</label>
                        <input type="text" class="form-control mb-3" id="section_code" name="section_code" value="" placeholder="section Code"required > 
                        <label for="category">Section</label>
                        <input type="text" class="form-control mb-1" id="name_si" name="name_si" value="" placeholder="Name in Sinhala" >   
                        <input type="text" class="form-control mb-1" id="name_ta" name="name_ta" value="" placeholder="Name in Tamil" >
                        <input type="text" class="form-control mb-1" id="name_en" name="name_en" value="" placeholder="Name in English" >           
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
                    <h5 class="modal-title" id="modaltitle">Update Support Data - <span id="to_updateName"></span></h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('update_resource_dd_section') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="row form-group">
                    <label for="category">DD Class</label>
                        <input type="hidden" id="id_update" name="id_update">
                        <select class="form-control mb-3"name="ddclass_update" id="ddclass_update" value=""required>
                            <option value="" disabled selected>DD Class</option>
                        </select>
                        <label for="category">DD Devision</label>
                        <select class="form-control mb-3"name="dddevision_update" id="dddevision_update" value=""required>
                            <option value="" disabled selected>DD Devision</option>
                        </select>
                        <label for="category">Section Code</label>
                        <input type="text" class="form-control mb-3" id="section_code_update" name="section_code_update" value="" placeholder="Section Code"required > 
                        <label for="category">Section</label>
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
                    <h5 class="modal-title" id="modaltitle">Delete Support Data</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('delete_resource_dd_section')}}">
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
                    <h5 class="modal-title" id="modaltitle">Import Support Data</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" method="POST" enctype="multipart/form-data" action="{{ route('import_resource_dd_section') }}"class="needs-validation"  novalidate>
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
       // -------------------------------------------
       $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('show_resource_type')}}", 
            data: { d_id: d_id, },
            success:function(data){
                @if($locale=="si") 
                $('#category_show').html(data.category.category_si);
                @elseif($locale=="ta") 
                $('#category_show').html(data.category.category_ta);
                @elseif($locale=="en")
                $('#category_show').html(data.category.category_en);
                @endif
                $('#id_show').html(data.id);
                $('#type_show').html(data.type_si+" /"+data.type_ta+" /"+data.type_en);
            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            }
        })
        // -------------------------------------------

       
   });

    $('#data_update').on('show.bs.modal', function (event) {
       
        var button = $(event.relatedTarget);
        var d_id = button.data('detail_id');
        var d_class = button.data('ddclass_id');
        load_class()
        load_Devision(d_class);

        $('#id_update').val(d_id);
        $('#to_updateName').html(d_id);

        @if($locale=="si")
        $("#name_update_si").prop('required',true);
        @elseif($locale=="ta")
        $("#name_update_ta").prop('required',true);
        @elseif($locale=="en")
        $("#name_update_en").prop('required',true);
        @endif

        // -------------------------------------------
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('edit_resource_dd_section')}}", 
            data: { d_id: d_id, },
            success:function(data){
                
                $("#ddclass_update").val(data.ddclass.id);
                $("#dddevision_update").val(data.dddevision.id);
                $("#section_code_update").val(data.section_code);
                $("#name_update_si").val(data.section_si);
                $("#name_update_ta").val(data.section_ta);
                $("#name_update_en").val(data.section_en);
               
            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            }
        })
        // -------------------------------------------

    });

    $('#data_delete').on('show.bs.modal', function (event) {
       
       var button = $(event.relatedTarget) 
       var d_id = button.data('detail_id') 
       var d_name = button.data('detail_name')
       $('#id_delete').val(d_id);
       $('#name_delete').html(d_name);
   });

   $('#data_create').on('show.bs.modal', function (event) {
        load_class()
        @if($locale=="si")
        $("#name_si").prop('required',true); 
        @elseif($locale=="ta")
        $("#name_ta").prop('required',true); 
        @elseif($locale=="en")
        $("#name_en").prop('required',true); 
        @endif

        
   });

});

function load_class()
{
    $("#ddclass").html("");
    $("#ddclass_update").html("");
    var op_c="";
    $.ajax
    ({
        type: "GET",
        url: "{{route('load_resource_dd_class')}}", 
        success:function(data){
            op_c+='<option value="" disabled selected>DD Class</option>';
            for(var i=0;i<data.length;i++)
            {
                op_c+='<option value="'+data[i].id+'">'+ 
                    @if($locale=="si") data[i].class_si 
                    @elseif($locale=="ta") data[i].class_ta 
                    @elseif($locale=="en") data[i].class_en
                    @endif +
                    '</option>';
            }
            $("#ddclass").append(op_c);
            $("#ddclass_update").append(op_c);
        },
        error:function(data){

        }
    })
}
  
function load_Devision(d_class)
{
    $("#dddevision").html("");
    $("#dddevision_update").html("");
     var op_d="";
     $('#dddevision_update').html("");
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('load_resource_dd_devision')}}", 
            data: { d_class: d_class, },
            success:function(data){
                op_d+='<option value="" disabled selected>DD Devision</option>';
                for(var i=0;i<data.length;i++)
                {
                    op_d+='<option value="'+data[i].id+'">'+ 
                        @if($locale=="si") data[i].devision_si 
                        @elseif($locale=="ta") data[i].devision_ta 
                        @elseif($locale=="en") data[i].devision_en
                        @endif +
                        '</option>';
                }
                $("#dddevision").append(op_d);
                $("#dddevision_update").append(op_d);
               
            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            }
        })
        // --------------------------------------------------------
}

$("#ddclass_update").change(function () {
    var d_class=$('#ddclass_update').val();
    load_Devision(d_class);
});

$("#ddclass").change(function () {
     var d_class=$('#ddclass').val();
     load_Devision(d_class);  
});

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


</script>

@endsection

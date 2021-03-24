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
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Members&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-plus"></i> Add Member&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center mb-2">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h5> <i class="fa fa-plus"> Add Member</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right">
            @can('data-import')
            <a class="btn btn-sm btn-js" data-toggle="modal" data-target="#data_import" ><i class="fa fa-file-excel-o" ></i>&nbsp;Import</a>
            @endcan
        </div>
    </div>
    
</div>

        <!-- Main content -->
<div class="container">
    <div class="card card-body">
        <div class="">   

        <form onSubmit="return false;"  id="member_save" class="needs-validation"  novalidate>
        {{ csrf_field() }}
            <div class="form-group">
                <div class="form-check form-check-inline" >
                    <label for="name">Title:</label> &nbsp;
                </div>
                <div class="form-check form-check-inline" >
                    <input type="radio" class="form-check-input" name="title" value="Mr" required>
                    <label class="form-check-label">Mr</label>
                </div>
                <div class="form-check form-check-inline" >
                    <input type="radio" class="form-check-input" name="title" value="Mrs" required>
                    <label class="form-check-label">Mis</label>
                </div>
                <div class="form-check form-check-inline" >
                    <input type="radio" class="form-check-input" name="title" value="Mrss" required>
                    <label class="form-check-label">Miss</label>
                    <div class="invalid-feedback" style="margin-left: 1em" >Please choose Title</div>
                </div>
                    
            </div>

    


            <div class="row form-group">
                <div class="form-group col-md-6">
                    <label for="categry">Category : </label>
                    <select class="form-control"name="category" value="{{old('category')}}"required>
                    <option value="" disabled selected>Select Member's Category</option>
                    @foreach($Mdata as $item)
                        <option value="{{ $item->id }}">{{ $item->$category }}</option>
                    @endforeach
            
                    </select>
                    <div class="invalid-feedback">{{ __("Please Select the Category")}}</div>
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                </div>
                <div class="form-group col-md-6 text-left">
                    <label for="categry">&nbsp;</label><br>
                    
                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Member Category" onclick="add_by_modal('/save_member_cat')" >
                    <i class="fa fa-plus"></i></button><label for="categry">&nbsp; New Category</label>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Name :</label>
                <input type="text" class="form-control" name="name_si" value="{{old('name_si')}}" placeholder="Name"required>
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
            <div class="form-group">
                <label for="Address">Address :</label>
                <input type="text" class="form-control" name="Address1_si" placeholder="Address Line 1" value="{{old('Address1')}}"required>
                <span class="text-danger">{{ $errors->first('Address1') }}</span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Address2_si" placeholder="Address Line 2" value="{{old('Address2')}}"required> 
                <span class="text-danger">{{ $errors->first('Address2') }}</span>
            </div>

            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="NIC">NIC :</label>
                    <input type="text" class="form-control" name="nic" placeholder="NIC" value="{{old('nic')}}"required>
                    <span class="text-danger">{{ $errors->first('nic') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="Mobile">Mobile No :</label>
                    <input type="text" class="form-control" name="Mobile" placeholder="Mobile No" value="{{old('Mobile')}}"required>
                    <span class="text-danger">{{ $errors->first('Mobile') }}</span>
                </div>
            </div>
            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="NIC">Birth Day :</label>
                    <input type="date" class="form-control" name="birthday" placeholder="Birth Day" value="{{old('birthday')}}"required>
                    <span class="text-danger">{{ $errors->first('birthday') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="gender">Gender :</label>
                    <div class="form-group">
                        <div class="form-check-inline">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="Male"required>Male
                        </label> &nbsp;
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="gender" value="Female">Female
                        </label>
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="descrip">Description :</label>
                <textarea class="form-control" rows="3" id="comment" name="Description" placeholder="Description" value="{{old('Description')}}"></textarea>
                <span class="text-danger">{{ $errors->first('Description') }}</span>
            </div>
            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="regdate">Registerd Date :</label>
                    <input type="date" class="form-control" name="registeredDate" placeholder="registered Date" value="{{old('registeredDate')}}"required>
                    <span class="text-danger">{{ $errors->first('registeredDate') }}</span>
                </div>
                <div class="form-group col-md-6">
                </div>
            </div>
            
        <div class="box-footer clearfix pull-right">
            
            <button type="submit" class="btn btn-success btn-sm toastrDefaultError toastsDefaultSuccess" id="save_member"><i class="fa fa-check" aria-hidden="true"></i> {{ __("Save")}}</button>
            &nbsp; &nbsp;
            <button type="button" class="btn btn-secondary btn-sm" id="cler">Reset
            <i class="fa fa-times"></i></button>
            <!-- Image loader -->
            <div id='loader' style='display: none;' >
                <div id="ajax-loader" ></div>
                <div id="page-overlay"></div>
            </div>
            <!-- Image loader -->
        </div>
            
        </form>
           
        </div>               

    </div>
</div>

<!---------------------------import Modal --------------------------------------->
<div class="modal fade" id="data_import" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Import Members</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" method="POST" enctype="multipart/form-data" action="{{ route('import_member') }}"class="needs-validation"  novalidate>
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
                    @can('data-import')
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> &nbsp; Import Data</button>
                    @endcan
                </div>
            </form>
           
        </div>
    </div>
</div>


@endsection

@section('script')
<script>

$(document).ready(function()
{
    
});

// -------------------------save Member----------------------------------
$("#save_member").click(function () {
   
    $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('members.store')}}", 
            data: $('#member_save').serialize(),

            beforeSend: function(){
                $("#loader").show();
            },

            success:function(data){
                toastr.success('Member Added Successfully')
                $("#member_save").trigger("reset");
            },
            error:function(data){
                toastr.error('Member Add faild Plese try again')
            },
            complete:function(data){
                $("#loader").hide();
            }
        })
        
});
//--------------------------end Member Save-----------------------------

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});



</script>

@endsection

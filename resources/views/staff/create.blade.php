@extends('layouts.app')


@section('content')
@php
$locale = session()->get('locale');
$lang="_".$locale;
$designetion="designetion".$lang;
$title="title".$lang;
$gender="gender".$lang;
$center="name".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('staff.index') }}"><i class="fa fa-folder-open"></i> {{__('Staff')}}&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-plus"></i> {{__('Add Staff')}}&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center mb-2">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h5> <i class="fa fa-plus"> {{__('Add Staff')}}</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right">
            @can('staff-import')
            <a class="btn btn-sm btn-js" data-toggle="modal" data-target="#data_import" ><i class="fa fa-file-excel-o" ></i>&nbsp;{{__('Import')}}</a>
            @endcan
        </div>
    </div>
    
</div>

        <!-- Main content -->
<div class="container">
    <div class="card card-body">
        <form  enctype="multipart/form-data"  id="staff_form" class="needs-validation"  novalidate>
        {{ csrf_field() }}

        <div class="form-row border border-secondary bg-light">
            <div class="col-md-2 col-12 m-auto pl-2 text-center">
                <img src="{{ asset('images/staffs/default_avatar.png') }}" class="img-resource1 elevation-3" id="avater_update">
            </div>
            <div class="col-md-10 col-12">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="image">{{__('Staff Image')}}</label>
                        <input type="file" id="image_member" name="image_member" class="form-control-file bg-white p-1 elevation-1">
                    </div>
                </div>
                <div class="row">
                    
                    <div class="form-group col-md-6">
                        <div class="form-check form-check-inline" >
                            <label for="name">{{__('Title')}}:</label> &nbsp;
                        </div>
                        @foreach($tdata as $item)
                        <div class="form-check form-check-inline" >
                            <input type="radio" class="form-check-input" name="title" value="{{$item->id}}" required>
                            <label class="form-check-label">{{$item->$title}}</label>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
            
        </div>

        <hr>

            <div class="row form-group">
                <div class="form-group col-md-5">
                    <label for="designation">{{__('Designation')}} : </label>
                    <select class="form-control"name="designation" id="designation" value="{{old('designation')}}"required>
                    <option value="" disabled selected>{{__('Select Staffs Designation')}}</option>
                    @foreach($Mdata as $item)
                        <option value="{{ $item->id }}">{{ $item->$designetion }}</option>
                    @endforeach
            
                    </select>
                    <div class="invalid-feedback">{{ __("Please Select the Designation")}}</div>
                    <span class="text-danger">{{ $errors->first('designation') }}</span>
                </div>
                <div class="form-group col-md-1 text-left">
                    <label for="categry">&nbsp;</label><br>
                    
                    <button type="button" id="btn_newdesignetion" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i></button>
                </div>
                <div class="form-group col-md-6">
                    <label for="regdate">{{__('Registerd Date')}} :</label>
                    <input type="date" class="form-control" name="registeredDate" placeholder="registered Date" value="{{old('registeredDate')}}"required>
                    <span class="text-danger">{{ $errors->first('registeredDate') }}</span>
                </div>
                
            </div>
            <div class="form-group">
                <label for="name">{{__('Name')}} :</label>
                <input type="text" class="form-control mb-1" name="name_si" id="name_si" value="{{old('name_si')}}" placeholder="{{__('Name in Sinahala')}}">
                <input type="text" class="form-control mb-1" name="name_ta" id="name_ta" value="{{old('name_ta')}}" placeholder="{{__('Name in Tamil')}}">
                <input type="text" class="form-control mb-1" name="name_en" id="name_en" value="{{old('name_en')}}" placeholder="{{__('Name in English')}}">
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
            <div class="form-group">
                <label for="Address">{{__('Address Line1')}} :</label>
                <input type="text" class="form-control mb-1" name="Address1_si" id="Address1_si" placeholder="{{__('Address Line 1 Sinhala')}}" value="{{old('Address1_si')}}">
                <input type="text" class="form-control mb-1" name="Address1_ta" id="Address1_ta" placeholder="{{__('Address Line 1 Tamil')}}" value="{{old('Address1_ta')}}">
                <input type="text" class="form-control mb-1" name="Address1_en" id="Address1_en" placeholder="{{__('Address Line 1 English')}}" value="{{old('Address1_en')}}">
                <span class="text-danger">{{ $errors->first('Address1') }}</span>
            </div>
            <div class="form-group">
                <label for="Address">{{__('Address Line2')}} :</label>
                <input type="text" class="form-control mb-1" name="Address2_si" placeholder="{{__('Address Line 2 Sinhala')}}" value="{{old('Address2_si')}}"> 
                <input type="text" class="form-control mb-1" name="Address2_ta" placeholder="{{__('Address Line 2 Tamil')}}" value="{{old('Address2_ta')}}"> 
                <input type="text" class="form-control mb-1" name="Address2_en" placeholder="{{__('Address Line 2 English')}}" value="{{old('Address2_en')}}"> 
                <span class="text-danger">{{ $errors->first('Address2') }}</span>
            </div>

            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="NIC">{{__('NIC')}} :</label>
                    <input type="text" class="form-control" name="nic" placeholder="{{__('NIC')}}" value="{{old('nic')}}"required>
                    <span class="text-danger">{{ $errors->first('nic') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="Mobile">{{__('Mobile No')}} :</label>
                    <input type="text" class="form-control" name="Mobile" placeholder="{{__('Mobile No')}}" value="{{old('Mobile')}}"required>
                    <span class="text-danger">{{ $errors->first('Mobile') }}</span>
                </div>
            </div>
            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="NIC">{{__('Birth Day')}} :</label>
                    <input type="date" class="form-control" name="birthday" placeholder="{{__('Birth Day')}}" value="{{old('birthday')}}"required>
                    <span class="text-danger">{{ $errors->first('birthday') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="name">{{__('Gender')}}:</label> <br>
                    <div class="bg-light p-2">
                        <div class="form-check form-check-inline" >
                            @foreach($gedata as $item)
                            <div class="form-check form-check-inline" >
                                <input type="radio" class="form-check-input" name="gender" value="{{$item->id}}" required>
                                <label class="form-check-label">{{$item->$gender}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <div class="row form-group">
                <label for="descrip">{{__('Description')}} :</label>
                <textarea class="form-control" rows="3" id="comment" name="Description" placeholder="{{__('Description')}}" value="{{old('Description')}}"></textarea>
                <span class="text-danger">{{ $errors->first('Description') }}</span>
            </div>
           
            <div class="row border border-secondary bg-light">
                <div class="form-group col-md-12">
                    <label for="center">{{__('Centers Allocation')}}: </label><br>
                    @foreach($cdata as $item)
                    <label class="ml-3 pl-1">
                        <input type="checkbox" name="center[]" value="{{$item->id}}" class="form-check-input"id="" >{{ $item->$center }}
                    </label><br>
                    @endforeach
                    <div class="invalid-feedback">{{ __("Please Select the Center")}}</div>
                    <span class="text-danger">{{ $errors->first('center') }}</span>
                </div>
            </div>
            
        <div class="box-footer clearfix pull-right mt-3">
            
            <button type="submit" class="btn btn-success btn-sm toastrDefaultError toastsDefaultSuccess" id="save_staff"><i class="fa fa-check" aria-hidden="true"></i> {{ __("Save")}}</button>
            &nbsp; &nbsp;
            <button type="button" class="btn btn-secondary btn-sm" id="cler">{{__('Reset')}}
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

<!---------------------------import Modal --------------------------------------->
<div class="modal fade" id="data_import" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">{{__('Import Staff')}}</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" method="POST" enctype="multipart/form-data" action="{{ route('import_staff') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="modal-body">

                <div class="custom-file form-group text-center m-3">
                    <div class="col-md-10">
                        <input type="file" class="form-control-file custom-file-input" id="file" name="file" required>
                        <label class="custom-file-label " for="customFile">{{__('Choose Excel file')}}</label>
                    </div>
                    <div class="col-md-2">
                   
                   
                </div>
            </div>
                    
                </div>

                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    @can('data-import')
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> &nbsp; {{__('Import Data')}}</button>
                    @endcan
                </div>
            </form>
           
        </div>
    </div>
</div>

@include('modal.create_by_modal')
@endsection

@section('script')
<script>

$(document).ready(function()
{
    @if($locale=="si")
        $("#name_si").prop('required',true);
        $("#Address1_si").prop('required',true);
        @elseif($locale=="ta")
        $("#name_ta").prop('required',true);
        $("#Address1_ta").prop('required',true);
        @elseif($locale=="en")
        $("#name_en").prop('required',true);
        $("#Address1_en").prop('required',true);
    @endif

    $('#staff_form').on('submit', function(event){
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax
            ({
                type: "POST",
                dataType : 'json',
                url: "{{route('staff.store')}}", 
                data: formData,
                contentType: false,
                cache: false,
                processData: false,

                beforeSend: function(){
                    $("#loader").show();
                },

                success:function(data){
                    toastr.success('Staff Added Successfully')
                    $("#staff_form").trigger("reset");
                },
                error:function(data){
                    toastr.error('Staff Add faild Plese try again')
                },
                complete:function(data){
                    $("#loader").hide();
                }
            })

    });

    $('#create_by_modal').on('show.bs.modal', function (event) {
       
       @if($locale=="si")
       $(this).find("#name_si").prop('required',true);
       @elseif($locale=="ta")
       $(this).find("#name_ta").prop('required',true);
       @elseif($locale=="en")
       $(this).find("#name_en").prop('required',true);
       @endif
   });
});


$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


$('#btn_newdesignetion').on('click', function() {
    $("#modal_feild").html("Designetion")
    $("#modal_route").val("{{route('designation.store')}}")
    $("#inputname").val("#designation")
    $("#create_by_modal").modal('show');
});


//--------------------------Quick create-----------------------------
$('#modal_form').on('submit', function(event){
    event.preventDefault();
    var formData = new FormData(this);
    var op='';
    $.ajax
        ({
        type: "POST",
        dataType : 'json',
        url: $("#modal_route").val(), 
        data: $('#modal_form').serialize(),
        cache: false,
        processData: true,

        success:function(data){
            toastr.info('Detail Added Successfully')
            for(var i=0;i<data.data.length;i++)
            {
                op+='<option value="'+data.data[i].id+'">'+ 
                    @if($locale=="si") data.data[i].name_si
                    @elseif($locale=="ta") data.data[i].name_ta
                    @elseif($locale=="en") data.data[i].name_en
                    @endif +
                    '</option>';
            }
            $($("#inputname").val())
            .empty()
            .append(op)
            .val(data.dataid);
            $("#modal_form").trigger("reset");
            $('#create_by_modal').modal('hide');
        },
        error:function(data){
            toastr.error('Detail Add faild Plese try again')
        }
    })

});

</script>

@endsection

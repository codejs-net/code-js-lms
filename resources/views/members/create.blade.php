@extends('layouts.app')


@section('content')
@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$title="title".$lang;
$guarantor="name".$lang;
$address1="address1".$lang;
$address2="address2".$lang;
$gender="gender".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('members.index') }}"><i class="fa fa-folder-open"></i> {{__('Members')}}&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-plus"></i> {{__('Add Member')}}&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center mb-2">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h5> <i class="fa fa-plus"> {{__('Add Member')}}</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right">
            @can('member-import')
            <a class="btn btn-sm btn-js" data-toggle="modal" data-target="#data_import" ><i class="fa fa-file-excel-o" ></i>&nbsp;{{__('Import')}}</a>
            @endcan
        </div>
    </div>
    
</div>

        <!-- Main content -->
<div class="container">
    <div class="card card-body">
        <form  enctype="multipart/form-data"  id="member_save" class="needs-validation"  novalidate>
        {{ csrf_field() }}

        <div class="form-row border border-secondary bg-light">
            <div class="col-md-2 col-12 m-auto pl-2 text-center">
                <img src="{{ asset('images/members/default_avatar.png') }}" class="img-resource1 elevation-3" id="avater_update">
            </div>
            <div class="col-md-10 col-12">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="image">{{__('Member Image')}}</label>
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
                <div class="form-group col-md-6">
                    <label for="categry">{{__('Category')}} : </label>
                    <select class="form-control"name="category" id="category" value="{{old('category')}}"required>
                    <option value="" disabled selected>{{__('Select Members Category')}}</option>
                    @foreach($Mdata as $item)
                        <option value="{{ $item->id }}">{{ $item->$category }}</option>
                    @endforeach
            
                    </select>
                    <div class="invalid-feedback">{{ __("Please Select the Category")}}</div>
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                </div>
                <div class="form-group col-md-6 text-left">
                <label for="new_language">&nbsp;</label></br>
                    <button type="button" id="btn_newcategory" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i></button>
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
                    <label for="Mobile">{{__('Mobile No')}} : {{__('( 94xxxxxxxxx )')}}</label>
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
            <div class="form-group">
                <div class="col-12 col-md-12">
                    <label for="email">{{__('Email')}} : </label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="{{__('Email')}}" value="{{old('email')}}">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="descrip">{{__('Description')}} :</label>
                <input type="text" class="form-control mb-1" name="description_si" id="description_si" placeholder="{{__('Description Sinhala')}}" value="{{old('description_si')}}"> 
                <input type="text" class="form-control mb-1" name="description_ta" id="description_ta" placeholder="{{__('Description Tamil')}}" value="{{old('description_ta')}}"> 
                <input type="text" class="form-control mb-1" name="description_en" id="description_en" placeholder="{{__('Description English')}}" value="{{old('description_en')}}"> 
                <span class="text-danger">{{ $errors->first('Description') }}</span>
            </div>
            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="regdate">{{__('Registerd Date')}} :</label>
                    <input type="date" class="form-control" name="registeredDate" placeholder="{{__('registered Date')}}" value="{{old('registeredDate')}}"required>
                    <span class="text-danger">{{ $errors->first('registeredDate') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="regnumber">{{__('Registretion No')}} :</label>
                    <input type="text" class="form-control" name="regnumber" placeholder="{{__('Registretion No')}}" value="{{old('regnumber')}}">
                    <span class="text-danger">{{ $errors->first('regnumber') }}</span>
                </div>
            </div>

           
            <div class="border border-primary bg-light mb-4">
              <div class="m-2">
              <div class="row">
               <div class="col-md-11">
                   <label for="member_guarantor">{{__('Guarantor')}} : </label>
                        <select class="form-control" id="member_guarantor" name="member_guarantor" value=""required>
                            <option value="" class="" selected disabled>{{__('Select Guarantor')}}</option>
                            @foreach($gdata as $item)
                                    <option value="{{ $item->id }}">{{ $item->$guarantor}}-{{$item->$address1}}-{{$item->nic}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="col-md-1">
                    <label for="categry">&nbsp;</label><br>
                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#guarantor_create" >
                    <i class="fa fa-plus"></i></button><label for="categry">&nbsp; {{__('New')}}</label>
                </div>

               </div>
              </div>
            </div>
            <hr>
        <div class="box-footer clearfix pull-right">
            
            <button type="submit" class="btn btn-success btn-sm" id="save_member"><i class="fa fa-check" aria-hidden="true"></i> {{ __("Save")}}</button>
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
                    <h5 class="modal-title" id="modaltitle">{{__('Import Members')}}</h5>
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
                        <label class="custom-file-label " for="customFile">{{__('Choose Excel file')}}</label>
                    </div>
                    <div class="col-md-2">
                   
                   
                </div>
            </div>
                    
                </div>

                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    @can('member-import')
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> &nbsp; {{__('Import Data')}}</button>
                    @endcan
                </div>
            </form>
           
        </div>
    </div>
</div>

@include('members.create_guarantor_modal')
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

    $('#member_save').on('submit', function(event){
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax
            ({
                type: "POST",
                dataType : 'json',
                url: "{{route('members.store')}}", 
                data: formData,
                contentType: false,
                cache: false,
                processData: false,

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

    $('#member_guarantor').select2({
        theme: 'bootstrap4',
    });

    $('#guarantor_create').on('show.bs.modal', function (e) {
       
       @if($locale=="si")
           $(this).find("#name_si").prop('required',true);
           $(this).find("#Address1_si").prop('required',true);
           $(this).find("#Address2_si").prop('required',true);
        //    $(this).find('input[name="name_si"]').prop('required',true);
       @elseif($locale=="ta")
           $(this).find("#name_ta").prop('required',true);
           $(this).find("#Address1_ta").prop('required',true);
           $(this).find("#Address2_ta").prop('required',true);
       @elseif($locale=="en")
           $(this).find("#name_en").prop('required',true);
           $(this).find("#Address1_en").prop('required',true);
           $(this).find("#Address2_en").prop('required',true);
       @endif
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


$('#guarantor_form').on('submit', function(event){
    event.preventDefault();
    var formData = new FormData(this);
    var op='';
    $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('member_guarantor.store')}}", 
            data: formData,
            contentType: false,
            cache: false,
            processData: false,

            success:function(data){
                toastr.success('Guarantor Added Successfully')
                for(var i=0;i<data.data.length;i++)
                {
                    op+='<option value="'+data.data[i].id+'">'+ 
                        @if($locale=="si") data.data[i].name_si +"-"+ data.data[i].address1_si +"-"+ data.data[i].nic
                        @elseif($locale=="ta") data.data[i].name_ta +"-"+ data.data[i].address1_ta +"-"+ data.data[i].nic
                        @elseif($locale=="en") data.data[i].name_en +"-"+ data.data[i].address1_en +"-"+ data.data[i].nic
                        @endif +
                        '</option>';
                }
                $('#member_guarantor')
                .empty()
                .append(op)
                .val(data.dataid);
                $("#guarantor_form").trigger("reset");
                $('#guarantor_create').modal('hide');
            },
            error:function(data){
                toastr.error('Guarantor Add faild Plese try again')
            }
        })

});


$('#btn_newcategory').on('click', function() {
    $("#modal_feild").html("Member Category")
    $("#modal_route").val("{{route('member_catagory.store')}}")
    $("#inputname").val("#category")
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

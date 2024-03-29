@extends('layouts.app')


@section('content')
@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$title="title".$lang;
$gender="gender".$lang;
$guarantor="name".$lang;
$address1="address1".$lang;
$address2="address2".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('members.index') }}"><i class="fa fa-folder-open"></i> {{__('Members')}}&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-plus"></i> {{__('Edit Member')}}&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center mb-2">
        <div class="col-md-12 col-sm-6 text-center"> 
            <h5> <i class="fa fa-plus"> {{__('Edit Member')}}</i></h5>
        </div>  
    </div>
    
</div>

        <!-- Main content -->
<div class="container">
    <div class="card card-body">
        <form action="{{route('update_member')}}" method="POST" enctype="multipart/form-data"  id="member_update" class="needs-validation"  novalidate>
        {{ csrf_field() }}
        <input type="hidden" name="member_id" id="member_id">
        <div class="form-row border border-secondary bg-light">
            <div class="col-md-2 col-12 m-auto pl-2 text-center">
                <img src="" class="img-resource1 elevation-3" id="avater_update">
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
        <div class="row">
            <div class="form-group col-md-6">
                <label for="regdate">{{__('Registerd Date')}} :</label>
                <input type="date" class="form-control" name="registeredDate" id="registeredDate" placeholder="{{__('registered Date')}}" value="{{old('registeredDate')}}"required>
                <span class="text-danger">{{ $errors->first('registeredDate') }}</span>
            </div>
            <div class="form-group col-md-6 p-2">
               <div class="mx-4">
                <input class="form-check-input" type="checkbox" value="" name="check_custom_reg" id="check_custom_reg">
                <label class="form-check-label" for="check_custom_reg">{{__('Custom Register Number')}}</label>
               </div>
                <input type="text" class="form-control" name="regnumber"  id="regnumber" placeholder="{{__('Registretion No')}}" value="{{old('regnumber')}}" disabled>
                <span class="text-danger">{{ $errors->first('regnumber') }}</span>
            </div>
        </div>
        <div class="row">
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
                <label for="categry">&nbsp;</label><br>
                
                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Member Category" onclick="add_by_modal('/save_member_cat')" >
                <i class="fa fa-plus"></i></button><label for="categry">&nbsp; {{__('New Category')}}</label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="name">{{__('Name')}} :</label>
                <input type="text" class="form-control mb-1" name="name_si" id="name_si" value="{{old('name_si')}}" placeholder="{{__('Name in Sinahala')}}">
                <input type="text" class="form-control mb-1" name="name_ta" id="name_ta" value="{{old('name_ta')}}" placeholder="{{__('Name in Tamil')}}">
                <input type="text" class="form-control mb-1" name="name_en" id="name_en" value="{{old('name_en')}}" placeholder="{{__('Name in English')}}">
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="Address">{{__('Address Line1')}} :</label>
                <input type="text" class="form-control mb-1" name="Address1_si" id="Address1_si" placeholder="{{__('Address Line 1 Sinhala')}}" value="{{old('Address1_si')}}">
                <input type="text" class="form-control mb-1" name="Address1_ta" id="Address1_ta" placeholder="{{__('Address Line 1 Tamil')}}" value="{{old('Address1_ta')}}">
                <input type="text" class="form-control mb-1" name="Address1_en" id="Address1_en" placeholder="{{__('Address Line 1 English')}}" value="{{old('Address1_en')}}">
                <span class="text-danger">{{ $errors->first('Address1') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="Address">{{__('Address Line2')}} :</label>
                <input type="text" class="form-control mb-1" name="Address2_si" id="Address2_si" placeholder="{{__('Address Line 2 Sinhala')}}" value="{{old('Address2_si')}}"> 
                <input type="text" class="form-control mb-1" name="Address2_ta" id="Address2_ta" placeholder="{{__('Address Line 2 Tamil')}}" value="{{old('Address2_ta')}}"> 
                <input type="text" class="form-control mb-1" name="Address2_en" id="Address2_en" placeholder="{{__('Address Line 2 English')}}" value="{{old('Address2_en')}}"> 
                <span class="text-danger">{{ $errors->first('Address2') }}</span>
            </div>
        </div>

        <div class=" row form-group">
            <div class="form-group col-md-6">
                <label for="NIC">{{__('NIC')}} :</label>
                <input type="text" class="form-control" name="nic" id="nic" placeholder="{{__('NIC')}}" value="{{old('nic')}}"required>
                <span class="text-danger">{{ $errors->first('nic') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="Mobile">{{__('Mobile No')}} : {{__('( 94xxxxxxxxx )')}}</label>
                <input type="text" class="form-control" name="Mobile" id="Mobile" placeholder="{{__('Mobile No')}}" value="{{old('Mobile')}}"required>
                <span class="text-danger">{{ $errors->first('Mobile') }}</span>
            </div>
        </div>
            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="NIC">{{__('Birth Day')}} :</label>
                    <input type="date" class="form-control" name="birthday" id="birthday" placeholder="{{__('Birth Day')}}" value="{{old('birthday')}}"required>
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
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="Occupation">{{__('Occupation')}} :</label>
                    <input type="text" class="form-control mb-1" name="occupation_si" id="occupation_si" placeholder="{{__('occupation Sinhala')}}" value="{{old('occupation_si')}}"> 
                    <input type="text" class="form-control mb-1" name="occupation_ta" id="occupation_ta" placeholder="{{__('occupation Tamil')}}" value="{{old('occupation_ta')}}"> 
                    <input type="text" class="form-control mb-1" name="occupation_en" id="occupation_en" placeholder="{{__('occupation English')}}" value="{{old('occupation_en')}}"> 
                    <span class="text-danger">{{ $errors->first('occupation') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="Workplace">{{__('Work Place/School')}} :</label>
                    <input type="text" class="form-control mb-1" name="Workplace_si" id="Workplace_si" placeholder="{{__('Workplace Sinhala')}}" value="{{old('Workplace_si')}}"> 
                    <input type="text" class="form-control mb-1" name="Workplace_ta" id="Workplace_ta" placeholder="{{__('Workplace Tamil')}}" value="{{old('Workplace_ta')}}"> 
                    <input type="text" class="form-control mb-1" name="Workplace_en" id="Workplace_en" placeholder="{{__('Workplace English')}}" value="{{old('Workplace_en')}}"> 
                    <span class="text-danger">{{ $errors->first('Workplace') }}</span>
                </div>
            </div>

            <div class="border border-primary bg-light mb-4">
              <div class="m-2">
              <div class="row">
               <div class="col-md-11">
                   <label for="member_guarantor">{{__('Guarantor')}} : </label>
                        <select class="form-control" id="member_guarantor" name="member_guarantor">
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

            <div class="form-row border border-secondary bg-light">
                <div class="form-group col-md-3 col-3 p-2 mt-2">
                    <label for="status">{{__('Change Status')}}</label><br>
                   <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status" value="1">{{__('Active')}}
                        </label> &nbsp;
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status" value="0">{{__('Remove')}}
                        </label> &nbsp;
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status" value="2">{{__('Backlist')}}
                        </label> &nbsp;
                   </div>
                   <span class="text-danger">{{ $errors->first('status') }}</span>
               </div>
               <div class="form-group col-md-9 col-9 p-2 mt-2">
               
                </div>
           </div>
            
        <div class="box-footer mt-2 clearfix pull-right">
            
            <button type="submit" class="btn btn-success btn-sm toastrDefaultError toastsDefaultSuccess" id="save_member"><i class="fa fa-check" aria-hidden="true"></i> {{ __("Update")}}</button>
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

@include('members.create_guarantor_modal')
@endsection

@section('script')
<script>

$(document).ready(function()
{
        $("#avater_update").attr("src","{{asset('images/members/'.$edata->image)}}");
        $('#member_id').val("{{$edata->id}}");
        $('input:radio[name="title"]').filter('[value="{{$edata->titleid}}"]').attr('checked', true);
        $('#category').val("{{$edata->categoryid}}");
        $('#name_si').val("{{$edata->name_si}}");
        $('#name_ta').val("{{$edata->name_ta}}");
        $('#name_en').val("{{$edata->name_en}}");
        $('#Address1_si').val("{{$edata->address1_si}}");
        $('#Address1_ta').val("{{$edata->address1_ta}}");
        $('#Address1_en').val("{{$edata->address1_en}}");
        $('#Address2_si').val("{{$edata->address2_si}}");
        $('#Address2_ta').val("{{$edata->address2_ta}}");
        $('#Address2_en').val("{{$edata->address2_en}}");
        $('#nic').val("{{$edata->nic}}");
        $('#Mobile').val("{{$edata->mobile}}");
        $('#birthday').val("{{$edata->birthday}}");
        $('input:radio[name="gender"]').filter('[value="{{$edata->genderid}}"]').attr('checked', true);
        $('#email').val("{{$edata->email}}");
        $('#description_si').val("{{$edata->description_si}}");
        $('#description_ta').val("{{$edata->description_ta}}");
        $('#description_en').val("{{$edata->description_en}}");
        $('#occupation_si').val("{{$edata->occupation_si}}");
        $('#occupation_ta').val("{{$edata->occupation_ta}}");
        $('#occupation_en').val("{{$edata->occupation_en}}");
        $('#Workplace_si').val("{{$edata->Workplace_si}}");
        $('#Workplace_ta').val("{{$edata->Workplace_ta}}");
        $('#Workplace_en').val("{{$edata->Workplace_en}}");
        $('#registeredDate').val("{{$edata->regdate}}");
        $('#regnumber').val("{{$edata->regnumber}}");
        @if($edata->regnumber != $edata->id)
        $('#check_custom_reg').prop('checked', true);
        $('input[name="regnumber"]').attr('disabled', false);
        @endif
        $('#member_guarantor').val("{{$edata->guarantor_id}}");
        $('input:radio[name="status"]').filter('[value="{{$edata->status}}"]').attr('checked', true);
       


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

    // $('#member_update').on('submit', function(event){
    //     event.preventDefault();
    //     var formData = new FormData(this);
    //     $.ajax
    //         ({
    //             type: "POST",
    //             dataType : 'json',
    //             url: "{{route('update_member')}}", 
    //             data: formData,
    //             contentType: false,
    //             cache: false,
    //             processData: false,

    //             beforeSend: function(){
    //                 $("#loader").show();
    //             },

    //             success:function(data){
    //                 toastr.success('Member Added Successfully')
                    
    //             },
    //             error:function(data){
    //                 toastr.error('Member Add faild Plese try again')
    //             },
    //             complete:function(data){
    //                 $("#loader").hide();
    //             }
    //         })

    // });

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


});
$('#check_custom_reg').change(function() {
    $('input[name="regnumber"]').attr('disabled', !this.checked);
    $("input[name='regnumber']").focus();
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

</script>

@endsection

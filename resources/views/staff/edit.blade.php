@extends('layouts.app')


@section('content')
@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$title="title".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Members&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-plus"></i> Edit Member&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center mb-2">
        <div class="col-md-12 col-sm-6 text-center"> 
            <h5> <i class="fa fa-plus"> Edit Member</i></h5>
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
                        <label for="image">Member Image</label>
                        <input type="file" id="image_member" name="image_member" class="form-control-file bg-white p-1 elevation-1">
                    </div>
                </div>
                <div class="row">
                    
                    <div class="form-group col-md-6">
                        <div class="form-check form-check-inline" >
                            <label for="name">Title:</label> &nbsp;
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
                    <label for="categry">Category : </label>
                    <select class="form-control"name="category" id="category" value="{{old('category')}}"required>
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
                <input type="text" class="form-control mb-1" name="name_si" id="name_si" value="{{old('name_si')}}" placeholder="Name in Sinahala">
                <input type="text" class="form-control mb-1" name="name_ta" id="name_ta" value="{{old('name_ta')}}" placeholder="Name in Tamil">
                <input type="text" class="form-control mb-1" name="name_en" id="name_en" value="{{old('name_en')}}" placeholder="Name in English">
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
            <div class="form-group">
                <label for="Address">Address Line1 :</label>
                <input type="text" class="form-control mb-1" name="Address1_si" id="Address1_si" placeholder="Address Line 1 Sinhala" value="{{old('Address1_si')}}">
                <input type="text" class="form-control mb-1" name="Address1_ta" id="Address1_ta" placeholder="Address Line 1 Tamil" value="{{old('Address1_ta')}}">
                <input type="text" class="form-control mb-1" name="Address1_en" id="Address1_en" placeholder="Address Line 1 English" value="{{old('Address1_en')}}">
                <span class="text-danger">{{ $errors->first('Address1') }}</span>
            </div>
            <div class="form-group">
                <label for="Address">Address Line2 :</label>
                <input type="text" class="form-control mb-1" name="Address2_si" id="Address2_si" placeholder="Address Line 2 Sinhala" value="{{old('Address2_si')}}"> 
                <input type="text" class="form-control mb-1" name="Address2_ta" id="Address2_si" placeholder="Address Line 2 Tamil" value="{{old('Address2_ta')}}"> 
                <input type="text" class="form-control mb-1" name="Address2_en" id="Address2_si" placeholder="Address Line 2 English" value="{{old('Address2_en')}}"> 
                <span class="text-danger">{{ $errors->first('Address2') }}</span>
            </div>

            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="NIC">NIC :</label>
                    <input type="text" class="form-control" name="nic" id="nic" placeholder="NIC" value="{{old('nic')}}"required>
                    <span class="text-danger">{{ $errors->first('nic') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="Mobile">Mobile No :</label>
                    <input type="text" class="form-control" name="Mobile" id="Mobile" placeholder="Mobile No" value="{{old('Mobile')}}"required>
                    <span class="text-danger">{{ $errors->first('Mobile') }}</span>
                </div>
            </div>
            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="NIC">Birth Day :</label>
                    <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Birth Day" value="{{old('birthday')}}"required>
                    <span class="text-danger">{{ $errors->first('birthday') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="gender">Gender :</label><br>
                   <div class="bg-light p-2">
                        <div class="form-check form-check-inline" >
                            <input type="radio" class="form-check-input" name="gender" value="Male"required>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline" >
                            <input type="radio" class="form-check-input" name="gender" value="Female"required>
                            <label class="form-check-label">Female</label>
                        </div>
                   </div>

                </div>
            </div>
            <div class="form-group">
                <label for="descrip">Description :</label>
                <textarea class="form-control" rows="3" id="Description" name="Description" placeholder="Description" value="{{old('Description')}}"></textarea>
                <span class="text-danger">{{ $errors->first('Description') }}</span>
            </div>
            <div class=" row form-group">
                <div class="form-group col-md-6">
                    <label for="regdate">Registerd Date :</label>
                    <input type="date" class="form-control" name="registeredDate" id="registeredDate" placeholder="registered Date" value="{{old('registeredDate')}}"required>
                    <span class="text-danger">{{ $errors->first('registeredDate') }}</span>
                </div>
                <div class="form-group col-md-6">
                </div>
            </div>

            <div class="form-row border border-secondary bg-light">
                <div class="form-group col-md-3 col-3 p-2 mt-2">
                    <label for="status">Change Status</label><br>
                   <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status" value="1">Active
                        </label> &nbsp;
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status" value="0">Remove
                        </label> &nbsp;
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status" value="2">Backlist
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


@endsection

@section('script')
<script>

$(document).ready(function()
{
        $("#avater_update").attr('src','/images/members/{{$edata->image}}');
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
        $('input:radio[name="gender"]').filter('[value="{{$edata->gender}}"]').attr('checked', true);
        $('#Description').val("{{$edata->description}}");
        $('#registeredDate').val("{{$edata->regdate}}");
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
});

</script>

@endsection

@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Settings&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-info"></i>Settings&nbsp;</a></li>
</ol>
</nav>

<!-- Main content -->
<div class="container">
    <div class="card card-body">
      <div><h6>Basic Library Settings</h6></div>
      <form method="post" action="{{ route('update_library') }}" enctype="multipart/form-data"  name="form_library" id="form_library" class="needs-validation"  novalidate>
        {{ csrf_field() }}
        <div class="form-row border border-secondary bg-light elevation-2">
          <div class="col-md-2 col-12 m-auto pl-2 text-center">
              <img src="" class="img-resource1  m-1" id="avater_library">
          </div>
          <div class="col-md-10 col-12">
              <div class="row">
                  <div class="form-group col-md-12">
                      <label for="image">Library Image</label>
                      <input type="file" id="image_library" name="image_library" class="form-control-file bg-white p-1 elevation-1">
                  </div>
              </div>
          </div>
          
      </div>
      <hr>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="lib_name">Library Name</label>
                <input type="text" class="form-control mb-1" id="lib_name_si" name="lib_name_si" value="{{old('lib_name_si')}}" placeholder="Library Name in sinhala" >
                <input type="text" class="form-control mb-1" id="lib_name_ta" name="lib_name_ta" value="{{old('lib_name_ta')}}" placeholder="Library Name in Tamil" >
                <input type="text" class="form-control mb-1" id="lib_name_en" name="lib_name_en" value="{{old('lib_name_en')}}" placeholder="Library Name in English" >
                
            </div>
            <div class="form-group col-md-12">
                <label for="address1">Library Address1</label>
                <input type="text" class="form-control mb-1" id="lib_address1_si" name="lib_address1_si" value="{{old('address1_si')}}" placeholder="Library Address1 in Sinhala">
                <input type="text" class="form-control mb-1" id="lib_address1_ta" name="lib_address1_ta" value="{{old('address1_si')}}" placeholder="Library Address1 in Tamil" >
                <input type="text" class="form-control mb-1" id="lib_address1_en" name="lib_address1_en" value="{{old('address1_si')}}" placeholder="Library Address1 in English" >
                
            </div>
            <div class="form-group col-md-12">
                <label for="address2">Library Address2</label>
                <input type="text" class="form-control mb-1" id="lib_address2_si" name="lib_address2_si" value="{{old('address1_si')}}" placeholder="Library Address2 in Sinhala" >
                <input type="text" class="form-control mb-1" id="lib_address2_ta" name="lib_address2_ta" value="{{old('address1_si')}}" placeholder="Library Address2 in Tamil" >
                <input type="text" class="form-control mb-1" id="lib_address2_en" name="lib_address2_en" value="{{old('address1_si')}}" placeholder="Library Address2 in English" >
                
            </div>
        
        </div>
        <hr>
    
        <div class="form-row">  
            <div class="form-group col-md-6">
                <label for="telephone">Telephone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="telephone No" value="{{old('telephone')}}" required>
                <span class="text-danger">{{ $errors->first('telephone') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="fax">Fax</label>
                <input type="text" class="form-control" id="fax" name="fax" placeholder="fax No" value="{{old('fax')}}">
                <span class="text-danger">{{ $errors->first('fax') }}</span>
            </div>
        </div>

        <div class="form-row">  
            <div class="form-group col-md-12">
                <label for="lib_email">Email</label>
                <input type="text" class="form-control" id="lib_email" name="lib_email" placeholder="Email" value="{{old('lib_email')}}" required>
                <span class="text-danger">{{ $errors->first('lib_email') }}</span>
            </div>
        </div>
        <div class="form-row">  
            <div class="form-group col-md-12">
                <label for="description">description</label>
                <textarea class="form-control" id="description" name="description" placeholder="description" value="{{old('description')}}" rows="3"></textarea>
                <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
        </div>
        <div class="box-footer mt-2 clearfix pull-right">
            
          <button type="submit" class="btn btn-success btn-sm elevation-2" id="update_library"><i class="fa fa-check" aria-hidden="true"></i> {{ __("Update")}}</button>
          &nbsp; &nbsp;
          <button type="button" class="btn btn-secondary btn-sm elevation-2" id="cler">Reset
          <i class="fa fa-times"></i></button>
      </div>
      </form>      
  </div>


</div>

@endsection
@section('script')
<script>

$(document).ready(function()
{
  $('#lib_name_si').val("{{$library->name_si}}");
  $('#lib_name_ta').val("{{$library->name_ta}}");
  $('#lib_name_en').val("{{$library->name_en}}");
  $('#lib_address1_si').val("{{$library->address1_si}}");
  $('#lib_address1_ta').val("{{$library->address1_ta}}");
  $('#lib_address1_en').val("{{$library->address1_en}}");
  $('#lib_address2_si').val("{{$library->address2_si}}");
  $('#lib_address2_ta').val("{{$library->address2_ta}}");
  $('#lib_address2_en').val("{{$library->address2_en}}");
  $('#telephone').val("{{$library->telephone}}");
  $('#fax').val("{{$library->fax}}");
  $('#lib_email').val("{{$library->email}}");
  $('#description').val("{{$library->description}}");
  $("#avater_library").attr("src","{{asset('images/'.$library->image)}}");

});
</script>

@endsection

@extends('layouts.app')


@section('content')
@php
$locale = session()->get('locale');
$lang="_".$locale;
$center="name".$lang;
$libname="name".$lang;


@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Staff&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-plus"></i> Edit center&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center mb-2">
        <div class="col-md-12 col-sm-6 text-center"> 
            <h5> <i class="fa fa-plus"> Edit Center</i></h5>
        </div>  
    </div>
    
</div>

        <!-- Main content -->
<div class="container">
    <div class="card card-body">
        <form action="{{route('update_center')}}" method="POST" enctype="multipart/form-data"  id="center_update" class="needs-validation"  novalidate>
        {{ csrf_field() }}
        <input type="hidden" name="center_id" id="center_id">
        <div class="form-row border border-secondary bg-light mb-2">
            <div class="col-md-12 col-12 m-auto p-2">
                <label for="designation">Library : </label>
                <select class="form-control"name="library" id="library" value="{{old('library')}}"required>
                    <option value="" disabled selected>Select Library</option>
                    @foreach($ldata as $item)
                        <option value="{{ $item->id }}">{{ $item->$libname }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="lib_name">Center Name</label>
                <input type="text" class="form-control mb-1" id="lib_name_si" name="lib_name_si" value="{{old('lib_name_si')}}" placeholder="Library Name in sinhala" >
                <input type="text" class="form-control mb-1" id="lib_name_ta" name="lib_name_ta" value="{{old('lib_name_ta')}}" placeholder="Library Name in Tamil" >
                <input type="text" class="form-control mb-1" id="lib_name_en" name="lib_name_en" value="{{old('lib_name_en')}}" placeholder="Library Name in English" >
                
            </div>
            <div class="form-group col-md-12">
                <label for="address1">Center Address1</label>
                <input type="text" class="form-control mb-1" id="lib_address1_si" name="lib_address1_si" value="{{old('address1_si')}}" placeholder="Library Address1 in Sinhala">
                <input type="text" class="form-control mb-1" id="lib_address1_ta" name="lib_address1_ta" value="{{old('address1_si')}}" placeholder="Library Address1 in Tamil" >
                <input type="text" class="form-control mb-1" id="lib_address1_en" name="lib_address1_en" value="{{old('address1_si')}}" placeholder="Library Address1 in English" >
                
            </div>
            <div class="form-group col-md-12">
                <label for="address2">Center Address2</label>
                <input type="text" class="form-control mb-1" id="lib_address2_si" name="lib_address2_si" value="{{old('address1_si')}}" placeholder="Library Address2 in Sinhala" >
                <input type="text" class="form-control mb-1" id="lib_address2_ta" name="lib_address2_ta" value="{{old('address1_si')}}" placeholder="Library Address2 in Tamil" >
                <input type="text" class="form-control mb-1" id="lib_address2_en" name="lib_address2_en" value="{{old('address1_si')}}" placeholder="Library Address2 in English" >
                
            </div>
       </div>

        <div class="form-row">  
            <div class="form-group col-md-6">
                <label for="telephone">Telephone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="telephone No" value="{{old('telephone')}}">
                <span class="text-danger">{{ $errors->first('telephone') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="fax">Fax</label>
                <input type="text" class="form-control" id="fax" name="fax" placeholder="fax No" value="{{old('fax')}}" >
                <span class="text-danger">{{ $errors->first('fax') }}</span>
            </div>
        </div>

        <div class="form-row">  
            <div class="form-group col-md-12">
                <label for="lib_email">Email</label>
                <textarea class="form-control" id="lib_email" name="lib_email" placeholder="Email" value="{{old('lib_email')}}" rows="1"></textarea>
                <span class="text-danger">{{ $errors->first('lib_email') }}</span>
            </div>
        </div>
        <div class="form-row">  
            <div class="form-group col-md-12">
                <label for="description">description</label>
                <textarea class="form-control" id="description" name="description" placeholder="description" value="{{old('description')}}" rows="2"></textarea>
                <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
        </div>
            
        <div class="box-footer mt-2 clearfix pull-right">
            
            <button type="submit" class="btn btn-success btn-sm" id="save_member"><i class="fa fa-check" aria-hidden="true"></i> {{ __("Update")}}</button>
            &nbsp; &nbsp;
            <button type="button" class="btn btn-secondary btn-sm" id="cler">Reset
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
       
        $('#center_id').val("{{$edata->id}}");
        $('#library').val("{{$edata->library_id}}");
        $('#lib_name_si').val("{{$edata->name_si}}");
        $('#lib_name_ta').val("{{$edata->name_ta}}");
        $('#lib_name_en').val("{{$edata->name_en}}");
        $('#lib_address1_si').val("{{$edata->address1_si}}");
        $('#lib_address1_ta').val("{{$edata->address1_ta}}");
        $('#lib_address1_en').val("{{$edata->address1_en}}");
        $('#lib_address2_si').val("{{$edata->address2_si}}");
        $('#lib_address2_ta').val("{{$edata->address2_ta}}");
        $('#lib_address2_en').val("{{$edata->address2_en}}");
        $('#telephone').val("{{$edata->telephone}}");
        $('#fax').val("{{$edata->fax}}");
        $('#lib_email').val("{{$edata->email}}");
        $('#description').val("{{$edata->description}}");
       


    @if($locale=="si")
        $("#lib_name_si").prop('required',true);
        $("#lib_address1_si").prop('required',true);
        @elseif($locale=="ta")
        $("#lib_name_ta").prop('required',true);
        $("#lib_address1_ta").prop('required',true);
        @elseif($locale=="en")
        $("#lib_name_en").prop('required',true);
        $("#lib_address1_en").prop('required',true);
    @endif

    
});

</script>

@endsection

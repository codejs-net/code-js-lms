@extends('layouts.app')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
      <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Roles&nbsp;</a></li>
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-user"></i> Create Role&nbsp;</li>
  </ol>
  </nav>
          <!-- Content Header (Page header) -->
  <div class="container">
      <div class="row text-center">
          <div class="col-md-11 col-sm-6 text-left p-2"> 
              <h5> <i class="fa fa-search ml-4 pl-2">Create Role</i></h5>
          </div>  
          <div class="col-md-1 col-sm-6 text-right p-2">
              <a href="{{ route('roles.index') }}" class="btn btn-info btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; back</a>
          </div>
      </div>
      
  </div>
  

<div class="container">
<div class="card card-body">

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


<form method="post" action="{{ route('roles.store')}}"  id="user_form" class="needs-validation"  novalidate>
{{ csrf_field() }}
    
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="name" value="{{old('name')}}" required>
        </div>
    </div>
</div>   

<div class="row">
    <div class="col-md-12">
        <div class="form-check">
            @php
            $category="";
            @endphp
            <table style="width: 100%" class="">
                <tr class="bg-light">
                    <th scope="col" style="width: 15%"><label for="role">Permissions </label></th>
                    <th style="width: 5%"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></th>
                    <th scope="col">
                        <label class="text-primary"><input type="checkbox" class="" id="checkAll">&nbsp;Check All</label>
                    </th>
                </tr>
                @foreach($permission as $item)
                <tr class="">
                    @if($item->category==$category)
                        <td></td>
                        <td></td>
                        <td>
                            <label class="ml-3 pl-1">
                                <input type="checkbox" name="permission[]" value="{{$item->id}}" class="form-check-input"id="" >{{ $item->name }}
                            </label>
                        </td>
                    @else
                        <td><span>{{$item->category}}</span></td>
                        <td><i class="fa fa-long-arrow-right" aria-hidden="true"></i></td>
                        <td>
                            <label class="ml-3 pl-1">
                                <input type="checkbox" name="permission[]" value="{{$item->id}}" class="form-check-input"id="" >{{ $item->name }}
                            </label>
                        </td>
                    @endif
                </tr>
                @php
                $category=$item->category;
                @endphp
                @endforeach
        </table>
            <span class="text-danger">{{ $errors->first('permission[]') }}</span>
        </div>
        <hr>
    </div>

    
    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="button" class="btn btn-sm btn-secondary" id="">
        <i class="fa fa-times"></i> Reset</button>

        <button type="submit" class="btn btn-sm btn-success ml-2" value="Save" id="" >
            <i class="fa fa-floppy-o"></i> Save</button>
    </div>
</div>
</form>

                
</div>
</div>

@endsection

@section('script')
<script>

$(document).ready(function()
{
   
});

$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

</script>

@endsection
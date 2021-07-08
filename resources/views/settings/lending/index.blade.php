@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$db_locale = session()->get('db_locale');
$category="category".$db_locale;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Setting&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-info"></i> Lending Setting&nbsp;</a></li>
</ol>
</nav>

        <!-- Main content -->
<div class="container">

    <div class="card card-body">
        <div><h6><i class="fa fa-sliders"></i>&nbsp;Default Lending Limit</h6></div>
       <form method="POST" action="{{ route('update_limit') }}">
        {{ csrf_field() }}
         <div class="form-group">
           <label for="theme">Limit:</label>
           <input type="text" class="form-control mb-1" id="default_limit" name="default_limit" value="{{$delault_limit->value}}" required>
         </div>
         <div class="box-footer clearfix pull-right">   
          <button type="submit" class="btn btn-outline-success btn-sm" id=""><i class="fa fa-check" aria-hidden="true"></i> {{ __("Apply")}}</button>
        </div>
       </form>              
      </div>
      {{-- ----------------------------------------------------- --}}
      <div class="card card-body">
        <div><h6><i class="fa fa-sliders"></i>&nbsp;Default Lending Period</h6></div>
       <form method="POST" action="{{ route('update_period') }}">
        {{ csrf_field() }}
         <div class="form-group">
           <label for="theme">Period (days):</label>
           <input type="text" class="form-control mb-1" id="default_period" name="default_period" value="{{$delault_period->value}}" required>
         </div>
         <div class="box-footer clearfix pull-right">   
          <button type="submit" class="btn btn-outline-success btn-sm" id=""><i class="fa fa-check" aria-hidden="true"></i> {{ __("Apply")}}</button>
        </div>
       </form>              
      </div>
      {{-- ---------------------------------------------------- --}}
      <div class="card card-body ">
        <div><h6><i class="fa fa-sliders"></i>&nbsp;Fine Rate</h6></div>
       <form method="POST" action="{{ route('update_fine') }}">
        {{ csrf_field() }}
         <div class="form-group">
           <label for="theme">Fine (per day):</label>
           <input type="text" class="form-control mb-1" id="fine_rate" name="fine_rate" value="{{$fine_rate->value}}" required>
         </div>
         <div class="box-footer clearfix pull-right">   
          <button type="submit" class="btn btn-outline-success btn-sm" id=""><i class="fa fa-check" aria-hidden="true"></i> {{ __("Apply")}}</button>
        </div>
       </form>              
      </div>
      {{-- ---------------------------------------------------- --}}

    <div class="card card-body">
        <div class="row text-center">
            <div class="col-md-12 col-sm-6 text-left"> 
                <h6> <i class="fa fa-sliders"></i>&nbsp;Catagory wise Lending Settings</h6>
            </div>  
        </div>
        <div class="form-row">
        <div class="table-responsive">
              
            <table class="table table-hover table-bordered" id="book_datatable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" style="width: 30%">Member Category</th>
                            <th scope="col" style="width: 20%">Lending Limit</th>
                            <th scope="col" style="width: 20%">Lending Period (days)</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                    @foreach ($details as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->member_cat->$category}}</td>
                            <td>{{ $data->lending_limit }}</td>
                            <td>{{ $data->lending_period }}</td>
                            <td>
                            @can('lending_setting-edit')
                            <a class="btn btn-sm btn-outline-info " data-toggle="modal" data-target="#data_update" data-detail_id="{{ $data->id }}" data-detail_category="{{ $data->member_cat->$category }}" data-detail_limit="{{ $data->lending_limit }}" data-detail_period="{{ $data->lending_period }}">
                                <i class="fa fa-pencil" ></i>&nbsp;Edit
                            </a>
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


<!--Update Modal -->
<div class="modal fade" id="data_update" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Update Lending Settings <span id="to_updateName"></span></h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('update_lending_config') }}" class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <input type="hidden" id="id_update" name="id_update">
                <div class="modal-body">
                    <div class="row form-group">
                        <label for="category">Member Category:</label>
                        <input type="text" class="form-control mb-1" id="category" name="category" value="" disabled >
                        <label for="limit">Lending Limit</label>
                        <input type="text" class="form-control mb-1" id="limit" name="limit" value="" required>     
                        <label for="period">Lending Period (days)</label>
                        <input type="text" class="form-control mb-1" id="period" name="period" value="" required>     
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


@endsection
@section('script')
<script>

$(document).ready(function()
{
    

    $('#data_update').on('show.bs.modal', function (event) {
       
        var button = $(event.relatedTarget) 
        var _id = button.data('detail_id') 
        var category = button.data('detail_category') 
        var limit = button.data('detail_limit') 
        var period = button.data('detail_period') 
        
        $('#id_update').val(_id);
        $('#category').val(category);
        $('#limit').val(limit);
        $('#period').val(period);

    });



});


</script>

@endsection

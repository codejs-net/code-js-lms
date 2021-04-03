@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$db_locale = session()->get('db_locale');
$category="category".$db_locale;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Setting&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-info"></i> Lending Setting&nbsp;</a></li>
</ol>
</nav>

        <!-- Main content -->
<div class="container">
    <div class="card card-body">
        <div class="row text-center">
            <div class="col-md-12 col-sm-6 text-center"> 
                <h5> <i class="fa fa-object-group"></i>&nbsp;Lending Settings</h5>
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
                            @can('setting-edit')
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

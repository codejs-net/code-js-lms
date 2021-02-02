@extends('layouts.app')


@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Books&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-info"></i> Book Details&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
        <a href="{{ route('books_category.index') }}" class="btn btn-outline-success ml-2" type="button">Book Category</a>
            <a href="{{ route('books_language.index') }}"class="btn btn-outline-success ml-2" type="button">Book Language</a>
            <a href="{{ route('books_dd.index') }}"class="btn btn-outline-success ml-2" type="button">Book DD</a>
            <a href="{{ route('books_publisher.index') }}"class="btn btn-outline-success ml-2" type="button">Book Publisher</a>
            <a href="{{ route('books_medium.index') }}"class="btn btn-outline-success ml-2" type="button">Book Medium</a>
            <a href=""class="btn btn-outline-success mr-2" type="button">Book Edition</a>
            <a href=""class="btn btn-outline-success mr-2" type="button">Book Rack</a>
            <a href=""class="btn btn-outline-success mr-2" type="button">Book Rack Floor</a>
        </form>
    </nav>
    </div>
    
    
</div>

             <!-- Main content -->
<div class="container-fluid bg-white">
    <div class="card-body">
        <div class="row text-center">
            <div class="col-md-11 col-sm-6 text-center"> 
                <h4> <i class="fa fa-object-group"></i>&nbsp;Book Category</h4>
            </div>  
            <div class="col-md-1 col-sm-6 text-right">
                <h4><a class="btn btn-primary text-white" data-toggle="modal" data-target="#book_detail_create" ><i class="fa fa-plus" ></i>&nbsp;New</a></h4>   
            </div>
        </div>
        <div class="form-row">
        <div class="table-responsive">               
            <table class="table table-hover table-bordered" id="book_datatable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col" style="width: 30%">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                    @foreach ($details as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->$category }}</td>
                           
                            <td>
                               
                            <a class="btn btn-success text-white" data-toggle="modal" data-target="#book_detail_show" data-detail_id="{{ $data->id }}" data-detail_name="{{ $data->$category }}"><i class="fa fa-eye" ></i>&nbsp;Show</a>
                            @can('book_details-edit')
                            <a class="btn btn-info text-white" data-toggle="modal" data-target="#book_detail_update" data-detail_id="{{ $data->id }}" data-detail_name_si="{{ $data->category_si }}" data-detail_name_ta="{{ $data->category_ta }}" data-detail_name_en="{{ $data->category_en }}"><i class="fa fa-pencil" ></i>&nbsp;Edit</a>
                            @endcan
                            @can('book_details-delete')
                            <a class="btn btn-danger text-white" data-toggle="modal" data-target="#book_detail_delete" data-detail_id="{{ $data->id }}" data-detail_name="{{ $data->$category }}"><i class="fa fa-trash" ></i>&nbsp;Delete</a>
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






<!--show Modal -->
<div class="modal fade" id="book_detail_show" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h4 class="modal-title" id="modaltitle">Show Details</h4>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
                <div class="modal-body">
                
                    <div class="row form-group">
                        
                        <div class="col-md-12">
                            <h5><span>ID : &nbsp;</span><span class="badge badge-info" id="id_show"></span></h5>
                            <h5 class="text-indigo"><span>Category : &nbsp;</span><span id="name_show"></span></h5>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   
                </div>
        
        </div>
    </div>
</div>
<!-- end show model -->

<!--Create Modal -->
<div class="modal fade" id="book_detail_create" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h4 class="modal-title" id="modaltitle">Create Book Category</h4>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('books_category.store') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="row form-group">
                        <label for="book_detail">Category</label>
                        <input type="text" class="form-control mb-1" id="name_si" name="name_si" value="" placeholder="Name in Sinhala" >   
                        <input type="text" class="form-control mb-1" id="name_ta" name="name_ta" value="" placeholder="Name in Tamil" >
                        <input type="text" class="form-control mb-1" id="name_ta" name="name_ta" value="" placeholder="Name in English" >           
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> &nbsp; Save</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- end Create model -->
<!--Update Modal -->
<div class="modal fade" id="book_detail_update" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h4 class="modal-title" id="modaltitle">Update Book Category - <span id="to_updateName"></span></h4>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('update_book_cat') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="row form-group">
                        <label for="book_detail">Category</label>
                        <input type="hidden" id="id_update" name="id_update">
                        <input type="text" class="form-control mb-1" id="name_update_si" name="name_update_si" value="" placeholder="Name in Sinhala" >   
                        <input type="text" class="form-control mb-1" id="name_update_ta" name="name_update_ta" value="" placeholder="Name in Tamil" >
                        <input type="text" class="form-control mb-1" id="name_update_en" name="name_update_en" value="" placeholder="Name in English" >          
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> &nbsp; Update</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- end update model -->

<!--Delete Modal -->
<div class="modal fade" id="book_detail_delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h4 class="modal-title" id="modaltitle">Delete Book Category</h4>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('delete_book_cat')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="id_delete" name="id_delete">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h4><label type="text"  id="name_delete"></label></h4>
                        </div>
                        <div class="col-md-8">
                            <h5 id="modallabel">Are you sure Remove Book ? </h5>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> &nbsp; Delete</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- end Delete model -->

@endsection
@section('script')
<script>

$(document).ready(function()
{
    $('#book_detail_show').on('show.bs.modal', function (event) {
       
       var button = $(event.relatedTarget) 
       var d_id = button.data('detail_id') 
       var d_name = button.data('detail_name')
       $('#id_show').html(d_id);
       $('#name_show').html(d_name);
   });

    $('#book_detail_update').on('show.bs.modal', function (event) {
       
        var button = $(event.relatedTarget) 
        var d_id = button.data('detail_id') 
        var d_name_si = button.data('detail_name_si');
        var d_name_ta = button.data('detail_name_ta');
        var d_name_en = button.data('detail_name_en');
        $('#id_update').val(d_id);
        $('#name_update_si').val(d_name_si);  $('#name_update_ta').val(d_name_ta);  $('#name_update_en').val(d_name_en);
        $('#to_updateName').html(d_id);

        @if($locale=="si")
        $("#name_update_si").prop('required',true);
        @elseif($locale=="ta")
        $("#name_update_ta").prop('required',true);
        @elseif($locale=="en")
        $("#name_update_en").prop('required',true);
        @endif

    });

    $('#book_detail_delete').on('show.bs.modal', function (event) {
       
       var button = $(event.relatedTarget) 
       var d_id = button.data('detail_id') 
       var d_name = button.data('detail_name')
       $('#id_delete').val(d_id);
       $('#name_delete').html(d_name);
   });

   $('#book_detail_create').on('show.bs.modal', function (event) {
       
        @if($locale=="si")
        $("#name_si").prop('required',true);
        @elseif($locale=="ta")
        $("#name_ta").prop('required',true);
        @elseif($locale=="en")
        $("#name_en").prop('required',true);
        @endif
   });

});



</script>

@endsection
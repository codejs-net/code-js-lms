@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Resources&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-search"></i> Search Resources&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h5> <i class="fa fa-search"> Search Resources</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right">
            <h5><a href="{{ route('books.create') }}" class="btn btn-info btn-md" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; New</a></h5>  
        </div>
    </div>
    
</div>

        <!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
            <div class="form-row">   
            <div class="table-responsive">               
            <table class="table table-hover" id="book_datatable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Book ID</th>
                            <th scope="col">Accession No</th>
                            <!-- <th scope="col">Barcode</th> -->
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                            <th scope="col">Language</th>
                            <th scope="col">Publisher</th>
                            <th scope="col">Place</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                    <!-- @push('scripts')
                    
                    @endpush -->
                    </tbody>
            </table>
        </div>
        </div>               

    </div>
</div>

<!-- --------------------------start  modal delete------------------------------- -->
   
<div class="modal fade" id="book_delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Remove Book</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="post" action="{{ route('delete_book')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="book_id" name="book_id">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h5 id="modallabel">Are you sure Remove Book </h5>
                        </div>
                        <div class="col-md-8">
                            <h5><label type="text"  id="bookname"></label></h5>
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
<!-- ---------------------end delete Model------------------------------------- -->

@php
$lang = session()->get('db_locale');
@endphp

@endsection



@section('script')
<script>

    $(document).ready(function()
    {
    // ----------view-------------------------
    $('#book_datatable').DataTable({
    processing: true,
    serverSide: true,

    ajax:{
    url: "{{ route('books.index') }}",
    },
    columns:[
        {data: "id",name: "Book ID"},
        {data: "accessionNo",name: "accessionNo"},
        // {data: "barcode",name: "barcode",orderable: false},
        {data: "book_title<?php echo $lang; ?>",name: "book_title"},
        {data: "authors<?php echo $lang; ?>",name: "authors"},
        {data: "category<?php echo $lang; ?>",name: "category"},
        {data: "language<?php echo $lang; ?>",name: "language"},
        {data: "publisher<?php echo $lang; ?>",name: "publisher"},
        {data: "rackno",name: "rackno"},
        {data: "status",name: "status",orderable: false},
        {data: "action",name: "action",orderable: false}
    ],
    "createdRow": function( row, data, dataIndex ) {
        if ( data['status'] == "Removed" ) {        
            $('td', row).addClass('bg-red');
            //$(row).addClass('bg_red');
        }

        }
    });


    // start book delete function
$('#book_delete').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 

var b_id = button.data('bookid') 
var b_title = button.data('book_title')
document.getElementById("book_id").value= b_id; 
document.getElementById("bookname").innerHTML = b_title;
})
// end book delete function


});



</script>

@endsection

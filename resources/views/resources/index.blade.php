@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$center="name".$lang;
$publisher="publisher".$lang;

@endphp

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
<div class="container-fluid">
<div class="card card-body">
    <div class="row">
        <div class="col-md-2 col-sm-2 text-center">
                <div class="form-group">
                    <!-- <label for="category">Category</label> -->
                    <select class="form-control mb-3"name="category" id="category" value="">
                        <option value="All" selected>All Categories</option>
                            @foreach($cat_data as $item)
                                <option value="{{ $item->id }}" style="background-image:url(images/{{ $item->image}});">&nbsp;{{ $item->$category}}</option>
                            @endforeach
                    </select>     
            </div>
        </div>
        <div class="col-md-8 col-sm-8 text-center">
            <div class="form-group text-center">
                <!-- <label for="category">Type</label> -->
                <span id="type_bar"></span>
            </div>
        </div>

        <div class="col-md-2 col-sm-2 text-center">
                <div class="form-group">
                    <select class="form-control mb-3"name="center" id="center" value="">
                        <option value="All" selected>All Centers</option>
                            @foreach($center_data as $item)
                                <option value="{{ $item->id }}">&nbsp;{{ $item->$center}}</option>
                            @endforeach
                    </select>     
            </div>
        </div>

    </div>
</div>   
</div>

        <!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
            <div class="form-row">   
            <div class="table-responsive">               
            <table class="table table-hover" id="resource_datatable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Resource ID</th>
                            <th scope="col">Resource</th>
                            <th scope="col">Accession No</th>
                            <th scope="col">ISBN/ISSN</th>
                            <th scope="col">Title</th>
                            <th scope="col">Creator</th>
                            <th scope="col">DDC</th>
                            <th scope="col">Publisher</th>
                            <th scope="col">Price</th>
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
    $('#resource_datatable').DataTable({
    processing: true,
    serverSide: true,

    ajax:{
    url: "{{ route('resources.index') }}",
    },
    columns:[
        {data: "id",name: "ResourceID"},
        {data: "image",name: "Resource"},
        {data: "accessionNo",name: "AccessionNo"},
        {data: "standardnumber",name: "standardnumber"},
        {data: "title<?php echo $lang; ?>",name: "Title"},
        {data: "creator<?php echo $lang; ?>",name: "Creator"},
        {data: "ddc<?php echo $lang; ?>",name: "category"},
        {data: "publisher<?php echo $lang; ?>",name: "publisher"},
        {data: "price",name: "price"},
        {data: "status",name: "status",orderable: false},
        {data: "action",name: "action",orderable: false}
    ],
    "createdRow": function( row, data, dataIndex ) {
        if ( data['status'] == "Removed" ) {        
            $('td', row).addClass('bg-warning');
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


load_type("All");


});


function load_type(d_cat)
{
        op="";
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('load_resource_type')}}", 
            data: { d_cat: d_cat, },
            success:function(data){
                for(var i=0;i<data.length;i++)
                {
                    op+='<a href="filter_by_type/'+data[i].id+'" class="btn btn-default btn-sm ml-2 mb-2"><img class="img-icon" src="images/'+data[i].image+'">&nbsp;'+
                        @if($locale=="si") data[i].type_si 
                        @elseif($locale=="ta") data[i].type_ta 
                        @elseif($locale=="en") data[i].type_en
                        @endif +
                        '&nbsp;</a>';
                }
                $("#type_bar").html(op);
               
            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            }
        })
        // --------------------------------------------------------
}

$("#category").change(function () {
     var d_cat=$('#category').val();
     load_type(d_cat);  
});



</script>

@endsection

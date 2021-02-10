@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$center="name".$lang;
$publisher="publisher".$lang;
$title="title".$lang;
$creator="name".$lang;

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
        <div class="col-md-10 col-sm-6 text-center"> 
            <h5> <i class="fa fa-search"> Search Resources</i></h5>
        </div>  
        <div class="col-md-2 col-sm-6 text-right">
            <h5>
            <a href="{{ route('resource.create') }}" class="btn btn-primary btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; New</a>
            @can('data-import')
                <a class="btn btn-sm btn-outline-primary bg-indigo " data-toggle="modal" data-target="#data_import" ><i class="fa fa-file-excel-o" ></i>&nbsp;Import</a>
            @endcan
            </h5>  
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
            <div class="table-responsive"style="overflow-x: auto;">               
            <table  class="table display nowrap table-hover" width="100%" cellspacing="0" id="resource_datatable">
                    <thead class="bg-gradient-secondary">
                        <tr>
                            <th scope="col">Resource ID</th>
                            <th scope="col">Resource</th>
                            <th scope="col">Accession No</th>
                            <!-- <th scope="col">ISBN/ISSN</th> -->
                            <th scope="col"style="width: 20%">Title</th>
                            <th scope="col"style="width: 15%">Creator</th>
                            <th scope="col">DDC</th>
                            <!-- <th scope="col">Publisher</th> -->
                            <!-- <th scope="col">Price</th> -->
                            <th scope="col">Status</th>
                            <th scope="col"style="width: 10%">Action</th>
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

<!---------------------------import Modal --------------------------------------->
<div class="modal fade" id="data_import" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Import Resources</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" method="POST" enctype="multipart/form-data" action="{{ route('import_resource') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="modal-body">

                <div class="custom-file form-group text-center m-3">
                    <div class="col-md-10">
                        <input type="file" class="form-control-file custom-file-input" id="file" name="file" required>
                        <label class="custom-file-label " for="customFile">Choose Excel file</label>
                    </div>
                    <div class="col-md-2">
                    @can('code-import')
                    @endcan
                </div>
            </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> &nbsp; Import Data</button>
                </div>
            </form>
           
        </div>
    </div>
</div>

@php
$lang = session()->get('db_locale');
@endphp

@endsection



@section('script')
<script>

$(document).ready(function()
{
    // ----------view-------------------------
   


    // start book delete function
$('#book_delete').on('show.bs.modal', function (event) 
{

var button = $(event.relatedTarget) 

var b_id = button.data('bookid') 
var b_title = button.data('book_title')
document.getElementById("book_id").value= b_id; 
document.getElementById("bookname").innerHTML = b_title;
})
// end book delete function


load_type("All");

var route="{{ route('resource.index') }}";
var cdta=$("#category").val();
load_datatable(route,cdta);


});


function load_type(cdta)
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
            data: { cdta: cdta, },
            success:function(data){
                for(var i=0;i<data.length;i++)
                {
                    op+='<a href="filter_by_type/'+data[i].id+'" class="btn btn-default btn-sm ml-2 mb-2"><img class="img-icon" src="images/'+data[i].image+'"><br>'+
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
function load_by_category(d_cat)
{
        op="";
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "filter_by_category", 
            data: { d_cat: d_cat, },
            success:function(data){
             
            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            }
        })
        // --------------------------------------------------------
}

$("#category").change(function () {
    var cdta=$("#category").val();
    load_type(cdta);  
    $('#resource_datatable').DataTable().clear().destroy();
    var route="{{ route('resource.index') }}";
    load_datatable(route,cdta);
});

function load_datatable(route,cdta)
{
    $('#resource_datatable').DataTable({
    columnDefs: [
        {"targets": [0],
        "visible": false,
        "searchable": false},
        // { type: 'natural', targets: '_all' }
    ],
    responsive: true,
    processing: true,
    serverSide: false,
    ordering: true,
    searching: true,

    ajax:{
        type: "GET",
        dataType : 'json',
        data: { 
            cdta: cdta, 
        },
        url: route,
    },
    pageLength: 15,
    
    columns:[
        {data: "id",name: "ResourceID",orderable: true},
        {data: "images",name: "images",orderable: false},
        {data: "accessionNo",name: "AccessionNo",orderable: true},
        // {data: "standard_number",name: "standard_number",orderable: true},
        {data: "title<?php echo $lang; ?>",name: "title"},
        {data: "name<?php echo $lang; ?>",name: "creator"},
        {data: "ddc",name: "ddc",orderable: true},
        // {data: "publisher<?php echo $lang; ?>",name: "publisher",orderable: false},
        // {data: "price",name: "price",orderable: true},
        {data: "status",name: "status",orderable: true},
        {data: "action",name: "action",orderable: false}
    ],
    // order:[[4,"asc"]],
    "createdRow": function( row, data, dataIndex ) {
        if ( data['status'] == "Removed" ) {        
            $('td', row).addClass('font-weight-bold');
            }
        }
    });
}

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


</script>

@endsection

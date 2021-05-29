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
$language="language".$lang;
$dd_class="class".$lang;
$dd_devision="devision".$lang;
$dd_section="section".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resource.index') }}"><i class="fa fa-folder-open"></i> {{__('Resources')}}&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-search"></i> {{__('Search Resources')}}&nbsp;</a></li>
</ol>
</nav>{{__('')}}
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-6 col-sm-6 col-12 text-left"> 
            <h5> <i class="fa fa-search ml-4 pl-2"> {{__('Search Resources')}}</i></h5>
        </div>  
        <div class="col-md-6 col-sm-6 col-12 text-right pb-2">
            <form class="form-inline pull-right" action="{{ route('report_recource_filter') }}" id="report_form" method="POST">
            {{ csrf_field() }}
                <input type="hidden" name="select_catg" class="select_catg">
                <input type="hidden" name="select_cent" class="select_cent">
                <input type="hidden" name="select_type" class="select_type">
                <!-- <a href="{{ route('create_resource') }}" class="btn btn-sm btn-js" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; New</a> -->
                <button type="submit" class="btn btn-outline-warning btn-sm text-dark mr-2"><i class="fa fa-file-pdf-o"></i>&nbsp; {{__('PDF')}}</button>
            </form>
            <form class="form-inline pull-right" action="{{ route('export_recource') }}" id="export_form" method="POST">
            {{ csrf_field() }}
                <input type="hidden" name="export_catg" class="select_catg">
                <input type="hidden" name="export_cent" class="select_cent">
                <input type="hidden" name="export_type" class="select_type">
                <button type="submit" class="btn btn-outline-warning btn-sm text-dark mr-2" name="rpt_excel" id="rpt_excel" ><i class="fa fa-file-excel-o"></i>&nbsp; {{__('Excel')}}</button>
            </form>
            @can('data-import')
                <!-- <a class="btn btn-sm btn-js" data-toggle="modal" data-target="#data_import" ><i class="fa fa-file-excel-o" ></i>&nbsp;Import</a> -->
            @endcan
        </div>
    </div>
    
</div>
<div class="container-fluid">
<div class="card p-2">
    <div class="row mt-3">
        <div class="col-md-2 col-sm-2 text-left">
            <div class="form-group js-select-box">
                <div class="ml-2 mr-2">
                    <span for="category">{{__('Category :')}}</span>
                    <select class="form-control form-control-sm mb-3"name="category" id="category" value="">
                        <option value="All" selected>{{__('All Categories')}}</option>
                            @foreach($cat_data as $item)
                                <option value="{{ $item->id }}" style="background-image:url(images/{{ $item->image}});">&nbsp;{{ $item->$category}}</option>
                            @endforeach
                    </select>     
                    </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 text-center">
            <div class="form-group text-center">
                <!-- <label for="category">Type</label> -->
                <div id="type_bar"></div>
            </div>
        </div>

        <div class="col-md-2 col-sm-2 text-left">
                <div class="form-group js-select-box">
                <div class="ml-2 mr-2">
                <span for="category">{{__('Center :')}}</span>
                    <select class="form-control form-control-sm mb-3"name="center" id="center" value="">
                        <!-- <option value="All" selected>All Centers</option> -->
                            @foreach($center_data as $item)
                                <option value="{{ $item->center->id }}">&nbsp;{{ $item->center->$center}}</option>
                            @endforeach
                    </select> 
                </div>    
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
            <table  class="table display wrap table-hover" width="100%" cellspacing="0" id="resource_datatable">
                    <thead class="js-tbl-header">
                        <tr class="js-tr">
                            <th scope="col">{{__('Resource ID')}}</th>
                            <th scope="col">{{__('Resource')}}</th>
                            <th scope="col">{{__('Accession No')}}</th>
                            <!-- <th scope="col">ISBN/ISSN</th> -->
                            <th scope="col"style="width: 20%">{{__('Resource Title')}}</th>
                            <th scope="col"style="width: 20%;">{{__('Creator/Author')}}</th>
                            <th scope="col">{{__('DDC')}}</th>
                            <!-- <th scope="col">Publisher</th> -->
                            <!-- <th scope="col">Price</th> -->
                            <th scope="col">{{__('Status')}}</th>
                            <th scope="col"style="width: 10%">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody class="tbody_resource_main">  
                    <!-- @push('scripts')
                    
                    @endpush -->
                    </tbody>
            </table>
        </div>
        </div>               

    </div>
</div>

<!-- --------------------------start  modal delete------------------------------- -->
   
<div class="modal fade" id="resource_delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">{{__('Remove Library Resources')}}</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="post" action="{{ route('delete_resource')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="delete_resource_id" name="delete_resource_id">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h5 id="modallabel">{{__('Are you sure Remove Resources')}} </h5>
                        </div>
                        <div class="col-md-8">
                            <h5><label type="text"  id="delete_resource_name"></label></h5>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> &nbsp; {{__('Delete')}}</button>
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
                    <h5 class="modal-title" id="modaltitle">{{__('Import Resources')}}</h5>
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
                        <label class="custom-file-label " for="customFile">{{__('Choose Excel file')}}</label>
                    </div>
                    <div class="col-md-2">
                    @can('code-import')
                    @endcan
                </div>
            </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> &nbsp; {{__('Import Data')}}</button>
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
load_type("All");

var centerdata=$("#center").val();
$("#category").val("All");
var typedata="All";
var catdata="All"
$(".select_cent").val(centerdata);
$(".select_catg").val(catdata);
$(".select_type").val(typedata);
load_datatable(catdata,centerdata,typedata);

// start resource delete function
$('#resource_delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var b_id = button.data('resoid') 
    var b_title = button.data('resotitle')
    document.getElementById("delete_resource_id").value= b_id; 
    document.getElementById("delete_resource_name").innerHTML = b_title;
    })
// end book delete function

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
                op+='<button type="button" value="All" class="btn btn-white  elevation-2 btntype"><img class="typ-icon" src="images/all_type.png"><br>{{trans('All')}}&nbsp;</button>';
                for(var i=0;i<data.length;i++)
                {
                    op+='<button type="button" value="'+data[i].id+'" class="btn btn-white  elevation-2 btntype"><img class="typ-icon" src="images/'+data[i].image+'"><br>'+
                        @if($locale=="si") data[i].type_si 
                        @elseif($locale=="ta") data[i].type_ta 
                        @elseif($locale=="en") data[i].type_en
                        @endif +
                        '&nbsp;</button>';
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
    var catdata=$("#category").val();
    var centerdata=$("#center").val();
    var typedata="All";
    load_type(catdata);  

    $(".select_cent").val(centerdata);
    $(".select_catg").val(catdata);
    $(".select_type").val(typedata);

    $('#resource_datatable').DataTable().clear().destroy();
    load_datatable(catdata,centerdata,typedata);
});

$("#center").change(function () {
    var catdata=$("#category").val();
    var centerdata=$("#center").val();
    var typedata="All";

    $(".select_cent").val(centerdata);
    $(".select_catg").val(catdata);
    $(".select_type").val(typedata);

    $('#resource_datatable').DataTable().clear().destroy();
    load_datatable(catdata,centerdata,typedata);
});


$(document).on("click", ".btntype", function(){
    var catdata=$("#category").val();
    var centerdata=$("#center").val();
    var typedata=$(this).val();

    $(".select_cent").val(centerdata);
    $(".select_catg").val(catdata);
    $(".select_type").val(typedata);

    $('#resource_datatable').DataTable().clear().destroy();
    load_datatable(catdata,centerdata,typedata);


});

function load_datatable(catdata,centerdata,typedata)
{

    $('#resource_datatable').DataTable({
        columnDefs: [
        {"targets": [0],
        "visible": false,
        "searchable": false},
        ],
        responsive: true,
        processing: true,
        serverSide: false,
        ordering: false,
        searching: true,
        cache: true,
        deferRender: true,

    ajax:{
        type: "GET",
        dataType : 'json',
        data: { 
            catdata: catdata,
            centerdata: centerdata,
            typedata: typedata,
        },
        url: "{{ route('resource.index') }}",
    },
    // pageLength: 15,
    
    columns:[
        {data: "id",name: "ResourceID",orderable: true},
        {data: "images",name: "images",orderable: false},
        {data: "accessionNo",name: "AccessionNo",orderable: true},
        // {data: "standard_number",name: "standard_number",orderable: true},
        {data: "title<?php echo $lang; ?>",name: "title"},
        {data: "creator",name: "creator"},
        {data: "ddc",name: "ddc",orderable: true},
        // {data: "publisher",name: "publisher",orderable: false},
        // {data: "price",name: "price",orderable: true},
        {data: "status",name: "status",orderable: false},
        {data: "action",name: "action",orderable: false}
    ],
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


// $("#rpt_excel").click(function () {
//     var catdata=$("#select_catg").val();
//     var centerdata=$("#select_cent").val();
//     var typedata=$("#select_type").val();

//     $.ajaxSetup({
//         headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//    $.ajax({
//            type: "POST",
//            dataType : 'json',
//            url: "{{ route('export_recource') }}", 
//            data: { 
//             catdata: catdata,
//             centerdata: centerdata,
//             typedata: typedata,
//             },

//            beforeSend: function(){
//            },

//            success:function(data){
//                if(data.massage=="success"){
//                 toastr.success('Data Export Successfully');
//                }
//                if(data.massage=="error"){
//                 toastr.error('Data Export faild');
//                }  
//            },
//            error:function(data){
//                toastr.error('Survey Finalized faild Plese try again')
//            },
//            complete:function(data){

//            }
//        })

// });




</script>

@endsection

@extends('layouts.app')
@section('style')
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
@endsection
@section('content')
@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$type="type".$lang;
$center="name".$lang;
$center_indix="center".$lang;
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
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Reports&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-search"></i> Reports&nbsp;</a></li>
</ol>
</nav>

<div class="row mb-2">
    <div class="col-md-12 col-sm-12 ml-3 text-left"> 
        <h5> <i class="fa fa-file-text">&nbsp;Indexing Resource Report</i></h5>
    </div>  
</div> 

<div class="container-fluid">
<div class="card">
    <div class="row">
        <div class="col-md-9 pl-4 pr-4">
            <div class="row pl-4 pt-3">
                <label>Provide Order and Resource Range to Genarate Report (example: 1-1000)</label>
            </div>
            <div class="row pl-3">
                <div class="col-md-4 col-sm-4 text-left">
                    <div class="form-group js-select-box">
                        <div class="ml-2 mr-2 fdiv">
                            <span for="indexing" class="">Order By</span>
                            <select class="form-control form-control-sm mb-3"name="select_indexing" id="select_indexing">
                                <option value="id" selected>ID</option>
                                <option value="accessionNo">Accession Number</option>
                                <option value="standard_number">Standard Number</option>
                                <option value="{{$title}}">Title</option>
                                <option value="{{$category}}">Category</option>
                                <option value="{{$type}}">Type</option>
                                <option value="{{$creator}}">Creator</option>
                                <option value="{{$publisher}}">Publisher</option>
                                <option value="{{$language}}">Language</option>
                                <option value="{{$center_indix}}">Center</option>
                                <option value="class_code">DD Class</option>
                                <option value="devision_code">DD Devision</option>
                                <option value="section_code">DD Section</option>
                                <option value="ddc">DDC</option>
                                <option value="price">Price</option>
                                <option value="purchase_date">Purchase Date</option>
                                <option value="edition">Edition</option>
                                <option value="publishyear">Publish Year</option>
                                <option value="phydetails">Physical Details</option>

                            </select>     
                            </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 text-center">
                    <div class="input-group mb-3 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">From</span>
                        </div>
                        <input type="text" name="txt_start" id="txt_start" class="form-control" placeholder="Start ID" aria-label="Start Number" aria-describedby="basic-addon1"required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 text-center">
                    <div class="input-group mb-3 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">To</span>
                        </div>
                        <input type="text" name="txt_end" id="txt_end" class="form-control" placeholder="End ID" aria-label="End Number" aria-describedby="basic-addon1"required>
                    </div>
                </div>
            </div>
            <div class="row pl-4 pt-1">
                <label>{{__('Total Resources :')}} {{$reso_count}}</label>
            </div>
            
        </div>
        <div class="col-md-3 col-3 p-2">
            <div class="elevation-2 card1">
              
                <h5>Indexing Resources Report</h5>
                 <p class="small">Range Resources Report in LMS. Provide Number Range and Download PDF or Excel</p>
                 <form class="form-inline pull-left" action="{{ route('report_recource_indexing') }}" id="report_indexing_form" class="indexing_form" method="POST">
                    {{ csrf_field() }}
                        <input type="hidden" name="resource_from" class="resource_from">
                        <input type="hidden" name="resource_to" class="resource_to">
                        <input type="hidden" name="resource_order" class="resource_order">
                        <button type="submit" class="btn-pdf btn btn-secondary btn-sm elevation-2 mr-2">
                            <span class="pdf-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <span class="spinner-border spinner-border-sm text-white loader" role="status" aria-hidden="true"  style="display: none;"></span>&nbsp; PDF
                        </button>
                </form>
                <form class="form-inline" action="{{ route('export_recource_indexing') }}" id="export_indexing_form" class="indexing_form" method="POST">
                    {{ csrf_field() }}
                        <input type="hidden" name="resource_from" class="resource_from">
                        <input type="hidden" name="resource_to" class="resource_to">
                        <input type="hidden" name="resource_order" class="resource_order">
                        <button type="submit" class="btn-excel btn btn-primary btn-sm elevation-2 mr-2">
                            <span class="excel-icon"><i class="fa fa-file-excel-o"></i></span>
                            <span class="spinner-border spinner-border-sm text-white loader" role="status" aria-hidden="true"  style="display: none;"></span>&nbsp; Excel
                        </button>
                </form>
            </div>
         </div>
    </div>

</div>
<div class="row mb-2">
    <div class="col-md-12 col-sm-12 ml-2 text-left"> 
        <h5> <i class="fa fa-file-text">&nbsp;Filterd Resource Report</i></h5>
    </div>  
</div>
<div class="card">
     <!-- ======================================filter Search=========================================== -->

     <div class="row js-border-radius-2 m-2">
        <div class="col-md-9 col-9">
        <span for="" class="ml-3 mt-1">Filter By</span>
       {{-- ------------- --}}
       <span id="ftag"></span>
      
        {{-- ------------- --}}
        <div class="col-md-12 p-3">
        <div class="js-filter-box elevation-2">
            <div class="col ml-3">
            <a  class="filter_section" href="" data-toggle="collapse" data-target="#center_filter"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<u>Center Filter</u></a>
            </div>
            <div id="center_filter" class="collapse">
                <div class="row mt-3 pl-3">
                    <div class="col-md-12 col-12">
                        <div class="form-group js-select-box ">
                            <div class="ml-2 mr-2 fdiv">
                                <span for="category" class="fname">Center</span>
                                <select class="form-control form-control-sm mb-3 filter"name="center" id="center" value="">
                                    <option value="All" selected>All Centers</option>
                                        @foreach($center_data as $item)
                                            <option value="{{ $item->center_id }}">&nbsp;{{ $item->center->$center}}</option>
                                        @endforeach
                                </select> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

    <div class="js-filter-box elevation-2">
    <div class="col ml-3">
        <a class="filter_section" href="" data-toggle="collapse" data-target="#type_filter"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<u>Category/Type Filter</u></a>
    </div>
    <div id="type_filter" class="collapse">
        <hr>
        <div class="row mt-1 pl-3">
            <div class="col-md-3 col-sm-3 text-left">
                <div class="form-group js-select-box">
                    <div class="ml-2 mr-2 fdiv">
                        <span for="category" class="fname">Category</span>
                        <select class="form-control form-control-sm mb-3 filter"name="category" id="category" value="">
                            <option value="All" selected>All Categories</option>
                                @foreach($cat_data as $item)
                                    <option value="{{ $item->id }}" style="background-image:url(images/{{ $item->image}});">&nbsp;{{ $item->$category}}</option>
                                @endforeach
                        </select>     
                        </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 text-center">
                <div class="form-group text-center">
                    <!-- <label for="category">Type</label> -->
                    <div id="type_bar"></div>
                </div>
            </div>
        </div>
    </div>
    </div>  

    <div class="js-filter-box elevation-2">
        <div class="col ml-3">
        <a  class="filter_section" href="" data-toggle="collapse" data-target="#creator_filter"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<u>Creator/Publisher Filter</u></a>
        </div>
        <div id="creator_filter" class="collapse">
        <div class="form-row mt-3 pl-3">

            <div class="col-md-6">
                <div class="form-group js-select-box ">
                    <div class="ml-2 mr-2 fdiv">
                
                        <span for="publisher" class="fname">Publisher</span>
                        <select class="form-control mb-3 filter" id="resource_publisher" name="resource_publisher" value="{{old('resource_publisher')}}"required>
                        <option value="All" selected>All Publishers</option>
                        @foreach($publisher_data as $item)
                                <option value="{{ $item->id }}">{{ $item->$publisher}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group js-select-box ">
                    <div class="ml-2 mr-2 pb-3 fdiv">
                        <span for="authors" class="fname">Creator</span>
                        <select class="form-control filter" id="resource_creator" name="resource_creator" value=""required>
                            <option value="All" class="" selected>All Creators</option>
                            @foreach($creator_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->$creator}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        
        </div>
        </div>
    </div> 

    <div class="js-filter-box elevation-2">
        <div class="col ml-3">
        <a  class="filter_section" href="" data-toggle="collapse" data-target="#ddc_filter"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<u>DDC Filter</u></a>
        </div>
        <div id="ddc_filter" class="collapse">
        <div class="form-row mt-3 pl-3">
                <!-- -------------------------------------------- -->
                <div class="col-md-4">
                <div class="form-group js-select-box ">
                <div class="ml-2 mr-2 fdiv">
                        <span for="dewey_decimal" class="fname">Dewey Decimal Class</span>
                        <select class="form-control mb-3 filter" id="resource_dd_class" name="resource_dd_class" required>
                        <option value="All" selected>All</option>
                        @foreach($ddclass_data as $item)
                            <option value="{{ $item->id }}">{{ $item->$dd_class}}</option>
                        @endforeach
                        </select>
                </div>
                </div>
                </div>

                <!-- -------------------------------------------- -->
                <div class="col-md-4">
                <div class="form-group js-select-box">
                <div class="ml-2 mr-2 fdiv">
                        <span for="dewey_decimal" class="fname">Dewey Decimal Devision</span>
                        <select class="form-control mb-3 filter" id="resource_dd_devision" name="resource_dd_devision" required>
                        <option value="All" selected>All</option>
                        @foreach($dddevision_data as $item)
                            <option value="{{ $item->id }}">{{ $item->$dd_devision}}</option>
                        @endforeach
                        </select>
                </div>
                </div>
                </div>

                <!-- -------------------------------------------- -->
                <div class="col-md-4">
                <div class="form-group js-select-box">
                <div class="ml-2 mr-2 fdiv">
                        <span for="dewey_decimal" class="fname">Dewey Decimal Section</span>
                        <select class="form-control mb-3 filter" id="resource_dd_section" name="resource_dd_section" required>
                        <option value="All" selected>All</option>
                        @foreach($ddsection_data as $item)
                            <option value="{{ $item->id }}">{{ $item->section_code}}-{{ $item->$dd_section}}</option>
                        @endforeach
                        </select>
                </div>
                </div>
                </div>

                <!-- -------------------------------------------- -->
        
            </div>
        </div>
    </div> 
    </div> 
    </div>
    <div class="col-md-3 col-3 p-2 mt-4">
        <div class="elevation-2 card1">
             <h5>Filterd Resources</h5>
             <p class="small">Filterd Resources Report in LMS. You can filter resource Center wise, Type wise, creator wise, Publisher wise or Dewy Decimal wise. click Download PDF or Excel to genarate report</p>
             <form class="form-inline pull-left" action="{{ route('report_recource_filter_all') }}" id="report_filter_form" name="report_filter_form" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="select_catg" class="select_catg">
                <input type="hidden" name="select_cent" class="select_cent">
                <input type="hidden" name="select_type" class="select_type">
                <input type="hidden" name="select_creator" class="select_creator">
                <input type="hidden" name="select_publisher" class="select_publisher">
                <input type="hidden" name="select_ddclass" class="select_ddclass">
                <input type="hidden" name="select_dddevision" class="select_dddevision">
                <input type="hidden" name="select_ddsection" class="select_ddsection">
                    <button type="submit" class="btn-pdf btn btn-secondary btn-sm elevation-2 mr-2">
                        <span class="pdf-icon"><i class="fa fa-file-pdf-o"></i></span>
                        <span class="spinner-border spinner-border-sm text-white loader" role="status" aria-hidden="true"  style="display: none;"></span>&nbsp; PDF
                    </button>
            </form>
            <form class="form-inline" action="{{ route('export_recource_filter_all') }}" id="export_filter_form" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="select_catg" class="select_catg">
                <input type="hidden" name="select_cent" class="select_cent">
                <input type="hidden" name="select_type" class="select_type">
                <input type="hidden" name="select_creator" class="select_creator">
                <input type="hidden" name="select_publisher" class="select_publisher">
                <input type="hidden" name="select_ddclass" class="select_ddclass">
                <input type="hidden" name="select_dddevision" class="select_dddevision">
                <input type="hidden" name="select_ddsection" class="select_ddsection">
                    <button type="submit" class="btn-excel btn btn-primary btn-sm elevation-2 mr-2">
                        <span class="excel-icon"><i class="fa fa-file-excel-o"></i></span>
                        <span class="spinner-border spinner-border-sm text-white loader" role="status" aria-hidden="true"  style="display: none;"></span>&nbsp; Excel
                    </button>
            </form>
        </div>
     </div>
    </div> 
    <!-- ===================================================================================== -->
</div>
<div class="row mb-2">
    <div class="col-md-12 col-sm-12 ml-2 text-left"> 
        <h5> <i class="fa fa-file-text">&nbsp;Other Resource Report</i></h5>
    </div>  
</div>
<div class="card mt-4">
   <div class="row pl-2">
    <div class="col-md-3 col-3 p-2">
       <div class="elevation-2 card1 ">
            <h5>Removed Resources</h5>
            <p class="small">Removed Resources Report in Library management system. Download PDF or Excel</p>
            <form class="form-inline pull-left" action="{{ route('report_recource_filter_all') }}" id="report_remove_form" method="POST">
                {{ csrf_field() }}
                    <button type="submit" class="btn-pdf btn btn-secondary btn-sm elevation-2 mr-2">
                        <span class="pdf-icon"><i class="fa fa-file-pdf-o"></i></span>
                        <span class="spinner-border spinner-border-sm text-white loader" role="status" aria-hidden="true"  style="display: none;"></span>&nbsp; PDF
                    </button>
            </form>
            <form class="form-inline" action="{{ route('export_recource_filter_all') }}" id="export_remove_form" method="POST">
                {{ csrf_field() }}
                    <button type="submit" class="btn-excel btn btn-primary btn-sm elevation-2 mr-2">
                        <span class="excel-icon"><i class="fa fa-file-excel-o"></i></span>
                        <span class="spinner-border spinner-border-sm text-white loader" role="status" aria-hidden="true"  style="display: none;"></span>&nbsp; Excel
                    </button>
            </form>
           
       </div>
    </div>

    <div class="col-md-3 col-3 p-2">
        <div class="elevation-2 card1 ">
             <h5>Doneted Resources</h5>
             <p class="small">Doneted Resources Report in Library management system. Download PDF or Excel</p>
             <a href="" class="btn btn-secondary btn-sm elevation-2 mr-2"><i class="fa fa-file-pdf-o"></i>&nbsp; PDF</a>
            <a href="" class="btn btn-primary btn-sm elevation-2 mr-2"><i class="fa fa-file-excel-o"></i>&nbsp; Excel</a>
        </div>
     </div>

     <div class="col-md-3 col-3 p-2">
        <div class="elevation-2 card1 ">
             <h5>ReadOnly Resources</h5>
             <p class="small">ReadOnly Resources Report in Library management system. Download PDF or Excel</p>
             <a href="" class="btn btn-secondary btn-sm elevation-2 mr-2"><i class="fa fa-file-pdf-o"></i>&nbsp; PDF</a>
            <a href="" class="btn btn-primary btn-sm elevation-2 mr-2"><i class="fa fa-file-excel-o"></i>&nbsp; Excel</a>
        </div>
     </div>
 
     <div class="col-md-3 col-3 p-2">
         <div class="elevation-2 card1 ">
              <h5>Stock Resources</h5>
              <p class="small">Stock Resources Report in Library management system. Download PDF or Excel</p>
              <a href="" class="btn btn-secondary btn-sm elevation-2 mr-2"><i class="fa fa-file-pdf-o"></i>&nbsp; PDF</a>
            <a href="" class="btn btn-primary btn-sm elevation-2 mr-2"><i class="fa fa-file-excel-o"></i>&nbsp; Excel</a>
         </div>
      </div>
   
   </div>

</div>
</div>




@endsection
@section('script')
<script>
 var tag_array=[];
$(document).ready(function()
{

    load_type("All");
   
    $('#resource_creator').select2({
        theme: 'bootstrap4',
    });

    // var inputfrom = document.getElementById("txt_start");
    // inputfrom.addEventListener("keyup", function(event) {
    //     $('.resource_from').val($('#txt_start').val());  
    // });

    // var inputto = document.getElementById("txt_end");
    // inputto.addEventListener("keyup", function(event) {
    //     $('.resource_to').val($('#txt_end').val()); 
    // });

    $('.select_type').val("All");

    $('#resource_creator').on('select2:select', function (e) {
        var filter_tag= 'Creator';
        filtertag(filter_tag);
    });
   
});

$('#report_indexing_form').on('submit', function(event){
    if($('#txt_start').val()=="" && $('#txt_end').val()==""){
        event.preventDefault();
        toastr.warning("Plese Provide Resource Range to Genarate Report");
    }
    else{
        $('.resource_from').val($('#txt_start').val());  
        $('.resource_to').val($('#txt_end').val()); 
        $('.resource_order').val($('#select_indexing').val()); 
    }
});

$('#export_indexing_form').on('submit', function(event){
    if($('#txt_start').val()=="" && $('#txt_end').val()==""){
        event.preventDefault();
        toastr.warning("Plese Provide Resource Range to Genarate Report");
    }
    else{
        $('.resource_from').val($('#txt_start').val());  
        $('.resource_to').val($('#txt_end').val()); 
        $('.resource_order').val($('#select_indexing').val()); 
    }
});

$('.filter_section').click(function() { 
    $(this).find('i').toggleClass('fa fa-plus fa fa-minus'); 
}); 


$(document).on("click", ".btntype", function(){
    $(".select_type").val($(this).val());
    var filter_tag= 'Type';
    filtertag(filter_tag);
});

$(document).on("click", ".close", function(){
   var fcolse= $(this).closest('button').val();
//    var fcolse= $(this).parents().eq(0);
    if(fcolse=="Center"){$('#center').val('All');}
    if(fcolse=="Category"){$('#category').val('All');}
    if(fcolse=="Publisher"){$('#resource_publisher').val('All');}
    if(fcolse=="Creator"){$('#resource_creator').val('All').trigger('change');}
    if(fcolse=="Dewey Decimal Class"){$('#resource_dd_class').val('All');}
    if(fcolse=="Dewey Decimal Devision"){$('#resource_dd_devision').val('All');}
    if(fcolse=="Dewey Decimal Section"){$('#resource_dd_section').val('All');}
    if(fcolse=="Type"){$('.select_type').val('All');}

    $(this).closest('.tag').fadeOut();
    tag_array.splice( $.inArray(fcolse, tag_array), 1 ); 
});

function filtertag(filter_tag){
    var tag_excist=false;
    for (i = 0; i < tag_array.length; i++)
    {
        if(filter_tag==tag_array[i]){tag_excist=true;}
    }
    if(tag_excist==false)
    {
        var op='';
        op+='<span class="badge badge-pill badge-info mx-1 tag">';
        op+= filter_tag;
        op+='<button type="button" class="close" value="'+filter_tag+'"><span aria-hidden="true">&times;</span></button>';
        op+='</span>';
        $('#ftag').append(op);
        tag_array.push(filter_tag);
    }
}

$(".filter").change(function () {
    var filter_tag= $(this).closest('.fdiv').find('.fname').html();
    filtertag(filter_tag);
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
            beforeSend: function(){
                $("#type_bar").html('<span class="spinner-border spinner-border-sm mb-1" role="status" aria-hidden="true"></span><span>&nbsp;Loading....</span>');
                },
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
    load_type($("#category").val());  
});

$('.btn-pdf').click(function() { 
    $(this).find('.pdf-icon').hide();
    $(this).find('.loader').show();
}); 

$('.btn-excel').click(function() { 
    $(this).find('.excel-icon').hide();
    $(this).find('.loader').show();
}); 

// function downloadFile(response) {
//   var blob = new Blob([response], {type: 'application/pdf'})
//   var url = URL.createObjectURL(blob);
//   location.assign(url);
// } 

$("#report_filter_form").submit(function(event){
    
    $('.select_catg').val( $('#category').val());
    $('.select_cent').val( $('#center').val());
    $('.select_creator').val( $('#resource_creator').val());
    $('.select_publisher').val( $('#resource_publisher').val());
    $('.select_ddclass').val( $('#resource_dd_class').val());
    $('.select_dddevision').val( $('#resource_dd_devision').val());
    $('.select_ddsection').val( $('#resource_dd_section').val());

    event.preventDefault();
    var formData = new FormData(this);
  
    $.ajax({
        cache: false,
        type: 'POST',
        contentType: false,
        processData: false,
        url:  "{{route('report_recource_filter_all')}}", 
        data:formData,
        xhrFields: {
            responseType: 'blob'
        },
        
        beforeSend: function(){
            $('#report_filter_form').find('.pdf-icon').hide();
            $('#report_filter_form').find('.loader').show();
        },
        success: function (response, status, xhr) {
            var filename = "";                   
            var disposition = xhr.getResponseHeader('Content-Disposition');

                if (disposition) {
                var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                var matches = filenameRegex.exec(disposition);
                if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
            } 
            var linkelem = document.createElement('a');
            try {
                var blob = new Blob([response], { type: 'application/octet-stream' });                        

                if (typeof window.navigator.msSaveBlob !== 'undefined') {
                    //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                    window.navigator.msSaveBlob(blob, filename);
                } else {
                    var URL = window.URL || window.webkitURL;
                    var downloadUrl = URL.createObjectURL(blob);

                    if (filename) { 
                        // use HTML5 a[download] attribute to specify filename
                        var a = document.createElement("a");

                        // safari doesn't support this yet
                        if (typeof a.download === 'undefined') {
                            window.location = downloadUrl;
                        } else {
                            a.href = downloadUrl;
                            a.download = filename;
                            document.body.appendChild(a);
                            a.target = "_blank";
                            a.click();
                        }
                    } else {
                        window.location = downloadUrl;
                    }
                }   

                } catch (ex) {
                    console.log(ex);
                } 
        },
        error: function(blob){
            // console.log(blob);
        },
        complete:function(data){
            $('#report_filter_form').find('.pdf-icon').show();
            $('#report_filter_form').find('.loader').hide();
        }
    });


});


$(".download-pdf").click(function(){

    var data = '';
   
});

</script>

@endsection


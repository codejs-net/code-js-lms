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
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Resources&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-search"></i>Resources Catalog&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-6 col-sm-6 col-12 text-left"> 
            <h5> <i class="fa fa-search ml-4 fa-sm"> </i>&nbsp;Resources Catalog</h5>
        </div>  
        <div class="col-md-6 col-sm-6 col-12 text-right pb-2">
            <form class="form-inline pull-right" action="{{ route('report_recource') }}" id="report_form" method="POST">
            {{ csrf_field() }}
                <input type="hidden" name="select_catg" class="select_catg">
                <input type="hidden" name="select_cent" class="select_cent">
                <input type="hidden" name="select_type" class="select_type">
                <button type="submit" class="btn btn-outline-warning btn-sm text-dark mr-2"><i class="fa fa-file-pdf-o"></i>&nbsp; PDF</button>
            </form>
        </div>
    </div>
    
</div>
<div class="container-fluid">

<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         Qucik Search
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <!-- ======================Quck Search================================== -->
         <div class="js-catalog-box elevation-1">
            <div class="form-row">   
            <div class="col-md-12">
                <form onSubmit="return false;"name="form_quick_search" id="form_quick_search" class="needs-validation"  novalidate>
                    {{ csrf_field() }}
                    <div class="form-group js-select-box">
                        <span class="ml-3 " for="">Keywords</span>
                        <div class="input-group ml-2 mr-2">
                            
                           <input type="text" class="form-control mb-3 mt-2" id="txt_quick" name="txt_quick"  value=""  placeholder="Title/Creator/ISBN/ISSN/ISMN/Category/Type/Publisher/DDC/Edition/........"required>
                            <span>
                                <button type="submit" class="btn btn-sm btn-outline-success search-feild-btn elevation-2" id="btn_quck_search"><i class="fas fa-search"></i>&nbsp; Search</button>
                            </span>
                        </div>
                    </div>   
                </form>
            </div>
            </div>  
        </div>
        <!-- =================================================================== -->
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Advance Search
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <!--=========================================Advance Search==================================== -->
            <div class="js-catalog-box elevation-1">
            <div class="form-row">   
            <div class="col-md-12">
                <div class="form-group js-select-box">
                    <span class="ml-3 " for="">Search Fields</span>
                    <div class="input-group ml-2 mr-2">
                        
                        <select class="form-control mb-3 mt-2" id="resource_feild" name="resource_publisher" required>
                        <option value="" selected disabled hidden>Select Feild</option>
                        <option value="accessionNo">Accession Number</option>
                        <option value="standard_number">Standard Number</option>
                        <option value="title_si">Title Sinhala</option>
                        <option value="title_ta">Title Tamil</option>
                        <option value="title_en">Title English</option>
                        <option value="category_si">Category Sinhala</option>
                        <option value="category_ta">Category Tamil</option>
                        <option value="category_en">Category English</option>
                        <option value="type_si">Type Sinhala</option>
                        <option value="type_ta">Type Tamil</option>
                        <option value="type_en">Type English</option>
                        <option value="name_si">Creator Sinhala</option>
                        <option value="name_ta">Creator Tamil</option>
                        <option value="name_en">Creator English</option>

                        <option value="publisher_si">Publisher Sinhala</option>
                        <option value="publisher_ta">Publisher Tamil</option>
                        <option value="publisher_en">Publisher English</option>
                        <option value="language_si">Language Sinhala</option>
                        <option value="language_ta">Language Sinhala</option>
                        <option value="language_en">Language Sinhala</option>
                        <option value="center_si">Center Sinhala</option>
                        <option value="center_en">Center Sinhala</option>
                        <option value="ddc">Center Sinhala</option>
                        <option value="price">Price</option>
                        <option value="purchase_date">Purchase Date</option>
                        <option value="edition">Edition</option>
                        <option value="publishyear">Publish Year</option>
                        <option value="phydetails">Physical Details</option>
                        <option value="note_si">Note Sinhala</option>
                        <option value="note_ta">Note Sinhala</option>
                        <option value="note_en">Note Sinhala</option>
                        
                        </select>
                        <span>
                            <button type="button" class="btn btn-sm btn-outline-warning search-feild-btn elevation-2" id="search_feild_add"><i class="fas fa-plus"></i>&nbsp; Add</button>
                        </span>
                    </div>
                </div>   
            </div>
            </div>  
            <div class="table-responsive"style="overflow-x: auto;"> 
            <table id="search_felid_select" class="table" width="100%" cellspacing="0">
                <thead>
                </thead>
                <tbody>
                
                </tbody>
            </table>    
            </div>    
        </div>
        
        <div class="form-row clearfix pull-right m-3">
            <button type="button" class="btn btn-sm btn-secondary  elevation-2" id="reset_resource">
            <i class="fa fa-times"></i> Reset</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-sm btn-primary elevation-2" value="Save" id="update_resource" >
            <i class="fa fa-search"></i> &nbsp; Search</button>
        </div> 
        <!-- ========================================================================================== --> 
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Filter Option
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
      <!-- ======================================filter Search=========================================== -->
      <div class="row js-border-radius-2 m-2">
            <span for="" class="ml-3 mt-1">Filter By</span>
            <div class="col-md-12 p-3">
            <div class="js-filter-box elevation-2">
                <div class="col ml-3">
                <a  class="filter_section" href="" data-toggle="collapse" data-target="#center_filter"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<u>Center Filter</u></a>
                </div>
                <div id="center_filter" class="collapse">
                    <div class="row mt-3 pl-3">
                        <div class="col-md-12 col-12">
                            <div class="form-group js-select-box ">
                                <div class="ml-2 mr-2">
                                    <span for="category">Center :</span>
                                    <select class="form-control form-control-sm mb-3"name="center" id="center" value="">
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
            </div> 

        <div class="js-filter-box elevation-2">
        <div class="col ml-3">
            <a class="filter_section" href="" data-toggle="collapse" data-target="#type_filter"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<u>Category/Type Filter</u></a>
        </div>
        <div id="type_filter" class="collapse show">
            <hr>
            <div class="row mt-1 pl-3">
                <div class="col-md-3 col-sm-3 text-left">
                    <div class="form-group js-select-box">
                        <div class="ml-2 mr-2">
                            <span for="category">Category :</span>
                            <select class="form-control form-control-sm mb-3"name="category" id="category" value="">
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
                        <div class="ml-2 mr-2">
                    
                            <span for="publisher">Publisher</span>
                            <select class="form-control mb-3" id="resource_publisher" name="resource_publisher" value="{{old('resource_publisher')}}"required>
                            <option value="" selected>All Publishers</option>
                            @foreach($publisher_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->$publisher}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group js-select-box ">
                        <div class="ml-2 mr-2 pb-3">
                            <span for="authors">Creator</span>
                            <select class="form-control" id="resource_creator" name="resource_creator" value=""required>
                                <option value="" class="" selected>All Creators</option>
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
                    <div class="ml-2 mr-2">
                            <span for="dewey_decimal">Dewey Decimal Class</span>
                            <select class="form-control mb-3" id="resource_dd_class" name="resource_dd_class" required>
                            <option value="" selected disabled hidden>Choose here</option>
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
                    <div class="ml-2 mr-2">
                            <span for="dewey_decimal">Dewey Decimal Devision</span>
                            <select class="form-control mb-3" id="resource_dd_devision" name="resource_dd_devision" required>
                            <option value="" selected disabled hidden>Choose here</option>
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
                    <div class="ml-2 mr-2">
                            <span for="dewey_decimal">Dewey Decimal Section</span>
                            <select class="form-control mb-3" id="resource_dd_section" name="resource_dd_section" required>
                            <option value="" selected disabled hidden>Choose here</option>
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
            <div class="form-row clearfix pull-right m-3">
                <button type="button" class="btn btn-sm btn-secondary  elevation-2" id="reset_resource">
                <i class="fa fa-times"></i> Reset</button>
                &nbsp; &nbsp;
                <button type="submit" class="btn btn-sm btn-primary elevation-2" value="Save" id="update_resource" >
                <i class="fa fa-filter"></i> &nbsp; Filter</button>
            </div> 
        <!-- ===================================================================================== -->
      </div>
    </div>
  </div>
</div>

    
</div>

<div class="container-fluid">
    <div class="card card-body">
            <div class="form-row m-auto">
            <div class="table-responsive"style="overflow-x: auto;">               
            <table  class="table m-auto" width="100%" cellspacing="0" id="resource_datatable">
                <thead style="display: none;">
                    <tr class="">
                        <th style="width:5%"></th>
                        <th style="width:90%"></th>
                        <th style="width:5%"></th>
                       
                    </tr>
                </thead>
                    <tbody>  
                   
                    </tbody>
            </table>
        </div>
        </div>               

    </div>
</div>
{{-- --------------------------------------------------------------- --}}



@endsection



@section('script')
<script>

$(document).ready(function()
{
load_type("All");
// load_datatable("All","All","All");
// $("#resource_creator").select2();

$('#resource_creator').select2({
    theme: 'bootstrap4',
});

});

$('.filter_section').click(function() { 
    $(this).find('i').toggleClass('fa fa-plus fa fa-minus'); 
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

function qucki_search(keyword)
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
        searching: false,
        

    ajax:{
        type: "GET",
        dataType : 'json',
        data: { 
            keyword: keyword,
        },
        url: "{{ route('catelog_quick_search') }}",
    },
    // pageLength: 15,
    
    columns:[
        {data: "id",name: "ResourceID",orderable: true},
        {data: "details",name: "details",orderable: false},
        {data: "action",name: "action",orderable: false}
    ],
    "createdRow": function( row, data, dataIndex ) {
        }
    });
}


$("#category").change(function () {
    var catdata=$("#category").val();
    var centerdata=$("#center").val();
    var typedata="All";
    load_type(catdata);  
    $(".select_catg").val(catdata);
});

$("#center").change(function () {
    var catdata=$("#category").val();
    var centerdata=$("#center").val();
    var typedata="All";
    $(".select_cent").val(centerdata);
});


$(document).on("click", ".btntype", function(){
    var catdata=$("#category").val();
    var centerdata=$("#center").val();
    var typedata=$(this).val();
    $(".select_type").val($(this).val());

});

$('#search_feild_add').click(function(){
    var op="";
    var feild=$("#resource_feild").val();
    var feild_text = $('#resource_feild').find(":selected").text();
    op+= '<tr>';
    op+= '<td style="width: 10%"><span class="" for="'+feild+'">'+feild_text+":&nbsp;"+'</span></td>';
    op+= '<td style="width: 85%"><input type="text" class="form-control" id="'+feild+'" name="'+feild+'" placeholder="'+feild_text+'"></td>';
    op+= '<td style="width: 5%"><button type="button" value="'+feild+'" class="btn btn-sm btn-outline-danger mt-1 remove_feild"><i class="fa fa-trash"></i></button></td>';
    op+= '</tr>';
    $('#search_felid_select tbody').append(op);
});

$("#search_felid_select").on('click', '.remove_feild', function () {
        $(this).closest('tr').remove();
});


$("#btn_quck_search").click(function () {

    // $('#resource_datatable').dataTable().fnDestroy();
    $('#resource_datatable').DataTable().clear().destroy();

    var keyword=$("#txt_quick").val();
    qucki_search(keyword);

    $([document.documentElement, document.body]).animate({
        scrollTop: $("#resource_datatable").offset().top
    }, 1000);

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
        searching: false,

    ajax:{
        type: "GET",
        dataType : 'json',
        data: { 
            catdata: catdata,
            centerdata: centerdata,
            typedata: typedata,
        },
        url: "{{ route('resource_catelog') }}",
    },
    // pageLength: 15,
    
    columns:[
        {data: "id",name: "ResourceID",orderable: true},
        {data: "details",name: "details",orderable: false},
        {data: "action",name: "action",orderable: false}
    ],
    "createdRow": function( row, data, dataIndex ) {
        }
    });
}


</script>
@endsection
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
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Resources&nbsp;</a></li>
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
    <div class="js-filter-box elevation-2">
        <div class="col ml-3">
        <a  class="" href="" data-toggle="collapse" data-target="#center_filter"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;<u>Center Filter</u></a>
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
    <a class="" href="" data-toggle="collapse" data-target="#type_filter"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;<u>Category/Type Filter</u></a>
</div>
  <div id="type_filter" class="collapse">
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
    <a  class="" href="" data-toggle="collapse" data-target="#creator_filter"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;<u>Creator/Publisher Filter</u></a>
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
                <div class="ml-2 mr-2">
                    <span for="authors">Creator</span>
                    <select class="form-control mb-3" id="resource_creator" name="resource_creator" value="{{old('resource_creator')}}"required>
                        <option value="" selected>All Creators</option>
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
    <a  class="" href="" data-toggle="collapse" data-target="#ddc_filter"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;<u>DDC Filter</u></a>
    </div>
      <div id="ddc_filter" class="collapse">
      <div class="form-row mt-3 pl-3">
            <!-- -------------------------------------------- -->
            <div class="col-md-4">
            <div class="form-group js-select-box ">
            <div class="ml-2 mr-2">
                    <span for="dewey_decimal">Dewey Decimal Class</span>
                    <select class="form-control" id="resource_dd_class" name="resource_dd_class" required>
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
                    <select class="form-control" id="resource_dd_devision" name="resource_dd_devision" required>
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
                    <select class="form-control" id="resource_dd_section" name="resource_dd_section" required>
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

        <!-- Main content -->
<div class="container-fluid">
    <div class="js-catalog-box elevation-1">
        <div class="form-row">   
        <div class="col-md-12">
            <div class="form-group js-select-box">
                <div class="ml-2 mr-2">
                    <span for="dewey_decimal">Search Fields</span>
                </div>
            </div>   
        </div>
        </div>              

    </div>
</div>

@endsection



@section('script')
<script>

$(document).ready(function()
{
load_type("All");

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

</script>
@endsection

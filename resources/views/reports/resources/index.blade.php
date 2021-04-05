@extends('layouts.app')
@section('style')
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
@endsection
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
    <li class="breadcrumb-item ml-2"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Reports&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-search"></i> Reports&nbsp;</a></li>
</ol>
</nav>

<div class="row mb-2">
    <div class="col-md-12 col-sm-12 ml-3 text-left"> 
        <h5> <i class="fa fa-file-text">&nbsp;Range Resource Report</i></h5>
    </div>  
</div> 

<div class="container-fluid">
<div class="card">
    <div class="row">
        <div class="col-md-9 pl-4 pr-4">
            <div class="row pl-4 pt-3">
                <label>Provide Resource Range to Genarate Report (example: 1-1000)</label>
            </div>
            <div class="row pl-3">
                <div class="col-sm-12 col-md-6 text-center">
                    <div class="input-group mb-3 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">From</span>
                        </div>
                        <input type="text" name="txt_start" id="txt_start" class="form-control" placeholder="Start ID" aria-label="Start Number" aria-describedby="basic-addon1"required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 text-center">
                    <div class="input-group mb-3 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">To</span>
                        </div>
                        <input type="text" name="txt_end" id="txt_end" class="form-control" placeholder="End ID" aria-label="End Number" aria-describedby="basic-addon1"required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-3 p-2">
            <div class="elevation-2 card1">
              
                <h5>Range Resources</h5>
                 <p class="small">Range Resources Report in LMS. Provide Number Range and Download PDF or Excel</p>
                 <form class="form-inline pull-left" action="{{ route('report_recource') }}" id="report_form" method="POST">
                    {{ csrf_field() }}
                        <input type="hidden" name="resource_from" class="resource_from">
                        <input type="hidden" name="resource_to" class="resource_to">
                        <button type="submit" class="btn-pdf btn btn-secondary btn-sm elevation-2 mr-2">
                            <span class="pdf-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <span class="spinner-border spinner-border-sm text-white loader" role="status" aria-hidden="true"  style="display: none;"></span>&nbsp; PDF
                        </button>
                </form>
                <form class="form-inline" action="{{ route('export_recource') }}" id="report_form" method="POST">
                    {{ csrf_field() }}
                        <input type="hidden" name="resource_from" class="resource_from">
                        <input type="hidden" name="resource_to" class="resource_to">
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
    <div class="col-md-3 col-3 p-2 mt-4">
        <div class="elevation-2 card1">
             <h5>Filterd Resources</h5>
             <p class="small">Filterd Resources Report in LMS. You can filter resource Center wise, Type wise, creator wise, Publisher wise or Dewy Decimal wise. click Download PDF or Excel to genarate report</p>
             <a href="" class="btn btn-secondary btn-sm elevation-2 mr-2"><i class="fa fa-file-pdf-o"></i>&nbsp; PDF</a>
             <a href="" class="btn btn-primary btn-sm elevation-2 mr-2"><i class="fa fa-file-excel-o"></i>&nbsp; Excel</a>
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
            <a href="" class="btn btn-secondary btn-sm elevation-2 mr-2"><i class="fa fa-file-pdf-o"></i>&nbsp; PDF</a>
            <a href="" class="btn btn-primary btn-sm elevation-2 mr-2"><i class="fa fa-file-excel-o"></i>&nbsp; Excel</a>
           
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

$(document).ready(function()
{
    load_type("All");

    $('#resource_creator').select2({
        theme: 'bootstrap4',
    });

    var inputfrom = document.getElementById("txt_start");
    inputfrom.addEventListener("keyup", function(event) {
        $('.resource_from').val($('#txt_start').val());  
    });

    var inputto = document.getElementById("txt_end");
    inputto.addEventListener("keyup", function(event) {
        $('.resource_to').val($('#txt_end').val()); 
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
$('.btn-pdf').click(function() { 
    $(this).find('.pdf-icon').hide();
    $(this).find('.loader').show();
}); 
$('.btn-excel').click(function() { 
    $(this).find('.excel-icon').hide();
    $(this).find('.loader').show();
}); 

</script>

@endsection


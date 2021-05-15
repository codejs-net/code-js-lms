@extends('layouts.app')
@section('class', 'bg-white')
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

<section class="content">
    <div class="container-fluid">
    {{-- <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
             Qucik Search
            </button>
          </h5>
        </div>
            <!-- ======================Quck Search================================== -->
             <div class="js-catalog-box elevation-1">
                <div class="row pb-2">   
                    <div class="col-md-2 col-2 text-center">
                        <img src="{{ asset('img/dashboard.png') }}" class="img-catalog" alt="Code-js">
                    </div>
                    <div class="col-md-10 col-10">
                        <form onSubmit="return false;"name="form_quick_search" id="form_quick_search" class="needs-validation"  novalidate>
                            {{ csrf_field() }}
                            <div class="form-group js-select-box mt-2">
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
      </div> --}}
      <div id="gsearch" class="my-5">
        <center>
            <div class="logo">
              <img alt="Google" src="{{ asset('img/library_logo.png') }}" class="img-catalog">
            </div>
            <div class="div_bar">
              <input class="searchbar" type="text" id="txt_quick" name="txt_quick"  title="Search">
              <a href="#"> <img class="voice" src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Google_mic.svg/716px-Google_mic.svg.png" title="Search by Voice"></a>
            </div>
            <div class="buttons">
              <button class="button" id="btn_quck_search" type="button">Library Search</button>
              <button class="button" type="button">I'm Feeling Lucky</button>
             </div>
        </center>
    </div>
</div>

<div class="container-fluid" id="reso_data" style="display: none; overflow-x: 0;">
    <hr>
    <div class="row m-auto"> 
        <div class="table-responsive">               
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
{{-- --------------------------------------------------------------- --}}

</section>
<br>
@endsection



@section('script')
<script>

$(document).ready(function()
{
$(document.body).addClass('bg-white');

});


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

$("#btn_quck_search").click(function () {

    // $('#resource_datatable').dataTable().fnDestroy();
    $('#resource_datatable').DataTable().clear().destroy();

    var keyword=$("#txt_quick").val();
    $('#reso_data').show();
    qucki_search(keyword);

    $([document.documentElement, document.body]).animate({
        scrollTop: $("#resource_datatable").offset().top
    }, 1000);

});

</script>
@endsection

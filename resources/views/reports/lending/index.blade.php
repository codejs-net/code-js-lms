@extends('layouts.app')
@section('style')
    <link href="{{ asset('css/report.css') }}" rel="stylesheet">
@endsection
@section('content')
@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$member="name".$lang;
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
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Reports&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-search"></i> Reports&nbsp;</a></li>
</ol>
</nav>

<div class="row mb-2">
    <div class="col-md-12 col-sm-12 ml-3 text-left"> 
        <h5> <i class="fa fa-file-text">&nbsp;Date Lending Report</i></h5>
    </div>  
</div> 

<div class="container-fluid">
<div class="card">
    <div class="row">
        <div class="col-md-9 col-12 pl-4 pr-4">
            <div class="row pl-4 pt-3">
                <label>Provide Lending Date Periode and Type, to Genarate Report</label>
            </div>
            <div class="row pl-3">
                <div class="col-md-6 col-12 input-group border border-secondary">
                    <div class="py-1 px-2 mr-2">
                        <div class="form-check form-check-inline text-primary" >
                            <label class="form-check-label"><i class="fa fa-shopping-cart"></i> &nbsp;Issued&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="returned" value="Issue" required>
                        </div>
                        <div class="form-check form-check-inline text-primary" >
                            <label class="form-check-label"><i class="fa fa-shopping-cart"></i> &nbsp;Returned&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="returned" value="Return" required>
                        </div>
                        <div class="form-check form-check-inline text-info" >
                            <label class="form-check-label"><i class="fa fa-times"></i> &nbsp;Non Returned&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="returned" value="Non Return" required>
                        </div>
                        <div class="form-check form-check-inline text-danger" >
                            <label class="form-check-label"><i class="fa fa-times"></i> &nbsp;Late&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="returned" value="Late" required>
                        </div>
                        <div class="form-check form-check-inline text-success" >
                            <label class="form-check-label"><i class="fa fa-check-square-o"></i> &nbsp; All&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="returned" value="All" required>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6 col-12">
                   <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">From</span>
                    </div>
                    <input type="date" name="dte_from" id="dte_from" class="form-control filter-date" value="{{$today}}" aria-describedby="basic-addon1"required>
                    <div class="input-group-prepend ml-2">
                        <span class="input-group-text" id="basic-addon1">To</span>
                    </div>
                    <input type="date" name="dte_to" id="dte_to" class="form-control filter-date"  value="{{$today}}" aria-describedby="basic-addon1"required>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12 p-2">
            <div class="elevation-2 card1">
              
                <h5>Date Lending</h5>
                 <p class="small">Date Lending Report in LMS. Filter Using From Date and To Date, Provide Date Periode and Lending Type to Download PDF or Excel</p>
                 <form class="form-inline pull-left" action="{{ route('report_lending') }}" id="report_form" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="rpt_from" class="rpt_from">
                    <input type="hidden" name="rpt_to" class="rpt_to">
                    <input type="hidden" name="rpt_filter" class="rpt_filter">
                        <button type="submit" class="btn-pdf btn btn-secondary btn-sm elevation-2 mr-2">
                            <span class="pdf-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <span class="spinner-border spinner-border-sm text-white loader" role="status" aria-hidden="true"  style="display: none;"></span>&nbsp; PDF
                        </button>
                        {{-- <button type="button" class="btn-excel btn btn-primary btn-sm elevation-2 mr-2" id="btn_export_lending">
                            <span class="excel-icon"><i class="fa fa-file-excel-o"></i></span>
                            <span class="spinner-border spinner-border-sm text-white loader" role="status" aria-hidden="true"  style="display: none;"></span>&nbsp; Excel
                        </button> --}}
                </form>
                <form class="form-inline" action="{{ route('export_lending')}}" id="report_form" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="rpt_from" class="rpt_from">
                    <input type="hidden" name="rpt_to" class="rpt_to">
                    <input type="hidden" name="rpt_filter" class="rpt_filter">
                        <button type="submit" class="btn-excel btn btn-primary btn-sm elevation-2 mr-2">
                            <span class="excel-icon"><i class="fa fa-file-excel-o"></i></span>
                            <span class="spinner-border spinner-border-sm text-white loader" role="status" aria-hidden="true"  style="display: none;"></span>&nbsp; Excel
                        </button>
                </form>
            </div>
         </div>
    </div>

</div>
{{-- ---------------lending Accouny---------- --}}
<div class="row mb-2">
    <div class="col-md-12 col-sm-12 ml-3 text-left"> 
        <h5> <i class="fa fa-file-text">&nbsp;Lending Account Report</i></h5>
    </div>  
</div> 

<div class="card">
    <div class="row">
        <div class="col-md-9 col-12 pl-4 pr-4">
            <div class="row pl-4 pt-3">
                <label>Provide Member Or Resource AccessionNo to Genarate Report</label>
            </div>
            <div class="row pl-3">
                <div class="col-md-6 col-12 input-group border border-secondary">
                    <div class=" py-1 px-2 mr-2">
                        <div class="form-check form-check-inline text-primary" >
                            <label class="form-check-label"><i class="fa fa-shopping-cart"></i> &nbsp;Issued&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="filter_account" value="Issue" required>
                        </div>
                        <div class="form-check form-check-inline text-primary" >
                            <label class="form-check-label"><i class="fa fa-shopping-cart"></i> &nbsp;Returned&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="filter_account" value="Return" required>
                        </div>
                        <div class="form-check form-check-inline text-info" >
                            <label class="form-check-label"><i class="fa fa-times"></i> &nbsp;Non Returned&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="filter_account" value="Non Return" required>
                        </div>
                        <div class="form-check form-check-inline text-success" >
                            <label class="form-check-label"><i class="fa fa-check-square-o"></i> &nbsp; All&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="filter_account" value="All" required>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6 col-12">
                   <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Member</span>
                    </div>
                    <select class="form-control" name="member" id="member" aria-describedby="basic-addon1" value="{{old('member')}}"required>
                        {{-- <option value="" disabled selected>Select Member </option> --}}
                        <option value="All" selected>{{__('All')}}</option>
                        @foreach($memberdata as $item)
                            <option value="{{ $item->id }}">{{$item->id}}-{{ $item->$member }}</option>
                        @endforeach
                        </select>
                        <div class="invalid-feedback">{{ __("Please Select the member")}}</div>
                        <span class="text-danger">{{ $errors->first('member') }}</span>
                    <div class="input-group-prepend ml-2">
                        <span class="input-group-text" id="basic-addon1">Resource</span>
                    </div>
                    <input type="text" name="resource" id="resource" class="form-control" aria-describedby="basic-addon1" placeholder="Accession No" required>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12 p-2">
            <div class="elevation-2 card1">
              
                <h5>Lending Account</h5>
                 <p class="small">Lending Account Report in LMS. Filter lending Using Member Or Resource, Provide Member or Resource to Download PDF or Excel</p>
                 <form class="form-inline pull-left" action="{{ route('report_lending_account') }}" id="report_lending_acc_form" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="rpt_member" class="rpt_member">
                    <input type="hidden" name="rpt_resource" class="rpt_resource">
                    <input type="hidden" name="rpt_filter_account" class="rpt_filter_account">
                        <button type="submit" class="btn-pdf btn btn-secondary btn-sm elevation-2 mr-2">
                            <span class="pdf-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <span class="spinner-border spinner-border-sm text-white loader" role="status" aria-hidden="true"  style="display: none;"></span>&nbsp; PDF
                        </button>
                </form>
                <form class="form-inline" action="{{ route('export_lending_account')}}" id="export_lending_acc_form" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="rpt_member" class="rpt_member">
                    <input type="hidden" name="rpt_resource" class="rpt_resource">
                    <input type="hidden" name="rpt_filter_account" class="rpt_filter_account">
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
        <h5> <i class="fa fa-file-text">&nbsp;Other Lending Report</i></h5>
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
    $("input[name=returned][value='All']").prop("checked",true);
    $("input[name=filter_account][value='All']").prop("checked",true);

    var returnfilter= $("input[name='returned']:checked").val()
    var from_date= $('#dte_from').val();
    var to_date= $('#dte_to').val();
    $('.rpt_from').val(from_date);
    $('.rpt_to').val(to_date);
    $('.rpt_filter').val(returnfilter);


    $('.rpt_filter_account').val($("input[name='filter_account']:checked").val());
    $('.rpt_member').val($('#member').val());
    $('.rpt_resource').val("All");


    $('#member').select2({
        theme: 'bootstrap4',
    });

});

$("#report_lending_acc_form").submit(function(){
    if($('#resource').val()==""){
        $('.rpt_resource').val("All");
    }
    else{
        $('.rpt_resource').val($('#resource').val());
    }
    $('.rpt_filter_account').val($("input[name='filter_account']:checked").val());
    $('.rpt_member').val($('#member').val());
});

$("#export_lending_acc_form").submit(function(){
    if($('#resource').val()==""){
        $('.rpt_resource').val("All");
    }
    else{
        $('.rpt_resource').val($('#resource').val());
    }
    $('.rpt_filter_account').val($("input[name='filter_account']:checked").val());
    $('.rpt_member').val($('#member').val());
});

$("input[name='returned']").click(function(){
    var returnfilter=$(this).val();
    var from_date= $('#dte_from').val();
    var to_date= $('#dte_to').val();
    $('.rpt_from').val(from_date);
    $('.rpt_to').val(to_date);
    $('.rpt_filter').val(returnfilter);
});

// $("input[name='filter_account']").click(function(){
//     $('.rpt_filter_account').val($(this).val());
//     $('.rpt_member').val($('#member').val());
//     $('.rpt_resource').val($('#resource').val());
// });

$('.filter-date').change(function() { 
    var returnfilter= $("input[name='returned']:checked").val()
    var from_date= $('#dte_from').val();
    var to_date= $('#dte_to').val();
    $('.rpt_from').val(from_date);
    $('.rpt_to').val(to_date);
    $('.rpt_filter').val(returnfilter);
}); 


$('.btn-pdf').click(function() { 
    $(this).find('.pdf-icon').hide();
    $(this).find('.loader').show();
}); 
// $('.btn-excel').click(function() { 
//     $(this).find('.excel-icon').hide();
//     $(this).find('.loader').show();
// }); 

$(".btn-excel").mouseup(function() {
    $(this).find('.excel-icon').show();
    $(this).find('.loader').hide();
});
$(".btn-excel").mousedown(function() {
    $(this).find('.excel-icon').hide();
    $(this).find('.loader').show();
});


// $('#btn_export_lending').click(function() { 
//     var rpt_filter= $("input[name='returned']:checked").val()
//     var rpt_from= $('#dte_from').val();
//     var rpt_to= $('#dte_to').val();

//     $.ajaxSetup({
//         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
//     });
//     $.ajax
//     ({
//         type: "GET",
//         dataType : 'json',
//         url: "{{route('export_lending')}}", 
//         data: { 
//             rpt_filter: rpt_filter,
//             rpt_from: rpt_from,
//             rpt_to:rpt_to
//         },
//         beforeSend: function(){
//             $(this).find('.excel-icon').hide();
//             $(this).find('.loader').show();
//         },
//         success:function(data){
//             toastr.success('Export faild Plese try again')
//         },
//         error:function(data){
//             toastr.error('Export faild Plese try again')
//         },
//         complete:function(data){
//             $(this).find('.excel-icon').show();
//             $(this).find('.loader').hide();
//         }
//     }).then((response) => {
//     const url = window.URL.createObjectURL(new Blob([response.data]));
//     const link = document.createElement('a');
//     link.setAttribute('download', 'file.xlsx');
//     document.body.appendChild(link);
//     link.click();
//     });

//     });

</script>

@endsection


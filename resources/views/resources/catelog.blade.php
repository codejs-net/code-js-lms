@extends('layouts.app')
@section('class', 'bg-white')
@section('content')

@php
$locale = session()->get('locale');
$library = session()->get('library');
$lang="_".$locale;
$lib_name="name".$lang;
$lib_add1="address1".$lang;
$lib_add2="address2".$lang;
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
    <div class="row bg-white">
        <div class="col-12">
            <div class="content-header pl-2 pb-1 mt-2">
                <div class="box box-info">
                    <div class="box-header text-left ml-2 pl-1">
                        <div class=" header js-dash-h">
                            <h5><i class="fa fa-inbox"></i>&nbsp;{{ __("Library Management System")}} -&nbsp;{{$library->$lib_name}}&nbsp;({{$library->$lib_add1}},&nbsp;{{$library->$lib_add2}})</h5>
                            <span>{{__('Centers :')}}
                                @foreach($cent_name as $center)
                                    <span class="text-dark">{{$center}} ,&nbsp;</span>
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div id="gsearch1" class="my-1" style="display: none;">
            <form onSubmit="return false;"name="form_quick_search1" id="form_quick_search1" class="needs-validation"  novalidate>
            {{ csrf_field() }}
           <div class="row">
            <div class="col-md-2 col-2">
                <div class="logo text-center">
                    <img alt="Google" src="{{ asset('img/library_logo.png') }}" class="img-catalog1">
                </div>
            </div>
            <div class="col-md-10 col-10">
                <div class="div_bar1 pull-right">
                    <center>
                      <input class="searchbar1 " type="text" id="txt_quick1" name="txt_quick1"  title="Search" required>
                      <a class="mr-0" id="btn_clear" href="#"><i class="fa fa-times"></i></a>
                      <span class="separeter">&nbsp;| &nbsp;</span>
                      <a id="start_speech1" class="" href="#"> 
                          <img class="voice1" src="{{ asset('img/mic.png') }}" id="mic-before1">
                          <img class="voice1" src="{{ asset('img/mic1.png') }}" id="mic-after1" style="display: none;">
                        </a>
                        <button class="btn rounded-circle bg-light mx-2" id="btn_quck_search1" type="submit"><i class="fa fa-search fa-lg"></i></button>
                    </center>
                </div>
            </div>
           </div>
            </form>
       
    </div>
    {{-- ----------------------------------------------------------------------- --}}
      <div id="gsearch" class="my-5">
        <center>
            <form onSubmit="return false;"name="form_quick_search" id="form_quick_search" class="needs-validation"  novalidate>
            {{ csrf_field() }}
            <div class="logo">
              <img alt="Google" src="{{ asset('img/library_logo.png') }}" class="img-catalog">
            </div>
            <div class="div_bar">
              <input class="searchbar" type="text" id="txt_quick" name="txt_quick"  title="Search" required>
              <a id="start_speech" href="#"> 
                  <img class="voice" src="{{ asset('img/mic.png') }}" id="mic-before">
                  <img class="voice" src="{{ asset('img/mic1.png') }}" id="mic-after" style="display: none;">
                </a>
            </div>
            <div class="buttons">
              <button class="button" id="btn_quck_search" type="submit">{{__('Library Search')}}</button>
              <button class="button" type="button">{{__("I'm Feeling Lucky")}}</button>
             </div>
            </form>
        </center>
    </div>
</div>

<div class="container-fluid" id="reso_data" style="display: none; overflow-x: 0;">
    {{-- <hr> --}}
    <div class="row m-auto"> 
        <div class="table-responsive">               
            <table  class="table m-auto" width="100%" cellspacing="0" id="resource_datatable">
                <thead style="display: none;">
                    <tr class="">
                        {{-- <th style="width:5%"></th> --}}
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
    document.getElementById("txt_quick").focus();
});
var recognition = new webkitSpeechRecognition();
var recognition1 = new webkitSpeechRecognition();
// recognition.continuous = true;
// recognition.interimResults = true;

recognition.lang = "{{$locale}}";
recognition1.lang = "{{$locale}}";

recognition.onresult = function(event) { 
    var saidText = "";
    for (var i = event.resultIndex; i < event.results.length; i++) {
        if (event.results[i].isFinal) {
            saidText = event.results[i][0].transcript;
        } else {
            saidText += event.results[i][0].transcript;
        }
       
    }
    // if(!saidText==""){
       
        document.getElementById('txt_quick').value = saidText;
        var keyword=$("#txt_quick").val();
        $("#txt_quick1").val(keyword);
        $('#gsearch1').show();
        $('#gsearch').hide();
        qucki_search(keyword);   
    // }
    // else{
    //     toastr.info('Sorry Not Listning anything...');
    // }  
}
recognition.onend = function() {
    $('#mic-before').show();
    $('#mic-after').hide();
}
recognition1.onend = function() {
    $('#mic-before1').show();
    $('#mic-after1').hide();
}

recognition1.onresult = function(event) { 
    var saidText = "";
    for (var i = event.resultIndex; i < event.results.length; i++) {
        if (event.results[i].isFinal) {
            saidText = event.results[i][0].transcript;
        } else {
            saidText += event.results[i][0].transcript;
        }
       
    }
   
    document.getElementById('txt_quick1').value = saidText;
    var keyword=$("#txt_quick1").val();
    qucki_search(keyword);   
    
}

$("#start_speech").click(function () {
    $('#reso_data').hide();
    $('#txt_quick').val('');
    $('#mic-before').hide();
    $('#mic-after').show();
    $('#resource_datatable').DataTable().clear().destroy();
    recognition.start();  

});

$("#start_speech1").click(function () {
    $('#reso_data').hide();
    $('#txt_quick1').val('');
    $('#mic-before1').hide();
    $('#mic-after1').show();
    $('#resource_datatable').DataTable().clear().destroy();
    recognition1.start();  
});

function qucki_search(keyword)
{

    $('#reso_data').show();
    $('#resource_datatable').DataTable({
        // columnDefs: [
        // {"targets": [0],
        // "visible": false,},
        // ],
        responsive: true,
        processing: true,
        serverSide: false,
        ordering: false,
        searching: false,
        info:     false,
        bLengthChange:false,
        

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
        // {data: "id",name: "ResourceID",orderable: true},
        {data: "details",name: "details",orderable: false},
        {data: "action",name: "action",orderable: false}
    ],
    });
}
// $('#txt_quick').on('input',function(e){
//     $('#resource_datatable').DataTable().clear().destroy();
//     var keyword=$("#txt_quick").val();
//     $('#reso_data').show();
//     qucki_search(keyword);
// });

$("#btn_quck_search").click(function () {

    // $('#resource_datatable').dataTable().fnDestroy();
    $('#resource_datatable').DataTable().clear().destroy();
    var keyword=$("#txt_quick").val();
    $("#txt_quick1").val(keyword);
    $('#gsearch1').show();
    $('#gsearch').hide();
    qucki_search(keyword);

    // $([document.documentElement, document.body]).animate({
    //     scrollTop: $("#resource_datatable").offset().top
    // }, 1000);

});

$("#btn_quck_search1").click(function () {

$('#resource_datatable').DataTable().clear().destroy();
var keyword=$("#txt_quick1").val();
qucki_search(keyword);

// $([document.documentElement, document.body]).animate({
//     scrollTop: $("#resource_datatable").offset().top
// }, 1000);

});
$("#btn_clear").click(function () {

$('#resource_datatable').DataTable().clear().destroy();
$("#txt_quick1").val('');
$('#reso_data').hide();
document.getElementById("txt_quick1").focus();
});

</script>
@endsection

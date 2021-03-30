<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>Document</title>
      <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <script src="{{ asset('js/app.js') }}" defer></script> -->


      <style>

      body { 
            font-family: 'iskpota';
      }
      @page {
            margin-top:10px;
            margin-left:20px;
            margin-right:10px;
            margin-bottom:5px; 
      }
      .img-member1 {
        width: 65px;
        max-height: 65px;
        border-radius: 5px;
        border: 1px solid #010101;
      }
     
      .text-center{
            text-align: center;
      }
      .text-left{
            text-align: left !important;
           
      }

      .column-1 {
      float: left;
      width: 25%;
      /* background: #e1ebf0; */
      }
      .column-2 {
      float: left;
      width: 70%;
      padding-left:10px;
      }

      /* Clear floats after the columns */
      .row:after {
      content: "";
      display: table;
      clear: both;
      }
      .qrcode{
            padding-left:2px;
            padding-right:5px;
            margin-top:15px;
      }
      .image{
            padding-left:2px;
            padding-right:5px;
            padding-top:5px;
      }
      .tbl_card{
            width:100%;
            font-size:11px !important;
            line-height:9px;
            
           
      }
      .tbl_card td{
           height:0px !important;
           vertical-align: top;
      }
      .card-heading{
            padding-bottom: 15px;
      }
      h4{
            font-size:15px !important;
            padding-bottom:10px;

      }

      </style>
</head>
<body>
@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$name="name".$lang;
$address1="address1".$lang;
$address2="address2".$lang;
$lib_name="name".$lang;

@endphp

@foreach($mdata as $data)
      <div class="row">
            <div class="column-1">
                  <div class="row image">
                        <img class="img-member1" src="images/members/{{$data->image}}">
                  </div>
                  <div class="row qrcode">
                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG((string)$data->id, 'QRCODE',40,40)}}" alt="barcode" />
                  </div>
            </div>
            <div class="column-2">
            <table class="tbl_card">
                  <tr class="card-heading">
                        <td colspan="3" class="text-left"><h4 class="">{{ $library->$lib_name}}</h4></td><br>
                  </tr>
                  <tr>
                        <td style="width: 30%"><b>{{__("Category")}}</b></td>
                        <td style="width: 5%" class="text-center">&nbsp;:&nbsp;</td>
                        <td class="text-left">{{$data->$category}}</td>
                  </tr>
                  <tr>
                        <td style="width: 30%"><b>{{__("Name")}}</b></td>
                        <td style="width: 5%" class="text-center">&nbsp;:&nbsp;</td>
                        <td class="text-left">{{$data->$name}}</td>
                  </tr>
                  <tr>
                        <td style="width: 30%"><b>{{__("Address")}}</b></td>
                        <td style="width: 5%">&nbsp;:&nbsp;</td>
                        <td class="text-left">{{$data->$address1}},{{$data->$address2}}</td>
                  </tr>
                  <tr>
                        <td style="width: 30%"><b>{{__("NIC")}}</b></td>
                        <td style="width: 5%">&nbsp;:&nbsp;</td>
                        <td class="text-left">{{$data->nic}}</td>
                  </tr>
                  <tr>
                        <td style="width: 30%"><b>{{__("Mobile")}}</b></td>
                        <td style="width: 5%">&nbsp;:&nbsp;</td>
                        <td class="text-left">{{$data->mobile}}</td>
                  </tr>
                  <tr>
                        <td style="width: 30%"><b>{{__("Register")}}</b></td>
                        <td style="width: 5%">&nbsp;:&nbsp;</td>
                        <td class="text-left">{{$data->regdate}}</td>
                  </tr>
            </table>
            </div>
      </div>
<pagebreak></pagebreak>
@endforeach
   
</body>
</html>
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
      .reg-num{
            padding-top:15px !important;
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
            /* line-height:10px; */
            
           
      }
      /* .tbl_card td{
           height:0px !important;
           
      } */
      table{
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
           
      }
      td{
            line-height: 10px;
            vertical-align: top;
            padding-bottom: 2px;
          
      }
      .pb-2{
            padding-bottom: 5px;
      }
      .pb-0{
            padding-bottom: 5px;
      }
      .card-heading{
            padding-bottom: 15px;
            margin-bottom: 10px;
            /* font-size: 14px !important; */
      }

      .card-heading1 {
            padding-bottom: 30px !important;
            padding-top: 20px !important;
            color: #530549 !important;
      }

      .card-heading1 span {
            color: #530549 !important;
      }


      .card-name{
            color: #272c66;
            font-size: 15px !important;
           
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
      <br>
      <div class="row">
            <div class="column-1">
                  <div class="row image">
                        <img class="img-member1" src="images/members/{{$data->image}}">
                  </div>
                  <div class="row qrcode">
                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG((string)$data->regnumber, 'QRCODE',40,40)}}" alt="barcode" />
                  </div>
            </div>
            <div class="column-2">
            <table class="tbl_card">
                  <tr class="card-heading">
                        <td colspan="3" class="text-left">
                              <span class="card-name"><u>{{__("Member Card")}} &nbsp;-{{$data->id}}&nbsp;</u></span>
                              <span class="reg-num">&nbsp;{{empty($data->regnumber)?"":"(".$data->regnumber.")"}}&nbsp;</span>
                        </td>
                  </tr>
                  <tr class="card-heading1">
                        <td colspan="3" class="text-left"><b><span class="">{{ $library->$lib_name}}</span></b></td><br><br>
                  </tr>
                 
                  <tr>
                        <td style="width: 20%"><b>{{__("Category")}}</b></td>
                        <td style="width: 5%" class="text-center">&nbsp;:&nbsp;</td>
                        <td class="text-left pb-0">{{$data->$category}}</td>
                  </tr>
                  <tr>
                        <td style="width: 20%"><b>{{__("Name")}}</b></td>
                        <td style="width: 5%" class="text-center">&nbsp;:&nbsp;</td>
                        <td class="text-left">{{$data->$name}}</td>
                  </tr>
                  <tr>
                        <td style="width: 20%"><b>{{__("Address")}}</b></td>
                        <td style="width: 5%">&nbsp;:&nbsp;</td>
                        <td class="text-left pb-2">{{$data->$address1}},&nbsp;{{$data->$address2}}</td>
                  </tr>
                  <tr>
                        <td style="width: 20%"><b>{{__("NIC")}}</b></td>
                        <td style="width: 5%" class="text-center">&nbsp;:&nbsp;</td>
                        <td class="text-left">{{$data->nic}}</td>
                  </tr>
                  <tr>
                        <td style="width: 20%"><b>{{__("Mobile")}}</b></td>
                        <td style="width: 5%" class="text-center">&nbsp;:&nbsp;</td>
                        <td class="text-left">{{$data->mobile}}</td>
                  </tr>
                  <!-- <tr>
                        <td style="width: 30%"><b>{{__("Register")}}</b></td>
                        <td style="width: 5%">&nbsp;:&nbsp;</td>
                        <td class="text-left">{{$data->regnumber}}</td>
                  </tr> -->
            </table>
            </div>
      </div>
<pagebreak></pagebreak>
@endforeach
   
</body>
</html>
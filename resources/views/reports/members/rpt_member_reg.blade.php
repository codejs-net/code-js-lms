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
            margin-bottom:20px; 
      }
      .img-member1 {
        width: 65px;
        max-height: 65px;
        border-radius: 5px;
        border: 1px solid #010101;
      }
      #tbl_office{
            border: #4b4949 solid 1px;
            margin-top:10px;
      }
      #tbl_member{
            margin-top:10px;
      }
      .text-center{
            text-align: center;
      }
      .text-left{
            text-align: left;
      }

      .column-1 {
      float: left;
      width: 70%;
      text-align: right;
      align-items: flex-end;
      /* background: #e1ebf0; */
      }
      .column-2 {
      float: left;
      width: 25%;
      padding-left:10px;
      }

      .row:after {
      content: "";
      display: table;
      clear: both;
      }
      .qrcode{
            padding-left:2px;
            padding-right:5px;
            margin-top:10px;
            width: 70px;
      }
      .image{
            padding-left:2px;
            padding-right:5px;
            padding-top:10px;
      }
      .number{
    width:10%;
    font-size: 16px;
    height:20px;
      }
      .title{
      width:25%;
      font-weight:bold;
      }
      .value{
      width:50%;
      text-align:left;
      }
      .index{
      width:15%;
      }
      .number-date{
      text-align:left;
      }
      .signature{
      text-align:center;
      }
      .refarance{
      position: fixed; 
      text-align:right;
      display: block;
      top: -30px; 
      margin-right: 0;

      }
      .signetute-containt{
      text-align: justify;
      }
      .signature-row td{
      height: 100px !important;
      }
      .separate{
      width:3%;
      }
      .tbl-data tr td{
      /* border: 1px solid black; */
      }
      #tbl_office tr td{
            font-size: 10px;
      }
      .footer {
      position: fixed; 
      bottom: -40px; 
      height: 50px; 
      text-align: center;
      display: block;
      margin-left: auto;
      margin-right: auto;
      }
     
      h5{
      font-size:14px;
      }
</style>
</head>
<body>
      @php
      $locale = session()->get('locale');
      $lang="_".$locale;
      $category="category".$lang;
      $name="name".$lang;
      $title="title".$lang;
      $address1="address1".$lang;
      $address2="address2".$lang;
      $workplace="Workplace".$lang;
      $occupation="occupation".$lang;
      $guarantor="guarantor".$lang;
      $lib_name="name".$lang;

      @endphp


<div class="container">
      <div class="row text-center">
            <span class=""><h4>{{ $library->$lib_name}} - {{__('Member Application')}}</h4></span>
      </div>
      <div class="row">
            <div class="column-1">
                  <div class="row">
                        <img class="img-member1" src="images/members/{{$data->image}}">
                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG((string)$data->id, 'QRCODE',40,40)}}" alt="barcode" class="qrcode"/>
                  </div>  
            </div>
            <div class="column-2">
                  <table class="table" id="tbl_office" style="width: 100%">
                        <tr>
                              <td colspan="2" class="text-left" >{{__("Office Use")}}</td>
                        </tr>
                        <tr>
                              <td style="width: 70%">{{__("Member ID")}}</td>
                              <td style="width: 30%">{{$data->id}}</td>      
                        </tr>
                        <tr>
                              <td>{{__("Registretion Number")}}</td>
                              <td>{{$data->regnumber}}</td>
                        </tr>
                        <tr>
                              <td>{{__("Registretion Date")}}</td>
                              <td>{{$data->regdate}}</td>
                        </tr>
                  </table>
            </div>
      </div>
      <div class="row">
            <table class="table" id="tbl_member" style="width: 100%">
                  <tbody>
                      <tr>
                          <td class="index"></td>
                          <td colspan="4">
                          </td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td class="number">(01)</td>
                          <td class="title">{{__('Category')}}</td>
                          <td class="separate">&nbsp;-&nbsp;</td>
                          <td class="value">{{ $data->$name}}</td>
                      </tr>
                      <tr>
                        <td class="index"></td>
                        <td class="number">(02)</td>
                        <td class="title">{{__('Full Name')}}</td>
                        <td class="separate">&nbsp;-&nbsp;</td>
                        <td class="value">{{ $data->$title." ". $data->$name}}</td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td class="number">(03)</td>
                          <td class="title">{{__('Address')}}</td>
                          <td class="separate">&nbsp;-&nbsp;</td>
                          <td class="value">{{ $data->$address1.",". $data->$address2}}</td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td class="number">(04)</td>
                          <td class="title">{{__('Date Of Birth')}}</td>
                          <td class="separate">&nbsp;-&nbsp;</td>
                          <td class="value">{{$data->birthday}}</td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td class="number">(05)</td>
                          <td class="title">{{__('Identity-Card Number')}}</td>
                          <td class="separate">&nbsp;-&nbsp;</td>
                          <td class="value">{{$data->nic}}</td>
                      </tr>
                      <tr>
                        <td class="index"></td>
                        <td class="number">(06)</td>
                        <td class="title">{{__('Mobile Number')}}</td>
                        <td class="separate">&nbsp;-&nbsp;</td>
                        <td class="value">{{$data->mobile}}</td>
                      </tr>
                      <tr>
                        <td class="index"></td>
                        <td class="number">(07)</td>
                        <td class="title">{{__('Occupation')}}</td>
                        <td class="separate">&nbsp;-&nbsp;</td>
                        <td class="value">{{$data->$occupation}}</td>
                      </tr>
                      <tr>
                        <td class="index"></td>
                        <td class="number">(08)</td>
                        <td class="title">{{__('Offie/Collage/School')}}</td>
                        <td class="separate">&nbsp;-&nbsp;</td>
                        <td class="value">{{$data->$workplace}}</td>
                      </tr>
                      <tr>
                          <td colspan="5" class="number"></td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td colspan="4">{{__('aplicant_statement')}}</td>  
                      </tr>
                      <tr>
                      <td colspan="5" class="number"></td>
                      </tr>
                      <tr class="signature-row">
                          <td class="index"></td>
                          <td class="number-date" colspan="2">Date- </td>
                          <td class="signature" colspan="2"><span class=signetute-containt> --------------------------------- <br> Aplicant Signature</span></td>              
                      </tr>
                      <tr>
                          <td class="index"></td> 
                          <td colspan="4"><hr></td>
                      </tr>
                     
                  </tbody>
              </table>
      </div>
      <div class="row">
            <table class="table" id="tbl_guarantor" style="width: 100%">
                  <tbody>
                      <tr>
                          <td class="index"></td>
                          <td colspan="4">{{__('Guarantor Statement')}}
                          </td>
                      </tr>
                      <tr>
                        <td class="index"></td>
                        <td colspan="4">{{__('guarantor_statement')}}</td>  
                        </tr>
                      <tr>
                        <td colspan="5" class="number"></td>
                      </tr>
                      <tr>
                        <td class="index"></td>
                        <td class="number">(02)</td>
                        <td class="title">{{__('Full Name')}}</td>
                        <td class="separate">&nbsp;-&nbsp;</td>
                        <td class="value">{{ $data->$title." ". $data->$name}}</td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td class="number">(03)</td>
                          <td class="title">{{__('Address')}}</td>
                          <td class="separate">&nbsp;-&nbsp;</td>
                          <td class="value">{{ $data->$address1}}</td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td class="number">(04)</td>
                          <td class="title">{{__('Street')}}</td>
                          <td class="separate">&nbsp;-&nbsp;</td>
                          <td class="value">{{$data->birthday}}</td>
                      </tr>
                      <tr>
                        <td class="index"></td>
                        <td class="number">(07)</td>
                        <td class="title">{{__('Rate Number')}}</td>
                        <td class="separate">&nbsp;-&nbsp;</td>
                        <td class="value">{{$data->$occupation}}</td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td class="number">(05)</td>
                          <td class="title">{{__('Identity-Card Number')}}</td>
                          <td class="separate">&nbsp;-&nbsp;</td>
                          <td class="value">{{$data->nic}}</td>
                      </tr>
                      <tr>
                        <td class="index"></td>
                        <td class="number">(06)</td>
                        <td class="title">{{__('Mobile Number')}}</td>
                        <td class="separate">&nbsp;-&nbsp;</td>
                        <td class="value">{{$data->mobile}}</td>
                      </tr>
                     
                      <tr>
                      <td colspan="5" class="number"></td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td class="number-date" colspan="2">Date- </td>
                          <td class="signature" colspan="2"><span class=signetute-containt> --------------------------------- <br>Guarantor Signature</span></td>              
                      </tr>
                      <tr>
                          <td class="index"></td> 
                          <td colspan="4"><hr></td>
                      </tr>
                     
                  </tbody>
              </table>
      </div>
      <div class="row">
            <table class="table" id="tbl_certify" style="width: 100%">
                  <tbody>
                      <tr>
                          <td class="index"></td>
                          <td colspan="4">{{__('Certification Statement')}}
                          </td>
                      </tr>
                      <tr>
                        <td class="index"></td>
                        <td colspan="4">{{__('certify_statement')}}</td>  
                        </tr>
                      <tr>
                        <td colspan="5" class="number"></td>
                      </tr>
                      <tr>
                        <td class="index"></td>
                        <td class="number">(02)</td>
                        <td class="title">{{__('Name')}}</td>
                        <td class="separate">&nbsp;-&nbsp;</td>
                        <td class="value"></td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td class="number">(03)</td>
                          <td class="title">{{__('Address')}}</td>
                          <td class="separate">&nbsp;-&nbsp;</td>
                          <td class="value"></td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td class="number">(04)</td>
                          <td class="title">{{__('Designetion')}}</td>
                          <td class="separate">&nbsp;-&nbsp;</td>
                          <td class="value"></td>
                      </tr>
                     
                      <tr>
                      <td colspan="5" class="number"></td>
                      </tr>
                      <tr>
                          <td class="index"></td>
                          <td class="number-date" colspan="2">Date- </td>
                          <td class="signature" colspan="2"><span class=signetute-containt> --------------------------------- <br>Certification Officer Signature</span></td>              
                      </tr>
                      <tr>
                          <td class="index"></td> 
                          <td colspan="4"><hr></td>
                      </tr>
                     
                  </tbody>
              </table>
      </div>
</div>



   
</body>
</html>
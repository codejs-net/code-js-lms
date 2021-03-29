<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>Document</title>

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
        width: 70px;
        max-height: 110px;
        border-radius: 5px;
        border: 1px solid #010101;
      }
      #tbl_member_card{
            font-size: 10px;
            line-height: 10px;
      }
      .text-center{
            text-align: center;
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
      @endphp


<table class="" id="tbl_member_card">
        <tr>
            <td colspan="4" class="text-center">{{ $library}}&nbsp; {{ __("Library Management System")}}</td>
        </tr>
      <tr>
            <td rowspan="3"><img class="img-member1" src="images/members/{{$data->image}}"></td>
            <td><b>{{__("Category")}}</b></td>
            <td>&nbsp;:&nbsp;</td>
            <td>{{$data->$category}}</td>
      </tr>
      <tr>
            <td><b>{{__("Name")}}</b></td>
            <td>&nbsp;:&nbsp;</td>
            <td>{{$data->$name}}</td>
      </tr>
      <tr>
            <td><b>{{__("Address")}}</b></td>
            <td>&nbsp;:&nbsp;</td>
            <td>{{$data->$address1}},{{$data->$address2}}</td>
      </tr>
      <tr>
            <td class="text-center" rowspan="3"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG((string)$data->id, "C128",1,60,array(0,0,0), true)}}" alt="barcode" /></td>
            <td><b>{{__("NIC")}}</b></td>
            <td>&nbsp;:&nbsp;</td>
            <td>{{$data->nic}}</td>
      </tr>
      <tr>
            <td><b>{{__("Mobile")}}</b></td>
            <td>&nbsp;:&nbsp;</td>
            <td>{{$data->mobile}}</td>
      </tr>
      <tr>
            <td><b>{{__("Register Date")}}</b></td>
            <td>&nbsp;:&nbsp;</td>
            <td>{{$data->regdate}}</td>
      </tr>
    </table>
   
</body>
</html>
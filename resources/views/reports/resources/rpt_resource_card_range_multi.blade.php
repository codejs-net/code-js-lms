@php
$locale = session()->get('locale');
$lang="_".$locale;
$library = session()->get('library');
$lib_name = "name" . $lang;
if (!empty($library)) {
$library_name = $library->$lib_name;
}

$category="category".$lang;
$type="type".$lang;
$center="name".$lang;
$publisher="publisher".$lang;
$title="title".$lang;
$creator1="name".$lang;
$creator2="name2".$lang;
$creator3="name3".$lang;
$language="language".$lang;
$dd_class="class".$lang;
$dd_devision="devision".$lang;
$dd_section="section".$lang;
      
@endphp

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
      <?php if ($locale=="ta") { ?>
      font-family: 'latha';
      font-size: '12px';
      <?php } else { ?>
      font-family: 'iskpota';
      <?php }?>   
}
@page {
      margin-top:10px;
      margin-left:20px;
      margin-right:10px;
      margin-bottom:5px; 
}

.text-center{
      text-align: center;
}
.text-left{
      text-align: left !important;     
}

.tbl_card{
      width:100%;
      border-collapse: collapse;
      border-spacing: 0;
}

.pb-2{
      padding-bottom: 5px;
}
.pb-0{
      padding-bottom: 5px;
}
.card-heading{
      padding-bottom: 15px;
}
h4{
      font-size:18px !important;
      padding-bottom:10px;
}
.card-name{
      color: #272c66;
}
.img-qr{
      width: 80px;
      height: auto;
      padding: 10px;
}
.tbl-data{
      width: 100%;
      height: 100% !important;
      
}

.td-qr{
      width: 30%;
      height: auto;
      text-align: center;
      border-right: #4d4d50 1px solid;
      /* margin-right: 15px; */

}
.td-data{
      width: 70%;
      padding-left: 10px;
}

.td-main{
      vertical-align: top;
      padding: 10px;
      border: #cdcdd1 dashed 1px;
      height: 280px;
}

.tbl-data td{
      line-height: 18px;
      vertical-align: top;
      padding-bottom: 2px;
      font-size: 17px !important; 
}

</style>
</head>
<body>

<table class="tbl_card">
@php
$x=1
@endphp
<tr>
@for ($i = 0; $i<$rcount; $i++)

            
@if($x%4==0)
<td class="td-main">
      <table class="tbl-data">
            <tr>
                  <td rowspan="9" class="td-qr">
                        <img class="img-qr" src="data:image/png;base64,{{DNS2D::getBarcodePNG((string)$rdata[$i]->accessionNo, 'QRCODE',40,40)}}" alt="barcode" />
                        <br><span class="text-qr">{{$rdata[$i]->accessionNo}}</span>
                  </td>
            </tr>
            <tr><td class="text-left td-data"><h4 class="">{{ $library->$lib_name}}</h4></td></tr>
            <tr><td class="text-left td-data">{{$rdata[$i]->$title}}</td></tr>
            <tr>
                  <td class="text-left td-data pb-2">
                        {{$rdata[$i]->$creator1}}
                        {{($rdata[$i]->cretor2_id !=null)?",\r\n".$rdata[$i]->$creator2:""}}
                        {{($rdata[$i]->cretor3_id !=null)?",\r\n".$rdata[$i]->$creator3:""}}
                        {{($rdata[$i]->cretor_more =="1")?",\r\n".trans('more...'):""}}
                  </td>
            </tr>
            <tr><td class="text-left td-data pb-0">{{$rdata[$i]->$category}}/{{$rdata[$i]->$type}}</td></tr>
            <tr><td class="text-left td-data">Standard No: {{$rdata[$i]->standard_number}}</td></tr>
            <tr><td class="text-left td-data">Price: {{$rdata[$i]->price}}</td></tr> 
            <tr><td class="text-left td-data">Physical: {{$rdata[$i]->phydetails}}</td></tr> 
            <tr><td class="text-left td-data">DDC: {{$rdata[$i]->ddc}}</td></tr> 
      </table>
</td>
</tr>
<tr>
 @else
 <td class="td-main">
      <table class="tbl-data">
            <tr>
                  <td rowspan="9" class="td-qr">
                        <img class="img-qr" src="data:image/png;base64,{{DNS2D::getBarcodePNG((string)$rdata[$i]->accessionNo, 'QRCODE',40,40)}}" alt="barcode" />
                        <br><span class="text-qr">{{$rdata[$i]->accessionNo}}</span>
                  </td>
            </tr>
            <tr><td class="text-left td-data"><h4 class="">{{ $library->$lib_name}}</h4></td></tr>
            <tr><td class="text-left td-data">{{$rdata[$i]->$title}}</td></tr>
            <tr>
                  <td class="text-left td-data pb-2">
                        {{$rdata[$i]->$creator1}}
                        {{($rdata[$i]->cretor2_id !=null)?",\r\n".$rdata[$i]->$creator2:""}}
                        {{($rdata[$i]->cretor3_id !=null)?",\r\n".$rdata[$i]->$creator3:""}}
                        {{($rdata[$i]->cretor_more =="1")?",\r\n".trans('more...'):""}}
                  </td>
            </tr>
            <tr><td class="text-left td-data pb-0">{{$rdata[$i]->$category}}/{{$rdata[$i]->$type}}</td></tr>
            <tr><td class="text-left td-data">Standard No: {{$rdata[$i]->standard_number}}</td></tr>
            <tr><td class="text-left td-data">Price: {{$rdata[$i]->price}}</td></tr> 
            <tr><td class="text-left td-data">Physical: {{$rdata[$i]->phydetails}}</td></tr> 
            <tr><td class="text-left td-data">DDC: {{$rdata[$i]->ddc}}</td></tr> 
      </table>
</td>
      
@endif

@php
$x++
@endphp

@endfor
</tr>
</table>

   
</body>
</html>



{{-- <div class="row">
      <div class="column-1">
      <table class="tbl_card">
            <tr>
                  <td>
                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG((string)$rdata[$i]->accessionNo, 'QRCODE',40,40)}}" alt="barcode" />
                  </td>
            </tr> 
            <tr><td class="text-center">{{$rdata[$i]->accessionNo}}</td></tr>
           
      </table>  
      </div>
      <div class="column-2">
      <table class="tbl_card">
            <tr class="card-heading1">
                  <td colspan="3" class="text-left"><h4 class="">{{ $library->$lib_name}}</h4></td><br>
            </tr>
            <tr><td class="text-left">{{$rdata[$i]->$title}}</td></tr>
            <tr>
                  <td class="text-left pb-2">
                        {{$rdata[$i]->$creator1}}
                        {{($rdata[$i]->cretor2_id !=null)?",\r\n".$rdata[$i]->$creator2:""}}
                        {{($rdata[$i]->cretor3_id !=null)?",\r\n".$rdata[$i]->$creator3:""}}
                        {{($rdata[$i]->cretor_more =="1")?",\r\n".trans('more...'):""}}
                  </td>
            </tr>
            <tr><td class="text-left pb-0">{{$rdata[$i]->$category}}/{{$rdata[$i]->$type}}</td></tr>
            <tr><td class="text-left">Standard No: {{$rdata[$i]->standard_number}}</td></tr>
            <tr>
                  <td class="text-left">Price: {{$rdata[$i]->price}}</td>
            </tr> 
            <tr>
                  <td class="text-left">Physical: {{$rdata[$i]->phydetails}}</td>
            </tr> 
            <tr>
                  <td class="text-left">DDC: {{$rdata[$i]->ddc}}</td>
            </tr> 
           
      </table>
      </div>
</div> --}}
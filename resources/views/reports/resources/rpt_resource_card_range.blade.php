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
            font-size: '10px';
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
      margin-left: 10px;
      border-left: #525050 solid 1px;
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
            font-size: 12px;
          
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
            font-size:14px !important;
            padding-bottom:10px;

      }
      .card-name{
            color: #272c66;
      }

      </style>
</head>
<body>


@foreach($rdata as $data)
      <br>
      <div class="row">
            <div class="column-1">
            <table class="tbl_card">
                  <tr>
                        <td>
                              <img src="data:image/png;base64,{{DNS2D::getBarcodePNG((string)$data->accessionNo, 'QRCODE',40,40)}}" alt="barcode" />
                        </td>
                  </tr> 
                  <tr><td class="text-center">{{$data->accessionNo}}</td></tr>
                 
            </table>  
            </div>
            <div class="column-2">
            <table class="tbl_card">
                  {{-- <tr class="card-heading">
                        <td colspan="3" class="text-center"><h5 class="card-name"><u>{{__("Resource Indexing Card")}} &nbsp;-{{$data->accessionNo}}</u></h5></td><br>
                  </tr> --}}
                  <tr class="card-heading1">
                        <td colspan="3" class="text-left"><h4 class="">{{ $library->$lib_name}}</h4></td><br>
                  </tr>
                  <tr><td class="text-left">{{$data->$title}}</td></tr>
                  <tr>
                        <td class="text-left pb-2">
                              {{$data->$creator1}}
                              {{($data->cretor2_id !=null)?",\r\n".$data->$creator2:""}}
                              {{($data->cretor3_id !=null)?",\r\n".$data->$creator3:""}}
                              {{($data->cretor_more =="1")?",\r\n".trans('more...'):""}}
                        </td>
                  </tr>
                  <tr><td class="text-left pb-0">{{$data->$category}}/{{$data->$type}}</td></tr>
                  <tr><td class="text-left">Standard No: {{$data->standard_number}}</td></tr>
                  <tr>
                        <td class="text-left">Price: {{$data->price}}</td>
                  </tr> 
                  <tr>
                        <td class="text-left">Physical: {{$data->phydetails}}</td>
                  </tr> 
                  <tr>
                        <td class="text-left">DDC: {{$data->ddc}}</td>
                  </tr> 
                 
            </table>
            </div>
      </div>
<pagebreak></pagebreak>
@endforeach
   
</body>
</html>
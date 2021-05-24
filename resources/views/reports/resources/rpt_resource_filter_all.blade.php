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
$creator="name".$lang;
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
            margin-top:70px;
            margin-left:90px;
            margin-right:50px;
            margin-bottom:50px; 
            header: page-header;
            footer: page-footer;
      }
      .sinhala{
            font-family: 'iskpota';
      }
      .tamil{
            font-family: 'latha';
      }
      .english{
            font-family: 'roboto';
      }
      table{
            width: 100%;
            /* border:2px solid #021452; */
            border-collapse: collapse;
            border-spacing: 0;
           
      }
      .tbl-data td{
            line-height: 18px;
            /* border-spacing:unset;
            height: 20px; */
            padding-top: 6px;
            padding-bottom: 6px;
            padding-left: 1px;
            padding-right: 1px;
      }
      .tbl-topic tr{
            line-height: 10px;
      }
     
      .thead th{
            background-color: #656ffd;
            color: #ffffff;
            padding-top: 6px;
            padding-bottom: 6px;
      }
      .row-1{
            background-color: #ffffff
      }
      .row-2{
            background-color: #f2f3f3
      }
      .header{
            font-weight: bold;
            color: #052ba7;
            font-size: 16px;
      }

      .text-left{
            text-align: left;
      }
      .text-right{
            text-align: right;
      }
      .text-center{
            text-align: center;
      }
      .topic{
            color: #201020;
            font-weight: bold;
      }

      </style>
</head>
<body class="sinhala">

<htmlpageheader name="page-header">
      <div class="header text-center"><h3>{{$library_name}}</h3></div> 
</htmlpageheader>

<htmlpagefooter name="page-footer">
      Page:{PAGENO}
</htmlpagefooter>

<table class="table tbl-topic">
      <tr><td class="topic" style="width: 15%"><span>{{__('Report Title')}}</span></td><td style="width: 5%">:</td><td>{{__('Library Resource Report')}}</td></tr>
      <tr><td><span>{{__('Category')}}</span></td><td>:</td><td>{{$rpt_category}}/{{$rpt_type}}</td></tr>
      <tr><td><span>{{__('Creator/Author')}}</span></td><td>:</td><td>{{$rpt_creator}}</td></tr>
      <tr><td><span>{{__('Publisher')}}</span></td><td>:</td><td>{{$rpt_publisher}}</td></tr>
      <tr><td><span>{{__('DD Class')}}</span></td><td>:</td><td>{{$rpt_ddclass}}</td></tr>
      <tr><td><span>{{__('DD Devision')}}</span></td><td>:</td><td>{{$rpt_dddevision}}</td></tr>
      <tr><td><span>{{__('DD Section')}}</span></td><td>:</td><td>{{$rpt_ddsection}}</td></tr>

</table>

<table class="table table-bordered tbl-data">
      <thead class="thead">
            <tr>
                  <th>No</th>
                  <th>Asscesion No</th>
                  <th>Type</th>
                  <th style="width: 25%;">Title</th>
                  <th style="width: 20%;">Creator</th>
                  <th>Publisher</th>
                  <th>DDC</th>
              </tr>
      </thead>
        
	    @foreach($resouredata as $value)
            <tr>
                  <td>{{ $value->id}}</td>
                  <td>{{ $value->accessionNo}}</td>
                  <td>{{ $value->$type}}</td>
                  <td>{{ $value->$title}}</td>
                  <td>{{ $value->$creator}}</td>  
                  <td>{{ $value->$publisher}}</td>  
                  <td>{{ $value->ddc}}</td>
            </tr>
	    @endforeach
    </table>
   
</body>

</html>
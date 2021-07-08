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
$center="center".$lang;
$title="title".$lang;
$member="member".$lang;
$member_category="member_category".$lang;
      
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>Lending Account Report</title>
      {{-- <link href="{{ asset('css/site.css') }}" rel="stylesheet"> --}}
      
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
            margin-bottom:30px; 
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
      td{
            line-height: 18px;
            /* border-spacing:unset;
            height: 20px; */
            padding-top: 6px;
            padding-bottom: 6px;
            padding-left: 1px;
            padding-right: 1px;
      }
     
      .thead th{
            background-color: #fafc80;
            color: #080000;
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
            color: #140a6e;
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
<body class="">

<htmlpageheader name="page-header">
      <div class="header text-center"><h3>{{$library_name}}</h3></div> 
</htmlpageheader>

<htmlpagefooter name="page-footer">
      Page:{PAGENO}
</htmlpagefooter>

<div>
      <table class="table">
            <tr>
                  <td style="text-align: left;" class="topic">{{__('Library Lending Account Report')}} - {{__($rpt_filter)}}</td>
                  <td style="text-align: right;">{{($rpt_member == "%") ? trans('All') : $rpt_member}} -> {{($rpt_resource == "%") ? trans('All') : $rpt_resource}}</td>
            </tr>
      </table>
</div>
<table class="table table-bordered">
      <thead class="thead">
            <tr>
                  <th>No</th>
                  <th>ID</th>
                  <th>Issue Date</th>
                  <th>Accession No</th>
                  <th style="width: 25%;">Title</th>
                  <th style="width: 30%;">Member</th>
                  <th>Return Date</th>
            </tr>
      </thead>
    
      <tbody>
            @for ($i=0 ; $i<$lendingdata->count();$i++)
            @if($i % 2==0)
                  <tr class="row-1">
                        <td>{{ $i+1 }}</td>
                        <td>{{ $lendingdata[$i]->id}}</td>
                        <td>{{ $lendingdata[$i]->issue_date}}</td>
                        <td>{{ $lendingdata[$i]->accessionNo}}</td>
                        <td>{{ $lendingdata[$i]->$title}}</td>
                        <td>{{ $lendingdata[$i]->member_id}}- {{ $lendingdata[$i]->$member}}</td>  
                        <td>{{ $lendingdata[$i]->return_date}}</td>  
                  </tr>
            @else
                  <tr class="row-2">
                        <td>{{ $i+1 }}</td>
                        <td>{{ $lendingdata[$i]->id}}</td>
                        <td>{{ $lendingdata[$i]->issue_date}}</td>
                        <td>{{ $lendingdata[$i]->accessionNo}}</td>
                        <td>{{ $lendingdata[$i]->$title}}</td>
                        <td>{{ $lendingdata[$i]->member_id}}- {{ $lendingdata[$i]->$member}}</td>  
                        <td>{{ $lendingdata[$i]->return_date}}</td>  
                  </tr>
            @endif

            @endfor
      </tbody>
    </table>
   
</body>

</html>
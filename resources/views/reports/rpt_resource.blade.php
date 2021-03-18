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
            margin-top:70px;
            margin-left:90px;
            margin-right:20px;
            margin-bottom:20px; 
            header: page-header;
            footer: page-footer;
            }
      </style>
</head>
<body>
<htmlpageheader name="page-header">
</htmlpageheader>

<htmlpagefooter name="page-footer">
      Page:{PAGENO}
</htmlpagefooter>

<p>පුස්ථකාල කළමණාකරන සම්පත් වාර්තාව</p>

<table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Asscesion No</th>
            <th>Type</th>
            <th width="300px">Title</th>
        </tr>
	    @foreach($resouredata as $item)
            @foreach($item as $value)
            <tr>
                  <td>{{ $value->id}}</td>
                  <td>{{ $value->accessionNo}}</td>
                  <td>{{ $value->type_si}}</td>
                  <td>{{ $value->title_si}}</td>
            </tr>
            @endforeach
	    @endforeach
    </table>
   
</body>
</html>
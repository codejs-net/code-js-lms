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
	Header Content
</htmlpageheader>

<htmlpagefooter name="page-footer">
	Footer Content
      {PAGENO}
</htmlpagefooter>

<p>පුස්ථකාල කළමණාකරන පද්ධතිය</p>
<h2>{{$data}}</h2>    
</body>
</html>
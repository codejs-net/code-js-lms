@php
$locale = session()->get('locale');
$lang="_".$locale;
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
      
      <script type="text/javascript">
            alert("");
      </script>
     
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
            margin-right:20px;
            margin-bottom:20px; 
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
      </style>
</head>
<body class="sinhala">

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
            <th>Title</th>
            <th>Creator</th>
            <th>Publisher</th>
            <th>DDC</th>
        </tr>
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
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script> -->

    <style>
    @page { margin: 20px; }
    body { margin: 20px; }

    table {
    width: 100%;
    }
    img {
        padding-bottom: 20px;
        padding-left: 10px;
        padding-top: 10px;
        padding-right: 5px;
        /* padding-right: 50px;
        padding-left: 80px; */
    }
    td {
        border-style: dashed;
        border-width: 2px;
        border-color: #d6d0d0;
    }  
    tr {
    /* padding-bottom:30px; */
    }    
    </style>

</head>

<body>
    <div >
    <table>
        @php
        $x=0
        @endphp
        <tr>
        @for ($i = $data[0]; $i<=$data[1]; $i++)
       
            @php
            $x++
            @endphp
                
            @if($x%5==0)
            <td><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($data[2].$i, 'C128',1,60,array(0,0,0), true)}}" alt="barcode" /></td>
            </tr>
            <tr>
            @else
            <td><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($data[2].$i, 'C128',1,60,array(0,0,0), true)}}" alt="barcode" /></td>
            @endif

        @endfor
        </tr>
    </table>
  </div>  
</body>
</html>


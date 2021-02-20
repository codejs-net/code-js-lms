@php
$locale = session()->get('locale');
$lang="_".$locale;
$title="title".$lang;
$category="category".$lang;
$type="type".$lang;
$member="member".$lang;

@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Receipt</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body onload="printDiv()">

    <div id="print_lendding">
    <h4>Issue Receipt</h4>
    <h5 id="member">{{$lendingdata[0]->$member}}</h5>
    <hr>
    
    <table>
    	<thead>
    		  <tr>
                <th>Accession No</th>
                <th>Title</th>
              </tr>    
    	</thead>
    	<tbody>
        @foreach ($lendingdata as $item)
	    <tr>
	        <td>{{ $item->accessionNo }}</td>
	        <td>{{ $item->$title }}</td>
	    </tr>
	    @endforeach
    		
    	</tbody>
    	
    </table>
    </div>

    <script>

// $('#genaral35a').css('width', '816px');

function printDiv() 
{

  var divToPrint=document.getElementById('print_lendding');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}

    function printlending(){
        var contents = $("#print_lendding").html();
        
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<link href="{{ asset('css/app.css') }}" rel="stylesheet">');
        frameDoc.document.write('<link href="{{ asset('css/site.css') }}" rel="stylesheet">');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    }


</script>
    
</body>
</html>
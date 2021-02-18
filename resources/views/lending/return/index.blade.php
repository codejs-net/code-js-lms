@extends('layouts.app')


@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$type="type".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Lending&nbsp;</a></li>
    <li class="breadcrumb-item active" ><a><i class="fa fa-plus"></i> Resources Return&nbsp;</a></li>
</ol>
</nav>
      <!-- Content Header (Page header) -->
<form class="form-inline" id="form_barrow" onSubmit="return false;">
{{csrf_field()}}
<div class="container-fluid">
    <div class="row text-center mb-2">
        <div class="col-md-12 col-sm-12 text-center"> 
            <h5> <i class="fa fa-shopping-cart">&nbsp;Resources Return</i></h5>
        </div> 

    </div>
    
</div>

<div class="container-fluid">
    <div class="card card-body">
        <div class="row">
        <input type="hidden" name="member_Name_id"id="member_Name_id">

            <div class="col-md-3 col-sm-12 text-left mt-1">
              <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-addon"id="basic-addon2"><i class="fa fa-user-circle-o fa-lg mt-2"></i></span>
                  </div>
                    <input type="text" class="form-control" id="member_id" placeholder="Member ID"aria-describedby="basic-addon2">&nbsp;&nbsp;
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addbarrowmember"><i class="fas fa-check-circle"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addbarrowmember_serch"><i class="fa fa-search"></i></button> 
                </div>  
            </div>

             <div class="col-md-5 col-sm-12 text-left mt-1">
              <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-addon"id="basic-addon3"><i class="fa fa-list fa-lg mt-2"></i></span>
                  </div>
                    <input type="text" class="form-control" id="resource_details" onfocus="this.value=''" placeholder="AccessionNo / ISBN / ISSN / ISMN" aria-describedby="basic-addon3">&nbsp;&nbsp;
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addbarrow" data-toggle="tooltip" data-placement="top"><i class="fa fa-level-down fa-lg"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addbarrow_serch"><i class="fa fa-search"></i></button>
                </div> 
            </div>
             <div class="col-md-1 col-sm-12">
             </div>
            <div class="col-md-3 col-sm-12 text-right mt-1">
                <div class="input-group pull-right">
                    <div class="input-group-prepend">
                        <span class="input-group-addon"id="basic-addon1"><i class="fa fa-calendar fa-lg mt-2"></i></span>
                    </div>
                    <input type="date" class="form-control" name="returndte" id="returndte" value="{{$returndate}}" aria-describedby="basic-addon1">
                </div>
            </div>

        </div>

        <div class="row text-center mt-4">
            <div class="col-md-12">
                <!-- small box -->
                    <div class="card card-name" style="height:2.5rem;">
                        <div class="text-center">
                        <span><i class="fa fa-user-circle-o">&nbsp;
                            <span id="member_Name"class="text-dark font-weight-bold"></span>
                            <!-- <span id="member_show_id"class="font-weight-bold badge badge-info"></span> -->
                        </i></span>
                        
                        </div>
                    </div>

            </div>
        </div>

            <div class="form-row ">
            <div class="table-responsive"style="overflow-x: auto;"> 
                <table class="table table-hover" id="resourceTable">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Resource ID</th>
                    <th scope="col">Type</th>
                    <th scope="col">Accession No</th>
                    <th scope="col">ISBN/ISSN</th>
                    <th scope="col">Title</th>
                    <th scope="col">Issue Date</th>
                    <th scope="col">Dateof Return</th>
                    <th scope="col">Fine</th>
                    <th scope="col">Return</th>
                    <th scope="col">Action</th>
                    </tr>    
                    </thead>

                    <tbody class="tbody_data" id="resourcedata">
                           
                    </tbody>
                </table>
                </div>
            </div>

    </div>
    <hr>
        <div class="input-group box-footer clearfix pull-right">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="check_print">
            <label class="form-check-label" for="check_print">Print Recipt</label>
        </div>
            <button type="button" class="btn btn-sm btn-primary btn-md ml-2" id="issue_resource">
            <i class="fa fa-floppy-o"></i> Save</button>
            &nbsp; &nbsp;
            <button type="button" class="btn btn-sm btn-warning btn-md ml-2" id="reset_issue">
            <i class="fa fa-times"></i> Reset</button>
        </div> 
</div>
</form>

<div id="printdiv" style="display: none;">
    <div class="col-md-4">
        <div id="print_lendding" style="text-align: center;">
            <div class="text-center"><u><h3>Issue Receipt</h3></u></div>
            </br>
            
                <h5 >Member : <span id="print_member"></span></h5>
                <h5 >Issue Date : <span id="print_issuedate"></span></h5>
                <h5>Return Date :<span id="print_returndate"></span></h5>
                
                <table id="print_table">
                    <!-- <thead>
                        <tr>
                            <th>Accession No</th>
                            <th>Title</th>
                            <th>&nbsp;</th>
                        </tr>    
                    </thead> -->
                    <tbody> 
                    </tbody>
                </table>

                </br>
                <div class="text-center mb-3"><h3>Thank You!</h3></div>
            </div>
        </div>
</div>

              
<!------------------------------------------------------------------------------------------->
                            
                        
@endsection
@push('scripts')

    <script>
    $(document).ready(function() {

        document.getElementById("member_id").focus();
        $("#resourceTable tbody").empty();

        var inputm = document.getElementById("member_id");
        inputm.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("addbarrowmember").click();
            $('#member_id').val('');
            }
        });
            var input = document.getElementById("resource_details");
            input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("addbarrow").click();
            $('#resource_details').val('');
            document.getElementById("resource_details").focus();
            }
        });
    });
// ----------------------------------------------------------------------------

        $('#addbarrowmember').on("click",function(){
        var memberid = $("#member_id").val();
        $('#resource_details').val('');
        $('#member_Name_id').val('');
        $('#member_Name').html('');
        $("#resourceTable tbody").empty();
        $("#print_table tbody").empty();
        var op="";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            dataType : 'json',
            data: { memberid: memberid },
            url: "{{route('get_lending')}}",
            success: function(data){
                // console.log(data);
                $('#member_id').val('');
                if(data[0]['status']=="success")
                {
                    var membr=data[0]['member_id']+" - "+data[0]['member_name']+"( "+data[0]['member_add1']+","+data[0]['member_add2']+" )";
                    $('#member_Name').html(membr);
                    $('#member_Name_id').val(data[0]['id']);
                    // ------------table-----------------------------
                    for (j = 0; j < data.length; j++)
                    {
                        op+='<tr>';
                        op+='<td class="td_id">'+data[j]['id']+'</td>';
                        op+='<td>'+data[j]['resource_id']+'</td>';
                        op+='<td>'+data[j]['resource_cat']+"-"+data[j]['resource_type']+'</td>';
                        op+='<td class="td_input">'+data[j]['resource_accno']+'</td>';
                        op+='<td class="td_input">'+data[j]['resource_isn']+'</td>';
                        op+='<td>'+data[j]['resource_title']+'</td>';
                        op+='<td>'+data[j]['issue_date']+'</td>';
                        op+='<td>'+data[j]['return_date']+'</td>';
                        op+='<td>'+data[j]['fine']+'</td>';
                        op+='<td>'+data[j]['return']+'</td>';
                        op+='<td><button type="button" value="'+data[j]['id']+'" class="btn btn-sm btn-outline-success return_resources"><i class="fa fa-level-down"></i></button></td>';
                        op+='</tr>';  
                    }
                    //-------------end table-------------------------
                    $("#resourceTable tbody").append(op);
                    document.getElementById("resource_details").focus();
                }
                else if(data[0]['status']=="no")
                {
                    toastr.info('No resources to return by '+data[0]['member_name']);
                    document.getElementById("member_id").focus();
                }
                else
                {
                    toastr.error('Member Not Registerd!')
                    document.getElementById("member_id").focus();
                }
            
            },
            error: function(data){
            toastr.error('Something Went Wrong!')
            $('#member_id').val('');
            document.getElementById("member_id").focus();
            }
        });
    });
    // ------------------------------------------------------------------------

    $('#addbarrow').on("click",function(){
        var resourceinput = $("#resource_details").val();
        var limit = $("#lending_limit").val();
        var op ="";
        var bexsist=false;
        if($('#member_Name_id').val())
        {    
            if(resourceinput)
            {
                var rowCount = $('#resourceTable tr').length;
                var oTable = document.getElementById('resourceTable');
                var mem_id = $("#member_Name_id").val();
                var dtereturn = $("#returndte").val();
                for (j = 1; j < rowCount; j++)
                {
                    var oCells = oTable.rows.item(j).cells;
                    var cellVal_accno = oCells.item(3).innerHTML;
                    var cellVal_snumber = oCells.item(4).innerHTML;
                    var cellVal_lend_id = oCells.item(0).innerHTML;
                    var cellVal_fine = oCells.item(8).innerHTML;
                    if(resourceinput.toUpperCase()==cellVal_accno.toUpperCase() || resourceinput.toUpperCase()==cellVal_snumber.toUpperCase() )
                    { 
                        //-------------------------------------------------------
                        $.ajaxSetup({
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                            $.ajax({
                                type: 'POST',
                                dataType : 'json',
                                data:{
                                    mem_id: mem_id,
                                    dtereturn: dtereturn,
                                    cellVal_lend_id: cellVal_lend_id,
                                    cellVal_fine:cellVal_fine
                                    },
                                url: "{{route('store_return')}}",
                                success: function(data){  
                                    // console.log(data);
                                    if(data.massage=="success")
                                    {
                                        // $(function(){
                                        //     $("#resourceTable .td_input").filter(function() {
                                        //         return $(this).text() == data.lendid;
                                        //     }).parent('tr').remove();
                                        // });

                                        $('#resourceTable').find('.td_id').each(function(){
                                            if($(this).text() == data.lendid){
                                                $(this).parent('tr').remove();
                                            }
                                        });

                                        // $('#mytable tr').each(function() {
                                        //     $(this).find(".customerIDCell").html();    
                                        // });
                                        toastr.success('Resources Successfully Returnd')
                                    }
                                   
                                },
                                error: function(data){
                                    toastr.error('Returing Error')
                                }
                            });
                        //-------------------------------------------------------
                        // oCells.item(9).innerHTML='<button type="button" value="1" class="btn btn-sm btn-success return_resources"><i class="fa fa-check"></i></button>'
                    }
                    
                }
                // -------------------------------------------------------
                // resourceinput= $("#resourceTable tr").filter(function() {
                //     var customerId = $(this).find(".customerIDCell").html();
                // }).closest("tr");
               
                //  $('#resourceTable tr:contains("'+resourceinput+'")').addClass('text-success');
                //  $("#resourceTable .td_input:contains('" + resourceinput + "')").addClass('text-success');
                // --------------------------------------------------------  
               
            }
            else{toastr.error('Enter Resource AccessionNo / ISBN / ISSN / ISMN')}
        }
        else
        {
            toastr.error('Plese Select Member first');
            document.getElementById("member_id").focus();
        }
        

    });
    // -----------------------------------------------------
    $('#issue_resource').on("click",function(){

        var oTable = document.getElementById('resourceTable');
        var rowLength = oTable.rows.length;
        var mem_id = $("#member_Name_id").val();
        var dteissue = $("#issuedte").val();
        var descript=[];
        if(rowLength>1)
        {
            for (i = 1; i < rowLength; i++)
            {
                var oCells = oTable.rows.item(i).cells;
                var resourcename = oCells.item(1).innerHTML;
                descript[i]=resourcename;
            }
            var description = descript.toString();

            // ------------------------lending save--------------------------------
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    dataType : 'json',
                    url: "{{route('issue.store')}}",
                    data:{
                        description: description,
                        mem_id: mem_id,
                        dteissue: dteissue
                        },
                    success: function(data){
                        var lendid=data.lend_id;
                        // ---------------------lending Details save--------------
                        for (j = 1; j < rowLength; j++)
                        {
                            var op="";
                            var oCells = oTable.rows.item(j).cells;
                            var resourceid = oCells.item(0).innerHTML;

                            $.ajaxSetup({
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                            $.ajax({
                                type: 'POST',
                                dataType : 'json',
                                data:{
                                    resourceid: resourceid,
                                    mem_id: mem_id,
                                    dteissue: dteissue,
                                    lendid: lendid
                                    },
                                url: "{{route('store_issue')}}",
                                success: function(data){  
                                   
                                },
                                error: function(data){
                                   
                                }
                            });
                        }
                        //------------------------end-----------------------------
                        toastr.success('lending Processe Successfuly Completed');
                        if($("#check_print").prop("checked") == true)
                        {
                            // --------------print--------------------------
                            $('#print_member').html($('#member_Name').html());
                            $('#print_issuedate').html(dteissue);
                            
                            for (k = 1; k < rowLength; k++)
                            {
                                var op="";
                                var oCells = oTable.rows.item(k).cells;
                                var resourceacceno = oCells.item(1).innerHTML;
                                var resourcetitle = oCells.item(3).innerHTML;
                                var resourcetype = oCells.item(5).innerHTML;
                            
                                op+='<tr>';
                                op+='<td>'+resourceacceno+'</td><td>&nbsp;-&nbsp;'+resourcetitle+'</td><td>&nbsp;('+resourcetype+')</td>';
                                op+='</tr>';
                                $("#print_table tbody").append(op);
                            }
                            printDiv();
                            //---------------end print----------------------  
                        }
                        
                        $('#resource_details').val('');
                        $('#member_Name_id').val('');
                        $('#member_Name').html('');
                        $("#resourceTable tbody").empty();
                        $("#print_table tbody").empty();
                        document.getElementById("member_id").focus();
                    },
                    error: function(data){
                        toastr.error('lending Processe faild');
                    }
            });
            // ----------------------end lending save-------------------------------
        }
        else
        {
            toastr.warning('Lending Cart is empty');
        }
         
    });

    $("#resourceTable").on('click', '.remove_resources', function () {
        $(this).closest('tr').remove();
        document.getElementById("resource_details").focus();

    });
   
    function printDiv(){
        var contents = $("#print_lendding").html();
        
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1[0].id = "frame1";
        frame1[0].width = "250px";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        frameDoc.document.write('<html><head><title>Riceipt</title>');
        frameDoc.document.write('</head><body>');
        frameDoc.document.write('<link href="{{ asset('css/app.css') }}" rel="stylesheet">');
        frameDoc.document.write('<link href="{{ asset('css/riceipt.css') }}" rel="stylesheet">');
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        // window.frames["frame1"].focus();
        // window.frames["frame1"].print();
        
        $("#frame1").get(0).contentWindow.print();
        setTimeout(function () {
           frame1.remove();
        }, 10000);
    }
    

</script>
@endpush

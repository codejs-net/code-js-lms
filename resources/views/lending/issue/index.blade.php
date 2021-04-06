@extends('layouts.app')


@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$title="title".$lang;
$category="category".$lang;
$type="type".$lang;
$publisher="publisher".$lang;
$medium="phymedia".$lang;
$language="language".$lang;
$dd_class="class".$lang;
$dd_devision="devision".$lang;
$dd_section="section".$lang;
$creator="name".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Lending&nbsp;</a></li>
    <li class="breadcrumb-item active" ><a><i class="fa fa-plus"></i> Resources Issue&nbsp;</a></li>
</ol>
</nav>
      <!-- Content Header (Page header) -->
<form class="form-inline" id="form_barrow" onSubmit="return false;">
{{csrf_field()}}
<div class="container-fluid">
    <div class="row text-center mb-2">
        <div class="col-md-12 col-sm-12 text-center"> 
            <h5> <i class="fa fa-shopping-cart">&nbsp;Resources Lending</i></h5>
        </div> 

    </div>
    
</div>

<div class="container-fluid">
    <div class="card card-body">
        <div class="row">
        <input type="hidden" name="member_Name_id"id="member_Name_id">
        <input type="hidden" name="member_Name_sms"id="member_Name_sms">
        <input type="hidden" name="member_mobile"id="member_mobile">
        <input type="hidden" name="db_count"id="db_count">
        <input type="hidden" name="lending_limit" id="lending_limit">

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
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addbarrow" data-toggle="tooltip" data-placement="top"><i class="fas fa-cart-plus"></i></button>
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
                    @if(auth()->user()->can('date-change'))
                    <input type="date" class="form-control" name="issuedte" id="issuedte" value="{{$issuedate}}" aria-describedby="basic-addon1">
                    @else
                    <input type="date" class="form-control" name="issuedte" id="issuedte" value="{{$issuedate}}" aria-describedby="basic-addon1"disabled>
                    @endif
                    
                </div>
            </div>

        </div>

        <div class="row text-center mt-4">
            <div class="col-md-12">
                <!-- small box -->
                    <div class="card card-name-1" style="height:2.5rem;">
                        <div class="text-center ">
                        <span><i class="fa fa-user-circle-o">&nbsp;
                            <span id="member_Name"class="text-indigo font-weight-bold"></span>
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
                    <th scope="col" class="td_id">ID</th>
                    <th scope="col">Accession No</th>
                    <th scope="col">ISBN/ISSN</th>
                    <th scope="col">Title</th>
                    <th scope="col">Creator</th>
                    <!-- <th scope="col">Category</th> -->
                    <th scope="col">Type</th>
                    <th scope="col">&nbsp;</th>
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
            <i class="fa fa-floppy-o"></i> Save&nbsp;<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"  style="display: none;" id='loader'></span></button>
            &nbsp; &nbsp;
            <button type="button" class="btn btn-sm btn-warning btn-md ml-2" id="reset_issue">
            <i class="fa fa-times"></i> Reset</button>
        </div> 
    </div>
    
</form>
 <!-- Image loader -->
 <!-- <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div id='loader' class="center text-center" style="display: none;">
        <img src='img/loader1.gif' width='140px' height='18px'>
        </div>
    </div>
</div> -->
<!-- Image loader -->

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
                            
@include('lending.issue.same_resource_modal')                       
@endsection
@section('script')

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
        $('#db_count').val('');
        $('#member_Name').html('');
        $("#resourceTable tbody").empty();
        $("#print_table tbody").empty();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            dataType : 'json',
            data: { memberid: memberid },
            url: "{{route('member_view')}}",
            success: function(data){
    
                var mem_detail=data.member_id+" - "+data.member_nme+" ("+data.member_adds1+","+data.member_adds2+")";
                $('#member_Name').html(mem_detail);
                $('#member_Name_sms').val(data.member_nme);
                $('#member_mobile').val(data.mobile);
                $('#member_Name_id').val(data.member_id);
                $('#db_count').val(data.db_count);
                $('#lending_limit').val(data.lending_limit);
                $('#member_id').val('');
                document.getElementById("resource_details").focus();
            
            },
            error: function(data){
            toastr.error('Member Not Found!')
            $('#member_id').val('');
            document.getElementById("member_id").focus();
            }
        });
    });
    // ------------------------------------------------------------------------

    $('#addbarrow').on("click",function(){
        var resourceinput = $("#resource_details").val();
        var limit = parseInt($("#lending_limit").val());
        var db_count = parseInt($("#db_count").val());
        var memberid= $('#member_Name_id').val();
        var op ="";
        var op1 ="";
        var bexsist=false;
        $("#same_resource_table tbody").empty();
        if($('#member_Name_id').val())
        {
            var rowCount = $('#resourceTable tr').length;
            if(rowCount + db_count <= limit) 
            {
                var oTable = document.getElementById('resourceTable');
                
                if(resourceinput)
                {
                    for (j = 1; j < rowCount; j++)
                    {
                        var oCells = oTable.rows.item(j).cells;
                        var cellVal_accno = oCells.item(1).innerHTML;
                        var cellVal_snumber = oCells.item(2).innerHTML;
                        if(resourceinput.toUpperCase()==cellVal_accno.toUpperCase() || resourceinput.toUpperCase()==cellVal_snumber.toUpperCase() )
                        { 
                            bexsist=true;   
                        }
                    }
                    if(bexsist==false)
                    { 
                        // -------------------------------------------------------
                        $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: 'POST',
                            dataType : 'json',
                            url: "{{route('resource_view')}}",
                            data:{
                                    resourceinput: resourceinput,
                                    memberid:memberid
                                },
                            success: function(data){
                            if(data.massage=="success")
                                {
                                    for (j = 1; j < rowCount; j++)
                                    {
                                        var oCells = oTable.rows.item(j).cells;
                                        var cellVal_accno = oCells.item(1).innerHTML;
                                        var cellVal_snumber = oCells.item(2).innerHTML;
                                        if(resourceinput.toUpperCase()==cellVal_accno.toUpperCase())
                                        { 
                                            bexsist=true;   
                                        }
                                    }
                                    if(bexsist==false)
                                    { 
                                        op+='<tr>';
                                        op+='<td class="td_id">'+data.id+'</td><td>'+data.accno+'</td><td>'+data.snumber+'</td><td>'+data.title+'</td><td>'+data.creator+'</td><td>'+data.category+"-"+data.type+'</td><td><button type="button" value="'+data.id+'" class="btn btn-sm btn-outline-danger remove_resources"><i class="fa fa-trash"></i></button></td>';
                                        op+='</tr>';
                                        $("#resourceTable tbody").append(op);
                                    }
                                    else{toastr.error('Resource Alrady in Cart')} 
                                   
                                }
                                else if(data.massage=="lend")
                                {
                                    toastr.error('Resource Alredy Lend');
                                }
                                else if(data.massage=="error")
                                {
                                    toastr.error('Resource not found');
                                }
                                else if(data.massage=="duplicate")
                                {
                                   
                                    for (j = 0; j < data.resos.length; j++)
                                    {
                                        console.log(data.resos[j].accessionNo);
                                        op1+='<tr>';
                                        op1+='<td class="td_id">'+data.resos[j].id+'</td><td>'+data.resos[j].accessionNo+'</td><td>'+data.resos[j].standard_number+'</td><td>'+data.resos[j].{{$title}}+'</td><td>'+data.resos[j].{{$creator}}+'</td><td>'+data.resos[j].{{$category}}+"-"+data.resos[j].{{$type}}+'</td><td><button type="button" value="'+data.resos[j].id+'" class="btn btn-sm btn-outline-success select_resos"><i class="fa fa-plus"></i></button></td>';
                                        op1+='</tr>';
                                        
                                    }
                                    $("#same_resource_table tbody").append(op1);
                                    $('#same_resource_modal').modal('show');
                                    toastr.warning('Same ISBN');
                                   
                                }
                        
                            },
                            error: function(data){
                            toastr.error('Something Went Wrong!')
                            }
                        });
                        // -------------------------------------------------------------
                    }
                    else{toastr.error('Resource Alrady in Cart')} 
                }
                else{toastr.error('Enter Resource AccessionNo / ISBN / ISSN / ISMN')}
            }
            else{toastr.error('Maximam Resource lending Limit reached!')}
        }
        else
        {
            toastr.error('Plese Select Member first');
            document.getElementById("member_id").focus();
        }
        

    });
    // -----------------------------------------------------
    $('#issue_resource').on("click",function(){
        // $("#loader").show();
        var oTable = document.getElementById('resourceTable');
        var rowLength = oTable.rows.length;
        var mem_id = $("#member_Name_id").val();
        var dteissue = $("#issuedte").val();
        var membername=$('#member_Name_sms').val();
        var membermobile=$('#member_mobile').val();
        var descript=[];
        if($('#member_Name_id').val())
        {
            if(rowLength>1)
            {
                for (i = 1; i < rowLength; i++)
                {
                    var oCells = oTable.rows.item(i).cells;
                    var resourceaccno = oCells.item(1).innerHTML;
                    var resourcetitles = oCells.item(3).innerHTML;
                    descript[i]=resourcetitles+"("+resourceaccno+")";
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
                            dteissue: dteissue,
                            membername:membername,
                            membermobile:membermobile
                            },
                        beforeSend: function(){
                            $("#loader").show();
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
                                    
                                    },
                                    complete:function(data){
                                    $("#loader").hide();
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
            {toastr.warning('Lending Cart is empty');}
        }
        else
        {
            toastr.error('Plese Select Member first');
            document.getElementById("member_id").focus();
        }
         
    });

    $("#resourceTable").on('click', '.remove_resources', function () {
        $(this).closest('tr').remove();
        document.getElementById("resource_details").focus();

    });

    $("#same_resource_table").on('click', '.select_resos', function () {
       var select_resoid= $(this).val();
       var memberid= $('#member_Name_id').val();
       var op="";
         // -------------------------------------------------------
         $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            dataType : 'json',
            url: "{{route('select_resource_view')}}",
            data:{
                    select_resoid: select_resoid,
                    memberid:memberid
                },
            success: function(data){
            if(data.massage=="success")
                {
                    op+='<tr>';
                    op+='<td class="td_id">'+data.id+'</td><td>'+data.accno+'</td><td>'+data.snumber+'</td><td>'+data.title+'</td><td>'+data.creator+'</td><td>'+data.category+"-"+data.type+'</td><td><button type="button" value="'+data.id+'" class="btn btn-sm btn-outline-danger remove_resources"><i class="fa fa-trash"></i></button></td>';
                    op+='</tr>';
                    $("#resourceTable tbody").append(op);
                    $('#same_resource_modal').modal('hide');
                }
                else if(data.massage=="lend")
                {
                    toastr.error('Resource Alredy Lend');
                }
                else if(data.massage=="error")
                {
                    toastr.error('Resource not found');
                }
                
        
            },
            error: function(data){
            toastr.error('Something Went Wrong!')
            }
        });
        // -------------------------------------------------------------
        
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
@endsection
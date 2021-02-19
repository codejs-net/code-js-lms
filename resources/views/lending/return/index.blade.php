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
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addbarrow" data-toggle="tooltip" data-placement="top"><i class="fa fa-check-square-o fa-lg"></i></button>
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
                    <th scope="col">Fine(Rs)</th>
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
    <div class="row mt-4">
        <div class="col-md-6">
            <span class="text-dark ml-3">&nbsp;Actions :</span>
            <span class="text-warning ml-3"><i class="fa fa-money"></i>&nbsp;Settle Fine&nbsp;|</span>
            <span class="text-success ml-3"><i class="fa fa-check-square-o"></i>&nbsp;Return Resource&nbsp;|</span>
            <span class="text-info ml-3"><i class="fa fa-calendar-plus-o"></i>&nbsp;Extend Days</span>

        </div>
        <div class="col-md-6">
            <div class="input-group box-footer clearfix pull-right">
                <button type="button" class="btn btn-sm btn-primary btn-md ml-2" id="print_return">
                <i class="fa fa-print"></i> Print</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-sm btn-warning btn-md ml-2" id="reset_issue">
                <i class="fa fa-times"></i> Reset</button>
            </div> 
        </div>
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
                        if(data[j]['fine_amount']!=0){op+='<tr class="text-danger font-weight-bold">';}
                        else{op+='<tr>';}
                        op+='<td class="td_id">'+data[j]['id']+'</td>';
                        op+='<td>'+data[j]['resource_id']+'</td>';
                        op+='<td>'+data[j]['resource_cat']+"-"+data[j]['resource_type']+'</td>';
                        op+='<td class="td_input">'+data[j]['resource_accno']+'</td>';
                        op+='<td class="td_input">'+data[j]['resource_isn']+'</td>';
                        op+='<td>'+data[j]['resource_title']+'</td>';
                        op+='<td>'+data[j]['issue_date']+'</td>';
                        op+='<td>'+data[j]['return_date']+'</td>';
                        op+='<td class="fine_amount">'+data[j]['fine_amount']+'</td>';
                        op+='<td>'+data[j]['return']+'</td>';
                        op+='<td>';
                        if(data[j]['fine_amount']!=0)
                        {
                            op+='<button type="button" value="'+data[j]['id']+'" class="btn btn-sm btn-outline-warning ml-1 settel_fine"><i class="fa fa-money"></i></button>';
                        }
                        else
                        {
                            op+='<button type="button" value="'+data[j]['id']+'" class="btn btn-sm btn-outline-success ml-1 return_lending"><i class="fa fa-check-square-o"></i></button>';
                            op+='<button type="button" value="'+data[j]['id']+'" class="btn btn-sm btn-outline-info ml-1 extend_lending"><i class="fa fa-calendar-plus-o"></i></button>';
                        }
                        op+='</td>';
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
                var resource_found=0;
                for (j = 1; j < rowCount; j++)
                {
                    var oCells = oTable.rows.item(j).cells;
                    var cellVal_accno = oCells.item(3).innerHTML;
                    var cellVal_snumber = oCells.item(4).innerHTML;
                    var cellVal_lend_id = oCells.item(0).innerHTML;
                    var cellVal_fine = oCells.item(8).innerHTML;
                    if(resourceinput.toUpperCase()==cellVal_accno.toUpperCase() || resourceinput.toUpperCase()==cellVal_snumber.toUpperCase() )
                    { 
                        resource_found=1;
                        if(cellVal_fine==0)
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
                                            
                                            $('#resourceTable').find('.td_id').each(function(){
                                                if($(this).text() == data.lendid){
                                                    $(this).parent('tr').remove();
                                                }
                                            });
                                            toastr.success('Resources Successfully Returnd');
                                        }
                                    },
                                    error: function(data){
                                        toastr.error('Returing Error');
                                    }
                                });
                            //---------------------------------------------------------
                        }
                        else
                        {
                            toastr.warning('Plese Settle the Fine Before Return');
                        }
                    
                    }
                }
               
                if(resource_found==0){  toastr.error('Resource Not Found!');}
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
         
    });


    $("#resourceTable").on('click', '.return_lending', function () {
        // $(this).closest('tr').remove();
        var dtereturn = $("#returndte").val();
        var fine_amount =  $(this).closest('tr').find(".fine_amount").html();
        var cellVal_lend_id=$(this).val();
        // toastr.error("lend id:"+lend_id+" fine:"+fine_amount);
        //-------------------------------------------------------
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                dataType : 'json',
                data:{
                    dtereturn: dtereturn,
                    cellVal_lend_id: cellVal_lend_id
                    },
                url: "{{route('store_return')}}",
                success: function(data){  
                    // console.log(data);
                    if(data.massage=="success")
                    {
                        $('#resourceTable').find('.td_id').each(function(){
                            if($(this).text() == data.lendid){
                                $(this).parent('tr').remove();
                            }
                        });
                        toastr.success('Resources Successfully Returnd');
                    }
                },
                error: function(data){
                    toastr.error('Returing Error');
                }
            });
        //---------------------------------------------------------
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

@extends('layouts.app')


@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$type="type".$lang;

$librarydata = session()->get('library');
$lib_name="name".$lang;

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
    <input type="hidden" name="member_Name_id"id="member_Name_id">
    <input type="hidden" name="member_Name_sms"id="member_Name_sms">
    <input type="hidden" name="member_mobile"id="member_mobile">
    
    <div class="card card-body">
        <div class="row">
            <div class="col-md-3 col-sm-12 text-left px-3">
              <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-addon elevation-1"id="basic-addon2"><i class="fa fa-user-circle-o fa-lg mt-2"></i></span>
                  </div>
                    <input type="text" class="form-control elevation-1" id="member_id" placeholder="Member ID"aria-describedby="basic-addon2">&nbsp;&nbsp;
                    <button type="button" class="btn btn-sm btn-outline-primary elevation-1" id="addbarrowmember"><i class="fas fa-check-circle"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-success elevation-1" id="addbarrowmember_serch"><i class="fa fa-search"></i></button> 
                </div>  
            </div>

             <div class="col-md-6 col-sm-12 text-left px-3">
              <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-addon elevation-1"id="basic-addon3"><i class="fa fa-list fa-lg mt-2"></i></span>
                  </div>
                    <input type="text" class="form-control elevation-1" id="resource_details" onfocus="this.value=''" placeholder="AccessionNo / ISBN / ISSN / ISMN" aria-describedby="basic-addon3">&nbsp;&nbsp;
                    <button type="button" class="btn btn-sm btn-outline-primary elevation-1" id="addbarrow" data-toggle="tooltip" data-placement="top"><i class="fa fa-check-square-o fa-lg" id="loader_icon"></i><span class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"  style="display: none;" id='loader'></span></button>
                    <button type="button" class="btn btn-sm btn-outline-success elevation-1" id="addbarrow_serch"><i class="fa fa-search"></i></button>
                </div> 
            </div>

            <div class="col-md-3 col-sm-12 text-right px-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-addon elevation-1"id="basic-addon1"><i class="fa fa-calendar fa-lg mt-2"></i></span>
                    </div>
                    @if(auth()->user()->can('date-change'))
                    <input type="date" class="form-control elevation-1" name="returndte" id="returndte" value="{{$returndate}}" aria-describedby="basic-addon1">
                    @else
                    <input type="date" class="form-control elevation-1" name="returndte" id="returndte" value="{{$returndate}}" aria-describedby="basic-addon1" disabled>
                    @endif
                   
                </div>
            </div>

        </div>

        <div class="" id="issue-cart" style="display: none;">
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

        <div class="form-row">
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
                    <th scope="col">Fine Status</th>
                    <th scope="col" style="width:10%;">Action</th>
                    </tr>    
                    </thead>

                    <tbody class="tbody_data" id="resourcedata">
                           
                    </tbody>
                </table>
            </div>
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
                <button type="button" class="btn btn-sm btn-primary elevation-2 mx-2" id="print_return">
                <i class="fa fa-print"></i> Print</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-sm btn-secondary elevation-2" id="reset_issue">
                <i class="fa fa-times"></i> Reset</button>
            </div> 
        </div>
    </div>
        
</div>
</form>

<div id="printdiv" style="display: none;">
    <div class="col-md-4">
        <div id="print_lendding" style="text-align: center;">
            <div class="text-center"><u><h3>Return Receipt</h3></u></div>
            </br>
                <h4 id="print_library">{{$librarydata->$lib_name}}</h4>
                <h5 >Member : <span id="print_member"></span></h5>
                <h5>Returned Date :<span id="print_returndate"></span></h5>
                
                <table id="print_table">
                    <thead>
                        <tr>
                            <th>Issue Date</th>
                            <th>Resources</th>
                        </tr>    
                    </thead> 
                    <tbody> 
                    </tbody>
                </table>

                </br>
                <div class="text-center mb-3"><h3>Thank You!</h3></div>
            </div>
        </div>
</div>

<div id="receiptdiv" style="display: none;">
    <div class="col-md-6">
        <div id="fine_receipt" style="text-align: center;">
            <div class="text-center"><u><h3>Fine Receipt</h3></u></div>
            </br>
            
                <h5 >Member : <span id="receipt_member"></span></h5>
                <h5 >Receipt Date : <span id="receipt_date"></span></h5>
                <h5 >Total Amount : <span id="receipt_tot_fine"></span></h5>
                
                <table id="fine_receiptTable">
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
            </div>
    </div>
</div>

              
<!------------------------------------------------------------------------------------------->

<!--settel Modal -->
<div class="modal fade" id="settel_show" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Fine Settlement</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form class="needs-validation" id="form_settle_fine" onSubmit="return false;" novalidate>
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-row ">
                    <div class="table-responsive"style="overflow-x: auto;"> 
                        <table class="table" id="fineTable">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Accession No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Fine(Rs)</th>
                            <th scope="col">Pay</th>
                            </tr>    
                            </thead>

                            <tbody class="tbody_data" id="finedata">
                                
                            </tbody>
                        </table>
                    </div>
                    <h6 class="font-weight-bold text-info">Total Amount :<span id="tot_fine"></span></h6>
                </div>
                    <hr>
                    <div class="form-row">
                        <label for="settle_ype">Settle Type :</label>
                        <select class="form-control mb-3"name="settle_type" id="settle_type" value=""required>
                            <option value="Payment" selected>Payment</option>
                            <option value="Ignore">Ignore</option>
                        </select>      
                    </div>

                    <div class="form-row" id="div_mannual">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="receipt_type">
                            <label class="form-check-label" for="receipt_type">Mannal Receipt</label>
                        </div>
                    </div>
                    <div class="form-row" style="display: none;" id="div_receiptno">
                        <label for="category">Receipt No</label>
                        <input type="text" class="form-control mb-1" id="receipt_no" name="receipt_no" value="" placeholder="Receipt no" >
                    </div>
                    <div class="form-row" style="display: none;" id="div_description">
                        <label for="category">Description</label>
                        <input type="text" class="form-control mb-1" id="description_si" name="description_si" value="" placeholder="Description in Sinhala" >   
                        <input type="text" class="form-control mb-1" id="description_ta" name="description_ta" value="" placeholder="Description in Tamil" >
                        <input type="text" class="form-control mb-1" id="description_en" name="description_en" value="" placeholder="Description in English" > 
                    </div>
                   
                    
                </div>

                <div class="modal-footer">
                    <div class="form-group text-center">
                        {{-- <div class="form-check form-check-inline text-primary" >
                            <label class="form-check-label"><i class="fa fa-check"></i> &nbsp;save&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="methord" value="1" required>|
                        </div> --}}
                        <div class="form-check form-check-inline text-info" >
                            <label class="form-check-label"><i class="fa fa-calendar-plus-o"></i> &nbsp;save & Extend&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="methord" value="2" required>|
                        </div>
                        <div class="form-check form-check-inline text-success" >
                            <label class="form-check-label"><i class="fa fa-check-square-o"></i> &nbsp; save & Return&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="methord" value="3" required>
                        </div>
                        
                    </div>
                    <div class="form-group text-right mt-3">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn_fine_settle" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> &nbsp; Save</button>
                    </div>
                    
                    
                </div>
                <input type="hidden" id="opp_status" name="opp_status">
            </form>
           
        </div>
    </div>
</div>
<!-- end settle model -->
                            
                        
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

        // --------settel Model------------------------------------------
        $('#settel_show').on('show.bs.modal', function (event) {
        var op="";
        var tot_fine=0;
        $('input:radio[name="methord"]').filter('[value="3"]').attr('checked', true);
        $("#div_description").hide();
        $("#div_receiptno").hide();
        $("#fineTable tbody").empty();

            $('#resourceTable tr').each(function(){
                if($(this).find(".fine_settle").html() == "unsettled"){
                    op+='<tr>';
                    op+='<td class="td_id">'+$(this).find(".td_id").html()+'</td>';
                    op+='<td class="td_acceno">'+$(this).find(".td_acceno").html()+'</td>';
                    op+='<td class="td_title">'+$(this).find(".td_title").html()+'</td>';
                    op+='<td class="fine_amount">'+$(this).find(".fine_amount").html()+'</td>';
                    op+='<td class="fine_pay"><input class="form-check-input pay_check" type="checkbox" value="1"></td>';
                    op+='</tr>';  
                    tot_fine += parseFloat($(this).find(".fine_amount").html());
                }
            });
            $("#fineTable tbody").append(op);
            $("#tot_fine").html(tot_fine);
            

           
        
        
        });
        // --------end settel Model------------------------------------------

        $('#settel_show').on('hidden.bs.modal', function (event) {
            var memberid=$('#member_Name_id').val();
            memberSelect(memberid);
            $('#form_settle_fine')[0].reset();
        })

    });
// --------------------------------------------------------------------------

    $('#addbarrowmember').on("click",function(){
        var memberid = $("#member_id").val();
        memberSelect(memberid);
    });
    // ------------------------------------------------------------------------
    function memberSelect(member)
    {
        var memberid = member;
        var dtereturn = $("#returndte").val();
        $('#resource_details').val('');
        $('#member_Name_id').val('');
        $('#member_Name').html('');
        $("#resourceTable tbody").empty();
        $("#fineTable tbody").empty();
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
            data:{
                    memberid: memberid,
                    dtereturn:dtereturn
                 },
            url: "{{route('get_lending')}}",
            success: function(data){
                // console.log(data);
                $('#member_id').val('');
                if(data[0]['status']=="success")
                {
                    $('#issue-cart').show();
                    var membr=data[0]['member_id']+" - "+data[0]['member_name']+"( "+data[0]['member_add1']+","+data[0]['member_add2']+" )";
                    $('#member_Name').html(membr);
                    $('#member_Name_id').val(data[0]['member_id']);
                    $('#member_Name_sms').val(data[0]['member_name']);
                    $('#member_mobile').val(data[0]['mobile']);
                    $('#print_member').html(membr);
                    $('#print_returndate').html(dtereturn);
                   
                    // ------------table-----------------------------
                    for (j = 0; j < data.length; j++)
                    {
                        if(data[j]['fine_settle']=="unsettled"){op+='<tr class="text-danger font-weight-bold">';}
                        else if(data[j]['fine_settle']=="settled"){op+='<tr class="text-info font-weight-bold">';}
                        else{op+='<tr>';}
                        op+='<td class="td_id">'+data[j]['id']+'</td>';
                        op+='<td>'+data[j]['resource_id']+'</td>';
                        op+='<td class="td_type">'+data[j]['resource_cat']+"-"+data[j]['resource_type']+'</td>';
                        op+='<td class="td_input td_acceno">'+data[j]['resource_accno']+'</td>';
                        op+='<td class="td_input">'+data[j]['resource_isn']+'</td>';
                        op+='<td class="td_title">'+data[j]['resource_title']+'</td>';
                        op+='<td class="td_issue_date">'+data[j]['issue_date']+'</td>';
                        op+='<td>'+data[j]['return_date']+'</td>';
                        op+='<td class="fine_amount">'+data[j]['fine_amount']+'</td>';
                        op+='<td>'+data[j]['return']+'</td>';
                        op+='<td class="fine_settle">'+data[j]['fine_settle']+'</td>';

                        op+='<td>';
                        if(data[j]['fine_settle']=="unsettled")
                        {
                            op+='<button type="button" value="'+data[j]['id']+'" class="btn btn-sm btn-outline-warning ml-1 settel_fine" data-toggle="modal" data-target="#settel_show"><i class="fa fa-money"></i></button>';
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
                    $('#issue-cart').hide();
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
    }

    $('#addbarrow').on("click",function(){
        var resourceinput = $("#resource_details").val();
        var limit = $("#lending_limit").val();
        // var op ="";
        var bexsist=false;
        if($('#member_Name_id').val())
        {    
            if(resourceinput)
            {
                var rowCount = $('#resourceTable tr').length;
                var oTable = document.getElementById('resourceTable');
                var mem_id = $("#member_Name_id").val();
                var dtereturn = $("#returndte").val();
                var membername=$('#member_Name_sms').val();
                var membermobile=$('#member_mobile').val();
                var resource_found=0;
                for (j = 1; j < rowCount; j++)
                {
                    var oCells = oTable.rows.item(j).cells;
                    var cellVal_accno = oCells.item(3).innerHTML;
                    var cellVal_title = oCells.item(5).innerHTML;
                    var cellVal_snumber = oCells.item(4).innerHTML;
                    var cellVal_lend_id = oCells.item(0).innerHTML;
                    var cellVal_fine = oCells.item(8).innerHTML;
                    var cellVal_type = oCells.item(2).innerHTML;
                    var cellVal_issue_date = oCells.item(6).innerHTML;
                    var description=oCells.item(5).innerHTML +"("+oCells.item(3).innerHTML+")";
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
                                        cellVal_fine:cellVal_fine,
                                        membername:membername,
                                        membermobile:membermobile,
                                        description:description
                                        },
                                    url: "{{route('store_return')}}",
                                    beforeSend: function(){
                                        $("#loader_icon").hide();
                                        $("#loader").show();
                                    },
                                    success: function(data){  
                                        // console.log(data);
                                        if(data.massage=="success")
                                        {
                                            //---------- ptint table---------
                                            var op="";
                                            op+='<tr>';
                                            op+='<td>'+cellVal_issue_date+'</td><td>'+description+'</td>';
                                            op+='</tr>';
                                            $("#print_table tbody").append(op);
                                            //-------------------------------
                                            $('#resourceTable').find('.td_id').each(function(){
                                                if($(this).text() == data.lendid){
                                                    $(this).parent('tr').remove();
                                                }
                                            });
                                            var _rowCount = $('#resourceTable tr').length;
                                            if(_rowCount==1)
                                            { $('#issue-cart').hide();}
                                            toastr.success('Resources Successfully Returnd');
                                        }
                                    },
                                    error: function(data){
                                        toastr.error('Returing Error');
                                    },
                                    complete:function(data){
                                    $("#loader").hide();
                                    $("#loader_icon").show();
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
    
    $('#btn_fine_settle').on("click",function(event){

        if ($('#form_settle_fine')[0].checkValidity() === false) {
            event.stopPropagation();
        } 
        else 
        {
       
            var opp_status=0;
            var payment_check=0; 
            var mem_id = $("#member_Name_id").val();
            var membername=$('#member_Name_sms').val();
            var settlement_type = $("#settle_type").val();
            var receipt_type= "system";
            if($("#receipt_type").prop("checked") == true)
            {receipt_type= "manual";}
            if(settlement_type=="Ignore")
            {receipt_type= "";}
            var op="";
            var receipt_tot_fine=0;
            var date_settle = $("#returndte").val();
            var receipt="fine";
            var receipt_id="";
            var methord= $("input[name='methord']:checked").val();
            var referance= $("#receipt_no").val();
            $("#fine_receiptTable tbody").empty();
            // ==============receipt=============================
            if(settlement_type=="Payment")
            {
                $('#fineTable tbody tr').each(function(){

                    if($(this).find(".pay_check").prop("checked") == true)
                    {
                        payment_check=1;
                        op+='<tr>';
                        op+='<td class="td_id">'+$(this).find(".td_id").html()+'</td>';
                        op+='<td class="td_acceno">'+$(this).find(".td_acceno").html()+'</td>';
                        op+='<td class="td_title">'+$(this).find(".td_title").html()+'</td>';
                        op+='<td class="fine_amount">'+$(this).find(".fine_amount").html()+'</td>';
                        op+='</tr>';  
                        receipt_tot_fine += parseFloat($(this).find(".fine_amount").html());
                        
                    }
                    else{payment_check==0}

                }).promise().done(function(){
                
                    if(payment_check==1)
                    {
                        //-------------------------------------------------------
                        $.ajaxSetup({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                        });
                        $.ajax({
                            type: 'POST',
                            dataType : 'json',
                            async: false,
                            data:{
                                receipt: receipt,
                                receipt_type:receipt_type,
                                mem_id: mem_id,
                                date_settle: date_settle,
                                receipt_tot_fine:receipt_tot_fine,
                                referance:referance
                                },
                            url: "{{route('fine_receipt')}}",
                            success: function(data){ 
                                if(data.massage=="success"){
                                toastr.success('Receipt Success');
                                receipt_id=data.receipt_id;
                                }
                            },
                            error: function(data){
                                toastr.error('Receipt Error');
                            }
                        });
                        //---------------------------------------------------------
                    }
                });
                $("#fine_receiptTable tbody").append(op);
                $("#receipt_tot_fine").html(receipt_tot_fine);
                $("#receipt_member").html(membername);
                $("#receipt_date").html(date_settle);
                
            }
            //================end================================
            //---------------settal fine---- receipt details-----
            $('#fineTable tbody tr').each(function(){

                if($(this).find(".pay_check").prop("checked") == true)
                {
                    payment_check=1;
                    var lend_id = parseInt($(this).find(".td_id").html());
                    var fine_amount = parseFloat($(this).find(".fine_amount").html());
                    var accno = $(this).find(".td_acceno").html();
                    var discrtpt_si= $("#description_si").val();
                    var discrtpt_ta= $("#description_ta").val();
                    var discrtpt_en= $("#description_en").val();
                
                    //-------------------------------------------------------
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });
                    $.ajax({
                        type: 'POST',
                        dataType : 'json',
                        data:{
                            lend_id: lend_id,
                            fine_amount: fine_amount,
                            date_settle: date_settle,
                            settlement_type:settlement_type,
                            receipt_type:receipt_type,
                            methord:methord,
                            accno:accno,
                            receipt_id:receipt_id,
                            referance:referance,
                            discrtpt_si:discrtpt_si,
                            discrtpt_ta:discrtpt_ta,
                            discrtpt_en:discrtpt_en
                            },
                        url: "{{route('settle_fine')}}",
                        success: function(data){ 
                            //
                            if(data.massage=="success"){
                                opp_status=1; 
                                toastr.success('Fine Settled Successfully');
                                // console.log(data.massage);
                                // $("#opp_status").val(data.massage);
                            }
                        },
                        error: function(data){
                            toastr.error('Fine Settled Error');
                            opp_status=0; 
                        }
                    });
                    //---------------------------------------------------------
                }
                else{payment_check==0}
                
            }).promise().done(function(){
                
                if(settlement_type=="Payment" && receipt_type=="system")
                {
                    if(payment_check==1)
                    {
                        print_div($('#fine_receipt').html());
                        
                        $("#settel_show").modal('hide');
                    }
                    else
                    {
                        toastr.error('Plece Check the resources to settle fine');
                    }
                }
                else
                {
                    if(payment_check==1)
                    {
                        $("#settel_show").modal('hide');
                    }
                    else
                    {
                        toastr.error('Plece Check the resources to settle fine');
                    }
                }
            });
        
        }
        $('#form_settle_fine').addClass('was-validated');

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
                        var _rowCount = $('#resourceTable tr').length;
                        if(_rowCount==1)
                        { $('#issue-cart').hide();}
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

    $("#resourceTable").on('click', '.extend_lending', function () {
        // $(this).closest('tr').remove();
        var dtereturn = $("#returndte").val();
        var fine_amount =  $(this).closest('tr').find(".fine_amount").html();
        var accno =  $(this).closest('tr').find(".td_acceno").html();
        var lend_id=$(this).val();
        // toastr.error("lend id:"+lend_id+" fine:"+fine_amount);
        //-------------------------------------------------------
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                type: 'POST',
                dataType : 'json',
                data:{
                    dtereturn: dtereturn,
                    lend_id: lend_id,
                    fine_amount: fine_amount,
                    accno: accno
                    },
                url: "{{route('extend_lending')}}",
                success: function(data){  
                    // console.log(data);
                    if(data.massage=="success")
                    {
                        var memberid=$('#member_Name_id').val();
                        memberSelect(memberid);
                        toastr.success('Lending Period Extend Successfully');
                    }
                },
                error: function(data){
                    toastr.error('Extend Error');
                }
            });
        //---------------------------------------------------------
        document.getElementById("resource_details").focus();

    });

    $('#returndte').change(function() {
        var memberid=$('#member_Name_id').val();
        if(memberid!="")
        {
            memberSelect(memberid);
        }
       
    });

    $('#settle_type').change(function() {
        var settle_type=$(this).val();
        $('#receipt_type').prop('checked', false);
        if(settle_type=="Ignore")
        {
            @if($locale=="si")
            $("#description_si").prop('required',true);
            @elseif($locale=="ta")
            $("#description_ta").prop('required',true);
            @elseif($locale=="en")
            $("#description_en").prop('required',true);
            @endif

           $("#div_description").show();
           $("#div_receiptno").hide();
           $("#div_mannual").hide();
        }
        else if(settle_type=="Payment")
        {
            $("#description_si").prop('required',false);
            $("#description_ta").prop('required',false);
            $("#description_en").prop('required',false);

            $("#div_description").hide();
            $("#div_receiptno").hide();
            $("#div_mannual").show();
        }
        $("#receipt_no").val('');
        $("#receipt_no").prop('required',false);
    });
    $('#receipt_type').change(function() {
        if($("#receipt_type").prop("checked") == true){
            $("#receipt_no").prop('required',true);
            $("#div_description").hide();
            $("#div_receiptno").show();
        }
        else{
            $("#div_description").hide();
            $("#div_receiptno").hide();
            $("#receipt_no").prop('required',false);
        }
        $("#receipt_no").val('');

    });
    $('#print_return').on("click",function(event){
        print_div($('#print_lendding').html());
    });
    function print_div(print_content){
        // var contents = $("#fine_receipt").html();
        var contents = print_content;
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

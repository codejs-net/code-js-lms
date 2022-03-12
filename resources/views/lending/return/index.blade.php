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
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('return.index') }}"><i class="fa fa-folder-open"></i> {{__('Lending')}}&nbsp;</a></li>
    <li class="breadcrumb-item active" ><a><i class="fa fa-plus"></i> {{__('Resources Return')}}&nbsp;</a></li>
</ol>
</nav>
      <!-- Content Header (Page header) -->
<form class="form-inline" id="form_barrow" onSubmit="return false;">
{{csrf_field()}}
<div class="container-fluid">
    <div class="row text-center mb-2">
        <div class="col-md-12 col-sm-12 text-center"> 
            <h5> <i class="fa fa-shopping-cart">&nbsp;{{__('Resources Return')}}</i></h5>
        </div> 

    </div>
    
</div>

<div class="container-fluid">
    <input type="hidden" name="member_Name_id"id="member_Name_id">
    <input type="hidden" name="member_Name_sms"id="member_Name_sms">
    <input type="hidden" name="member_mobile"id="member_mobile">

    <div class="main-content">
        <div class="row elevation-1">
            <div class="col-md-3 col-sm-12 text-left mt-1 p-3  js-rightbar-bg">
              <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-addon elevation-1"id="basic-addon2"><i class="fa fa-user-circle-o fa-lg mt-2"></i></span>
                  </div>
                    <input type="text" class="form-control elevation-1" id="member_id" placeholder="{{__('Member ID')}}"aria-describedby="basic-addon2">&nbsp;&nbsp;
                    <button type="button" class="btn btn-sm btn-outline-primary elevation-1" id="addbarrowmember"><i class="fas fa-check-circle"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-success elevation-1" id="addbarrowmember_serch"><i class="fa fa-search"></i></button> 
                </div>  
            </div>

             <div class="col-md-6 col-sm-12 text-left p-3 mt-1 bg-white">
              <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-addon elevation-1"id="basic-addon3"><i class="fa fa-list fa-lg mt-2"></i></span>
                  </div>
                    <input type="text" class="form-control elevation-1" id="resource_details" onfocus="this.value=''" placeholder="{{__('AccessionNo / ISBN / ISSN / ISMN')}}" aria-describedby="basic-addon3">&nbsp;&nbsp;
                    <button type="button" class="btn btn-sm btn-outline-primary elevation-1" id="addbarrow" data-toggle="tooltip" data-placement="top"><i class="fas fa-cart-plus"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-success elevation-1" id="addbarrow_serch"><i class="fa fa-search"></i></button>
                </div> 
            </div>
            <div class="col-md-3 col-sm-12 text-right mt-1 p-3 bg-white">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-addon elevation-1"id="basic-addon1"><i class="fa fa-calendar fa-lg mt-2"></i></span>
                    </div>
                    @if(auth()->user()->can('date-change'))
                    <input type="date" class="form-control elevation-1" name="returndte" id="returndte" value="{{$returndate}}" aria-describedby="basic-addon1">
                    @else
                    <input type="date" class="form-control elevation-1" name="returndte" id="returndte" value="{{$returndate}}" aria-describedby="basic-addon1"disabled>
                    @endif
                </div>
            </div>
        </div>
        <div class="row elevation-1" id="return-cart" style="display: none;">
            <div class="col-md-3 col-3 p-3 js-rightbar-bg">
                <div class="text-center ">
                    <h6 id="member_Name"class="text-indigo font-weight-bold"></h6>
                    <div id="member_lend"class="mt-2">
                        <table style="width: 100%;" id="resourceTable">
                            <tbody class="tbody_data" id="resourcedata">    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <form  id="form_returntable" class="">
            {{ csrf_field() }}
            <div class="col-md-9 col-9 p-3 bg-white">
                <div class="table-responsive"style="overflow-x: auto;"> 
                    <table class="table table-hover" id="returnTable">
                        <thead class="js-tbl-header">
                            <tr>
                            <th scope="col">{{__('ID')}}</th>
                            <th scope="col">{{__('Resource')}}</th>
                            <th scope="col">{{__('Type')}}</th>
                            <th scope="col">{{__('Accession')}}</th>
                            <th scope="col">{{__('ISBN/ISSN')}}</th>
                            <th scope="col">{{__('Resource Title')}}</th>
                            <th scope="col">{{__('Issue')}}</th>
                            <th scope="col">{{__('ToBeReturn')}}</th>
                            <th scope="col">{{__('Fine(Rs)')}}</th>
                            {{-- <th scope="col">Return</th> --}}
                            {{-- <th scope="col">Fine Status</th> --}}
                            <th scope="col">{{__('Action')}}</th>
                            <th scope="col">&nbsp;</th>
                            </tr>    
                            </thead>
        
                            <tbody class="tbody_data" id="returndata">    
                            </tbody>
                    </table>
                </div>
               
            </div>
        </form>
        </div>
    </div>
    <hr>
    <div class="row mt-4">
        <div class="col-md-6">
            <span class="text-dark ml-3">&nbsp;{{__('Actions')}} :</span>
            <span class="text-warning ml-3"><i class="fa fa-money"></i>&nbsp;{{__('Settle Fine')}}&nbsp;|</span>
            <span class="text-success ml-3"><i class="fa fa-check-square-o"></i>&nbsp;{{__('Return Resource')}}&nbsp;|</span>
            <span class="text-info ml-3"><i class="fa fa-calendar-plus-o"></i>&nbsp;{{__('Extend Days')}}</span>

        </div>
        <div class="col-md-6">
            <div class="input-group box-footer clearfix pull-right">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="check_print">
                    <label class="form-check-label" for="check_print">{{__('Print Recipt')}}</label>
                </div>
                <button type="button" class="btn btn-sm btn-primary elevation-2 mx-2" id="return_resource">
                <i class="fa fa-floppy-o"></i> {{__('Save')}}&nbsp;<span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"  style="display: none;" id='loader'></span></button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-sm btn-secondary elevation-2" id="btn_reset">
                <i class="fa fa-times"></i> {{__('Reset')}}</button>
            </div> 
        </div>
    </div>
        
</div>
</form>

<div id="printdiv" style="display: none;">
    <div class="col-md-4">
        <div id="print_lendding" style="text-align: center;">
            </br>
            <div class="text-center"><u><h3>{{__('Return Receipt')}}</h3></u></div>
            </br>
                <h4 id="print_library">{{$librarydata->$lib_name}}</h4>
                <h5 >{{__('Member')}} : <span id="print_member"></span></h5>
                <h5>{{__('Returned Date')}} :<span id="print_returndate"></span></h5>
                
                <table id="print_table_return">
                    <thead>
                        <tr>
                            <th>{{__('Resources')}}</th>
                        </tr>    
                    </thead> 
                    <tbody> 
                    </tbody>
                </table>
                <hr>
               <div id="div_extend" style="display: none;">
                <h5>{{__('Issue Date')}} :<span id="print_issuedate"></span></h5>
                <table id="print_table_issue">
                    <thead>
                        <tr>
                            <th>{{__('Resources')}}</th>
                        </tr>    
                    </thead> 
                    <tbody> 
                    </tbody>
                </table>
                <h5>{{__('To Be Return')}} :<span id="print_tobe_return"></span></h5>
               </div>
                </br>
                <div class="text-center mb-3"><h3>{{__('Thank You!')}}</h3></div>
            </div>
        </div>
</div>

<div id="receiptdiv" style="display: none;">
    <div class="col-md-6">
        <div id="fine_receipt" style="text-align: center;">
            </br>
            <div class="text-center"><u><h3>{{__('Fine Receipt')}}</h3></u></div>
            </br>
            
                <h5 >{{__('Member')}} : <span id="receipt_member"></span></h5>
                <h5 >{{__('Receipt Date')}} : <span id="receipt_date"></span></h5>
                <h5 >{{__('Total Amount')}} : <span id="receipt_tot_fine"></span></h5>
                
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
                    <h5 class="modal-title" id="modaltitle">{{__('Fine Settlement')}}</h5>
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
                            <th scope="col">{{__('ID')}}</th>
                            <th scope="col">{{__('Accession No')}}</th>
                            <th scope="col">{{__('Title')}}</th>
                            <th scope="col">{{__('Fine(Rs)')}}</th>
                            <th scope="col">{{__('Pay')}}</th>
                            </tr>    
                            </thead>

                            <tbody class="tbody_data" id="finedata">
                                
                            </tbody>
                        </table>
                    </div>
                    <h6 class="font-weight-bold text-info">{{__('Total Amount')}} :<span id="tot_fine"></span></h6>
                </div>
                    <hr>
                    <div class="form-row">
                        <label for="settle_ype">{{__('Settle Type')}} :</label>
                        <select class="form-control mb-3"name="settle_type" id="settle_type" value=""required>
                            <option value="Payment" selected>{{__('Payment')}}</option>
                            <option value="Ignore">{{__('Ignore')}}</option>
                        </select>      
                    </div>

                    <div class="form-row" id="div_mannual">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="receipt_type">
                            <label class="form-check-label" for="receipt_type">{{__('Mannal Receipt')}}</label>
                        </div>
                    </div>
                    <div class="form-row" style="display: none;" id="div_receiptno">
                        <label for="category">{{__('Receipt No')}}</label>
                        <input type="text" class="form-control mb-1" id="receipt_no" name="receipt_no" value="" placeholder="Receipt no" >
                    </div>
                    <div class="form-row" style="display: none;" id="div_description">
                        <label for="category">{{__('Description')}}</label>
                        <input type="text" class="form-control mb-1" id="description_si" name="description_si" value="" placeholder="{{__('Description in Sinhala')}}" >   
                        <input type="text" class="form-control mb-1" id="description_ta" name="description_ta" value="" placeholder="{{__('Description in Tamil')}}" >
                        <input type="text" class="form-control mb-1" id="description_en" name="description_en" value="" placeholder="{{__('Description in English')}}" > 
                    </div>
                   
                    
                </div>

                <div class="modal-footer">
                    <div class="form-group text-center">
                        <div class="form-check form-check-inline text-info" >
                            <label class="form-check-label"><i class="fa fa-calendar-plus-o"></i> &nbsp;{{__('Extend')}}&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="methord" value="2" required>|
                        </div>
                        <div class="form-check form-check-inline text-success" >
                            <label class="form-check-label"><i class="fa fa-check-square-o"></i> &nbsp;{{__('Return')}}&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="methord" value="3" required>
                        </div>
                        
                    </div>
                    <div class="form-group text-right mt-3">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" id="btn_fine_settle" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> &nbsp; {{__('Save')}}</button>
                    </div>
                    
                    
                </div>
                <input type="hidden" id="opp_status" name="opp_status">
            </form>
           
        </div>
    </div>
</div>
<!-- end settle model -->
                                                   
<br>                    
@endsection
@section('script')

    <script>
    let viewState=0;
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
                if($(this).find(".r_fine").html() != 0.00 && $(this).find(".r_fine_settleId").html() == "N/A"){
                    op+='<tr>';
                    op+='<td class="td_id">'+$(this).find(".r_lendid").html()+'</td>';
                    op+='<td class="td_acceno">'+$(this).find(".r_accno").html()+'</td>';
                    op+='<td class="td_title">'+$(this).find(".r_title").html()+'</td>';
                    op+='<td class="fine_amount">'+$(this).find(".r_fine").html()+'</td>';
                    op+='<td class="fine_pay"><input class="form-check-input pay_check" type="checkbox" value="1"></td>';
                    op+='</tr>';  
                    tot_fine += parseFloat($(this).find(".r_fine").html());
                }
            });
            $("#fineTable tbody").append(op);
            $("#tot_fine").html(tot_fine);
        
        });
        // --------end settel Model------------------------------------------

        $('#settel_show').on('hidden.bs.modal', function (event) {
            // var memberid=$('#member_Name_id').val();
            // memberSelect(memberid);
            $('#form_settle_fine')[0].reset();
        })


    });
    // --------------------------------------------------------------------------
    window.addEventListener("beforeunload", function(event) {
        if(viewState==1){
            event.preventDefault();
            event.returnValue = 'Plese Save Changes Before Exit'; 
        } 
    });


    $('#addbarrowmember').on("click",function(){
        var memberid = $("#member_id").val();
        memberSelect(memberid);
    });

    $('#addbarrow').on("click",function(){
        var resourceinput = $("#resource_details").val();
        add_to_retun_table(resourceinput,"Return");
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
        $("#returnTable tbody").empty();
        $("#fineTable tbody").empty();
        $("#print_table_issue tbody").empty();
        $("#print_table_return tbody").empty();
        $('#return-cart').hide();
        $('#div_extend').hide();
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
                    $('#return-cart').show();
                    var membr=data[0]['regnumber']+" - "+data[0]['member_name']+"( "+data[0]['member_add1']+","+data[0]['member_add2']+" )";
                    $('#member_Name').html(membr);
                    $('#member_Name_id').val(data[0]['member_id']);
                    $('#member_Name_sms').val(data[0]['member_name']);
                    $('#member_mobile').val(data[0]['mobile']);
                    $('#print_member').html(membr);
                    $('#print_returndate').html(dtereturn);
                   
                    // --------resource list-------
                    for (j = 0; j < data.length; j++)
                    {
                        if(data[j]['fine_amount']!=0.00){op+='<tr class="text-danger font-weight-bold">';}
                        else{op+='<tr>';}
                        op+='<td>';
                        op+='<div class="card">';
                            op+='<div class="card-body">';
                                op+='<div class="row issue-card">';
                                    op+='<div class="col-md-4 col-4">';
                                        op+='<img class="img-resource-80" src="images/resources/'+data[j]['image']+'" alt="image">';
                                        op+='<h6><span class="r_type">'+data[j]['resource_cat']+'-'+data[j]['resource_type']+'</span></h6>';
                                    op+='</div>';
                                    op+='<div class="col-md-8 col-8 pl-2">';                                      
                                        op+='<h5><span class="r_title">'+data[j]['resource_title']+'</span></h5>';
                                        op+='<div><span>ResourceID:</span><span class="r_resoid">'+data[j]['resource_id']+'</span></div>';
                                        op+='<div><span>AccessionNo:</span><span class="r_accno">'+data[j]['resource_accno']+'</span></div>';
                                        op+='<div><span>Lending ID:</span><span class="r_lendid">'+data[j]['id']+'</span></div>';
                                        op+='<div><span>SNumber:</span><span class="r_snumber">'+data[j]['resource_isn']+'</span></div>';
                                        op+='<div><span>IssueDate: </span><span class="r_issuedate">'+data[j]['issue_date']+'</span></div>';
                                        op+='<div><span>To Be Return: </span><span class="r_returndate">'+data[j]['return_date']+'</span></div>';
                                        op+='<div><span> Fine: </span><span class="r_fine">'+data[j]['fine_amount']+'</span></div>';

                                        if(data[j]['fine_amount']!=0.00 && data[j]['fine_settle_id']==null)
                                        {
                                            op+='<div><span> Fine settleId: </span><span class="r_fine_settleId">'+"N/A"+'</span></div>';
                                            op+='<button type="button" value="'+data[j]['id']+'" class="btn btn-sm btn-outline-warning ml-1 settel_fine" data-toggle="modal" data-target="#settel_show"><i class="fa fa-money"></i></button>';
                                        }
                                        else
                                        {
                                            op+='<div><span> Fine settleId: </span><span class="r_fine_settleId">'+data[j]['fine_settle_id']+'</span></div>';
                                            op+='<button type="button" value="'+data[j]['resource_accno']+'" class="btn btn-sm btn-outline-success ml-1 return_lending"><i class="fa fa-check-square-o"></i></button>';
                                            op+='<button type="button" value="'+data[j]['resource_accno']+'" class="btn btn-sm btn-outline-info ml-1 extend_lending"><i class="fa fa-calendar-plus-o"></i></button>';
                                        }
                                        
                                    op+='</div>';
                                op+='</div>';
                            op+='</div>';
                        op+='</div>';
                        op+='</td>';
                        op+='</tr>';
                    }
                    $("#resourceTable tbody").append(op);
                    // ----------------------------
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
    }
    function add_to_retun_table(resourceinput,returnaction)
    {
        var op ="";
        var exsist=false;
        var resource_found=0;
        if($('#member_Name_id').val())
        {    
            if(resourceinput)
            {
                // --------add to return Table------------------
                $('#resourceTable tbody tr').each(function(){
                    var accno=$(this).find(".r_accno").html();
                    var snumber=$(this).find(".r_snumber").html();
                    var fine=$(this).find(".r_fine").html();
                    var fine_settelId= $(this).find(".r_fine_settleId").html();
                    if(resourceinput.toUpperCase()==accno.toUpperCase() || resourceinput.toUpperCase()==snumber.toUpperCase() )
                    {
                        resource_found=1;
                        if(fine_settelId!="N/A")
                        {
                            $('#returnTable tbody tr').each(function(){
                                var td_accno=$(this).find(".td_acceno").html();
                                if(accno.toUpperCase()==td_accno.toUpperCase())
                                {exsist=true;}   
                            });
                            if(exsist==false)
                            {
                                op+='<tr>';
                                op+='<td class="td_id">'+$(this).find(".r_lendid").html()+'</td>';
                                op+='<td class="td_reso_id">'+$(this).find(".r_resoid").html()+'</td>';
                                op+='<td class="td_type">'+$(this).find(".r_type").html()+'</td>';
                                op+='<td class="td_acceno">'+$(this).find(".r_accno").html()+'</td>';
                                op+='<td class="td_snumber">'+$(this).find(".r_snumber").html()+'</td>';
                                op+='<td class="td_title">'+$(this).find(".r_title").html()+'</td>';
                                op+='<td class="td_issuedate">'+$(this).find(".r_issuedate").html()+'</td>';
                                op+='<td class="td_tobereturn">'+$(this).find(".r_returndate").html()+'</td>';
                                op+='<td class="td_fine_amount">'+$(this).find(".r_fine").html()+'</td>';
                                op+='<td class="td_action">'+returnaction+'</td>';
                                op+='<td><button type="button" value="'+$(this).find(".r_lendid").html()+'" class="btn btn-sm btn-outline-danger remove_resources"><i class="fa fa-trash"></i></button></td>'
                                op+='</tr>';  
                            }
                            else{toastr.error('Resource Alrady in Return Cart')} 
                        }
                        else{toastr.warning('Plese Settle the Fine Before Return');}  
                    } 
                });
                if(resource_found==0){  toastr.error('Resource Not Found!');}
                $("#returnTable tbody").append(op);
                viewState=1;
                // --------------------------------------------     
            }
            else{toastr.error('Enter Resource AccessionNo / ISBN / ISSN / ISMN')}
        }
        else
        {
            toastr.error('Plese Select Member first');
            document.getElementById("member_id").focus();
        }
    }
    // -----------------------------------------------------
    $("#returnTable").on('click', '.remove_resources', function () {
        $(this).closest('tr').remove();
        document.getElementById("resource_details").focus();

    });

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
                    var op1="";
                    var returnaction="";
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
                            if(data.massage=="success"){
                                viewState=1;
                                toastr.success('Fine Settled Successfully');
                            // -------------add to return table-------------
                            if(methord==2){returnaction="Extend";}
                            else if(methord==3){returnaction="Return";}

                                $('#resourceTable tbody tr').each(function(){
                                    var r_lendid=$(this).find(".r_lendid").html();
                                    if(lend_id==r_lendid)
                                    {
                                        op1+='<tr>';
                                        op1+='<td class="td_id">'+$(this).find(".r_lendid").html()+'</td>';
                                        op1+='<td class="td_reso_id">'+$(this).find(".r_resoid").html()+'</td>';
                                        op1+='<td class="td_type">'+$(this).find(".r_type").html()+'</td>';
                                        op1+='<td class="td_acceno">'+$(this).find(".r_accno").html()+'</td>';
                                        op1+='<td class="td_snumber">'+$(this).find(".r_snumber").html()+'</td>';
                                        op1+='<td class="td_title">'+$(this).find(".r_title").html()+'</td>';
                                        op1+='<td class="td_issuedate">'+$(this).find(".r_issuedate").html()+'</td>';
                                        op1+='<td class="td_title">'+$(this).find(".r_returndate").html()+'</td>';
                                        op1+='<td class="td_fine_amount">'+$(this).find(".r_fine").html()+'</td>';
                                        op1+='<td class="td_action">'+returnaction+'</td>';
                                        op1+='<td><button type="button" value="'+$(this).find(".r_lendid").html()+'" class="btn btn-sm btn-outline-danger remove_resources"><i class="fa fa-trash"></i></button></td>'
                                        op1+='</tr>';  
                                        $("#returnTable tbody").append(op1);
                                    }   
                                });

                            // ---------------------------------------------
                            }
                        },
                        error: function(data){
                            toastr.error('Fine Settled Error');
                            // opp_status=0; 
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

    $('#return_resource').on("click",function(){
        var oTable = document.getElementById('returnTable');
        var rowLength = oTable.rows.length;

        var mem_id = $("#member_Name_id").val();
        var dtereturn = $("#returndte").val();
        var membername=$('#member_Name_sms').val();
        var membermobile=$('#member_mobile').val();
        var _return_descript = [];
        var _extend_descript = [];
        var reso_extend=false;

        if($('#member_Name_id').val())
        {
            if(rowLength>1)
            {
                for (i = 1; i < rowLength; i++)
                {
                    var oCells = oTable.rows.item(i).cells;
                    var resourceaccno = oCells.item(3).innerHTML;
                    var resourcetitles = oCells.item(5).innerHTML;
                    var return_action = oCells.item(9).innerHTML;
                    var desc=resourcetitles+"("+resourceaccno+")";
                    if(return_action=="Extend")
                    { 
                        _extend_descript.push(desc);
                        reso_extend=true;
                    }
                    _return_descript.push(desc);
                }
                var extend_descript = _extend_descript.toString();
                var return_descript = _return_descript.toString();
                var lend_data = [];
                var return_data = [];
                var lend_id, reso_id, type,accno,snumber,title,issuedate,tobe_return,fine_amount,return_action;

                lend_data.push({
                    mem_id: mem_id,
                    dtereturn: dtereturn,
                    membername: membername,
                    membermobile: membermobile,
                    return_descript:return_descript,
                    extend_descript:extend_descript
                    });

                $('#returnTable tbody tr').each(function(){
                    lend_id = $(this).find(".td_id").html();
                    reso_id = $(this).find(".td_reso_id").html();
                    type = $(this).find(".td_type").html();
                    accno = $(this).find(".td_acceno").html();
                    snumber = $(this).find(".td_snumber").html();
                    title = $(this).find(".td_title").html();
                    issuedate = $(this).find(".td_issuedate").html();
                    tobe_return = $(this).find(".td_tobereturn").html();
                    fine_amount = $(this).find(".td_fine_amount").html();
                    return_action = $(this).find(".td_action").html();

                    return_data.push({
                        lend_id: lend_id,
                        reso_id: reso_id,
                        type:type,
                        accno: accno,
                        snumber: snumber,
                        title: title,
                        issuedate: issuedate,
                        tobe_return: tobe_return,
                        fine_amount: fine_amount,
                        return_action:return_action
                        });
                });
        
                $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: 'POST',
                    dataType : 'json',
                    async:false,
                    data: {
                    'lend_data':JSON.stringify(lend_data),
                    'return_data':JSON.stringify(return_data)
                    },
                    url: "{{route('return.store')}}",
                    beforeSend: function(){
                        $("#loader").show();
                    },
                    success: function(data){  
                        if(data.status=="success")
                        {
                            toastr.success('Return Processe Successfuly Completed'); 
                            if(reso_extend==true){$('#div_extend').show();}
                            if($("#check_print").prop("checked") == true)
                            {
                                $("#print_table_return tbody").append(data.print_r);
                                $("#print_table_issue tbody").append(data.print_i);
                                $("#print_member").html(membername);
                                $("#print_returndate").html(dtereturn);
                                $("#print_issuedate").html(dtereturn);
                                $("#print_tobe_return").html(data.tobe_return);
                               
                                print_div($("#print_lendding").html());
                            }
                            memberSelect(mem_id);
                            viewState=0;
                        }
                        
                    },
                    error: function(data){
                        toastr.error('Processe Faild'); 
                    },
                    complete:function(data){
                    $("#loader").hide();
                    }
                });

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

    $("#resourceTable").on('click', '.return_lending', function () {
        // var fine_amount =  $(this).closest('tr').find(".fine_amount").html();
        var resourceinput=$(this).val();
        add_to_retun_table(resourceinput,"Return");
    });

    $("#resourceTable").on('click', '.extend_lending', function () {
        var resourceinput=$(this).val();
        add_to_retun_table(resourceinput,"Extend");
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
    // $('#print_return').on("click",function(event){
    //     print_div($('#print_lendding').html());
    // });
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
        frameDoc.document.write('<style>@media print {@page { margin-top: 0; margin-bottom: 0;}body { margin: 1.6cm; }}</style>');
        frameDoc.document.write('<link href="{{ asset('css/app.css') }}" rel="stylesheet">');
        frameDoc.document.write('<link href="{{ asset('css/riceipt.css') }}" rel="stylesheet">');
        frameDoc.document.write('</head><body>');
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        console.log(contents);
        $("#frame1").get(0).contentWindow.print();
        setTimeout(function () {
           frame1.remove();
        }, 10000);
        frameDoc.document.close();
    }
    

</script>
@endsection

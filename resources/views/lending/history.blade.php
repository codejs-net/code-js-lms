@extends('layouts.app')
@section('content')
@php
$lang = session()->get('db_locale');
$category="category".$lang;
$name="member".$lang;
$address1="address1".$lang;
$address2="address2".$lang;


@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Books&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-search"></i> Lending History&nbsp;</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 text-left p-2"> 
            <h5> <i class="fa fa-search  pl-2"> Lending History</i></h5>
        </div>  
        <div class="col-md-10 text-right">
            <form class="needs-validation" novalidate id="filter_form">
                {{ csrf_field() }}
                <div class="input-group mb-3">
                    {{--  --}}
                    <div class="border border-secondary pt-1 px-2 mr-2">
                        <div class="form-check form-check-inline text-primary" >
                            <label class="form-check-label"><i class="fa fa-check"></i> &nbsp;Returned&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="returned" value="1" required>|
                        </div>
                        <div class="form-check form-check-inline text-info" >
                            <label class="form-check-label"><i class="fa fa-times"></i> &nbsp;Not Returned&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="returned" value="0" required>|
                        </div>
                        <div class="form-check form-check-inline text-success" >
                            <label class="form-check-label"><i class="fa fa-check-square-o"></i> &nbsp; All&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="returned" value="All" required>
                        </div>
                        
                    </div>
                    {{--  --}}
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">From</span>
                    </div>
                    <input type="date" name="dte_from" id="dte_from" class="form-control" value="{{$today}}" aria-describedby="basic-addon1"required>
                    <div class="input-group-prepend ml-2">
                        <span class="input-group-text" id="basic-addon1">To</span>
                    </div>
                    <input type="date" name="dte_to" id="dte_to" class="form-control"  value="{{$today}}" aria-describedby="basic-addon1"required>
                    <select class="form-control mx-2" name="date_type" id="date_type">
                        <option value="issue_date">Issue Date</option>
                        <option value="return_date">Return Date</option>
                    </select>
                    <button type="button" class="btn btn-sm btn-primary elevation-2 mx-2" value="" id="btn_filter" >
                        <i class="fa fa-filter"></i>&nbsp;Filter
                    </button>
                    <a href="{{ route('lending_history') }}" class="btn btn-sm btn-secondary elevation-2 mx-2" id="btn_reset" >
                        <i class="fa fa-times pt-2">&nbsp;Reset</i>
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
<div class="container-fluid">

</div>
<!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
            <div class="form-row">   
            <div class="table-responsive"style="overflow-x: auto;">               
            <table  class="table display nowrap table-hover" width="100%" cellspacing="0" id="lending_datatable">
                    <thead class="js-tbl-header">
                        <tr class="js-tr">
                            <th scope="col">ID</th>
                            <th scope="col">Accession No</th>
                            <th scope="col" style="width: 15%">Title</th>
                            <th scope="col" style="width: 15%">Member</th>
                            <th scope="col">NIC</th>
                            <th scope="col">Issue Date</th>
                            <th scope="col">To Be Return</th>
                            <th scope="col">Return</th>
                            <th scope="col">Returned Date</th>
                            <th scope="col">Fine</th>
                            <th scope="col"style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>  
                    <!-- @push('scripts')
                    
                    @endpush -->
                    </tbody>
            </table>
        </div>
        </div>               

    </div>
</div>
{{-- end main --}}

<!-- --------------------------start  modal delete------------------------------- -->
   
<div class="modal fade" id="member_delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Remove Lending Record</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="post" action="{{ route('delete_member')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="delete_member_id" name="delete_member_id">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h5 id="modallabel">Are you sure Remove Recorde </h5>
                        </div>
                        <div class="col-md-8">
                            <h5><label type="text"  id="delete_member_name"></label></h5>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i> &nbsp; Delete</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- ---------------------end delete Model------------------------------------- -->

@include('members.show_modal')
@include('members.member_card_modal')
@endsection

@section('script')
<script>

$(document).ready(function()
{
    $("input[name=returned][value='All']").prop("checked",true);
    var returnfilter= $("input[name='returned']:checked").val()
    var date_type= $('#date_type').val();
    var from_date= $('#dte_from').val();
    var to_date= $('#dte_to').val();
    load_datatable(returnfilter,from_date,to_date,date_type);

    // start member delete function
    $('#member_delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var m_id = button.data('mid') 
        var m_name = button.data('mname')
        document.getElementById("delete_member_id").value= m_id; 
        document.getElementById("delete_member_name").innerHTML = m_name;
        })
    // end member delete function

});

function load_datatable(returnfilter,from_date,to_date,date_type)
{

    $('#lending_datatable').DataTable({
        // columnDefs: [
        // {"targets": [0],
        // "visible": false,
        // "searchable": false},
        // ],
        responsive: true,
        processing: true,
        serverSide: false,
        ordering: false,
        searching: true,

    ajax:{
        type: "GET",
        dataType : 'json',
        url: "{{ route('lending_history') }}",
        data: { 
            returnfilter: returnfilter,
            from_date: from_date,
            to_date: to_date,
            date_type: date_type,
        },
    },
    // pageLength: 15,
    
    columns:[
        {data: "id",name: "lendingid" ,"sClass": "lend_id",orderable: true},
        {data: "accessionNo",name: "AccessionNo",orderable: true},
        // {data: "standard_number",name: "standard_number",orderable: true},
        {data: "title<?php echo $lang; ?>",name: "title"},
        {data: "<?php echo $name; ?>",name: "name"},
        {data: "nic",name: "nic",orderable: true},
        // {data: "mobile",name: "mobile",orderable: false},
        {data: "issue_date",name: "issue_date"},
        {data: "to_be_return",name: "to_be_return","sClass": "to_be_return"},
        {data: "returned",name: "returned"},
        {data: "returned_date",name: "returned_date"},
        {data: "fine",name: "fine"},
        {data: "action",name: "action",orderable: false}
    ],
    "createdRow": function( row, data, dataIndex ) {
            if(data['fine'] != 0.00 && data['return'] == 0 ) 
            {        
                $('td', row).addClass('font-weight-bold text-red');
            }
        }
    });
}

$("input[name='returned']").click(function(){
    var returnfilter=$(this).val();
    $('#lending_datatable').DataTable().clear().destroy();
    
    if(returnfilter=="0"){
        $( "#date_type").val("issue_date");
        $( "#date_type").prop( "disabled", true );
    }
    else{
        $( "#date_type" ).prop( "disabled", false );
    }
    var date_type= $('#date_type').val();
    var from_date= $('#dte_from').val();
    var to_date= $('#dte_to').val();
    load_datatable(returnfilter,from_date,to_date,date_type);
});

$('#btn_filter').click(function() {
    $('#lending_datatable').DataTable().clear().destroy();
    var returnfilter= $("input[name='returned']:checked").val()
    var date_type= $('#date_type').val();
    var from_date= $('#dte_from').val();
    var to_date= $('#dte_to').val();
    load_datatable(returnfilter,from_date,to_date,date_type);    
});

$('#btn_reset').click(function() {
   
});

$("#lending_datatable").on('click', '.remainder', function () {
    var lend_detail_id =  $(this).closest('tr').find(".lend_id").html();
    var to_be_return =  $(this).closest('tr').find(".to_be_return").html();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "GET",
        dataType : 'json',
        url: "{{ route('lending_remainder') }}", 
        data: { 
            lend_detail_id: lend_detail_id,
            to_be_return:to_be_return,
        },

        beforeSend: function(){
        },

        success:function(data){
        toastr.success('Remainder Massage Send Successfully');
        },
        error:function(data){
        toastr.error('Remainder Massage Falid Send Plese Try again');
        },
        complete:function(data){

        }
    })

});

</script>

@endsection

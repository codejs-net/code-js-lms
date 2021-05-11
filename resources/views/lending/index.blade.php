@extends('layouts.app')
@section('content')
@php
$lang = session()->get('db_locale');
$category="category".$lang;
$name="name".$lang;
$title="title".$lang;
$member="member".$lang;


@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Lending&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-search"></i>&nbsp;Search Lending</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 text-left p-2"> 
            <h5> <i class="fa fa-search  pl-2">Search Lending</i></h5>
        </div>  
        <div class="col-md-10 text-right">
            <form class="needs-validation" novalidate id="filter_form">
                {{ csrf_field() }}
               
                <div class="input-group mb-3">
                    <div class="border border-secondary pt-1 px-2 mr-2">
                        <div class="form-check form-check-inline text-info" >
                            <label class="form-check-label"><i class="fa fa-shopping-cart"></i> &nbsp;Issue&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="lending" value="issue" required>
                        </div>
                        <div class="form-check form-check-inline text-info" >
                            <label class="form-check-label"><i class="fa fa-shopping-cart"></i> &nbsp;Return&nbsp;</label>
                            <input type="radio" class="form-check-input methord" name="lending" value="return" required>
                        </div>
                        
                    </div>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">From</span>
                    </div>
                    <input type="date" name="dte_from" id="dte_from" class="form-control" value="{{$today}}" aria-describedby="basic-addon1"required>
                    <div class="input-group-prepend ml-2">
                        <span class="input-group-text" id="basic-addon1">To</span>
                    </div>
                    <input type="date" name="dte_to" id="dte_to" class="form-control"  value="{{$today}}" aria-describedby="basic-addon1"required>
                    <button type="button" class="btn btn-sm btn-primary elevation-2 mx-2" value="" id="btn_filter" >
                        <i class="fa fa-filter"></i>&nbsp;Filter
                    </button>
                    <a href="{{ route('lending.index') }}" class="btn btn-sm btn-secondary elevation-2 mx-2" id="btn_reset" >
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
                            <th scope="col">Lending ID</th>
                            <th scope="col">Lending Date</th>
                            <th scope="col" style="width: 40%">Description</th>
                            <th scope="col" style="width: 25%">Member</th>
                            <th scope="col" style="width: 10%">Action</th>
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
   
<div class="modal fade" id="data_delete" tabindex="-1" role="dialog"  aria-hidden="true">
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
            
            <form method="post" action="{{ route('delete_lending')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="delete_id" name="delete_id">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h5 id="modallabel">Are you sure Remove Recorde </h5>
                        </div>
                        <div class="col-md-8">
                            <h5><label type="text"  id="delete_name"></label></h5>
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
<!-- ---------------------end delete Model-------------------------------- -->

<!-- --------------------start  show delete------------------------------- -->
   
<div class="modal fade bd-example-modal-lg" id="data_show" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Lending Details</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="post" action="{{ route('show_lending')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="data_id" name="data_id">
                    <div class="row table-responsive">
                        <table class="table table-striped" id="tbl_show">
                            <thead class="">
                                <tr>
                                    <th scope="col">Lending ID</th>
                                    <th scope="col">Accession No</th>
                                    <th scope="col" style="width: 15%">Title</th>
                                    <th scope="col" style="width: 15%">Member</th>
                                    <th scope="col">NIC</th>
                                    <th scope="col">Issue Date</th>
                                    <th scope="col">Return</th>
                                    <th scope="col">Return Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                        </table>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- ---------------------end show Model------------------------------------- -->
@endsection

@section('script')
<script>

$(document).ready(function()
{
    $("input[name='lending'][value='issue']").prop("checked",true);
    var lending= $("input[name='lending']:checked").val()
    var from_date= $('#dte_from').val();
    var to_date= $('#dte_to').val();
    load_datatable(from_date,to_date,lending);

    // start lending delete function
    $('#data_delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var m_id = button.data('mid') 
        var m_name = button.data('mname')
        document.getElementById("delete_id").value= m_id; 
        document.getElementById("delete_name").innerHTML = m_name;
    })
    // end member delete function

    // start lending show function
    $('#data_show').on('show.bs.modal', function (event) {
        var lend_id = $(event.relatedTarget).data('mid') 
        var op='';
       // -------------------------------------------
       $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('show_lending')}}", 
            data: { lend_id: lend_id, },
            success:function(data){
                console.log(data);
                for (j = 0; j < data.length; j++)
                {
                    op+='<tr>';
                    op+='<td>'+data[j].id+'</td>';
                    op+='<td>'+data[j].accessionNo+'</td>';
                    op+='<td>'+data[j].{{$title}}+'</td>';
                    op+='<td>'+data[j].{{$member}}+'</td>';
                    op+='<td>'+data[j].nic+'</td>';
                    op+='<td>'+data[j].issue_date+'</td>';
                    if(data[j].return==1)
                    {op+='<td>{{trans('Yes')}}</td>';}
                    else
                    {op+='<td class="text-danger">{{trans('No')}}</td>';}
                    op+='<td>'+data[j].return_date+'</td>';
                    op+='</tr>';  
                }
                $('#tbl_show tbody').empty().append(op);
            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            }
        })
        // -------------------------------------------
       
    })
    // end lending show function

});

function load_datatable(from_date,to_date,lending)
{

    $('#lending_datatable').DataTable({

        responsive: true,
        processing: true,
        serverSide: false,
        ordering: false,
        searching: true,

    ajax:{
        type: "GET",
        dataType : 'json',
        url: "{{ route('lending.index') }}",
        data: { 
            from_date: from_date,
            to_date: to_date,
            lending:lending,
        },
    },
    // pageLength: 15,
    
    columns:[
        {data: "id",name: "lendingid",orderable: true},
        {data: "lending_date",name: "lending_date",orderable: true},
        {data: "description",name: "title"},
        {data: "<?php echo $name; ?>",name: "name"},
        {data: "action",name: "action",orderable: false}
    ],
   
    });
}


$('#btn_filter').click(function() {
    $('#lending_datatable').DataTable().clear().destroy();
    var lending= $("input[name='lending']:checked").val()
    var from_date= $('#dte_from').val();
    var to_date= $('#dte_to').val();
    load_datatable(from_date,to_date,lending);   
});

$("input[name='lending']").click(function(){
    $('#lending_datatable').DataTable().clear().destroy();
    var lending= $("input[name='lending']:checked").val()
    var from_date= $('#dte_from').val();
    var to_date= $('#dte_to').val();
    load_datatable(from_date,to_date,lending);   
});

$('#btn_reset').click(function() {
   
});
</script>

@endsection

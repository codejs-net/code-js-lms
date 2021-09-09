@extends('layouts.app')
@section('content')
@php
$lang = session()->get('db_locale');
$description="description".$lang;
$member="name".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('receipt.index') }}"><i class="fa fa-folder-open"></i> {{__('Receipts')}}&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-search"></i> {{__('Search Receipt')}}&nbsp;</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-12 col-sm-12 text-left p-2"> 
            <h5> <i class="fa fa-search ml-4 pl-2"> {{__('Search Receipt')}}</i></h5>
        </div>  
    </div>
    
</div>

<!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
            <div class="form-row">   
            <div class="table-responsive"style="overflow-x: auto;">               
            <table  class="table display nowrap table-hover" width="100%" cellspacing="0" id="receipt_datatable">
                    <thead class="js-tbl-header">
                        <tr class="js-tr">
                            <th scope="col">{{__('Receipt id')}}</th>
                            <th scope="col" style="width: 10%">{{__('Receipt')}}</th>
                            <th scope="col" style="width: 10%">{{__('Date')}}</th>
                            <th scope="col" style="width: 20%">{{__('Member')}}</th>
                            <th scope="col" style="width: 30%">{{__('Description')}}</th>
                            <th scope="col">{{__('Amount')}}</th>
                            <th scope="col"style="width: 15%">{{__('Action')}}</th>
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
   
<div class="modal fade" id="receipt_delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">{{__('Remove Library Center')}}</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="post" action="{{ route('cancel_receipt')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="delete_receipt_id" name="delete_receipt_id">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h5 id="modallabel">{{__('Are you sure Remove center')}} </h5>
                        </div>
                        <div class="col-md-8">
                            <h5><label type="text"  id="delete_receipt_name"></label></h5>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i> &nbsp; {{__('Cancel')}}</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- ---------------------end delete Model------------------------------------- -->

@include('members.show_modal')
@endsection

@section('script')
<script>

$(document).ready(function()
{
    load_datatable();

    // start member delete function
    $('#receipt_delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var m_id = button.data('sid') 
        var m_name = button.data('sname')
        document.getElementById("delete_receipt_id").value= m_id; 
        document.getElementById("delete_receipt_name").innerHTML = m_name;
        })
    // end member delete function

    

});

function load_datatable()
{

    $('#receipt_datatable').DataTable({
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
        url: "{{ route('receipt.index') }}",
    },
    // pageLength: 15,
    
    columns:[
        {data: "id",name: "id",orderable: true},
        {data: "receipts",name: "receipts"},
        {data: "receipt_date",name: "receipt_date"},
        {data: "<?php echo $member; ?>",name: "member"},
        {data: "<?php echo $description; ?>",name: "description"},
        {data: "payment",name: "payment",orderable: false},
        {data: "action",name: "action",orderable: false}
    ],
    });
}

</script>

@endsection

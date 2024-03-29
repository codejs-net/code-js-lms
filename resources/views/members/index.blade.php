@extends('layouts.app')
@section('content')
@php
$lang = session()->get('db_locale');
$category="category".$lang;
$name="name".$lang;
$address1="address1".$lang;
$address2="address2".$lang;


@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> {{__('Members')}}&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-search"></i> {{__('Search Members')}}&nbsp;</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-7 col-sm-6 text-left p-2"> 
            <h5> <i class="fa fa-search ml-4 pl-2"> {{__('Search Members')}}</i></h5>
        </div>  
        <div class="col-md-5 col-sm-6 text-right p-2">
            @can('member-create')
            <a href="{{ route('create_member') }}" class="btn btn-info btn-sm" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; {{__('New')}}</a>
            @endcan
            @can('member-report')
            <a class="btn btn-sm btn-js" data-toggle="modal" data-target="#member_card_range" ><i class="fa fa-file-pdf-o" ></i>&nbsp;{{__('Member Card')}}</a>
            <a href="{{ route('export_member') }}" class="btn btn-outline-primary btn-sm text-dark mr-2" id="export_member" ><i class="fa fa-file-excel-o"></i>&nbsp; {{__('Export')}}</a>
            @endcan
        </div>
    </div>
    
</div>

<!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
            <div class="form-row">   
            <div class="table-responsive"style="overflow-x: auto;">               
            <table  class="table display nowrap table-hover" width="100%" cellspacing="0" id="member_datatable">
                    <thead class="js-tbl-header">
                        <tr class="js-tr">
                            <th scope="col">{{__('ID')}}</th>
                            <th scope="col">{{__('MID')}}</th>
                            <th scope="col">{{__('Avatar')}}</th>
                            <th scope="col">{{__('Title')}}</th>
                            <th scope="col" style="width: 15%">{{__('Name')}}</th>
                            <th scope="col" style="width: 15%">{{__('Address1')}}</th>
                            <th scope="col" style="width: 15%">{{__('Addresss2')}}</th>
                            <th scope="col">{{__('NIC')}}</th>
                            <th scope="col">{{__('Mobile')}}</th>
                            <th scope="col">{{__('Gender')}}</th>
                            <th scope="col">{{__('Status')}}</th>
                            <th scope="col"style="width: 10%">{{__('Action')}}</th>
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
                    <h5 class="modal-title" id="modaltitle">{{__('Remove Library Members')}}</h5>
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
                            <h5 id="modallabel">{{__('Are you sure Remove Member')}} </h5>
                        </div>
                        <div class="col-md-8">
                            <h5><label type="text"  id="delete_member_name"></label></h5>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i> &nbsp; {{__('Delete')}}</button>
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
    load_datatable();

    // start member delete function
    $('#member_delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var m_id = button.data('mid') 
        var m_name = button.data('mname')
        document.getElementById("delete_member_id").value= m_id; 
        document.getElementById("delete_member_name").innerHTML = m_name;
        })
    // end member delete function

    $('#member_show').on('show.bs.modal', function (event) {
       
       var button = $(event.relatedTarget) ;
       var m_id = button.data('mid');
       
       $(".show_member_id").val(m_id);
       $("#show_table_tbody").empty();
       var op='';
       // -------------------------------------------
       $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('show_member')}}", 
            data: { m_id: m_id, },
            success:function(data){
              
                op+= '<tr>';
                op+= '<td colspan="2" class="text-center"><b>Library Management System</b></td>';
                op+= '</tr>';
                op+= '<tr>';
                    op+='<td rowspan="4"><img class="img-member1" src="images/members/'+data.image+'"></td>';
                    op+='<td><b>Category : </b>'+data.category_si+'/'+data.category_ta+'/'+data.category_en+'</td>';
                op+= '</tr>';
                op+= '<tr>';
                    op+='<td><b>Name : </b>'+data.name_si+'/'+data.name_ta+'/'+data.name_en+'</td>';
                op+= '</tr>';
                op+= '<tr>';
                    op+='<td><b>Address1 : </b>'+data.address1_si+'/'+data.address1_ta+'/'+data.address1_en+'</td>';
                op+= '</tr>';
                op+= '<tr>';
                    op+='<td><b>Address2 : </b>'+data.address2_si+'/'+data.address2_ta+'/'+data.address2_en+'</td>';
                op+= '</tr>';
                op+= '<tr>';
                    op+='<td class="text-center" rowspan="4"><img src="data:image/png;base64,{{DNS2D::getBarcodePNG('+m_id+', 'QRCODE',5,5)}}" alt="barcode"/></td>';
                op+= '</tr>';
                op+= '<tr>';
                    op+='<td><b>NIC : </b>'+data.nic+'</td>';
                op+= '</tr>';
                op+= '<tr>';
                    op+='<td><b>Mobile: </b>'+data.mobile+'</td>';
                op+= '</tr>';
               
                op+= '<tr>';
                    op+='<td><b>Register Date: '+data.birthday+'</b></td>';
                op+= '</tr>';

                $('#show_table tbody').append(op);

            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            }
        })
        // -------------------------------------------

       
   });

});

function load_datatable()
{

    $('#member_datatable').DataTable({
        columnDefs: [
        {"targets": [0],
        "visible": false,
        "searchable": false},
        ],
        responsive: true,
        processing: true,
        serverSide: false,
        ordering: false,
        searching: true,

    ajax:{
        type: "GET",
        dataType : 'json',
        url: "{{ route('members.index') }}",
    },
    // pageLength: 15,
    
    columns:[
        {data: "id",name: "ResourceID",orderable: true},
        {data: "regnumber",name: "regnumber",orderable: true},
        {data: "images",name: "images",orderable: false},
        {data: "title<?php echo $lang; ?>",name: "title"},
        {data: "<?php echo $name; ?>",name: "name"},
        {data: "<?php echo $address1; ?>",name: "address1"},
        {data: "<?php echo $address2; ?>",name: "address2"},
        {data: "nic",name: "nic",orderable: true},
        {data: "mobile",name: "mobile",orderable: false},
        {data: "gender<?php echo $lang; ?>",name: "gender"},
        {data: "status",name: "status",orderable: false},
        {data: "action",name: "action",orderable: false}
    ],
    "createdRow": function( row, data, dataIndex ) {
        if ( data['status'] == "Removed" ) {        
            $('td', row).addClass('font-weight-bold');
            }
        else if ( data['status'] == "Backlist" ) {        
            $('td', row).addClass('font-weight-bold text-red');
            }
        }
    });
}


$("#genarate_card").click(function () {
    if($('#txt_start').val()!="" && $('#txt_end').val()!=""){
        $("#loader").show();
    }
   
});
</script>

@endsection

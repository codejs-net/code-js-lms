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
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-search"></i>&nbsp;Lending Account</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 text-left p-2"> 
            <h5> <i class="fa fa-search  pl-2">Lending Account</i></h5>
        </div>  
        <div class="col-md-10 text-right">
            <form class="needs-validation" novalidate id="filter_form">
                {{ csrf_field() }}
               
                <div class="input-group mb-3">
                   
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Member</span>
                    </div>
                    <select class="form-control" name="member" id="member" aria-describedby="basic-addon1" value="{{old('member')}}"required>
                        <option value="" disabled selected>Select Member </option>
                        @foreach($memberdata as $item)
                            <option value="{{ $item->id }}">{{ $item->$member }}</option>
                        @endforeach
                        </select>
                        <div class="invalid-feedback">{{ __("Please Select the member")}}</div>
                        <span class="text-danger">{{ $errors->first('member') }}</span>
                    <div class="input-group-prepend ml-2">
                        <span class="input-group-text" id="basic-addon1">Resource</span>
                    </div>
                    <input type="text" name="resource" id="resource" class="form-control" aria-describedby="basic-addon1" placeholder="Accession No" required>
                    <div class="invalid-feedback">{{ __("Please Enter Resource")}}</div>
                    <button type="button" class="btn btn-sm btn-primary elevation-2 mx-2" value="" id="btn_filter" >
                        <i class="fa fa-search"></i>&nbsp;Search
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
                            <th scope="col">Accession No</th>
                            <th scope="col"style="width: 20%">Title</th>
                            <th scope="col"style="width: 20%">Member</th>
                            <th scope="col">Issue Date</th>
                            <th scope="col">Return</th>
                            <th scope="col">Returned Date</th>
                            <th scope="col">Fine</th>
                        </tr>
                    </thead>
                    <tbody>  
                    
                    </tbody>
            </table>
        </div>
        </div>               

    </div>
</div>
{{-- end main --}}


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

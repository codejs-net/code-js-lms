@extends('layouts.app')


@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
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
            <h5> <i class="fa fa-handshake-o">&nbsp;Resources Lending</i></h5>
        </div> 

    </div>
    
</div>

<div class="container-fluid">
    <div class="card card-body">
        <div class="row">
        <input type="hidden" name="member_Name_id"id="member_Name_id">
        <input type="hidden" name="lending_limit" id="lending_limit" value="{{$lending_setting->value}}">

            <div class="col-md-3 col-sm-12 text-left mt-1">
              <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-addon"id="basic-addon2"><i class="fa fa-user-circle-o fa-lg mt-2"></i></span>
                  </div>
                    <input type="text" class="form-control" id="member_id" placeholder="Member ID"aria-describedby="basic-addon2">&nbsp;&nbsp;
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addbarrowmember"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-success" id="addbarrowmember_serch"><i class="fa fa-search"></i></button> 
                </div>  
            </div>

             <div class="col-md-5 col-sm-12 text-left mt-1">
              <div class="input-group">
                  <div class="input-group-prepend">
                     <span class="input-group-addon"id="basic-addon3"><i class="fa fa-list fa-lg mt-2"></i></span>
                  </div>
                    <input type="text" class="form-control" id="resource_details" onfocus="this.value=''" placeholder="AccessionNo / ISBN / ISSN / ISMN" aria-describedby="basic-addon3">&nbsp;&nbsp;
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addbarrow" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></button>
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
                    <input type="date" class="form-control" name="issuedte" id="issuedte" aria-describedby="basic-addon1">
                </div>
            </div>

        </div>

        <div class="row text-center mt-4">
            <div class="col-md-12">
                <!-- small box -->
                    <div class="card card-name" style="height:2.5rem;">
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
        <div class="box-footer clearfix pull-right">
            <button type="button" class="btn btn-primary btn-md" id="issue_resource">
            <i class="fa fa-floppy-o"></i> Save</button>
            &nbsp; &nbsp;
            <button type="button" class="btn btn-warning btn-md" id="reset_issue">
            <i class="fa fa-times"></i> Reset</button>
        </div> 
</div>
</form>
              
<!-----------------------------------------form start--------------------------------------------------->
                            
                        
@endsection
@push('scripts')

            <script>
            $(document).ready(function() {

                document.getElementById("member_id").focus();
                // -------------------------date------------------
                var today = new Date();
                var tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();
                if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = mm+'/'+dd+'/'+yyyy;
                $('#issuedte').attr('value', today);
                // -----------------------------------------------

                var inputm = document.getElementById("member_id");
                inputm.addEventListener("keyup", function(event) {
                if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("addbarrowmember").click();
                $('#member_id').val('');
                
                }
                $("#resourceTable tbody").empty();

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
                $('#issue_error').html('');
                $('#issue_success').html('');

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
                        $('#member_Name_id').val(data.member_id);
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
                var limit = $("#lending_limit").val();
                var op ="";
                var bexsist=false;
               
                if(resourceinput)
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
                        data:{resourceinput: resourceinput},
                        success: function(data){
                        if(data.massage=="success")
                            {
                            op+='<tr>';
                            op+='<td class="td_id">'+data.id+'</td><td>'+data.accno+'</td><td>'+data.snumber+'</td><td>'+data.title+'</td><td>'+data.creator+'</td><td>'+data.category+"-"+data.type+'</td><td><button value="'+data.id+'" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button></td>';
                            op+='</tr>';
                            $("#resourceTable tbody").append(op);
                            }
                            else{toastr.error('Resource Not Found!')}
                    
                        },
                        error: function(data){
                        toastr.error('Something Went Wrong!')
                        }
                    });
                    // -------------------------------------------------------------
                }
                else{toastr.error('Enter Resource AccessionNo / ISBN / ISSN / ISMN')}
               
                
                    
                        if($('#member_Name_id').val())
                        {
                            var rowCount = $('#resourceTable tr').length;
                            if(rowCount<4) //3+1 must get by settings
                            {
                            var oTable = document.getElementById('resourceTable');
                            var rowLength = oTable.rows.length;
                            
                            for (j = 1; j < rowLength; j++)
                            {
                                var oCells = oTable.rows.item(j).cells;
                                var cellVal = oCells.item(1).innerHTML;
                                if(resourceid.toUpperCase()==cellVal.toUpperCase())
                                { 
                                    bexsist=true;   
                                }
                            }

                            if(bexsist==false)
                            {
                               
                            }
                            else{$('#issue_error').html('Book Allready Exsists');}
                    
                            }
                            else{$('#issue_error').html('* Maximam Books allowd');}
                            }
                            else{$('#issue_error').html('* Select Member First');
                            document.getElementById("member_id").focus();
                        }


                    });
                    // -----------------------------------------------------
                    $('#issue_book').on("click",function(){

                        var oTable = document.getElementById('BookTable');
                        var rowLength = oTable.rows.length;
                        var mem_id = $("#member_Name_id").val();
                        var dteissue = $("#issuedte").val();
                        //var dteissue =new Date().toLocaleDateString();
                        for (j = 1; j < rowLength; j++)
                        {
                            var oCells = oTable.rows.item(j).cells;
                            var Bookid = oCells.item(0).innerHTML;
                            // -----------------------
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                method: 'POST',
                                data:{
                                    Bookid: Bookid,
                                    mem_id: mem_id,
                                    dteissue: dteissue
                                
                                    },
                                url: '/issue_save',
                                success: function(response){
                                $('#issue_success').html("Books Issue Sucessfully");
                                $('#bookB_details').val('');
                                $('#member_Name_id').val('');
                                $('#member_Name').html('');
                                $('#issue_error').html('');
                                $("#BookTable tbody").empty();
                                document.getElementById("member_id").focus();


                                },
                                error: function(response){
                                $('#issue_error').html('Books Issued Fali!');
                                }
                            });
                            }
                        });
            </script>
        @endpush

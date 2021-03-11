@extends('layouts.app')

@section('content')
<div>
        <!-- Content Header (Page header) -->
    <section class="content-fulid mt-1">
        <h2> &nbsp Board Of Survey</h2> 
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li><a ><i class="fa fa-briefcase"></i> Board Of Survey</a></li>
                <li class="active"><i class="fa fa-book"></i>Survey</li>
        </ol>
    </section>

        <!-- Main content -->
    <section class="content">

        <div class="row">
                <!-- --------------------------- section 1------------------------------------- -->
            <section class="col-lg-12 connectedSortable">
 
                <div class="box box-info">
                        <div class="box-header ">
                           <div class="pull-left header"> <h4> <i class="fa fa-book"> Survey</i></h4></div>
                           <div class="pull-right header"> <h4> <a href="" data-toggle="modal" data-target="#start_new_survey" ><i class="fa fa-plus"></i>&nbsp;New</a></h4></div>
                           
                           
                        </div>

                            <div class="box-body">
                                
                                <form onSubmit="return false;" class="form-inline">
                                    <div class="form-row">
                                        <div class="form-group col-md-5 text-left">
                                            <div class="row form-inline">
                                                <label for="">Book ID &nbsp;&nbsp;&nbsp;&nbsp;: </label>&nbsp;
                                                 <input type="text" class="form-control" id="book_capture" placeholder="Book ID">&nbsp;
                                                 
                                                <button type="button" class="btn btn-primary" id="book_check"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="btn btn-warning mt-1" id="book_uncheck"><i class="fa fa-minus"></i></button>
                                                
                                                <!-- <button type="button" class="btn btn-success" id=""><i class="fa fa-search"></i></button>  -->

                                            </div>
                                            <br>

                                            <div class="row">
                                                <label for="">Suggestion: </label>&nbsp;
                                                <!-- <input type="text" class="form-control" id="book_suggestion" placeholder="suggestion">&nbsp; -->
                                                <select class="form-control" id="book_suggestion" name="book_suggestion">
                                                    <!-- <option value="1" selected disabled hidden>-Choose Suggetion-</option> -->
                                                        @foreach($sdata as $sitem)
                                                            <option value="{{ $sitem->id }}">{{ $sitem->Suggetion }}</option>
                                                        @endforeach
                                                </select>
                                                
                                                
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="small-box  col-lg-12 text-center " style="height:9rem;">
                                                <div class="row">
                                                    <!-- <div class="icon">
                                                        <i class="ion ion-pie-graph"></i>
                                                    </div> -->
                                                    <!-- <h4> <label>Book details</label></h4> -->
                                                    <h4 class="text-black"> <label id="book_capturename"></label></h4>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="small-box bg-aqua col-lg-12 text-center " style="height:9rem;">
                                                <div class="row">
                                                    <!-- <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                    <h4  class=" text-black"> <label>Total &nbsp;&nbsp; -</label></h4>
                                                        
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <h3 id="total_count" class="">{{ $Bcount }}</h3>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                    <h4  class=" text-black"> <label>Survey -</label></h4>
                                                    </div>
                                                    <div class="col-md-6 text-left">
                                                        <span type="hidden" id="survey_count" class=""><h3>{{ $Scount }}</h3></span>
                                                        <h3 id="survey_countb"></h3>
                                                    </div>
                                                    
                                                </div> 
                                            </div>

                                        </div>
                                        <div class="form-group col-md-1 text-center" >
                                        <div class="row">
                                                <a href="/export_surveytemp" class="btn btn-primary" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;All &nbsp;&nbsp;</i></a>
                                                <a href="/export_surveytemp1" class="btn btn-warning" id=""><i class="fa fa-line-chart">&nbsp;UnCheck</i></a>
                                                
                                            </div>    
                                           
                                        </div>
                                    </div>
                                        
                                </form>
                            </div> 


                        
                

                        <div class="box box-info">
                            <div class="box-header">
                                               
                                <table class="table table-responsive " id="survey_datatable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Book ID</th>
                                            <th scope="col">Accession No</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Survey</th>
                                            <th scope="col">suggestion</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                @push('scripts')
                                <script>

                                    $(document).ready(function() {
                                    
                                    // -----------------------------------
                                    
                                    $('#survey_datatable').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    dom: 'Bfrtip',
                                    buttons: [
                                        'copy', 'excel', 'pdf'
                                    ],

                                    ajax:{
                                    url: "{{ route('survey.survey') }}",
                                    },
                                    columns:[
                                        {data: "id",name: "id"},
                                        {data: "accessionNo",name: "accessionNo"},
                                        {data: "book_title",name: "book_title"},
                                        {data: "authors",name: "authors"},
                                        {data: "price",name: "price"},
                                        {data: "survey",name: "survey",orderable: false},
                                        {data: "Suggetion",name: "Suggetion"},
                                        
                                    ]
                                    });
                                    
                                    document.getElementById("book_capture").focus();
                                    // -----------------------------------------------------------------------
                                    var input = document.getElementById("book_capture");
                                    input.addEventListener("keyup", function(event) {
                                    if (event.keyCode === 13) {
                                    event.preventDefault();
                                    document.getElementById("book_check").click();
                                    $('#book_capture').val('');
                                    $('#book_suggestion').prop('selectedIndex',0);
                                    document.getElementById("book_capture").focus();
                                    }
                                    });

                                    var input_s = document.getElementById("book_suggestion");
                                    input_s.addEventListener("keyup", function(event) {
                                    if (event.keyCode === 13) {
                                    event.preventDefault();
                                    document.getElementById("book_check").click();
                                    $('#book_capture').val('');
                                    $('#book_suggestion').prop('selectedIndex',0);
                                    document.getElementById("book_capture").focus();
                                    }
                                    });

                                    

                                    });

                                // ----------------------------------------------------------------------------

                                    $('#book_check').on("click",function(){
                                        var book_acc = $("#book_capture").val();
                                        var sugge = $("#book_suggestion").val();
                                        load=0;

                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });

                                        $.ajax({
                                            method: 'POST',
                                            url: '/ckeck_book',
                                            data: { 
                                                book_acc: book_acc,
                                                sugge   : sugge
                                            },
                                            
                                            
                                            success: function(response){

                                               
                                                $('#survey_count').html('');
                                                $('#book_capturename').html(response.book_name);
                                                $('#survey_countb').html(response.survey_count);
                                                $('#survey_datatable').DataTable().ajax.reload();
                                               
                                            },
                                            error: function(response){
                                                $('#book_capturename').html("Book Not Found..!");
                                            }
                                        });
                                    });
                                // ------------------------------------------------------------------------
     

                                 $('#book_uncheck').on("click",function(){
                                        var book_acc = $("#book_capture").val();
                                        var sugge = $("#book_suggestion").val();
                                       

                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });

                                        $.ajax({
                                            method: 'POST',
                                            url: '/unckeck_book',
                                            data: { 
                                                book_acc: book_acc,
                                                sugge   : sugge
                                            },
                                            
                                            
                                            success: function(response){

                                               
                                                $('#survey_count').html('');
                                                $('#book_capturename').html(response.book_name);
                                                $('#survey_countb').html(response.survey_count);
                                                $('#survey_datatable').DataTable().ajax.reload();
                                                $('#book_capture').val('');
                                                $('#book_suggestion').prop('selectedIndex',0);
                                                document.getElementById("book_capture").focus();
                                               
                                            },
                                            error: function(response){
                                                $('#book_capturename').html("Book Not Found..!");
                                            }
                                        });
                                    });
                                // ------------------------------------------------------------------------


                                // $('#finalize').on("click",function(){

                                //         $.ajaxSetup({
                                //             headers: {
                                //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                //             }
                                //         });

                                //         $.ajax({
                                //             method: 'POST',
                                //             url: '/finalize_suevey',
                                //             data: { },
                                            
                                //             success: function(response){

                                //                 $('#book_capturename').html("Survey Finalized Successfully");
                                //                 location.reload();
                                               
                                //             },
                                //             error: function(response){
                                //                 $('#book_capturename').html("Error Survey Finalizing");
                                //             }
                                //         });
                                //     });
                                // ------------------------------------------------------------------------

                                 </script>
                                @endpush
                                                                    
                            </tbody>
                        </table>
                
                            <div class="pull-right">
                                
                            <a href="" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#finalize_survey" ><i class="fa fa-save">&nbsp;<strong>Finalize</strong></i></a>
                                <!-- <button class="btn btn-primary btn-lg" id="finalize"><i class="fa fa-save">&nbsp;<strong>Finalize</strong></i></button> -->
                                <!-- <a href="" class="btn btn-success "><i class="fa fa-search">&nbsp;View</i></a>
                                <a href="" class="btn btn-danger "><i class="fa fa-refresh">&nbsp;Clear</i></a> -->
                            </div>

                        </div>               
                    </div>
                </div>

            </section>
  
        </div>
                   

    </section>


</div>

           


@include('boardOfSurvey.new_survey_modal')
@include('boardOfSurvey.survey_finalize_modal')
@endsection

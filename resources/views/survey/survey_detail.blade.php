@extends('layouts.app')

@section('content')
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-fulid mt-1">
            <h2> &nbsp Board Of Survey</h2> 
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                    <li><a ><i class="fa fa-briefcase"></i> Board Of Survey</a></li>
                    <li class="active"><i class="fa fa-book"></i> Past Survey</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <!-- --------------------------- section 1------------------------------------- -->
                <section class="col-lg-12 connectedSortable">
 
                    <div class="box box-info">
                        <div class="box-header ">
                           <div class="pull-left header"> <h4> <i class="fa fa-book">Survey Details</i></h4></div>
                        </div>
                        
                        <div class="box-body">
                            <div class="form-row">
                                    <div class="small-box bg-aqua col-lg-12 text-center " style="height:5rem;">
                                        <div class="row">
                                            <div class="col-md-1 text-left">
                                                <h4  class=" text-black "> <label>Survey ID</label></h4>  
                                            </div>
                                            <div class="col-md-1">
                                                <h4  class="" id="s_id"> <label>{{$survy->id}}</label></h4>  
                                            </div>
                                            <div class="col-md-1 text-left">
                                                <h4  class=" text-black "> <label>Start Date</label></h4>  
                                            </div>
                                            <div class="col-md-1">
                                                <h4  class="" id="ssdate"> <label>{{$survy->start_date}}</label></h4>  
                                            </div>
                                            <div class="col-md-1 text-left">
                                                <h4  class=" text-black "> <label>End date</label></h4>  
                                            </div>
                                            <div class="col-md-1">
                                                <h4  class="" id="sedate"> <label>{{$survy->end_date}}</label></h4>  
                                            </div>
                                            <div class="col-md-1 text-left">
                                                <h4  class=" text-black "> <label>Total Count</label></h4>  
                                            </div>
                                            <div class="col-md-1">
                                                <h4  class="" id="tot_count"> <label>{{$survy->TotalBooks}}</label></h4>  
                                            </div>
                                            <div class="col-md-1 text-left">
                                                <h4  class=" text-black "> <label>Removed Count</label></h4>  
                                            </div>
                                            <div class="col-md-1">
                                                <h4  class="" id="remov_count"> <label>{{$survy->removedBooks}}</label></h4>  
                                            </div>
                                            <div class="col-md-1 text-left">
                                                <h4  class=" text-black"> <label>Survey Count</label></h4>  
                                            </div>
                                            <div class="col-md-1">
                                                <h4  class="" id="servy_count"> <label>{{$survy->surveyBooks}}</label></h4>  
                                            </div>
                                        </div>
                                        <!-- -------------------------------------------------------------- -->
                                        
                                    </div>

                            

                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-row">
                            <input type="hidden" name="id" id="id" value="{{$Sdata}}">  
                                <table class="table " id="sdatatable">
                                    <thead class="thead-dark">
                                        <tr>
                                        <!-- <th scope="col">Book ID</th> -->
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
                                        $('#id').val("{{$Sdata}}");

                                        var seid = $("#id").val();
                                        
                                        
                                        // var ssid = $(this).attr('id');
                                        
                                        // ----------view-------------------------
                                        $('#sdatatable').DataTable({
                                        processing: true,
                                        serverSide: true,

                                        ajax:{
                                            url: '/survey_details/'+seid,
                                        },
                                        
                                        columns:[
                                            // {data: "id",name: "id"},
                                            {data: "accessionNo",name: "accessionNo"},
                                            {data: "book_title",name: "book_title"},
                                            {data: "authors",name: "authors"},
                                            {data: "price",name: "price"},
                                            {data: "survey",name: "survey",orderable: false},
                                            {data: "Suggetion",name: "Suggetion"},
                                        ]
                                        });

                                        });
                                         

                                    </script>
                                    @endpush
                                    </tbody>
                                </table>

                                </div>

                                <a href="/export_surveyAll_book/{{$survy->id}}" class="btn btn-primary" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;All Book Report &nbsp;&nbsp;</i></a> &nbsp;&nbsp;

                                <a href="/export_surveyCheck_book/{{$survy->id}}" class="btn btn-success" id=""><i class="fa fa-line-chart">&nbsp;&nbsp;Suevey Report</i></a>&nbsp;&nbsp;

                                <a href="/export_surveytemp" class="btn btn-danger" id=""><i class="fa fa-pie-chart">&nbsp;&nbsp;Removed Book Report &nbsp;&nbsp;</i></a> &nbsp;&nbsp;

                                <a href="/export_surveytemp1" class="btn btn-warning" id=""><i class="fa fa-bar-chart">&nbsp;&nbsp;UnCheck Book Report</i></a>&nbsp;&nbsp;

                        </div>
                    </div>
                   
                    <!-- --------------------------end section1----------------------------------------------- -->

                </section>



            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>
@endsection

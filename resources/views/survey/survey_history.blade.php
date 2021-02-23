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
                           <div class="pull-left header"> <h4> <i class="fa fa-book">Survey History</i></h4></div>
                        </div>

                        <div class="box-body">
                            <div class="form-row">
                                   
                                <table class="table " id="sdatatable">
                                    <thead class="thead-dark">
                                        <tr>
                                        <th scope="col">Survey ID</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">TotalBooks</th>
                                        <th scope="col">RemovedBooks</th>
                                        <th scope="col">surveyBooks</th>
                                        <th scope="col">finalize</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Sdata as $data)
                                        <tr>
                                       
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->start_date}}</td>
                                            <td>{{$data->end_date}}</td>
                                            <td>{{$data->TotalBooks}}</td>
                                            <td>{{$data->removedBooks}}</td>
                                            <td>{{$data->surveyBooks}}</td>
                                            <td>{{$data->finalize}}</td>
                                            <td>
             
                                            <a href="/survey_details/{{$data->id}}" class="btn btn-success btn-sm"><i class="fa fa-search" ></i></a>&nbsp; 

                                            <a class="btn btn-danger btn-sm " data-toggle="modal" data-target="#Modal_delete_servey" data-servyid="{{$data->id}}" data-surveydte="{{$data->start_date}}"><i class="fa fa-trash" ></i></a>&nbsp;
                                            

                                            </td>
                                        </tr>
                                    @endforeach
                                    @push('scripts')
                                        <script>
                                          $(document).ready(function() {
    
                                                $('#sdatatable').DataTable();
                                               
                                            });

                                            $('#Modal_delete_servey').on('show.bs.modal', function (event) {
  
                                                var button = $(event.relatedTarget) 

                                                var s_id = button.data('servyid') 
                                                var s_dte = button.data('start_date')
                                                var modal = $(this)

                                                document.getElementById("servyid").value= s_id; 
                                                document.getElementById("svr_dte").innerHTML = s_id;
                                            })
                                        

                                        </script>
                                    @endpush
                                    </tbody>
                                </table>

                                </div>

                
                        </div>
                    </div>
                   
                    <!-- --------------------------end section1----------------------------------------------- -->

                </section>



            </div>

            
        </section>

    </div>
    <!-- start modal delete-------------------------------------------------------------------------------------------- -->
    <div class="modal modal-default fade" id="Modal_delete_servey" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Remove Survey</h4>
                            </div>
                            <form method="post" action="/deleteSurvey">
                                {{ csrf_field() }}
                                <div class="modal-body">

                                    <input type="hidden" id="servyid" name="servyid">
                                    <div class="row form-group">
                                        <div class="col-md-4">
                                            <h5 id="myModalLabel">Are you sure Remove Survey - </h5>
                                        </div>
                                        <div class="col-md-8">
                                            <h4><label type="text"  id="svr_dte"></label></h4>
                                        </div>
                                    </div>
                                        

                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger "><i class="fa fa-trash"></i> &nbsp; Delete</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
    <!-- end modal delete ------------------------------------------------------------------------------------------>

@endsection

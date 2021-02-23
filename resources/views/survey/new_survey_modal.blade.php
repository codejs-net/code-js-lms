 <!------------------------------ new survey modal--------------------------- -->
 <div class="modal fade" id="start_new_survey" tabindex="-1" role="dialog" aria-labelledby="categoryModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                  <h3 class="modal-title" id="opp_title"></h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  <h4> <i class="fa fa-plus"> Start new survey</i></h4>
                  </div>
                  <form name="new_survey" id="newsurvey" method="post" action="/new_survey" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="modal-body">
                        <div class="box-header ">
                        <div class="pull-left header"> 
                              
                              <div class="card-body">
                              <div class="form-group">
                              <label class="text-red" for="purchase_date" >Warning!! - If start new survey ,Current Unfinalize Survey details Will Discard. </label>
                              <label class="" for="purchase_date" >Click Start for New Survey. Click close to stay currnt Survey  </label>
                              <!-- <input class="form-control" type="date" name="Survey_startDte" id="Survey_startDte">  -->
                                 
                              </div>
                              <br>
                              <input type="password" class="form-control" name="adpass"  value="" placeholder="Admin Password">
                              </div>
                        </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                        
                        <button class="btn btn-success" type="submit">Start New</button>
                       
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close &nbsp;<i class="fa fa-times"></i></button>
                        
                  </div>
            </form>
            </div>
      </div>
</div>
                            <!-- ------------------------------------------------------------------------ -->
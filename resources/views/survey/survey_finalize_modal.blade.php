
<!-- ------------------------------------------------------------------------ -->
<div class="modal fade" id="finalize_survey" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-js">
                <div class="text-center js-text-light">
                    <h5 class="modal-title" id="modaltitle">Finalize Survey</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form onSubmit="return false;" class="needs-validation" name="finalize_survey_form" id="finalize_survey_form" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                  <input type="hidden" name="fsurveyid" id="fsurveyid" value="{{$sdata->id}}">
                  <h5>Survey{{$sdata->id}}-{{$sdata->start_date}}({{$sdata->$description}}) </h5>
                  <span class="" for="" >Click finalize for Complete the Survey or Click close to stay with Survey </span>
                  <div class="form-group">
                    <label class="" for="survey_date" >Finalize Date:</label>
                    <input class="form-control" type="date" name="finalize_date" id="finalize_date" value="{{$nowdate}}">              
                </div>
                </div>

                <div class="modal-footer">
                    <div class="progress">
                        <div class="bar"></div >
                        <div class="percent">0%</div >
                    </div>
                  <button class="btn btn-sm btn-success" id="finalize" type="submit"><span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"  style="display: none;" id='loader'></span>&nbsp;Finalize</button>
                  <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Close &nbsp;<i class="fa fa-times"></i></button>
                </div>
            </form>
           
        </div>
    </div>
</div>
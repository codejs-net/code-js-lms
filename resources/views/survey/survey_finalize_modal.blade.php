
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
            
            <form method="POST" action="{{route('finalize_survey')}}"class="needs-validation" id="finalize_survey" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                  <input type="hidden" name="fsurveyid" id="fsurveyid" value="{{$sdata->id}}">
                  <h5>Survey{{$sdata->id}}-{{$sdata->start_date}}({{$sdata->$description}}) </h5>
                  <label class="" for="purchase_date" >Click finalize for Complete the Survey or Click close to stay with Survey </label>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-sm btn-success" id="finalize" type="submit">Finalize</button>
                  <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Close &nbsp;<i class="fa fa-times"></i></button>
                </div>
            </form>
           
        </div>
    </div>
</div>
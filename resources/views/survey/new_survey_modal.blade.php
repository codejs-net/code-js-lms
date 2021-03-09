 <!------------------------------ new survey modal--------------------------- -->

<div class="modal fade" id="start_new_survey" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-js">
                <div class="text-center js-text-light">
                    <h5 class="modal-title" id="modaltitle">Create New Survey</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" method="POST" enctype="multipart/form-data" action="{{ route('create_survey') }}"class="needs-validation" id="create_newsurvey" novalidate>
                {{ csrf_field() }}
                <div class="modal-body">
                    <label class="" for="purchase_date" >Click Start for New Survey. Click close to cancel  </label>
                <div class="form-group">
                    <label class="" for="purchase_date" >Survey Date:</label>
                    <input class="form-control" type="date" name="survey_date" id="survey_date" value="{{$surveydate}}">              
                </div>

                <div class="checkbox-group">
                    <strong>Category:</strong>
                    <div class="form-check">
                        @foreach($catdata as $value)
                            <label><input type="checkbox" name="category[]" class="form-check-input" value="{{ $value->id }}"> {{ $value->$category }}</label>
                        <br/>
                        @endforeach
                    </div>
                </div>

                <div class="checkbox-group">
                    <strong>Center:</strong>
                    <div class="form-check">
                        @foreach($centdata as $value)
                            <label><input type="checkbox" name="center[]" class="form-check-input" value="{{ $value->id }}"> {{ $value->$center }}</label>
                        <br/>
                        @endforeach
                    </div>
                </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success bg-js"><i class="fa fa-plus"></i> &nbsp; Create</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- end Create model -->
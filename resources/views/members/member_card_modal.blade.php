<!--show Modal -->
<div class="modal fade" id="member_card_range" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Genarate Member Cards</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            <form action="{{route('member_card_range')}}" method="post" class="needs-validation" data-toggle="validator" novalidate>
            {{ csrf_field() }}
            <div class="modal-body">
                
                <div class="card-body">
                <h5>Provide Member ID Range to Genarate Cards</h5>
                <span>(example: 1-1000)</span>
                    <div class="row bg-gradient-white">
                        <div class="col-sm-12 col-md-6 text-center">
                            <div class="input-group mb-3 mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">From</span>
                                </div>
                                <input type="text" name="txt_start" class="form-control" placeholder="Start ID" aria-label="Start Number" aria-describedby="basic-addon1"required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 text-center">
                            <div class="input-group mb-3 mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">To</span>
                                </div>
                                <input type="text" name="txt_end" class="form-control" placeholder="End ID" aria-label="End Number" aria-describedby="basic-addon1"required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="modal-footer">
                    
                        <div class="box-footer mt-2 clearfix pull-right">
                            <button type="submit" class="btn btn-success btn-sm " id="genarate_card" ><span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"  style="display: none;" id='loader'></span> {{ __("Genarate")}}</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
                        </div>
                   
                   
                </div>
            </form>
        
        </div>
    </div>
</div>
<!-- end show model -->  
<!--show Modal -->
<div class="modal fade" id="resource_card_range" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Genarate Resource Cards</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            <form action="{{route('recource_card_range')}}" method="post" class="needs-validation" data-toggle="validator" novalidate>
            {{ csrf_field() }}
            <div class="modal-body">
                
                <div class="card-body">
                <h6>Provide Resource Range to Genarate Cards</h6>
                <span>(example: 1-1000)</span>
                    <div class="row bg-gradient-white">
                        <div class="col-md-12 col-12 text-center">
                            <div class="input-group mb-3 mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Order</span>
                                </div>
                                <select class="form-control"name="resource_order" id="resource_order" aria-label="order" aria-describedby="basic-addon1">
                                    <option value="id" selected>ID</option>
                                    <option value="accessionNo">Accession Number</option>
                                    <option value="standard_number">Standard Number</option>
                                    <option value="{{$title}}">Title</option>
                                    <option value="{{$category}}">Category</option>
                                    <option value="{{$type}}">Type</option>
                                    <option value="{{$creator}}">Creator</option>
                                    <option value="{{$publisher}}">Publisher</option>
                                    <option value="{{$language}}">Language</option>
                                    <option value="{{$center_indix}}">Center</option>
                                    <option value="class_code">DD Class</option>
                                    <option value="devision_code">DD Devision</option>
                                    <option value="section_code">DD Section</option>
                                    <option value="ddc">DDC</option>
                                    <option value="price">Price</option>
                                    <option value="purchase_date">Purchase Date</option>
                                    <option value="edition">Edition</option>
                                    <option value="publishyear">Publish Year</option>
                                    <option value="phydetails">Physical Details</option>
                                </select>     
                            </div>
                        </div>
                        <div class="col-12 col-md-6 text-center">
                            <div class="input-group mb-3 mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">From</span>
                                </div>
                                <input type="text" name="resource_from" class="form-control" placeholder="Start" aria-label="Start Number" aria-describedby="basic-addon1"required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 text-center">
                            <div class="input-group mb-3 mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">To</span>
                                </div>
                                <input type="text" name="resource_to" class="form-control" placeholder="End" aria-label="End Number" aria-describedby="basic-addon1"required>
                            </div>
                        </div>
                        <div class="col-md-12 col-12 input-group border border-secondary">
                            <div class=" py-1 px-2 mr-2">
                                <div class="form-check form-check-inline text-primary" >
                                    <label class="form-check-label"><i class="fa fa-print"></i> &nbsp;Single&nbsp;</label>
                                    <input type="radio" class="form-check-input methord" name="resource_print" value="Single" checked required>
                                </div>
                                <div class="form-check form-check-inline text-primary" >
                                    <label class="form-check-label"><i class="fa fa-print"></i> &nbsp;Multipal&nbsp;</label>
                                    <input type="radio" class="form-check-input methord" name="resource_print" value="Multipal" required>
                                </div>
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
<!--show Modal -->
<div class="modal fade bd-example-modal-lg" id="same_resource_modal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Select Resource</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            <form  method="post" class="needs-validation" data-toggle="validator" novalidate>
            {{ csrf_field() }}
            <div class="modal-body">
                
                <div class="card-body">
                <h5>Input have multiple resources plese select one of item to Survey</h5>
                <table class="table table-light" id="same_resource_table">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col" class="td_id">ID</th>
                        <th scope="col">Accession No</th>
                        <th scope="col">ISBN/ISSN</th>
                        <th scope="col">Title</th>
                        <th scope="col">Creator</th>
                        <th scope="col">Type</th>
                        <th scope="col">Action</th>
                        </tr>    
                    </thead>
                    <tbody>
                        <!-- ----- -->
                        <!-- ----- -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                
                </div>
            </div>

                <div class="modal-footer">
                    
                        <div class="box-footer mt-2 clearfix pull-right">
                            <!-- <button type="submit" class="btn btn-success btn-sm " id="genarate_card"><span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"  style="display: none;" id='loader'></span> {{ __("Select")}}</button> -->
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
                        </div>
                   
                   
                </div>
            </form>
        
        </div>
    </div>
</div>
<!-- end show model -->  
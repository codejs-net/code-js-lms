<!-- --------------------------start  modal delete------------------------------- -->
   
<div class="modal fade" id="book_delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <div class="text-center">
                    <h4 class="modal-title" id="modaltitle">Remove Book</h4>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="post" action="/deleteBook">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="id" name="id">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h5 id="modallabel">Are you sure Remove- </h5>
                        </div>
                        <div class="col-md-8">
                            <h4><label type="text"  id="modallabel"></label></h4>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> &nbsp; Delete</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- ---------------------end delete Model------------------------------------- -->
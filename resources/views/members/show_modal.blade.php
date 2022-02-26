<!--show Modal -->
<div class="modal fade" id="member_show" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Show Member Details</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
                <div class="modal-body">
                
                    <div class="row">
                        
                        <div class="col-md-12">
                            <table class="table table-bordered  show-table" id="show_table">
                               <thead>

                               </thead>
                                <tbody id=show_table_tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    
                    <form action="{{route('member_card')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="show_member_id" id="show_member_id" name="show_member_id">
                        <div class="box-footer mt-2 clearfix pull-right">
                            <button type="submit" class="btn btn-success btn-sm " id="save_member"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ __("Member Card")}}</button>
                        </div>
                    </form>
                    <form action="{{route('report_member_reg')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" class="show_member_id" id="show_member_id" name="show_member_id">
                        <div class="box-footer mt-2 clearfix pull-right">
                            <button type="submit" class="btn btn-info btn-sm " id="reg_form"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ __("Registretion Form")}}</button>
                        </div>
                    </form>
                    <div class="box-footer mt-2 clearfix pull-right">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>    
                    </div>

                </div>
        
        </div>
    </div>
</div>
<!-- end show model -->  
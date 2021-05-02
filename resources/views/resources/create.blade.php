@extends('layouts.app')


@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$type="type".$lang;
$publisher="publisher".$lang;
$medium="phymedia".$lang;
$language="language".$lang;
$dd_class="class".$lang;
$dd_devision="devision".$lang;
$dd_section="section".$lang;
$creator="name".$lang;
$title="title".$lang;
$gender="gender".$lang;
$rack="rack".$lang;
$center="name".$lang;

@endphp


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Resources&nbsp;</a></li>
    <li class="breadcrumb-item active" ><a><i class="fa fa-plus"></i> Add Resources&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center mb-2">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h5> <i class="fa fa-plus-circle"> {{__("Add Resources")}}</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right">
        @can('data-import')
                <a class="btn btn-sm btn-js" data-toggle="modal" data-target="#data_import" ><i class="fa fa-file-excel-o" ></i>&nbsp;Import</a>
            @endcan
        </div>
    </div>
    
</div>

        <!-- Main content -->
<div class="container">
    <div class="card card-body">
         <div class="row">
         <div class="col-md-12">
                <!-- --------------------------- section 1------------------------------------- -->
    
                <form enctype="multipart/form-data"  name="resource_save" id="resource_save" class="needs-validation"  novalidate>
                {{ csrf_field() }}

                <div class="form-row border border-secondary bg-light">
                    <div class="col-md-2 col-12 mt-2 pl-2">
                        <img src="{{ asset('images/resources/default_book.jpg') }}" class="img-resource1 elevation-3" id="avater">
                    </div>
                    <div class="col-md-10 col-12">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="image">Resource Image</label>
                                <div class="col-md-11 col-12"><input type="file" id="resource_image" name="resource_image" class="form-control-file bg-white p-1 elevation-1"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="book_category" class="">Category</label>
                                <select class="form-control elevation-1" id="resoure_category" name="resoure_category" value="{{old('resoure_category')}}"required>
                                <option value="" selected disabled hidden>Choose here</option>
                                @foreach($cat_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->$category}}</option>
                                @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('category') }}</span>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="new_category">&nbsp;</label></br>
                                <a href="{{ route('resource_catagory.index') }}" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i></a>
                            </div>
        
                            <div class="form-group col-md-5">
                                <label for="language">Type &nbsp;
                                    <span id="loader_type" style="display:none"><i class="fa fa-spinner fa-spin fa-md"></i></span>
                                </label>
                                <div class="input-group">
                                    <select class="form-control elevation-1" id="resoure_type" name="resoure_type" value="{{old('resoure_type')}}"required>
                                    <option value="" selected disabled hidden>Choose here</option>
                                    </select>
                                   
                                    <span class="text-danger">{{ $errors->first('language') }}</span>
                                </div>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="new_language">&nbsp;</label></br>
                                <a href="{{ route('resource_type.index') }}" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div>


                <hr>
                <div class="form-row">

                    <div class="form-group col-md-6">
                    <label for="isbn">ISBN/ISSN/ISMN</label>
                        <input type="text" class="form-control" id="resoure_isn" name="resoure_isn"  value="{{old('resoure_isn')}}"  placeholder="ISBN/ISSN/ISMN">
                        <span class="text-danger">{{ $errors->first('isbn') }}</span>
                    </div>
                   

                    <div class="form-group col-md-6">
                       
                        <label for="accessionNo">Accession Number</label>
                        <input type="text" class="form-control" id="resoure_accession" name="resoure_accession" value="{{old('resoure_accession')}}" placeholder="Accession Number:" required>
                        <span class="text-danger" >{{ $errors->first('accessionNo') }}</span>
                    </div>
                    
                </div>
                <hr>
                    
                <div class="form-row">
                    
                    <div class="form-group col-md-12">
                        <label for="book_title">Title</label>
                        <input type="text" class="form-control mb-1" id="resource_title_si" name="resource_title_si" value="{{old('book_title_si')}}" placeholder="Title in sinhala" >
                        <input type="text" class="form-control mb-1" id="resource_title_ta" name="resource_title_ta" value="{{old('book_title_ta')}}" placeholder="Title in Tamil" >
                        <input type="text" class="form-control mb-1" id="resource_title_en" name="resource_title_en" value="{{old('book_title_en')}}" placeholder="Title in English" >
                        <span class="text-danger">{{ $errors->first('book_title') }}</span>
                    </div>
                    <div class="form-group col-md-11">
                        <label for="authors">Creator</label>
                            <select class="form-control" id="resource_creator" name="resource_creator" value="{{old('resource_creator')}}"required>
                                <option value="" selected disabled>Choose here</option>
                                @foreach($creator_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->$creator}}</option>
                                @endforeach
                            </select>
                        <span class="text-danger">{{ $errors->first('authors') }}</span>
                    </div>
                    <div class="form-group col-md-1">
                        <label>&nbsp;</label></br>
                        <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#creator_create"><i class="fa fa-plus"></i></button>
                    </div>

                    
                </div>
                <hr>
                <div class="form-row">

                <div class="form-group col-md-5">
                        <label for="publisher">Publisher</label>
                        <select class="form-control" id="resource_publisher" name="resource_publisher" value="{{old('resource_publisher')}}"required>
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach($pub_data as $item)
                                <option value="{{ $item->id }}">{{ $item->$publisher}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('publisher') }}</span>
                    </div>
                    <div class="form-group col-md-1">
                    <label for="new_publisher">&nbsp;</label> </br>
                    <button type="button" id="btn_newpublisher" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i></button>

                    </div>

                    <div class="form-group col-md-5">
                        <label for="language">Language</label>
                        <select class="form-control" id="resource_language" name="resource_language" value="{{old('resource_language')}}"required>
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach($lang_data as $item)
                                <option value="{{ $item->id }}">{{ $item->$language }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('language') }}</span>
                    </div>
                    <div class="form-group col-md-1">
                    <label for="new_language">&nbsp;</label>  </br>
                    <button type="button" id="btn_newlanguage" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i></button>

                    </div>
                    
                </div>
                <hr>
                <div class="form-row border border-secondary bg-light">
                    <!-- -------------------------------------------- -->
                    <div class="form-group col-md-3">
                            <label for="dewey_decimal">Dewey Decimal Class</label>
                            <select class="form-control" id="resource_dd_class" name="resource_dd_class" value="{{old('resource_dd_class')}}">
                            <option value="" selected disabled hidden>Choose here</option>
                            @foreach($dd_class_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->class_code}}-{{ $item->$dd_class}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>

                    <!-- -------------------------------------------- -->
                    <div class="form-group col-md-3">
                            <label for="dewey_decimal">Dewey Decimal Devision &nbsp;
                                <span id="loader_dd_devision" style="display:none"><i class="fa fa-spinner fa-spin fa-md"></i></span>
                            </label>
                            <select class="form-control" id="resource_dd_devision" name="resource_dd_devision" value="{{old('resource_dd_devision')}}">
                            <option value="" selected disabled hidden>Choose here</option>
                            </select>
                            <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>

                    <!-- -------------------------------------------- -->
                    <div class="form-group col-md-3">
                            <label for="dewey_decimal">Dewey Decimal Section &nbsp;
                                <span id="loader_dd_section" style="display:none"><i class="fa fa-spinner fa-spin fa-md"></i></span>
                            </label>
                            <select class="form-control" id="resource_dd_section" name="resource_dd_section" value="{{old('resource_dd_section')}}">
                            <option value="" selected disabled hidden>Choose here</option>
                            </select>
                            <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>

                     <!-- -------------------------------------------- -->
                     <div class="form-group col-md-3">
                            <label for="dewey_decimal">Dewey Decimal Classificetion</label>
                            <input type="text" class="form-control" id="resource_ddc" name="resource_ddc" value="{{old('resource_ddc')}}" placeholder="DDC:">
                            <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>
                    
                    <!-- -------------------------------------------- -->
                </div>
                <hr>
                <div class="form-row">
                
                    <div class="form-group col-md-3">
                        <label for="purchase_date" >Purchase Date</label>
                        <input class="form-control" type="date" name="resource_purchase_date" value="{{old('resource_purchase_date')}}" id="resource_purchase_date"required>
                        <span class="text-danger">{{ $errors->first('purchase_date') }}</span>
                    </div>

                     <div class="form-group col-md-3">
                        <label for="price">Price</label>
                        <input type="value" class="form-control" name="resource_price"  value="{{old('resource_price')}}" placeholder="resource_price:"required>
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    </div>

                   <div class="form-group col-md-3">
                        <label for="edition">Edition</label>
                        <select class="form-control" id="resource_edition" name="resource_edition">
                        <option value="" selected disabled hidden>Choose here</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        </select>
                    </div>

                     <div class="form-group col-md-3">
                        <label for="publishyear">Publication year</label>
                        <input class="form-control" type="year" name="resource_publishyear"value="{{old('resource_publishyear')}}" id="resource_publishyear">
                        <span class="text-danger">{{ $errors->first('publishyear') }}</span>
                    </div>
                  
                </div>
                 <hr>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="phy_details">Physical Details</label>
                        <input type="text" class="form-control" name="resource_phydetails" id="resource_phydetails" value="{{old('resource_phydetails')}}" placeholder="Physical Details">
                        <span class="text-danger">{{ $errors->first('phydetails') }}</span>
                    </div>
                    <!-- ------------------------ -->
                    <div class="form-group col-md-9">
                        <label for="note">Note</label>
                        <textarea class="form-control mb-1" id="resource_note_si" name="resource_note_si" placeholder="Note in Sinhala" value="{{old('resource_note_si')}}" rows="1"></textarea>
                        <textarea class="form-control mb-1" id="resource_note_ta" name="resource_note_ta" placeholder="Note in Tamil" value="{{old('resource_note_ta')}}" rows="1"></textarea>
                        <textarea class="form-control mb-1" id="resource_note_en" name="resource_note_en" placeholder="Note in English" value="{{old('resource_note_en')}}" rows="1"></textarea>
                        <span class="text-danger">{{ $errors->first('note') }}</span>
                    </div>
                </div>

                <hr>
                <div class="form-row border border-secondary bg-light">
                   <div class="form-group col-md-12 col-12 p-2 mt-2">
                    <label for="note">Resource Center:</label>
                        <select class="form-control form-control-sm"name="resource_center" id="resource_center">
                                @foreach($center_data as $item)
                                    <option value="{{ $item->center_id }}">{{ $item->center->$center}}</option>
                                @endforeach
                        </select> 
                    </div>
               </div>
               <hr>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="check_place" name="check_place">
                    <label class="form-check-label" for="check_place">Set Resource Placement Later</label>
                </div>
                <div class="form-row border border-secondary bg-light" id="resoure_placement_div">
               
                    <!-- -------------------------------------------- -->
                    <div class="form-group col">
                            <label for="place_rack">Rack/Coupboard</label>
                            <select class="form-control" id="place_rack" name="place_rack" value="{{old('place_rack')}}"required>
                            <option value="" selected disabled hidden>Choose Rack/Coupboard</option>
                            @foreach($rdata as $item)
                                    <option value="{{ $item->id }}">{{ $item->$rack}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('place_rack') }}</span>
                    </div>

                    <!-- -------------------------------------------- -->
                    <div class="form-group col">
                            <label for="place_floor">Floor &nbsp;<span id="loader_floor" style="display:none"><i class="fa fa-spinner fa-spin"></i></span></label>
                            <div class="input-group">
                                <select class="form-control" id="place_floor" name="place_floor" value="{{old('place_floor')}}"required>
                                <option value="" selected disabled hidden>Choose Floor</option>
                                </select>
                            </div>
                            <span class="text-danger">{{ $errors->first('place_floor') }}</span>
                    </div>

                     <!-- -------------------------------------------- -->
                     <div class="form-group col-md-3">
                            <label for="place_index">Placement Index</label>
                            <input type="text" class="form-control" id="place_index" name="place_index" value="{{old('place_index')}}" placeholder="Placement index" required>
                            <span class="text-danger">{{ $errors->first('place_index') }}</span>
                    </div>
                    
                    <!-- -------------------------------------------- -->
                </div>
                <hr>

            <div class="box-footer clearfix pull-right">
                <button type="button" class="btn btn-sm btn-secondary" id="reset_resource">
                <i class="fa fa-times"></i> Reset</button>
                &nbsp; &nbsp;
                <button type="submit" class="btn btn-sm btn-success" value="Save" id="save_resource" >
                <i class="fa fa-floppy-o"></i> Save</button>
            </div>   
            </form>
                        
        </div> 
        </div>        
    </div>
</div>

<!-- -------------------------import-------------------------------- -->
<div class="modal fade" id="data_import" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Import Resources</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" method="POST" enctype="multipart/form-data" action="{{ route('import_resource') }}"class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="modal-body">

                <div class="custom-file form-group text-center m-3">
                    <div class="col-md-10">
                        <input type="file" class="form-control-file custom-file-input" id="file" name="file" required>
                        <label class="custom-file-label " for="customFile">Choose Excel file</label>
                    </div>
                    <div class="col-md-2">
                    @can('code-import')
                    @endcan
                </div>
            </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> &nbsp; Import Data</button>
                </div>
            </form>
           
        </div>
    </div>
</div>

<!-- -------------------------end import---------------------------------------------------- -->
@include('resources.create_creator_modal')
@include('modal.create_by_modal')
<br>
@endsection

@section('script')
<script>
$("#book_aNo").change(function(){
    $("#code_view_bq").html("");
    var assenNO = $("#book_aNo").val();
    $("#code_view_bq").html(' <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('code-js', 'C128',1,60,array(0,0,0), true)}}" alt="barcode" />');
   
  });

  $(document).ready(function()
    {
        
        @if($locale=="si")
        $("#resource_title_si").prop('required',true);
        @elseif($locale=="ta")
        $("#resource_title_ta").prop('required',true);
        @elseif($locale=="en")
        $("#resource_title_en").prop('required',true);
        @endif

        $('#resource_creator').select2({
        theme: 'bootstrap4',
        });

        $('#creator_create').on('show.bs.modal', function (event) {
       
            @if($locale=="si")
                $("#name_si").prop('required',true);
            @elseif($locale=="ta")
                $("#name_ta").prop('required',true);
            @elseif($locale=="en")
                $("#name_en").prop('required',true);
            @endif
        });

        $('#create_by_modal').on('show.bs.modal', function (event) {
       
            @if($locale=="si")
            $(this).find("#name_si").prop('required',true);
            @elseif($locale=="ta")
            $(this).find("#name_ta").prop('required',true);
            @elseif($locale=="en")
            $(this).find("#name_en").prop('required',true);
            @endif
        });

    });

// -------------------------save resource----------------------------------
$('#resource_save').on('submit', function(event){
    event.preventDefault();
    var formData = new FormData(this);
    $.ajax
       ({
            type: "POST",
            dataType : 'json',
            url: "{{ route('resource.store') }}", 
            data: formData,
            contentType: false,
            cache: false,
            processData: false,

           beforeSend: function(){
            //    $("#loader").show();
           },

           success:function(data){
                toastr.success('Resource Created Successfully')
                $("#resource_save").trigger("reset");
                $("#resource_save").removeClass( "was-validated" ).addClass( "needs-validation" );
                $("#resource_creator").val('');
                // $('#resource_creator option').prop('selected', function(){
                // return this.defaultSelected;
                // }).prop('disabled', false);
           },
           error:function(data){
               toastr.error('Resource Created faild Plese try again')
           },
           complete:function(data){
            //    $("#loader").hide();
           }
       })
       
});
//--------------------------end resource Save--------------------------

//--------------------------creator create-----------------------------
$('#creator_form').on('submit', function(event){
    event.preventDefault();
    var formData = new FormData(this);
    var op='';
    $.ajax
        ({
        type: "POST",
        dataType : 'json',
        url: "{{route('resource_creator.store')}}", 
        data: $('#creator_form').serialize(),
        cache: false,
        processData: true,
        beforeSend: function(){
                    $("#loader_creator_save").show();
        },
        success:function(data){
            toastr.info('Creator Added Successfully')
            for(var i=0;i<data.data.length;i++)
            {
                op+='<option value="'+data.data[i].id+'">'+ 
                    @if($locale=="si") data.data[i].name_si
                    @elseif($locale=="ta") data.data[i].name_ta
                    @elseif($locale=="en") data.data[i].name_en
                    @endif +
                    '</option>';
            }
            $('#resource_creator')
            .empty()
            .append(op)
            .val(data.dataid);
            $("#creator_form").trigger("reset");
            $('#creator_create').modal('hide');
        },
        error:function(data){
            toastr.error('Creator Add faild Plese try again')
        },
        complete:function(data){
                    $("#loader_creator_save").hide();
        }
    })

});


$('#btn_newpublisher').on('click', function() {
    $("#modal_feild").html("Publisher")
    $("#modal_route").val("{{route('resource_publisher.store')}}")
    $("#inputname").val("#resource_publisher")
    $("#create_by_modal").modal('show');
});


$('#btn_newlanguage').on('click', function() {
    $("#modal_feild").html("Language")
    $("#modal_route").val("{{route('resource_language.store')}}")
    $("#inputname").val("#resource_language")
    $("#create_by_modal").modal('show');
});


//--------------------------Quick create-----------------------------
$('#modal_form').on('submit', function(event){
    event.preventDefault();
    var formData = new FormData(this);
    var op='';
    $.ajax
        ({
        type: "POST",
        dataType : 'json',
        url: $("#modal_route").val(), 
        data: $('#modal_form').serialize(),
        cache: false,
        processData: true,

        success:function(data){
            toastr.info('Detail Added Successfully')
            for(var i=0;i<data.data.length;i++)
            {
                op+='<option value="'+data.data[i].id+'">'+ 
                    @if($locale=="si") data.data[i].name_si
                    @elseif($locale=="ta") data.data[i].name_ta
                    @elseif($locale=="en") data.data[i].name_en
                    @endif +
                    '</option>';
            }
            $($("#inputname").val())
            .empty()
            .append(op)
            .val(data.dataid);
            $("#modal_form").trigger("reset");
            $('#create_by_modal').modal('hide');
        },
        error:function(data){
            toastr.error('Detail Add faild Plese try again')
        }
    })

});

$("#check_place").change(function(){
    // $("#resoure_placement_div").toggle();
    if($("#check_place").prop("checked") == true)
    {
        $("#place_rack").prop('required',false);
        $("#place_floor").prop('required',false);
        $("#place_index").prop('required',false);
        $("#resoure_placement_div").slideUp('slow');
    }
    else
    {
        $("#place_rack").prop('required',true);
        $("#place_floor").prop('required',true);
        $("#place_index").prop('required',true);
        $("#resoure_placement_div").slideDown('slow');
    }
   
  });

function load_floor(rack)
{
     var op_d="";
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('load_resource_floor')}}", 
            data: { rack: rack, },
            beforeSend: function(){
                    $("#loader_floor").show();
            },
            success:function(data){
                op_d+='<option value="" disabled selected hidden>Choose Floor</option>';
                for(var i=0;i<data.length;i++)
                {
                    op_d+='<option value="'+data[i].id+'">'+ 
                        @if($locale=="si") data[i].floor_si 
                        @elseif($locale=="ta") data[i].floor_ta 
                        @elseif($locale=="en") data[i].floor_en
                        @endif +
                        '</option>';
                }
                $("#place_floor").empty().append(op_d);
               
            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            },
            complete:function(data){
                    $("#loader_floor").hide();
            }
        })
        // --------------------------------------------------------
}

function load_type(cdta)
{
     var op_d="";
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('load_resource_type')}}", 
            data: { cdta: cdta, },
            beforeSend: function(){
                    $("#loader_type").show();
            },
            success:function(data){
                op_d+='<option value="" disabled selected hidden>Choose here</option>';
                for(var i=0;i<data.length;i++)
                {
                    op_d+='<option value="'+data[i].id+'">'+ 
                        @if($locale=="si") data[i].type_si 
                        @elseif($locale=="ta") data[i].type_ta 
                        @elseif($locale=="en") data[i].type_en
                        @endif +
                        '</option>';
                }
                $("#resoure_type").empty().append(op_d);
               
            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            },
            complete:function(data){
                    $("#loader_type").hide();
            }
        })
        // --------------------------------------------------------
}

function load_dd_devision(dd_class_id)
{
     var op_d="";
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('load_dd_devision')}}", 
            data: { dd_class_id: dd_class_id, },
            beforeSend: function(){
                    $("#loader_dd_devision").show();
            },
            success:function(data){
                op_d+='<option value="" disabled selected hidden>Choose here</option>';
                for(var i=0;i<data.length;i++)
                {
                    op_d+='<option value="'+data[i].id+'">'+ 
                        @if($locale=="si")  data[i].devision_code+'-'+ data[i].devision_si 
                        @elseif($locale=="ta") data[i].devision_code+'-'+data[i].devision_ta 
                        @elseif($locale=="en") data[i].devision_code+'-'+data[i].devision_en
                        @endif +
                        '</option>';
                }
                $("#resource_dd_devision").empty().append(op_d);
               
            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            },
            complete:function(data){
                    $("#loader_dd_devision").hide();
            }
        })
        // --------------------------------------------------------
}

function load_dd_section(dd_devision_id)
{
     var op_d="";
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax
        ({
            type: "POST",
            dataType : 'json',
            url: "{{route('load_dd_section')}}", 
            data: { dd_devision_id: dd_devision_id, },
            beforeSend: function(){
                    $("#loader_dd_section").show();
            },
            success:function(data){
                op_d+='<option value="" disabled selected hidden>Choose here</option>';
                for(var i=0;i<data.length;i++)
                {
                    op_d+='<option value="'+data[i].id+'">'+ 
                        @if($locale=="si")  data[i].section_code+'-'+ data[i].section_si 
                        @elseif($locale=="ta") data[i].section_code+'-'+data[i].section_ta 
                        @elseif($locale=="en") data[i].section_code+'-'+data[i].section_en
                        @endif +
                        '</option>';
                }
                $("#resource_dd_section").empty().append(op_d);
               
            },
            error:function(data){
                toastr.error('Some thing went Wrong!')
            },
            complete:function(data){
                    $("#loader_dd_section").hide();
            }
        })
        // --------------------------------------------------------
}
$("#resoure_category").change(function () {
    var r_cat=$('#resoure_category').val();
    load_type(r_cat);
});

$("#place_rack").change(function () {
    var r_rack=$('#place_rack').val();
    load_floor(r_rack);
});

$("#resource_dd_class").change(function () {
    var dd_class_id=$('#resource_dd_class').val();
    load_dd_devision(dd_class_id);
    var op ='<option value="" disabled selected hidden>Choose here</option>';
    $("#resource_dd_section").empty().append(op);

});

$("#resource_dd_devision").change(function () {
    var dd_devision_id=$('#resource_dd_devision').val();
    load_dd_section(dd_devision_id);
});

</script>


@endsection

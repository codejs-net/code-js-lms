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
$center="name".$lang;

@endphp


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Resources&nbsp;</a></li>
    <li class="breadcrumb-item active" ><a><i class="fa fa-pencil"></i> Update Resources&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h5> <i class="fa fa-pencil"> {{__("Update Resources")}}</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right">
        </div>
    </div>
    
</div>

        <!-- Main content -->
<div class="container">
    <div class="card card-body">
         <div class="row">
         <div class="col-md-12">
                <!-- --------------------------- section 1------------------------------------- -->
    
                <form action="{{route('update_resource')}}" enctype="multipart/form-data" method="POST" name="resource_save" id="resource_save" class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <input type="hidden" name="resource_id" id="resource_id">
                
                <div class="form-row border border-secondary bg-light">
                    <div class="col-md-2 col-12 mt-2 pl-2">
                        <img src="" class="img-resource1 elevation-3" id="avater_update">
                    </div>
                    <div class="col-md-10 col-12">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="image">Resource Image</label>
                                <div class="col-md-11 col-12"><input type="file" id="image_update" name="image_update" class="form-control-file bg-white p-1 elevation-1"></div>
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
                                <button type="button" class="btn btn-outline-success btn-sm elevation-1" data-toggle="modal" data-target="#addModal"  data-backdrop="static" data-opp_name="Book Category" onclick="add_by_modal('/save_Book_category')"><i class="fa fa-plus"></i></button>
        
                            </div>
        
                            <div class="form-group col-md-5">
                                <label for="language">Type</label>
                                <select class="form-control elevation-1" id="resoure_type" name="resoure_type" value="{{old('resoure_type')}}"required>
                                <option value="" selected disabled hidden>Choose here</option>
                                @foreach($type_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->$type }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('language') }}</span>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="new_language">&nbsp;</label></br>
                                <button type="button" class="btn btn-outline-success btn-sm elevation-1" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Book Language" onclick="add_by_modal('/save_Book_language')"><i class="fa fa-plus"></i></button>
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
                        <input type="text" class="form-control" id="resoure_accession" name="resoure_accession" value="{{old('accessionNo')}}" placeholder="Accession Number:" required>
                        <span class="text-danger" >{{ $errors->first('accessionNo') }}</span>
                    </div>
                    
                </div>
                <hr>
                    
                <div class="form-row">
                    
                    <div class="form-group col-md-12">
                        <label for="book_title">Title</label>
                        <input type="text" class="form-control mb-1" id="resource_title_si" name="resource_title_si" value="{{old('title_si')}}" placeholder="Title in sinhala" >
                        <input type="text" class="form-control mb-1" id="resource_title_ta" name="resource_title_ta" value="{{old('title_ta')}}" placeholder="Title in Tamil" >
                        <input type="text" class="form-control mb-1" id="resource_title_en" name="resource_title_en" value="{{old('title_en')}}" placeholder="Title in English" >
                        <span class="text-danger">{{ $errors->first('resource_title_en') }}</span>
                    </div>
                    <div class="form-group col-md-11">
                        <label for="authors">Creator</label>
                            <select class="form-control" id="resource_creator" name="resource_creator" value="{{old('resource_creator')}}"required>
                                <option value="" selected disabled hidden>Choose here</option>
                                @foreach($creator_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->$creator}}</option>
                                @endforeach
                            </select>
                        <span class="text-danger">{{ $errors->first('authors') }}</span>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="new_category">&nbsp;</label>  </br>
                        <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addModal"  data-backdrop="static" data-opp_name="Book Category"
                        onclick="add_by_modal('/save_Book_category')"><i class="fa fa-plus"></i></button>
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
                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Book Publisher"
                    onclick="add_by_modal('/save_Book_publisher')"><i class="fa fa-plus"></i></button>

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
                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Book Language"
                    onclick="add_by_modal('/save_Book_language')"><i class="fa fa-plus"></i></button>

                    </div>
                    
                </div>
                <hr>
                <div class="form-row border border-secondary bg-light">
                    <!-- -------------------------------------------- -->
                    <div class="form-group col-md-3">
                            <label for="dewey_decimal">Dewey Decimal Class</label>
                            <select class="form-control" id="resource_dd_class" name="resource_dd_class" value="{{old('resource_dd_class')}}"required>
                            <option value="" selected disabled hidden>Choose here</option>
                            @foreach($dd_class_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->$dd_class}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>

                    <!-- -------------------------------------------- -->
                    <div class="form-group col-md-3">
                            <label for="dewey_decimal">Dewey Decimal Devision</label>
                            <select class="form-control" id="resource_dd_devision" name="resource_dd_devision" value="{{old('resource_dd_devision')}}"required>
                            <option value="" selected disabled hidden>Choose here</option>
                            @foreach($dd_devision_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->$dd_devision}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>

                    <!-- -------------------------------------------- -->
                    <div class="form-group col-md-3">
                            <label for="dewey_decimal">Dewey Decimal Section</label>
                            <select class="form-control" id="resource_dd_section" name="resource_dd_section" value="{{old('resource_dd_section')}}"required>
                            <option value="" selected disabled hidden>Choose here</option>
                            @foreach($dd_section_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->section_code}}-{{ $item->$dd_section}}</option>
                                @endforeach
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
                <div class="form-row mt-4">
                
                    <div class="form-group col-md-3">
                        <label for="purchase_date" >Purchase Date</label>
                        <input class="form-control" type="date" name="resource_purchase_date" value="{{old('resource_purchase_date')}}" id="resource_purchase_date"required>
                        <span class="text-danger">{{ $errors->first('purchase_date') }}</span>
                    </div>

                     <div class="form-group col-md-3">
                        <label for="price">Price</label>
                        <input type="value" class="form-control" name="resource_price" id="resource_price"  value="{{old('resource_price')}}" placeholder="resource_price:"required>
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
                        <textarea class="form-control mb-1" id="resource_note_si" name="resource_note_si" placeholder="Note in Sinhala" value="{{old('resource_note_si')}}" rows="2"></textarea>
                        <textarea class="form-control mb-1" id="resource_note_ta" name="resource_note_ta" placeholder="Note in Tamil" value="{{old('resource_note_ta')}}" rows="2"></textarea>
                        <textarea class="form-control mb-1" id="resource_note_en" name="resource_note_en" placeholder="Note in English" value="{{old('resource_note_en')}}" rows="2"></textarea>
                        <span class="text-danger">{{ $errors->first('note') }}</span>
                    </div>
                </div>
                <hr>
                <div class="form-row border border-secondary bg-light">
                    <div class="form-group col-md-3 col-3 p-2 mt-2">
                        <label for="status">Change Status</label><br>
                       <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1">Active
                            </label> &nbsp;
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="0">Remove
                            </label> &nbsp;
                       </div>
                       <span class="text-danger">{{ $errors->first('status') }}</span>
                   </div>
                   <div class="form-group col-md-9 col-9 p-2 mt-2">
                    <label for="note">Center:</label>
                        <select class="form-control form-control-sm mb-3"name="resource_center" id="resource_center" value="">
                                @foreach($center_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->$center}}</option>
                                @endforeach
                        </select> 
                    </div>
               </div>

               <hr>
            <div class="box-footer clearfix pull-right">
                <button type="button" class="btn btn-md btn-warning  elevation-2" id="reset_resource">
                <i class="fa fa-times"></i> Reset</button>
                &nbsp; &nbsp;
                <button type="submit" class="btn btn-md btn-success elevation-2" value="Save" id="update_resource" >
                <i class="fa fa-floppy-o"></i> Save</button>
            </div>   
            </form>
                        
        </div> 
        </div>        
    </div>
</div>


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
        // alert("{{$resouredata->image}}");
        $("#avater_update").attr('src','/images/resources/{{$resouredata->image}}');
        $('#resource_id').val("{{$resouredata->id}}");
        $('#resoure_category').val("{{$resouredata->category_id}}");
        $('#resoure_type').val("{{$resouredata->type_id}}");
        $('#resoure_isn').val("{{$resouredata->standard_number}}");
        $('#resoure_accession').val("{{$resouredata->accessionNo}}");
        $('#resource_title_si').val("{{$resouredata->title_si}}");
        $('#resource_title_ta').val("{{$resouredata->title_ta}}");
        $('#resource_title_en').val("{{$resouredata->title_en}}");
        $('#resource_creator').val("{{$resouredata->cretor_id}}");
        $('#resource_publisher').val("{{$resouredata->publisher_id}}");
        $('#resource_language').val("{{$resouredata->language_id}}");
        $('#resource_dd_class').val("{{$resouredata->dd_class_id}}");
        $('#resource_dd_devision').val("{{$resouredata->dd_devision_id}}");
        $('#resource_dd_section').val("{{$resouredata->dd_section_id}}");
        $('#resource_ddc').val("{{$resouredata->ddc}}");
        $('input:radio[name="status"]').filter('[value="{{$resouredata->status}}"]').attr('checked', true);
        $('#resource_purchase_date').val("{{$resouredata->purchase_date}}");
        $('#resource_price').val("{{$resouredata->price}}");
        $('#resource_edition').val("{{$resouredata->edition}}");
        $('#resource_publishyear').val("{{$resouredata->publishyear}}");
        $('#resource_phydetails').val("{{$resouredata->phydetails}}");
        $('#resource_note_si').val("{{$resouredata->note_si}}");
        $('#resource_note_ta').val("{{$resouredata->note_ta}}");
        $('#resource_note_en').val("{{$resouredata->note_en}}");
        $('#resource_center').val("{{$resouredata->center_id}}");


    });

// -------------------------save resource----------------------------------
// $("#update_resource").click(function () {
   
//    $.ajax
//        ({
//            type: "POST",
//            dataType : 'json',
//            url: "{{ route('resource.store') }}", 
//            data: $('#resource_save').serialize(),

//            beforeSend: function(){
//             //    $("#loader").show();
//            },

//            success:function(data){
//                toastr.success('Resource Created Successfully')
//                $("#resource_save").trigger("reset");
//            },
//            error:function(data){
//                toastr.error('Resource Created faild Plese try again')
//            },
//            complete:function(data){
//             //    $("#loader").hide();
//            }
//        })
       
// });
//--------------------------end resource Save-----------------------------

</script>


@endsection

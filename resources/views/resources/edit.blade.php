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
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> {{__('Resources')}}&nbsp;</a></li>
    <li class="breadcrumb-item active" ><a><i class="fa fa-pencil"></i> {{__('Update')}} Resources&nbsp;</a></li>
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
                                <label for="image">{{__('Resource Image')}}</label>
                                <div class="col-md-11 col-12"><input type="file" id="image_update" name="image_update" class="form-control-file bg-white p-1 elevation-1"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="book_category" class="">{{__('Category')}}</label>
                                <select class="form-control elevation-1" id="resoure_category" name="resoure_category" value="{{old('resoure_category')}}"required>
                                <option value="" selected disabled hidden>{{__('Choose here')}}</option>
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
                                <label for="language">{{__('Type')}} &nbsp;
                                    <span id="loader_type" style="display:none"><i class="fa fa-spinner fa-spin fa-md"></i></span>
                                </label>
                                <div class="input-group">
                                    <select class="form-control elevation-1" id="resoure_type" name="resoure_type" value="{{old('resoure_type')}}"required>
                                    <option value="" selected disabled hidden>{{__('Choose here')}}</option>
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
                    <label for="isbn">{{__('ISBN/ISSN/ISMN')}}</label>
                        <input type="text" class="form-control" id="resoure_isn" name="resoure_isn"  value="{{old('resoure_isn')}}"  placeholder="{{__('ISBN/ISSN/ISMN')}}">
                        <span class="text-danger">{{ $errors->first('isbn') }}</span>
                    </div>
                   

                    <div class="form-group col-md-6">
                       
                        <label for="accessionNo">{{__('Accession Number')}}</label>
                        <input type="text" class="form-control" id="resoure_accession" name="resoure_accession" value="{{old('resoure_accession')}}" placeholder="{{__('Accession Number')}}:" required>
                        <span class="text-danger" >{{ $errors->first('accessionNo') }}</span>
                    </div>
                    
                </div>
                <hr>
                    
                <div class="form-row">
                    
                    <div class="form-group col-md-12">
                        <label for="book_title">{{__('ResourceTitle')}}</label>
                        <input type="text" class="form-control mb-1" id="resource_title_si" name="resource_title_si" value="{{old('book_title_si')}}" placeholder="{{__('Title in sinhala')}}" >
                        <input type="text" class="form-control mb-1" id="resource_title_ta" name="resource_title_ta" value="{{old('book_title_ta')}}" placeholder="{{__('Title in Tamil')}}" >
                        <input type="text" class="form-control mb-1" id="resource_title_en" name="resource_title_en" value="{{old('book_title_en')}}" placeholder="{{__('Title in English')}}" >
                        <span class="text-danger">{{ $errors->first('book_title') }}</span>
                    </div>
                    <div class="form-group col-md-11">
                        <label for="authors">{{__('Creator')}}</label>
                            <select class="form-control" id="resource_creator" name="resource_creator" value="{{old('resource_creator')}}">
                                <option value="" selected disabled>Choose here</option>
                            </select>
                        <span class="text-danger" id="error_creator">{{ $errors->first('authors') }}</span>
                    </div>
                    <div class="form-group col-md-1">
                        <label>&nbsp;</label></br>
                        <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#creator_create"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row ml-2">
                    <input type="hidden" name="creator1" id="creator1">
                    <input type="hidden" name="creator2" id="creator2">
                    <input type="hidden" name="creator3" id="creator3">
                    <input type="hidden" name="creator_more" id="creator_more">
                    <span id="crlist"></span>
                </div>
                <hr>
                <div class="form-row">

                <div class="form-group col-md-5">
                        <label for="publisher">{{__('Publisher')}}</label>
                        <select class="form-control" id="resource_publisher" name="resource_publisher" value="{{old('resource_publisher')}}"required>
                        <option value="" selected disabled hidden>{{__('Choose here')}}</option>
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
                        <label for="language">{{__('Language')}}</label>
                        <select class="form-control" id="resource_language" name="resource_language" value="{{old('resource_language')}}"required>
                        <option value="" selected disabled hidden>{{__('Choose here')}}</option>
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
                            <label for="dewey_decimal">{{__('Dewey Decimal Class')}}</label>
                            <select class="form-control" id="resource_dd_class" name="resource_dd_class" value="{{old('resource_dd_class')}}">
                            <option value="" selected disabled hidden>{{__('Choose here')}}</option>
                            @foreach($dd_class_data as $item)
                                <option value="{{ $item->id }}">{{ $item->class_code}}-{{ $item->$dd_class}}</option>
                            @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>

                    <!-- -------------------------------------------- -->
                    <div class="form-group col-md-3">
                            <label for="dewey_decimal">{{__('Dewey Decimal Devision')}} &nbsp;
                                <span id="loader_dd_devision" style="display:none"><i class="fa fa-spinner fa-spin fa-md"></i></span>
                            </label>
                            <select class="form-control" id="resource_dd_devision" name="resource_dd_devision" value="{{old('resource_dd_devision')}}">
                            <option value="" selected disabled hidden>{{__('Choose here')}}</option>
                            </select>
                            <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>

                    <!-- -------------------------------------------- -->
                    <div class="form-group col-md-3">
                            <label for="dewey_decimal">{{__('Dewey Decimal Section')}} &nbsp;
                                <span id="loader_dd_section" style="display:none"><i class="fa fa-spinner fa-spin fa-md"></i></span>
                            </label>
                            <select class="form-control" id="resource_dd_section" name="resource_dd_section" value="{{old('resource_dd_section')}}">
                            <option value="" selected disabled hidden>{{__('Choose here')}}</option>
                            </select>
                            <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>

                     <!-- -------------------------------------------- -->
                     <div class="form-group col-md-3">
                            <label for="dewey_decimal">{{__('Dewey Decimal Classificetion')}}</label>
                            <input type="text" class="form-control" id="resource_ddc" name="resource_ddc" value="{{old('resource_ddc')}}" placeholder="{{__('DDC')}}:">
                            <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>
                    
                    <!-- -------------------------------------------- -->
                </div>
                <hr>
                <div class="form-row">
                
                    <div class="form-group col-md-3">
                        <label for="purchase_date" >{{__('Purchase Date')}}</label>
                        <input class="form-control" type="date" name="resource_purchase_date" value="{{old('resource_purchase_date')}}" id="resource_purchase_date"required>
                        <span class="text-danger">{{ $errors->first('purchase_date') }}</span>
                    </div>

                     <div class="form-group col-md-3">
                        <label for="price">{{__('Price')}}</label>
                        <input type="value" class="form-control" name="resource_price" id="resource_price"  value="{{old('resource_price')}}" placeholder="{{__('resource')}}_price:"required>
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    </div>

                   <div class="form-group col-md-3">
                        <label for="edition">{{__('Edition')}}</label>
                        <select class="form-control" id="resource_edition" name="resource_edition">
                        <option value="" selected disabled hidden>{{__('Choose here')}}</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        </select>
                    </div>

                     <div class="form-group col-md-3">
                        <label for="publishyear">{{__('Publication year')}}</label>
                        <input class="form-control" type="year" name="resource_publishyear"value="{{old('resource_publishyear')}}" id="resource_publishyear">
                        <span class="text-danger">{{ $errors->first('publishyear') }}</span>
                    </div>
                  
                </div>
                 <hr>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="phy_details">{{__('Physical Details')}}</label>
                        <input type="text" class="form-control" name="resource_phydetails" id="resource_phydetails" value="{{old('resource_phydetails')}}" placeholder="{{__('Physical')}} Details">
                        <span class="text-danger">{{ $errors->first('phydetails') }}</span>
                    </div>
                    <!-- ------------------------ -->
                    <div class="form-group col-md-9">
                        <label for="note">{{__('Note')}}</label>
                        <textarea class="form-control mb-1" id="resource_note_si" name="resource_note_si" placeholder="{{__('Note in Sinhala')}}" value="{{old('resource_note_si')}}" rows="1"></textarea>
                        <textarea class="form-control mb-1" id="resource_note_ta" name="resource_note_ta" placeholder="{{__('Note in Tamil')}}" value="{{old('resource_note_ta')}}" rows="1"></textarea>
                        <textarea class="form-control mb-1" id="resource_note_en" name="resource_note_en" placeholder="{{__('Note in English')}}" value="{{old('resource_note_en')}}" rows="1"></textarea>
                        <span class="text-danger">{{ $errors->first('note') }}</span>
                    </div>
                </div>
               <hr>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="check_place" name="check_place">
                    <label class="form-check-label" for="check_place">{{__('Set Resource Placement Late')}}r</label>
                </div>
                <div class="form-row border border-secondary bg-light" id="resoure_placement_div">
               
                    <!-- -------------------------------------------- -->
                    <div class="form-group col">
                            <label for="place_rack">{{__('Rack/Coupboard')}}</label>
                            <select class="form-control" id="place_rack" name="place_rack" value="{{old('place_rack')}}"required>
                            <option value="" selected disabled hidden>{{__('Choose Rack/Coupboard')}}</option>
                            @foreach($rdata as $item)
                                <option value="{{ $item->id }}">{{ $item->$rack}}</option>
                            @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('place_rack') }}</span>
                    </div>

                    <!-- -------------------------------------------- -->
                    <div class="form-group col">
                            <label for="place_floor">{{__('Floor')}} &nbsp;<span id="loader_floor" style="display:none"><i class="fa fa-spinner fa-spin"></i></span></label>
                            <div class="input-group">
                                <select class="form-control" id="place_floor" name="place_floor" value="{{old('place_floor')}}"required>
                                <option value="" selected disabled hidden>{{__('Choose Floor')}}</option>
                                </select>
                            </div>
                            <span class="text-danger">{{ $errors->first('place_floor') }}</span>
                    </div>

                     <!-- -------------------------------------------- -->
                     <div class="form-group col-md-3">
                            <label for="place_index">{{__('Placement Index')}}</label>
                            <input type="text" class="form-control" id="place_index" name="place_index" value="{{old('place_index')}}" placeholder="Placement index" required>
                            <span class="text-danger">{{ $errors->first('place_index') }}</span>
                    </div>
                    
                    <!-- -------------------------------------------- -->
                </div>
                <hr>

                <div class="form-row border border-secondary bg-light">
                    <div class="form-group col-md-3 col-3 p-2 mt-2">
                        <label for="status">{{__('Change Status')}}</label><br>
                       <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1">{{__('Active')}}
                            </label> &nbsp;
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="0">{{__('Remove')}}
                            </label> &nbsp;
                       </div>
                       <span class="text-danger">{{ $errors->first('status') }}</span>
                   </div>
                   <div class="form-group col-md-9 col-9 p-2 mt-2">
                    <label for="note">{{__('Center')}}:</label>
                        <select class="form-control form-control-sm mb-3"name="resource_center" id="resource_center" value="">
                                @foreach($center_data as $item)
                                    <option value="{{ $item->center_id }}">{{ $item->center->$center}}</option>
                                @endforeach
                        </select> 
                    </div>
               </div>

               <hr>
            <div class="box-footer clearfix pull-right">
                <button type="button" class="btn btn-sm btn-secondary  elevation-2" id="reset_resource">
                <i class="fa fa-times"></i> {{__('Reset')}}</button>
                &nbsp; &nbsp;
                <button type="submit" class="btn btn-sm btn-success elevation-2" value="Save" id="update_resource" >
                <i class="fa fa-floppy-o"></i> {{__('Update')}}</button>
            </div>   
            </form>
                        
        </div> 
        
        </div>        
    </div>
</div>

@include('resources.create_creator_modal')
@include('modal.create_by_modal')
<br>
@endsection

@section('script')
<script>

var creator_list=[];
function creator_select2()
  {
    $("#resource_creator").select2({
        theme: 'bootstrap4',
        placeholder: 'search',

        ajax: {
            url: "{{route('load_creator')}}",
            type: "get",
            dataType: 'json',
            data: function (params) {
                return {
                    term: params.term,
                    page: params.page || 1,
                };
            },
            processResults: function(data, params) {
                return {
                results: data.results,
                pagination: { 
                    more: true
                    }
                };
            }, 
            cache: true,           
            },
        });

    }

$(document).ready(function()
{
    creator_select2();

    $('#resoure_category').val("{{$resouredata->category_id}}");
    $('#resource_dd_class').val("{{$resouredata->dd_class_id}}");

    load_type($('#resoure_category').val(),false);

    load_dd_devision($('#resource_dd_class').val(),false);
    $('#resource_dd_devision').val("{{$resouredata->dd_devision_id}}");
    
    load_dd_section($('#resource_dd_devision').val(),false);
    $('#resource_dd_section').val("{{$resouredata->dd_section_id}}");

    @if(!empty($place_data))
    $('#place_rack').val("{{$place_data->rack_id}}");
    load_floor($('#place_rack').val(),false);
    $('#place_floor').val("{{$place_data->floor_id}}");
    $('#place_index').val("{{$place_data->placement_index}}");
    @endif

    $("#avater_update").attr("src","{{asset('images/resources/'.$resouredata->image)}}");
    $('#resource_id').val("{{$resouredata->id}}");
    $('#resoure_type').val("{{$resouredata->type_id}}");
    $('#resoure_isn').val("{{$resouredata->standard_number}}");
    $('#resoure_accession').val("{{$resouredata->accessionNo}}");
    $('#resource_title_si').val("{{$resouredata->title_si}}");
    $('#resource_title_ta').val("{{$resouredata->title_ta}}");
    $('#resource_title_en').val("{{$resouredata->title_en}}");

    $('#creator1').val("{{$resouredata->cretor_id}}");
    $('#creator2').val("{{$resouredata->cretor2_id}}");
    $('#creator3').val("{{$resouredata->cretor3_id}}");
    $('#resource_creator').val("{{$resouredata->cretor_id}}").trigger('change');

    $('#resource_publisher').val("{{$resouredata->publisher_id}}");
    $('#resource_language').val("{{$resouredata->language_id}}");
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

    var cdata = @json($creator_data);
    var cdata_more = @json($resouredata->cretor_more);
    cdata_length=cdata.length;
    for (i = 0; i < cdata_length; i++)
    {
        cid=cdata[i].id;
        cname=cdata[i].text;
        select_creator(cid.toString(),cname.toString());   
    }
    
    if(cdata_more=="1"){
        var op='';
        var cid='more';
        op+='<span class="badge badge-pill text-primary mx-1 select-list list-more">';
        op+= '{{trans("more...")}}';
        op+='<button type="button" class="close" value="'+cid+'"><span aria-hidden="true">&times;</span></button>';
        op+='</span>';
        $('#crlist').append(op);
        creator_list.push(cid);
        $('#resource_creator').val('').trigger('change');
        $('#resource_creator').prop('disabled', true);
    }
    

    @if($locale=="si")
    $("#resource_title_si").prop('required',true);
    @elseif($locale=="ta")
    $("#resource_title_ta").prop('required',true);
    @elseif($locale=="en")
    $("#resource_title_en").prop('required',true);
    @endif

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

    $('#resource_creator').on('select2:select', function (e) {
        var cid= $('#resource_creator :selected').val();
        var cname= $('#resource_creator :selected').text();
        select_creator(cid,cname);
    });

    $('#resource_creator').val(creator_list[creator_list.length-1]);
    $('#resource_creator').val(creator_list[creator_list.length-1]).trigger("change");
  
});

// $(window).on('load', function(){
//     console.log(creator_list);
   
//     $('#resource_creator').val(creator_list[creator_list.length-1]).trigger('change');
// });

$('#resource_save').on('submit', function(event){
    if(creator_list.length==0){
        event.preventDefault();
        toastr.warning("Select at least one Creator/Author");
        // $('#error_creator').html("Select at least one Creator/Author")
    }
    else{
        $('#creator1').val((creator_list[0])?creator_list[0]:null);
        $('#creator2').val((creator_list[1])?creator_list[1]:null);
        $('#creator3').val((creator_list[2])?creator_list[2]:null);
        $('#creator_more').val((creator_list[3])?1:0);
    }
   
  
});

function select_creator(cid,cname){
        var excist=false;
        var list_length=creator_list.length;
        if(list_length<3){
            for (i = 0; i < list_length; i++)
            {
                if(cid==creator_list[i]){excist=true;}
            }
            if(excist==false)
            {
                var op='';
                op+='<span class="badge badge-pill badge-primary mx-1 select-list">';
                op+= cname;
                op+='<button type="button" class="close" value="'+cid+'"><span aria-hidden="true">&times;</span></button>';
                op+='</span>';
                $('#crlist').append(op);
                creator_list.push(cid);
                // console.log(creator_list);
            }
        }
        else if(list_length>=3)
        {
            var op='';
            var cid='more';
            op+='<span class="badge badge-pill text-primary mx-1 select-list list-more">';
            op+= '{{trans("more...")}}';
            op+='<button type="button" class="close" value="'+cid+'"><span aria-hidden="true">&times;</span></button>';
            op+='</span>';
            $('#crlist').append(op);
            creator_list.push(cid);
            $('#resource_creator').val('').trigger('change');
            $('#resource_creator').prop('disabled', true);
        }
      
}

$(document).on("click", ".close", function()
{
    var cid= $(this).val();
    var more=false;
    var list_length=creator_list.length;
    for (i = 0; i < list_length; i++)
    {
        if('more'==creator_list[i])
        { 
            creator_list.splice( $.inArray('more', creator_list), 1 );
        }
    }

    for (i = 0; i < list_length; i++)
    {
        if(cid==creator_list[i])
        {
            creator_list.splice( $.inArray(cid, creator_list), 1 ); 
            
        }
    }
    $('#resource_creator').val(creator_list[creator_list.length-1]).trigger('change');
    $('#resource_creator').prop('disabled', false);
    
    $(this).closest('.select-list').fadeOut();
    $('.list-more').fadeOut();
});

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


function load_category()
{
    var op="";
    $.ajax
    ({
        type: "GET",
        url: "{{route('load_resource_category')}}", 
        async: false,
        success:function(data){
            op+='<option value="" disabled selected hidden>Choose here</option>';
            for(var i=0;i<data.length;i++)
            {
                op+='<option value="'+data[i].id+'">'+ 
                    @if($locale=="si") data[i].category_si 
                    @elseif($locale=="ta") data[i].category_ta 
                    @elseif($locale=="en") data[i].category_en
                    @endif +
                    '</option>';
            }
            $("#resoure_category").empty().append(op);
        },
        error:function(data){
        }
    })
}

function load_rack()
{
    var op="";
    $.ajax
    ({
        type: "GET",
        url: "{{route('load_resource_rack')}}", 
        async: false,
        success:function(data){
            op+='<option value="" disabled selected hidden>Choose here</option>';
            for(var i=0;i<data.length;i++)
            {
                op+='<option value="'+data[i].id+'">'+ 
                    @if($locale=="si") data[i].rack_si 
                    @elseif($locale=="ta") data[i].rack_ta 
                    @elseif($locale=="en") data[i].rack_en
                    @endif +
                    '</option>';
            }
            $("#place_rack").empty().append(op);
        },
        error:function(data){
        }
    })
}

function load_dd_class()
{
    var op="";
    $.ajax
    ({
        type: "GET",
        url: "{{route('load_dd_class')}}", 
        async: false,
        success:function(data){
            op+='<option value="" disabled selected hidden>Choose here</option>';
            for(var i=0;i<data.length;i++)
            {
                op+='<option value="'+data[i].id+'">'+ 
                    @if($locale=="si") data[i].class_code +'-'+data[i].class_si 
                    @elseif($locale=="ta") data[i].class_code +'-'+data[i].class_ta 
                    @elseif($locale=="en") data[i].class_code +'-'+data[i].class_en
                    @endif +
                    '</option>';
            }
            $("#resource_dd_class").empty().append(op);
        },
        error:function(data){
        }
    })
}


function load_floor(rack,async)
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
            async: async,
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

function load_type(cdta,async)
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
            async: async,
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

function load_dd_devision(dd_class_id,async)
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
            async: async,
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

function load_dd_section(dd_devision_id,async)
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
            async: async,
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
    load_type(r_cat,true);
});

$("#place_rack").change(function () {
    var r_rack=$('#place_rack').val();
    load_floor(r_rack,true);
});

$("#resource_dd_class").change(function () {
    var dd_class_id=$('#resource_dd_class').val();
    load_dd_devision(dd_class_id,true);
    var op ='<option value="" disabled selected hidden>Choose here</option>';
    $("#resource_dd_section").empty().append(op);

});

$("#resource_dd_devision").change(function () {
    var dd_devision_id=$('#resource_dd_devision').val();
    load_dd_section(dd_devision_id,true);
});


</script>


@endsection

@extends('layouts.app')


@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;
$publisher="publisher".$lang;
$medium="phymedia".$lang;
$language="language".$lang;
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
    <div class="row text-center">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h4> <i class="fa fa-plus-circle"> {{__("Add Resources")}}</i></h4>
        </div>  
        <div class="col-md-1 col-sm-6 text-right">
            <!-- <h4><button class="btn btn-info btn-md" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; New</button></h4>   -->
        </div>
    </div>
    
</div>

        <!-- Main content -->
<div class="container bg-white">
    <div class="card-body">
         <div class="row">
         <div class="col-md-12">
                <!-- --------------------------- section 1------------------------------------- -->
    
                <form action="{{ route('resource.store') }}" method="post" name="book_save" id="book_save" class="needs-validation"  novalidate>
                {{ csrf_field() }}
                <div class="form-row">

                    <div class="form-group col-md-6">
                    <label for="isbn">ISBN/ISSN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn"  value="{{old('isbn')}}"  placeholder="ISBN">
                        <span class="text-danger">{{ $errors->first('isbn') }}</span>
                    </div>
                    <div class="form-group col-md-2">
                        <div class="form-check-inline">
                            <label class="form-check-label"></label>
                                <!-- <input type="radio" class="form-check-input" name="br_qr_code" value="bar_code"> BarCode
                                <input type="radio" class="form-check-input" name="br_qr_code" value="qr_code"> QRCode -->
                                <!-- <button class="btn btn-primary"><i class="fa fa-circle-o">Genarete</i></button> -->

                        </div>
                        <div id="code_view_bq" class="form-group">
                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('code-js', 'C128',1,60,array(0,0,0), true)}}" alt="barcode" />
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                       
                        <label for="accessionNo">Accession Number</label>
                        <input type="text" class="form-control" id="book_aNo" name="accessionNo" value="{{old('accessionNo')}}" placeholder="Accession Number:" required>
                        <span class="text-danger" >{{ $errors->first('accessionNo') }}</span>
                    </div>

                </div>

                    
                <div class="form-row">
                    
                    <div class="form-group col-md-12">
                        <label for="book_title">Title</label>
                        <input type="text" class="form-control mb-1" id="book_title_si" name="book_title_si" value="{{old('book_title_si')}}" placeholder="Title in sinhala" >
                        <input type="text" class="form-control mb-1" id="book_title_ta" name="book_title_ta" value="{{old('book_title_ta')}}" placeholder="Title in Tamil" >
                        <input type="text" class="form-control mb-1" id="book_title_en" name="book_title_en" value="{{old('book_title_en')}}" placeholder="Title in English" >
                        <span class="text-danger">{{ $errors->first('book_title') }}</span>
                    </div>
                    <div class="form-group col-md-10">
                        <label for="authors">Creator</label>
                            <select class="form-control" id="book_category" name="book_category" value="{{old('category')}}"required>
                                <option value="" selected disabled hidden>Choose here</option>
                                @foreach($cat_data as $item)
                                        <option value="{{ $item->id }}">{{ $item->$category}}</option>
                                @endforeach
                            </select>
                        <span class="text-danger">{{ $errors->first('authors') }}</span>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="new_category">New Creator</label>  </br>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal"  data-backdrop="static" data-opp_name="Book Category"
                        onclick="add_by_modal('/save_Book_category')"><i class="fa fa-plus"></i></button>
                    </div>

                    
                </div>
                <hr>
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="book_category">Category</label> &nbsp; &nbsp;
                        <select class="form-control" id="book_category" name="book_category" value="{{old('category')}}"required>
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach($cat_data as $item)
                                <option value="{{ $item->id }}">{{ $item->$category}}</option>
                        @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('category') }}</span>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="new_category">New Category</label>  </br>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal"  data-backdrop="static" data-opp_name="Book Category"
                        onclick="add_by_modal('/save_Book_category')"><i class="fa fa-plus"></i></button>

                    </div>

                    <div class="form-group col-md-4">
                        <label for="language">Language</label>
                        <select class="form-control" id="language" name="language" value="{{old('language')}}"required>
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach($lang_data as $item)
                                <option value="{{ $item->id }}">{{ $item->$language }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('language') }}</span>
                    </div>
                    <div class="form-group col-md-2">
                    <label for="new_language">New Language</label>  </br>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Book Language"
                    onclick="add_by_modal('/save_Book_language')"><i class="fa fa-plus"></i></button>

                    </div>
                    
                </div>

                <div class="form-row">
                    
                    <div class="form-group col-md-4">
                        <label for="publisher">Publisher</label>
                        <select class="form-control" id="publisher" name="publisher" value="{{old('publisher')}}"required>
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach($pub_data as $item)
                                <option value="{{ $item->id }}">{{ $item->$publisher}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('publisher') }}</span>
                    </div>
                    <div class="form-group col-md-2">
                    <label for="new_publisher">New Publisher</label> </br>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Book Publisher"
                    onclick="add_by_modal('/save_Book_publisher')"><i class="fa fa-plus"></i></button>

                    </div>

           

                </div>

                <div class="form-row">


                <div class="form-group col-md-4">
                        <label for="dewey_decimal">Dewey Decimal Classification</label>
                        <select class="form-control" id="dewey_decimal" name="dewey_decimal" value="{{old('dewey_decimal')}}"required>
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach($dd_class as $item)
                                <option value="{{ $item->id }}">{{ $item->class_si}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>
                    <div class="form-group col-md-2">
                    <label for="new_dewey_decimal"> New DDC </label></br>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Book Dewey Decimal"
                    onclick="add_by_modal('/save_Book_Ddecimal')"><i class="fa fa-plus"></i></button>

                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="purchase_date" >Purchase Date</label>
                        <input class="form-control" type="date" name="purchase_date" value="{{old('purchase_date')}}" id="purchase_date"required>
                        <span class="text-danger">{{ $errors->first('purchase_date') }}</span>
                    </div>
                    <div class="form-group col-md-2"></div>
                  
                </div>

                <div class="form-row">
                    
                    <div class="form-group col-md-4">
                        <label for="edition">Edition</label>
                        <select class="form-control" id="edition" name="edition">
                        <option value="" selected disabled hidden>Choose here</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-4">
                        <label for="price">Price</label>
                        <input type="value" class="form-control" name="price"  value="{{old('price')}}" placeholder="Price:"required>
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                    </div>


                </div>
                <div class="form-row">

                <div class="form-group col-md-4">
                        <label for="publishyear">Publication year</label>
                        <input class="form-control" type="year" name="publishyear"value="{{old('publishyear')}}" id="">
                        <span class="text-danger">{{ $errors->first('publishyear') }}</span>
                    </div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-4">
                        <label for="phy_details">Physical Details</label>
                        <input type="text" class="form-control" name="phydetails" value="{{old('phydetails')}}" placeholder="Physical Details">
                        <span class="text-danger">{{ $errors->first('phydetails') }}</span>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="rackno">Rack No</label>
                        <select class="form-control" id="rackno" name="rackno">
                        <option value="" selected disabled hidden>Choose here</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-4">
                    <label for="rowno">Row No</label>
                        <select class="form-control" id="rowno" name="rowno">
                        <option value="" selected disabled hidden>Choose here</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                        <option>D</option>
                        <option>E</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="note">Note</label>
                        <textarea class="form-control" id="note" name="note" placeholder="Note" value="{{old('note')}}" rows="3"></textarea>
                        <span class="text-danger">{{ $errors->first('note') }}</span>
                    </div>

                </div>


            <div class="box-footer clearfix pull-right">
                <button type="submit" class="btn btn-primary btn-md" value="Save" id="save_book" >
                <i class="fa fa-floppy-o"></i> Save</button>
                &nbsp; &nbsp;
                <button type="button" class="btn btn-warning btn-md" id="reset_book">
                <i class="fa fa-times"></i> Reset</button>
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
        $("#book_title_si").prop('required',true);
        $("#authors_si").prop('required',true);
        @elseif($locale=="ta")
        $("#book_title_ta").prop('required',true);
        $("#authors_ta").prop('required',true);
        @elseif($locale=="en")
        $("#book_title_en").prop('required',true);
        $("#authors_en").prop('required',true);
        @endif

    });
</script>


@endsection

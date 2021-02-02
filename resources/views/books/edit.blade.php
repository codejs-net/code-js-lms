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
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Books&nbsp;</a></li>
    <li class="breadcrumb-item active" ><a><i class="fa fa-pencil"></i> Update Book&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h4> <i class="fa fa-pencil-square"> Update Book</i></h4>
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
         @include('flash_massage')
                <!-- --------------------------- section 1------------------------------------- -->
    
            <form action="{{ route('books.update',$selectdata->id) }}" method="post" name="book_updata" id="book_update" class="needs-validation"  novalidate>
            @csrf
            @method('PUT')

                    <input type="hidden" name="id" id="id" value="{{$selectdata->id}}">
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="accessionNo">Accession Number</label>
                            <input type="text" class="form-control" id="book_aNo" name="accessionNo" value="{{$selectdata->accessionNo}}" placeholder="Accession Number:"required>
                            <span class="text-danger" >{{ $errors->first('accessionNo') }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="form-check-inline">
                            <label class="form-check-label"></label>
                                    <!-- <input type="radio" class="form-check-input" name="br_qr_code" value="bar_code"> BarCode
                                    <input type="radio" class="form-check-input" name="br_qr_code" value="qr_code"> QRCode -->
                                    <!-- <button class="btn btn-primary"><i class="fa fa-circle-o">Genarete</i></button> -->

                            </div>
                            <div id="code_view_bq" class="form-group">
                            {!!DNS1D::getBarcodeSVG("Code-js", "C128",1,50)!!}
                            </div>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="isbn">ISBN</label>
                            <input type="text" class="form-control" id="book_isbn" name="isbn"  value="{{$selectdata->isbn}}"  placeholder="ISBN" required>
                            <span class="text-danger">{{ $errors->first('isbn') }}</span>
                        </div>

                    </div>

                        
                    <div class="form-row">
                        
                    <div class="form-group col-md-12">
                        <label for="book_title">Title</label>
                        <input type="text" class="form-control mb-1" id="book_title_si" name="book_title_si" value="{{$selectdata->book_title_si}}" placeholder="Title in sinhala" >
                        <input type="text" class="form-control mb-1" id="book_title_ta" name="book_title_ta" value="{{$selectdata->book_title_ta}}" placeholder="Title in Tamil" >
                        <input type="text" class="form-control mb-1" id="book_title_en" name="book_title_en" value="{{$selectdata->book_title_en}}" placeholder="Title in English" >
                        <span class="text-danger">{{ $errors->first('book_title') }}</span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="authors">Authors</label>
                        <input type="text" class="form-control mb-1" id="authors_si" name="authors_si" value="{{$selectdata->authors_si}}" placeholder="Author in Sinhala" >
                        <input type="text" class="form-control mb-1" id="authors_ta" name="authors_ta" value="{{$selectdata->authors_ta}}" placeholder="Author in Tamil" >
                        <input type="text" class="form-control mb-1" id="authors_en" name="authors_en" value="{{$selectdata->authors_en}}" placeholder="Author in English" >
                        <span class="text-danger">{{ $errors->first('authors') }}</span>
                    </div>
                        
                    </div>
                    <hr>
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="book_category">Category</label> &nbsp; &nbsp;
                            <select class="form-control" id="book_category" name="book_category" value="{{$selectdata->book_category_id}}"required>
                            <option value="" selected disabled hidden>Choose here</option>
                            @foreach($Cat_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->$category}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('category') }}</span>
                        </div>
                        <div class="form-group col-md-2">
                        <label for="new_category">New Category</label>  &nbsp; &nbsp;
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal"  data-backdrop="static" data-opp_name="Book Category"
                        onclick="add_by_modal('/save_Book_category')"><i class="fa fa-plus"></i></button>

                        
                        </div>

                        <div class="form-group col-md-4">
                            <label for="language">Language</label>
                            <select class="form-control" id="language" name="language" value="{{$selectdata->language_id}}">
                            <option value="" selected disabled hidden>Choose here</option>
                            @foreach($Lang_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->$language }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('language') }}</span>
                        </div>
                        <div class="form-group col-md-2">
                        <label for="new_language">New Language</label>  &nbsp; &nbsp;
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Book Language"
                        onclick="add_by_modal('/save_Book_language')"><i class="fa fa-plus"></i></button>

                        </div>
                        
                    </div>

                    <div class="form-row">
                        
                        <div class="form-group col-md-4">
                            <label for="publisher">Publisher</label>
                            <select class="form-control" id="publisher" name="publisher" value="{{$selectdata->publisher_id}}">
                            <option value="" selected disabled hidden>Choose here</option>
                            @foreach($Pub_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->$publisher}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('publisher') }}</span>
                        </div>
                        <div class="form-group col-md-2">
                        <label for="new_publisher">New Publisher</label>  &nbsp; &nbsp;
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Book Publisher"
                        onclick="add_by_modal('/save_Book_publisher')"><i class="fa fa-plus"></i></button>

                        </div>

                        <div class="form-group col-md-4">
                            <label for="phymedium">Physical Medium</label>
                            <select class="form-control" id="phymedium" name="phymedium" value="">
                            <option value="" selected disabled hidden>Choose here</option>
                            @foreach($PhyMdm_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->$medium}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('phymedia') }}</span>
                        </div>
                        <div class="form-group col-md-2">
                        <label for="new_phymedium">New Physical Medium</label> 
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Book Physical Medium"
                        onclick="add_by_modal('/save_Book_phymedium')"><i class="fa fa-plus"></i></button>

                        </div>

                    </div>

                    <div class="form-row">


                    <div class="form-group col-md-4">
                            <label for="dewey_decimal">Dewey Decimal Classification</label>
                            <select class="form-control" id="dewey_decimal" name="dewey_decimal" value="{{$selectdata->dewey_decimal_id}}"required>
                            <option value="" selected disabled hidden>Choose here</option>
                            @foreach($DDC_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->dd}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('ddecimal') }}</span>
                    </div>
                        <div class="form-group col-md-2">
                        <label for="new_dewey_decimal"> New DDC </label> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-opp_name="Book Dewey Decimal"
                        onclick="add_by_modal('/save_Book_Ddecimal')"><i class="fa fa-plus"></i></button>

                        </div>
                        
                        <div class="form-group col-md-4">
                            <label for="purchase_date" >Purchase Date</label>
                            <input class="form-control" type="date" id="purchase_date" name="purchase_date" value="{{$selectdata->purchase_date}} "id="purchase_date" required>
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
                            <input type="value" class="form-control" id="price" name="price"  value="{{$selectdata->price}}" placeholder="Price:"required>
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        </div>


                    </div>
                    <div class="form-row">

                    <div class="form-group col-md-4">
                            <label for="publishyear">Publication year</label>
                            <input class="form-control" type="year" id="publishyear" name="publishyear" value="{{$selectdata->publishyear}}" id="purchasedate">
                            <span class="text-danger">{{ $errors->first('publishyear') }}</span>
                        </div>
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-4">
                            <label for="phy_details">Physical Details</label>
                            <input type="text" class="form-control" id="phydetails" name="phydetails" value="{{$selectdata->phydetails}}" placeholder="Physical Details">
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
                            <textarea class="form-control" id="note" name="note" placeholder="Note" value="{{$selectdata->note}}" rows="3">{{$selectdata->note}}</textarea>
                            <span class="text-danger">{{ $errors->first('note') }}</span>
                        </div>
                       

                    </div>
                    <div class="row">
                         <div class="form-group col-md-12">
                            <div class="form-check-inline">
                                 <label for="status">Change Status</label>
                            </div>
                           
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="status" value="1">Active
                                </label> &nbsp;
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="status" value="0">Remove
                                </label> &nbsp;
                            </div>
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        </div>
                    </div>


                        <div class="box-footer clearfix pull-right">
                                <button type="submit" class="btn btn-success btn-md" id="save_books">Save
                                <i class="fa fa-floppy-o"></i></button>
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
$(document).ready(function() {
   
    $('#book_category').val("{{$selectdata->book_category_id}}");
    $('#language').val("{{$selectdata->language_id}}");
    $('#publisher').val("{{$selectdata->publisher_id}}");
    $('#phymedium').val("{{$selectdata->phymedium_id}}");
    $('#dewey_decimal').val("{{$selectdata->dewey_decimal_id}}");
    $('input:radio[name="status"]').filter('[value="{{$selectdata->status}}"]').attr('checked', true);
    $('#purchase_date').val("{{$selectdata->purchase_date}}");
    $('#rackno').val("{{$selectdata->rackno}}");
    $('#rowno').val("{{$selectdata->rowno}}");

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

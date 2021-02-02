@extends('layouts.app')


@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-4"><a href="#"><i class="fa fa-home"></i> Home&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Books&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-search"></i> Search Book&nbsp;</li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container-fluid">
    <div class="row text-center">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h4> <i class="fa fa-search"> Search Books</i></h4>
        </div>  
        <div class="col-md-1 col-sm-6 text-right">
            <h4><a href="{{ route('books.create') }}" class="btn btn-info btn-md" name="create_recode" id="create_recode" ><i class="fa fa-plus"></i>&nbsp; New</a></h4>  
        </div>
    </div>
    
</div>

        <!-- Main content -->
<div class="container-fluid bg-white">
    <div class="card-body">
            <div class="form-row">   
           
        </div>               

    </div>
</div>




@endsection

@section('script')
<script>

$(document).ready(function()
{
    

});

</script>

@endsection

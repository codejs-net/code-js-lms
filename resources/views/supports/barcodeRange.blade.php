
@extends('layouts.app')
@section('content')


<div class="content-header">
<div class="container-fluid">
    <div class="row ">
        <div class="col-sm-12 col-md-12 text-center">
            <h5 class="heding">Custom Code Genareter</h5>
        </div>
    </div>
</div>
</div>

<div class="container-fluid">
    
    <form action="{{ route('CodeRangepdf') }}" method="POST"  class="needs-validation" data-toggle="validator" novalidate>
        @csrf
        <div class="card-body">
            <div class="row bg-gradient-white">
                <div class="col-sm-12 col-md-4 text-center">
                    <div class="input-group mb-3 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">From</span>
                        </div>
                        <input type="text" name="txt_start" class="form-control" placeholder="Start Number" aria-label="Start Number" aria-describedby="basic-addon1"required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 text-center">
                    <div class="input-group mb-3 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">To</span>
                        </div>
                        <input type="text" name="txt_end" class="form-control" placeholder="End Number" aria-label="End Number" aria-describedby="basic-addon1"required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 text-center">
                    <div class="input-group mb-3 mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Perfix</span>
                        </div>
                        <input type="text" name="txt_prefix" class="form-control" placeholder="Perfix Srting or Number" aria-label="Perfix" aria-describedby="basic-addon1"required>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right">
        <button class="btn btn-primary mr-3" type="submit">Genarate PDF</button>
        <a class="btn btn-warning btn-md mr-3" >Clear</a>
        </div>
       
    </form>
    
</div>

   
@push('scripts')


<script>

</script>



@endpush

@endsection

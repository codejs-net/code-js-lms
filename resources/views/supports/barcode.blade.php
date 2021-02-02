
@extends('layouts.app')
@section('content')


<div class="content-header">
<div class="container-fluid">
    <div class="row bg-gradient-light">
        <div class="col-sm-12 col-md-12 text-center">
           
        </div>
    </div>
</div>
</div>

<div class="container-fluid">
    

    <div class="card-body">
    <div class="bg-gradient-white">
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" class="form-inline needs-validation" data-toggle="validator" novalidate>
            @csrf
            <div class="custom-file form-group text-center m-3">
                <div class="col-md-10">
                    <input type="file" class="form-control-file custom-file-input" id="file" name="file" required>
                    <label class="custom-file-label " for="customFile">Choose Excel file</label>
                </div>
                <div class="col-md-2">
                @can('code-import')
                <button class="btn btn-success ml-3">Import BarCodes</button>
                @endcan
                   
                </div>
            </div>
          
        </form>
        </div>
       
    </div>

    <div class="card-body">
      
    <table class="table table-bordered" id="tbl_code">
    <thred>
        <tr>
            <th>No</th>
            <th>Code</th>
            <th>Barcode</th>
            <th>Quantity</th>
            <th width="280px">Action</th>
        </tr>
    </thred>
    <tbody>
	    @foreach ($codes as $code)
	    <tr>
	        <td>{{ $code->id }}</td>
	        <td>{{ $code->code }}</td>
            <td> <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($code->code, 'C128',1,60,array(0,0,0), true)}}" alt="barcode" /></td>
            <td>{{ $code->qty }}</td>
	       
	        <td>
                <form action="" method="POST">
                    @can('product-edit')
                    <a class="btn btn-primary" href="">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
        </tbody>
    </table>
    {!! $codes->links('pagination::bootstrap-4') !!}
   
    <div class="card-body text-right">

    <!-- ------------------------------------------------------------------------- -->

    <form action="{{ route('generateCodePDF') }}" method="POST"  class="needs-validation" data-toggle="validator" novalidate>
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
                <div class="col-sm-12 col-md-4 text-right">
                    <button class="btn btn-primary mr-3 mb-3 mt-3" type="submit">Genarate PDF</button>
                    <a class="btn btn-warning btn-md mr-3 mb-3 mt-3" >Clear</a>
                </div>
            </div>
        </div>
        
       
    </form>
    
    <!-- ------------------------------------------------------------------------ -->
    </div>

                    
    </div>
</div>

@endsection

@section('script')
<script>

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

//   $(function () {
    
//     var table = $('#tbl_code').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: "{{ route('codes.index') }}",
//         columns: [
//             {data: 'id', name: 'id'},
//             {data: 'code', name: 'code'},
//             {data: 'Barcode', name: 'Barcode', orderable: false, searchable: false},
//             {data: 'qty', name: 'qty'},
//             {data: 'action', name: 'action', orderable: false, searchable: false},
//             ]
//     });
    
//   });


</script>

<!--Datatable -->
<!-- <script src="{{ asset('plugins/datatables-jquery/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script> -->

@endsection


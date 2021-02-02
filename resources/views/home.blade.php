@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                <h5 class="heding">Code Genareter</h5>
                </div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h6 class="heding">Genarate Barcode Bulk Using Excel Or Custom Range Input</h6>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container mt-4">
       
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 col-12 mx-auto text-center">
                <div class="card card-body">
                    <span class="display-3 d-block">403</span>
                    <div class="mb-4 lead">
                        <i class="fa fa-lock fa-lg" aria-hidden="true">&nbsp;</i>
                        {{$exception->getMessage() ?: 'Forbidden'}}
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-link">Back to Home</a>
                </div>
            </div>
        </div>
      
    </div>
</div>
@endsection


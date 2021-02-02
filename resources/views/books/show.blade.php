@extends('layouts.app')


@section('content')
<div class="content-header">
<div class="container">
<div class="col-sm-12 col-md-12">
        <div class="pull-right text-center">
            <h4> Show Role</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
  
    </div>
</div>
</div>

<div class="container">
<div class="card-body">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
                
</div>
</div>

@endsection
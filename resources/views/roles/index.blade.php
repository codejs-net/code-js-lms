@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Role&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-search"></i> Search Role&nbsp;</a></li>
</ol>
</nav>
        <!-- Content Header (Page header) -->
<div class="container">
    <div class="row text-center mb-2">
        <div class="col-md-11 col-sm-6 text-center"> 
            <h5> <i class="fa fa-search"> Search Role</i></h5>
        </div>  
        <div class="col-md-1 col-sm-6 text-right">
        @can('role-create')
            <a class="btn btn-default btn-sm bg-primary" href="{{ route('roles.create') }}"><i class="fa fa-plus"></i>&nbsp; New</a>
        @endcan
        </div>
    </div>
    
</div>

<div class="container">
<div class="card card-body">
    <div class="form-row">   
        <div class="table-responsive">  
        <table class="table table-hover">
        <thead class="bg-gradient-light">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-outline-info btn-sm" href="{{ route('roles.show',$role->id) }}">Show</a>
                    @can('role-edit')
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                    @endcan
                    @can('role-delete')
                    <a class="btn btn-sm btn-outline-danger " data-toggle="modal" data-target="#data_delete" data-dataid="{{ $role->id }}" data-dataname="{{ $role->name }}"><i class="fa fa-trash" ></i>&nbsp;Delete</a>
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    </div>


{{-- {!! $roles->render() !!} --}}
                
</div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="data_delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <div class="text-center">
                    <h5 class="modal-title" id="modaltitle">Delete Roles</h5>
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                    
            </div>
            
            <form method="POST" action="{{ route('delete_roles')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <input type="hidden" id="id_delete" name="id_delete">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <h5><label type="text"  id="name_delete"></label></h5>
                        </div>
                        <div class="col-md-8">
                            <h6 id="modallabel">Are you sure Remove Role ? </h6>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> &nbsp; Delete</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<!-- end Delete model -->



@endsection
@section('script')
<script>

$(document).ready(function()
{
    $('#data_delete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('dataid') 
    var name = button.data('dataname')
    document.getElementById("id_delete").value= id; 
    document.getElementById("name_delete").innerHTML = name;
    })
});

</script>

@endsection


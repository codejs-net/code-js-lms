@extends('layouts.app')
@section('content')

@php
$locale = session()->get('locale');
$lang="_".$locale;
$category="category".$lang;

@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item ml-2"><a href="{{ route('home') }}"><i class="fa fa-home"></i> {{ __('Home') }}&nbsp;</a></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-folder-open"></i> Support&nbsp;</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a><i class="fa fa-info"></i> Resource Support&nbsp;</a></li>
</ol>
</nav>

<!-- Main content -->
<div class="container-fluid">
    <div class="card card-body">
                     
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

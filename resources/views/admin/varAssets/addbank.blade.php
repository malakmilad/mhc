@extends('admin.layouts.master')
@section('pagetitle') Add Bank  @endsection
@section('contentheader') 
<section class="content-header">
	  <h1>
      Add Bank
 </h1>
 
 <ol class="breadcrumb">
    <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>
</ol>

 </section>
 @endsection
@section('main-content')
<div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title"> Cach Receipt Data </h5>
                <div class="card-tools">
                </div>
</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('var_assets.storebank')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="menuid" value="{{$menuid}}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label> Code</label>
                    <input type="text" name="id" value="@if($errors->any()){{ old('id') }}@else {{$next_id}} @endif" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>  Account Name </label>
                    <input type="text" name="name" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label> Account No  </label>
                    <input type="text" name="AccountNo" class="form-control" required>
                </div>
            </div>
        </div>


        <input type="submit" value="Add Bank Account  "  class="form-control save_trans add">

    </form>
@endsection

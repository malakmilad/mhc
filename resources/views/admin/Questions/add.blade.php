@extends('admin.layouts.master')
@section('pagetitle') @lang('home.Questions') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      Questions
      <small>@lang('home.add_new')</small>
    </h1>
    <ol class="breadcrumb">
     <!--    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('home.control') </a></li>-->
    <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>

    <!--  <li class="active">@lang('home.add_new')</li>-->
    </ol>
 </section>
@endsection
@section('main-content')
<section class="content">
  <!--<div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-plus"></i>
              <h3 class="box-title"> @lang('home.add_new')</h3>
              
              <div class="pull-left box-tools">-->
     <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.add_new')</h5>
                <div class="card-tools">
      
                <a href="{{ route('question.index',$menuid) }}" class="btn btn-info btn-sm">  @lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
              </div><!-- /. tools -->
            </div>
            <div class="box-body">
            @if(count($errors) > 0)
                        <div class="alert alert-danger text-center">
                            @foreach($errors->all() as $error)
                                <P>{{ $error }}</P>
                            @endforeach
                        </div>
            @endif
              <form action="{{ route('question.store') }}" method="post">
              <input type="hidden" name="menuid" value="{{ $menuid }}">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <lable>  Question </lable> <span style="color: red;">*</span>
                      <input type="text" class="form-control" name="question" value="{{ old('question') }}" required placeholder="Question"/>
                    </div>
                  </div>
                <!--   <div class="col-6">
                      <div class="form-group">
                        <lable>  Answer (please insert number) </lable> <span style="color: red;">*</span>
                        <input type="number" class="form-control" name="answer" value="{{ old('answer') }}" required placeholder="Answer" >
                      </div>
                    </div>-->

                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <lable>  Question Type (please insert number) </lable> <span style="color: red;">*</span>              
                        <select name="question_type" id="question_type">
                          <option value="True/False Question">True 1 /False 0 Question </option>
                          <option value="Rating">Rating (1-5)</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <input type="checkbox" id="active" name="active" value="1" >
                        <label for="active">  Active</label><br>
                      </div>
                    </div>
                    
                  </div>
            <div class="row"> 
              <div class="col-6"> 
                <div class="box-footer clearfix">
                  <button class="pull-left btn btn-default">@lang('home.save') <i class="fa fa-plus"></i></button>
                </div>
              </div>
               
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
@endsection
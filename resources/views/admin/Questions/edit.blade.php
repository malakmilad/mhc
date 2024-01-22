@extends('admin.layouts.master')
@section('pagetitle') @lang('home.questions') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.questions')
      <small>@lang('home.edit')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  @lang('home.control') </a></li>
      <li class="active"> @lang('home.edit')</li>
    </ol>
 </section>
@endsection
@section('main-content')
<section class="content">
 <!-- <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-edit"></i>
              <h3 class="box-title"> @lang('home.edit')</h3>
          
              <div class="pull-left box-tools">-->
 <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.edit')</h5>
                <div class="card-tools">
      
                <a href="{{ route('menu.index',$menuid) }}" class="btn btn-info btn-sm">  @lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
              </div><!-- /. tools -->
            </div>
            <div class="box-body">
            @if(count($errors) > 0)
                        <div class="alert alert-danger text-center">
                            @foreach($errors->all() as $error)
                                <P>{{ $error }}</P>
                            @endforeach
                        </div>
                        <div></div>
                    @endif
              <form action="{{ route('question.update',$question['id']) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
                 <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <lable>  @lang('home.question') </lable> <span style="color: red;">*</span>
                      <input type="text" class="form-control" name="question" value="{{ $question->question }}" required placeholder="@lang('home.question')">
                    </div>
                  </div>
                   <div class="col-6">
                    <div class="form-group">
                      <lable>   Question Type (please insert number)  </lable> <span style="color: red;">*</span>              
                      <select name="question_type">
                          <?php $selectedd = "";?>
                      @if($question->question_type == "True/False Question")
                      <?php $selected = "selected";?>
                      @else
                      <?php $selected = "";?>
                      @endif
                       @if($question->question_type == "Rating")
                        <?php $selectedd = "selected";?>
                      @else
                      <?php $selectedd = "";?>
                      @endif
                        <option  {{ $selected}} value="True/False Question">True/False Question </option>
                        <option {{ $selectedd}} value="Rating">Rating</option>
                      </select>
                    </div>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      @if($question->active == 1)
                      <input type="checkbox" id="active" name="active" checked>
                      @else
                      <input type="checkbox" id="active" name="active" >
                      @endif
                      <label for="active">  Active</label><br>
                    </div>
                  </div>
               <!--   <div class="col-6">
                    <div class="form-group">
                      <lable>  @lang('home.answer') </lable> <span style="color: red;">*</span>
                      <input type="number" class="form-control" name="answer" value="{{ old('answer') }}" required placeholder="@lang('home.answer')" >
                    </div>
                  </div>-->
                  </div>

            </div>

            </div>
            <div class="box-footer clearfix">
              <button class="pull-left btn btn-default">@lang('home.save') <i class="fa fa-plus"></i></button>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
@endsection
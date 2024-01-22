@extends('admin.layouts.master')
@section('pagetitle') @lang('home.Answers') @endsection
@section('contentheader') 
 <section class="content-header">
	  <h1>
	    Answers
	    <small>	Answers Desc </small>
	  </h1>
	  <!-- <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i>@lang('home.control') </a>
      </li>
	    <li class="active">@lang('home.Answers')</li>
	  </ol> -->
      <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>

 </section>
@endsection
@section('main-content')
 <section class="content">
  <!-- <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"> @lang('home.Answers')</h3>
                  <div class="box-tools">-->
      <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  Answers</h5>
                <div class="card-tools">
 
                    <div class="input-menu" >
                      <?php
                      $add = "no";
                      $update = "no";
                      $delete = "no";
                    ?>
                    @foreach(\Auth::user()->groups as $usergroup)   <!-- user Groups -->
                      @foreach($usergroup->group->permissions as $permission)   <!-- group permissions -->
                         @if($permission['menu_id'] == $menuid )
                           @if($permission['add'] == 1 )
                             <?php $add = "yes";?>
                           @endif

                           @if($permission['delete'] == 1 )
                             <?php $delete = "yes";?>
                           @endif

                           @if($permission['update'] == 1 )
                             <?php $update = "yes";?>
                           @endif

                          @endif
                       @endforeach 
                    @endforeach
                    @if($add == "yes")
                    
               <!--     <a href="{{ route('question.create',$menuid) }}" class="pull-right action add"> <i class="fa fa-plus"></i> Add </a>-->
                    @endif  

                    </div>
                </div>
                <form action="{{ route('answer.answersearch') }}" id="searchrame" method="post" style=" margin-top: 20px; ">
                    {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
                <div class="row">
                 <div class="col-6"> 
                 <div class="form-group pull-left" style="margin-left: 5px;">
                     <label> @lang('home.employee') </label>
                   <select name="customer_id" class="col-sm-12 form-control">
                     <option value="">@lang('home.employee')</option>
                     @foreach($clients as $user)
                     <option value="{{ $user->id }}">{{ $user->name }}</option>
                     @endforeach
                   </select>
                 </div>
                  </div>
                 <div class="col-6"> 
                 <div class="form-group pull-left" style="margin-left: 5px;">
                       <label> Questions </label>
                      <select name="question_id" class="col-sm-12 form-control">
                        <option value="">Questions</option>
                        @foreach($questions as $question)
                        <option value="{{ $question->id }}">{{ $question->question }}</option>
                        @endforeach
                      </select>
                 </div>
                  </div>
                </div>
              <div class="row">
                <div class="col-2">  
                 <div class="form-group pull-left " style="margin-left: 5px">
                   <input type="submit" value="@lang('home.search')" class="col-sm-12 form-control btn btn-success">
                 </div>
                </div>
              </div>
                </div>
                </form>

                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                  <table class="display table-bordered" style="width:100%">
                      <thead>
                   @if($allAnswers->count() > 0)
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center"> Customer</th>
                      <th class="text-center">Operation</th>
                      <th class="text-center">Question</th>
                      <th class="text-center">Answer</th>
                    <!--  <th class="text-center"> Created_at</th>-->
                      <th class="text-center">Options</th>
                    </tr>
                    <?php $i= 1;?>
                    </thead>
                    <tbody>
                  @foreach($allAnswers as $act)
                    <tr>
                      <td class="text-center">{{ $i }}</td>
                      <td class="text-center">{{ $act->customer['name'] }}</td>
                      <td class="text-center">{{ $act->operation['name'] }}</td>
                      <td class="text-center">@if(isset($act->questions)){{ $act->questions['question'] }}@endif</td>
                      <td class="text-center">@if($act->questions['question_type']=="True/False Question" && $act['answer']== 0)False @elseif($act->questions['question_type']=="True/False Question" && $act['answer']== 1) True @else {{$act['answer']}} @endif</td> </td>
                      <td class="text-center">{{ $act['active'] }}</td  >
                      <!--  <td class="text-center">{{ date('d/m/Y',strtotime($act['created_at'])) }}</td>-->
                      <td class="text-center">
                  {{--   @if($update == "yes")
                        <a href="{{ route('answer.edit',['answer' => $act['id'] , 'menuid' => $menuid ] ) }}" class="action edit"><i class="fa fa-edit"></i> </a>
                      @endif--}}
                      @if($delete == "yes")
                        <a href="{{ route('answer.destory',['answer' => $act['id'] , 'menuid' => $menuid ] ) }}" class="action delete"> <i class="fa fa-times"></i> </a>
                      @endif
                      </td>
                    </tr>
                    <?php $i= $i + 1;?>
                  @endforeach
                  </tbody>
                  @else
                  <h3 class="text-center" style="color: red;">
                    <br>
                    <br>
                    <br>
                     @lang('home.empty_data')
                    <br>
                    <br>
                    <br>
                  </h3>
                  @endif
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
 </section><!-- /.content -->
  <script type="text/javascript">
    function searchcvs() {
      $('#searchrame').slideToggle();
    }
 </script>
@endsection
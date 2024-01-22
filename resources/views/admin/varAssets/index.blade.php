@extends('admin.layouts.master')
@section('pagetitle') Banks @endsection
@section('contentheader') 
 <section class="content-header">
	  <h1>
      Banks
     </h1>
	  <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>

 </section>
@endsection
@section('main-content')
 <section class="content">
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title"> Banks</h5>
                <div class="card-tools">
      
                    <div class="input-menu" >
                      <?php
                      $add = "no";
                      $update = "no";
                      $delete = "no";
                    ?>
                    @foreach(\Auth::user()->groups as $usergroup)   <!-- user Groups -->
                      @foreach($usergroup->group->permissions as $permission)   <!-- group permissions -->
                         @if($permission['id'] == $id )
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
                    
                    <a href="{{ route('var_assets.add',['menuid' =>$id ]) }}"> Add Cash</a>
                        <a href="{{ route('var_assets.addbank',['menuid' =>$id ]) }}">  Add Bank</a>
                       {{--@if($add == "yes")         
                      <ul class="nav navbar-nav ">
                          <li class="dropdown ">
                              <a href="#" class="    btn btn-primary  btn-add  dropdown-toggle" aria-expanded="false" type="button" data-toggle="dropdown">Add
                                  <span class="caret"></span></a>
                              <ul class="dropdown-menu " role="menu">
                                  <li><a href="{{ route('var_assets.add',['menuid' =>$id ]) }}"> Add Cash</a></li>
                                  <li><a href="{{ route('var_assets.addbank',['menuid' =>$id ]) }}">  Add Bank</a></li>
                              </ul>
                          </li>
                      </ul>

                      <script>
                          $('.dropdown-toggle').dropdown()
                      </script>
            @endif--}}  
</div></div></div>                          <div class="form-top">بحث</div>
<form action="{{ route('var_assets.search',['id'=>$id])}}" method="post" class="form-out">
    {{ csrf_field() }}
    <div class="form-group from date">
        <label  class="date-lb">من تاريخ</label>
        @if(isset($date_from))
            <input type="date" name="date_from" value="{{$date_from}}" required>
        @else
            <input type="date" name="date_from"  required class="date-input clr">
        @endif
    </div>
    <div class=" form-group date">
        <label  class="date-lb">الي تاريخ </label>
        @if(isset($date_to))
            <input type="date" name="date_to" value="{{$date_to}}" required>
        @else
            <input type="date" name="date_to"  required class="date-input clr">
        @endif
    </div>
    <div class="">
        <button  class="btn-search" >
            <i class="fa fa-search"></i>
            <input type="submit" value="بحث"  class="in-style">
        </button>
    </div>
</form>
    

            
<div class="row">
    <div class="col-md-6">
        <label>أجمالي المدين : {{$total_debit}}</label>
    </div>
   
</div>
 <br>

<table class="display table-bordered" style="width:100%">
 <thead>
   <tr>
   <th class="text-center">الرقم التسلسلي</th>
   <th class="text-center">الاسم</th>

   <th class="text-center">النوع</th>
   <th class="text-center">الأجمالي</th>
   <th class="text-center">التاريخ</th>
   <th class="text-center">عمليات</th>
   </tr>
 </thead>
 <tbody id="tbody">
   @foreach ($varAssets as $item)
       <tr>
        <td class="text-center"><a href="{{route('var_assets.show',[$item->id ,$id])}}">{{$item->id}}</a></td>
        <td class="text-center">{{$item->name}}</td>
        <td class="text-center">{{$item->type}}</td>
        <td class="text-center">{{$item->sum}}</td>
        <td class="text-center">{{date("Y-m-d",strtotime($item->created_at))}}</td>

        <td>
         

@if($permission['update'] == 1 )
                           
        <a href="{{ route('var_assets.edit',['var_asset_id' =>$item->id,'menuid'=>$id ]) }}">تعديل</a
        >
    @endif
    @if($permission['delete'] == 1 )
                         
     <a href="{{ route('var_assets.destory',['var_asset_id' =>$item->id,'menuid'=>$id ]) }}" onclick="return confirm('هل أنت متأكد')">مسح</a>
    @endif

     </td>

    </tr>
   @endforeach
 </tbody>
</table>
@endsection

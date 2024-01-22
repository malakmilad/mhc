@extends('admin.layouts.master')
@section('pagetitle') Payment Receipt @endsection
@section('contentheader') 
<section class="content-header">
	  <h1>
    Payment Receipt
 </h1>
	   <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>

 </section>
 @endsection
@section('main-content')
<div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  Payment Receipt</h5>
                <div class="card-tools">
                  
   
                   @foreach(\Auth::user()->groups as $usergroup)   <!-- user Groups -->
    @foreach($usergroup->group->permissions as $permission)   <!-- group permissions -->
       @if($permission['menu_id'] == $id )
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

        <a href="{{ route('giving_permission.add',['menuid' =>$id ]) }}" class="pull-right action add"> <i class="fa fa-plus"></i>
           
          Add Payment Receipt   
        </a>

    @endif          
</div>
</div>
</div>    
     <div class="form-top">Search</div>
   
     <form action="{{ route('giving_permission.search',['id'=>$id])}}" method="post" class="form-out">
         {{ csrf_field() }}
         <div class="row">
                   <div class="col-3">    
                       <div class="form-group pull-left" style="margin-left: 5px;">
                        <label class="date-lb"> From Date</label>
                        @if(isset($date_from))
                        <input type="date" name="date_from" value="{{$date_from}}" required>
                        @else
                        <input type="date" name="date_from"  required class="date-input clr">
                        @endif
                    </div>
                  </div>
                    <div class="col-3">    
                       <div class="form-group pull-left" style="margin-left: 5px;">
                  
                      <label class="date-lb"> To Date </label>
                        @if(isset($date_to))
                      <input type="date" name="date_to" value="{{$date_to}}" required>
                      @else
                      <input type="date" name="date_to"  required class="date-input clr">
                      @endif
                  </div>
                </div>
              
                  <div class="col-3">  
                    <div class="form-group pull-left" style="margin-left: 5px">
                      <label> </label>
                      <input type="submit" value="@lang('home.search')" class="col-sm-12 form-control btn btn-success">
                    </div>
                   </div>
                   </div>
                  
     </form>
     <br><br>
               


<div class="machine">
<table class="table table-condensed table-striped " id="info-table">
 <thead>
   <tr class="table-row">
      <th class="cell-head"> Serial No</th>
      <th class="cell-head">Name</th>
      <th class="cell-head">Money</th>
    {{--<th class="cell-head">الأصل المتداول</th>--}}  
      <th class="cell-head">Notes</th>
      <th class="cell-head">Date </th>
      <th class="cell-head">Operations</th>
   </tr>
 </thead>
 <tbody id="tbody">
    <?php 
  ?>
    @foreach ($permissions as $item)
    
       <tr class="table-row">
          <td class="cell-row">{{$item->id}}</td>
          <td class="cell-row">{{$item->name}}</td>
          <td class="cell-row">{{$item->money}}</td>
          <td class="cell-row">{{$item->VarAsset->name}}</td>
          <td class="cell-row">{{$item->notes}}</td>
        <td class="cell-row">{{date("Y-m-d",strtotime($item->created_at))}}</td>
       
        <td class="cell-row">
        @if($update == "yes")
     
            <a href="{{ route('giving_permission.edit',['giving_permissionid' =>$item->id,'menuid' =>$id ]) }}" class="edit"><i class="fa fa-edit"></i></a> 
      
        @endif
       @if($delete == "yes")
    
         <a href="{{ route('giving_permission.destory',['giving_permissionid' =>$item->id,'menuid'=>$id ]) }}" onclick="return confirm('هل أنت متأكد')" class="edit">
         <i class="fa fa-times"></i></a>
     
        @endif
    </td>

       </tr>
   @endforeach
 </tbody>
</table>
</div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
 </section><!-- /.content -->
</div>
@endsection

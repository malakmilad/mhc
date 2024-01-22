@extends('admin.layouts.master')
@section('pagetitle') Edit Cash Receipt @endsection
@section('contentheader') 
<section class="content-header">
	  <h1>
      Add Cash Receipt
 </h1>
 
 <ol class="breadcrumb">
    <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>
</ol>

 </section>
 @endsection
@section('main-content')
<script>
       
       $(document).ready(function(){
           var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     
      $(document).on('change','.account',function(){
           $(".order_remain").text("");
          var account=$(this).val();
           $(".items").children().remove();
           $.ajax({
               /* the route pointing to the post function */
               url: '../get_operations',
               type: 'POST',
               /* send the csrf-token and the input to the controller */
               data: {_token: CSRF_TOKEN, account:$('.account').val()},
               dataType: 'JSON',
               /* remind that 'data' is the response of the AjaxController */
               success: function (data) {
                    $(".operation").children().remove();
                   $(".operation").append("<option value=''> Choose Operation</option>");
                   if(data.operations.length>0)
                   {
                       var element="";
                       for(var i=0;i<data.operations.length;i++)
                       {
                           $(".operation").append("<option  value='"+data.operations[i]['id']+"' added_value='"+data.operations[i]['added_value']+"'>"+data.operations[i]['name']+"</option>");
                       }
                   }
               }
           });
     //  }
       });
   });
       $(document).on('change','.operation',function(){
           var added_value = $('option:selected', this).attr('added_value');
           $(".order_remain").text(added_value);
           $("#added_value").val(added_value);
           if($(".money").val()>added_value)
           {
               alert("المبلغ تعدي القيمه المستحقه للفاتورة");
               $(".money").val(added_value);
           }
       });    
</script>
<script>
  $(document).ready(function() {
       $('.select').select2();
   });
</script>

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
        <form action="{{ route('receiving_permission.update')}}" method="post">
                {{ csrf_field() }}
               
                <input type="hidden" name="menuid" value="{{$menuid}}">
                <input type="hidden" name="repermissionid" value="{{$repermission->id}}">
                <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                   <label class="labl"> Code</label>
                   <input type="text" name="id" value="@if($errors->any()){{ old('id') }}@else {{$repermission->id}} @endif" class="form-control" required>
                 </div>
                 </div>
                 <div class="col-md-6">
                <div class="form-group">
                      <label class="labl">   Account</label>
                    <select name="account" class="form-control account select" >
                      @foreach ($accounts as $account)
                       @if(($repermission->clientid==$account['id']))
                       <option value="{{$account['id']}}" selected>{{$account['name']}}</option>
                      
                       @else
                       <option value="{{$account['id']}}">{{$account['name']}}</option>
                       @endif
                      @endforeach
                    </select>
           
                  </div>
               </div>
          </div>
          <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="labl">Cash or Payment papers</label>
                      
                      <select name="type" class="form-control" >
                          @if($repermission->type==1)
                          <option value=1 selected>Cash</option>
                          <option value=2> Payment papers</optio>
                          @else
                          <option value=1>Cash</option>
                          <option value=2 selected> Payment papers</optio>
                          @endif
                      </select>
             </div>
                    </div>
                    <div class="col-md-6">
                 <div class="form-group">
                        <label class="labl">    Money</label>
                        <input type="number" step="0.1" min=0 name="money" value="{{$repermission->money}}" class="form-control money">
                
                   </div>
                   </div>
                   </div>
                 <div class="form-group">
                      <label class="labl"> operation </label>
                      
                      <select name="operation" class="form-control operation select" >
                        <option value="">Choose Operation</option>
                        @foreach($orders_ids as $item)
                        @if($repermission->orderid == $item['id'])
                             <option value="{{$item['id']}}" selected>{{$item['name']}}</option>
                        @else
                             <option value="{{$item['id']}}">{{$item['name']}}</option>
                        @endif
                        @endforeach
                      </select>
             
                </div>
                <div class="form-group">
                      <label class="labl"> remaining : </label>
                      
                      <span class="order_remain">{{$repermission->order_remain}}</span>
             
                </div>
             
                 <div class="form-group">
                      <label class="labl"> للأصل المتداول</label>
                      
                      <select name="var_asset_id" class="form-control select" >
                        @foreach ($var_assets as $item)
                             @if($repermission->var_asset_id==$item->id)
                             <option value="{{$item->id}}" selected>{{$item->name}}</option>
                             @else
                             <option value="{{$item->id}}">{{$item->name}}</option>
                             @endif
                        @endforeach
                      </select>
             
                  </div>
                     <div class="form-group">
                        <label class="labl">    Notes</label>
                        <input type="text" name="notes" value="{{$repermission->notes}}" class="form-control">
                
                   </div>
                    
                      <div class="form-group">

                          <input type="submit" value="تعديل" class="btn btn-success" style="margin-left: 15px;">
                          <a href="{{ route('receiving_permission.index',['menuid'=>$menuid ]) }}" class="btn btn-danger" >إلغاء</a>

                      </div>
             </form>
                        <meta name="csrf-token" content="{{ csrf_token() }}" />

          @endsection
@push('scripts')
    <script>
              $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
               
            $('.account').on('change', function (e) {
               // $(".work_order_remain").text("");
                $(".order_remain").text("");
                var account=$(this).val();
                $(".items").children().remove();
              
                $.ajax({
                            /* the route pointing to the post function */
                            url: '../get_operations',
                            type: 'POST',
                            /* send the csrf-token and the input to the controller */
                            data: {_token: CSRF_TOKEN, account:$('.account').val()},
                            dataType: 'JSON',
                            /* remind that 'data' is the response of the AjaxController */
                            success: function (data) { 
                                         $(".operation").children().remove();
                                         $(".operation").append("<option value=''> Choose operation </option>"); 
                                     if(data.operations.length>0)
                                     {
                                         var element="";
                                          for(var i=0;i<data.operations.length;i++)
                                          {
                                            $(".operation").append("<option  value='"+data.operations[i]['id']+"' added_value='"+data.operations[i]['added_value']+"'>"+data.operations[i]['name']+"</option>");
                                          }
                                     }
                                     $(".operation_work").children().remove();
                                   
                                }          
                     });
            });
        
            $(document).on('change','.operation',function(){
                var remain = $('option:selected', this).attr('remain');
                $(".order_remain").text(remain);
                 if($(".money").val()>remain)
                {
                    alert("المبلغ تعدي القيمه المستحقه للفاتورة");
                    $(".money").val(remain);
                }
            });
           
       });
    </script>
            <script>
$(document).ready(function() {
    $('.select').select2();
});


     </script>


@endpush
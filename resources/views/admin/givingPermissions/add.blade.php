@extends('admin.layouts.master')
@section('pagetitle') Add Payment Receipt @endsection
@section('contentheader') 
<section class="content-header">
	  <h1>
      Add Payment Receipt
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
               var account_values=$(this).val();
               var p = account_values.indexOf(",");
               var account=account_values.substring(p+1, account_values.length);
               $(".items").children().remove();
                $.ajax({
                    /* the route pointing to the post function */
                    url: '../get_operations_duduct',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, account:account},
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
                                $(".operation").append("<option  value='"+data.operations[i]['id']+"' deduct_value='"+data.operations[i]['deduct_value']+"'>"+data.operations[i]['name']+"</option>");
                            }
                        }
                    }
                });
          //  }
            });
        });
            $(document).on('change','.operation',function(){
                var deduct_value = $('option:selected', this).attr('deduct_value');
                $(".order_remain").text(deduct_value);
                $("#deduct_value").val(deduct_value);
                if($(".money").val()>deduct_value)
                {
                    alert("المبلغ تعدي القيمه المستحقه للفاتورة");
                    $(".money").val(deduct_value);
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
                <h5 class="card-title"> Payment Receipt Data </h5>
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
        <form action="{{ route('giving_permission.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{$menuid}}">
             
                <div class="row">
                  <div class="col-md-6">
                 <div class="form-group">
                    <label class="labl"> Code</label>
                    <input type="text" name="id" value="@if($errors->any()){{ old('id') }}@else {{$next_id}} @endif" class="form-control" required>
                 </div>
                 </div>
                  <div class="col-md-6">
                <div class="form-group">
                    <label class="labl">   Account</label>
                    <select name="account" class="form-control account select"  required>
                        <option value=''>Choose account</option>
                      @foreach ($accounts as $account)
                       <option value="{{$account['id']}}">{{$account['name']}}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">

                        <label class="labl"> operation </label>

                        <select name="operation" class="form-control operation select" >
                            <option value=""> Choose Operation</option>
                        </select>

                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="labl"> remaining : </label>
                            <span class="order_remain"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                      <label class="labl">Cash or Payment papers</label>

                      <select name="type" class="form-control select" >
                          <option value=1>cash</option>
                          <option value=2> Payment papers</option>

                      </select>
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group">
                            <label class="labl">    Money</label>
                            <input type="number" step="0.1" min=0 name="money" id="deduct_value" class="form-control money">

                     </div>
                     </div>
                 </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="labl">   Date  </label>

                        <input type="date" name="created_at" class="form-control" required value="{{date('Y-m-d')}}">
                    </div>


                </div>
                    <div class="col-md-6">
                     <div class="form-group">
                          <label class="labl">  Bank</label>

                          <select name="var_asset_id" class="form-control select" >
                            @foreach ($var_assets as $item)
                             <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                          </select>
                    </div>
                    </div>
                </div>
               <div class="row">
                <div class="col-md-6">
                    <label class="labl"  for="photo"> Collected by</label>
                    <select name="users" class="form-control  select" >
                        <option value="">Choose User</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="labl"  for="PaymentMethod">PaymentMethod</label>
                    <select name="PaymentMethod" class="form-control  select" >
                        <option value="">Choose PaymentMethod</option>
                        <option value="PayTabs">PayTabs</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                    </select>
                </div>

            </div>
         <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="labl"  for="attachment">attachment</label>
                            <input type="file" name="attachment" id="attachment" accept="image/*,.pdf,.docx,.doc" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="labl">    notes</label>
                            <input type="text" name="notes" class="form-control">

                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-12">
                       <div class="form-group">

                          <div class="box-footer clearfix">
                        <button class="pull-left btn btn-default">@lang('home.save') <i class="fa fa-plus"></i></button>
                        </div>
                      </div>
                </div>
            </div>
            <meta name="csrf-token" content="{{ csrf_token() }}" />

          </form>
             
     

@endsection
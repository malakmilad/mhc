@extends ('admin.layouts.app')

 @section('title', 'تقارير المدفوعات') 

@section('admin-content')
     @component('admin.layouts.components.panel')
     <div class="form-top">بحث</div>
     <form action="{{ route('receivings.report.filter',['id'=>$id])}}" method="post" class="form-out">
         {{ csrf_field() }}
     <div class="row reports-sales">
    
     <div class="col-md-3  form-group ">
         <label  class="date-lb">العميل </label>
         <select name="account" class="select">
             <option value=0>الكل</option>
             @foreach($accounts as $account)
             <option value="{{$account['id']}}" @if(isset($filter['account']) && $filter['account']==$account['id']) selected @endif>{{$account['name']}}</option>
             @endforeach
             
         </select>
     </div>
     <div class="col-md-3  form-group">
         <label  class="date-lb">الموظف </label>
         <select name="employee" class="select">
             <option value=0>الكل</option>
             @foreach($users as $employee)
             <option value="{{$employee['id']}}" @if(isset($filter['employee']) && $filter['employee']==$employee['id']) selected @endif>{{$employee['name']}}</option>
             @endforeach
             
         </select>
     </div>

    </div>
     <div class=" form-group from date" style="margin-right: 5%;">
         <label  class="date-lb">من تاريخ</label>
         @if(isset($filter['date_from']))
         <input type="date" name="date_from" value="{{$filter['date_from']}}" >
         @else
         <input type="date" name="date_from"  class="date-input clr">
         @endif
     </div>
      <div class="form-group date">
         <label  class="date-lb">الي تاريخ </label>
          @if(isset($filter['date_to']))
         <input type="date" name="date_to" value="{{$filter['date_to']}}" >
         @else
         <input type="date" name="date_to"  class="date-input clr">
         @endif
     </div>
     <div class="">
         <button  class="btn-search" >
     <i class="fa fa-search"></i>
     <input type="submit" value="بحث"  class="in-style">
     </button>
     </div>

     </form>
     <br><br>


<div class="machine">
<table id="report-table" class="table-bordered table-hover">
 <thead>
   <tr class="table-row">
      <th class="cell-head">الرقم التسلسلي</th>
      <th class="cell-head">رقم الفاتورة </th>
      <th class="cell-head">العميل</th>
      <th class="cell-head">الموظف</th>
      <th class="cell-head">الطريقه</th>
      <th class="cell-head">التاريخ </th>
      <th class="cell-head">الأجمالي</th>

   </tr>
 </thead>
 <tbody id="tbody">
    <?php 
    $total=0;
  ?>
    @foreach ($permissions as $item)
    <?php $total+=$item->money?>
       <tr class="table-row">
          <td class="cell-row">{{$item->id}}</td>
          <td class="cell-row">{{$item->orderid}}</td>
          <td class="cell-row">{{$item->name}}</td>
          <td class="cell-row">{{$item->employee->name}}</td>
          <td class="cell-row">
              @if($item->type==1)
              نقدية
              @else
              أوراق قبض
              @endif
          </td>
        <td class="cell-row">{{date("Y-m-d",strtotime($item->created_at))}}</td>
        <td class="cell-row">{{$item->money}}</td>
        

       </tr>
   @endforeach
   <tr>
       <td colspan=6>المجموع</td>
       <td>{{$total}}</td>
   </tr>
 </tbody>
</table>
</div>
<script>
$(document).ready(function() {
    $('.select').select2();
});


     </script>

@endsection

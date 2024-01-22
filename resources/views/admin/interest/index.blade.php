@extends('admin.layouts.master')
@section('pagetitle') العملاء المهتمين @endsection
@section('contentheader') 
 <section class="content-header text-right">
	  <h1>
	    العملاء المهتمين
	    <small>يمكنك اضافة و تعديل و حذف العملاء المهتمين من هنا</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> لوحة التحكم </a>
      </li>
	    <li class="active">العملاء المهتمين</li>
	  </ol>
 </section>
@endsection
@section('main-content')
 <section class="content">
   <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">قائمة العملاء المهتمين</h3>
                  <div class="box-tools">
                    <div class="input-group" >

                      <a onclick="searchcvs()" style="font-size: 15px; font-weight: bold;margin-left: 5px;" class="btn btn-sm btn-info pull-right">بحث <i class="fa fa-search"></i></a>


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

                    @endif
                    @if($delete == "yes")
                    <div class="pull-right" style="margin-right: 10px;"> 
                    <input type="checkbox"  onClick="setAllCheckboxes('actors', this);" /> Select To  Delete All <br/>
                    </div>
                    @endif   
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                 <form action="{{ route('search.interestsearch') }}" id="searchrame" method="post" style="display: none; margin-top: 20px;">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
                 <div class="form-group pull-left">
                   <input type="text" name="name" class="col-sm-12 form-control" placeholder="اسم العميل">
                 </div>

                 <div class="form-group pull-left" style="margin-left: 5px;">
                   <input type="email" name="email" class="col-sm-12 form-control" placeholder="البريد الالكتروني">
                 </div>

                 <div class="form-group pull-left" style="margin-left: 5px;">
                   <input type="text" name="phone" class="col-sm-12 form-control" placeholder="رقم الهاتف">
                 </div>

                 <div class="form-group pull-left" style="margin-left: 5px;">
                   <input type="date" name="dynmicdate" class="col-sm-12 form-control" placeholder="اسم العميل">
                 </div>
                 @if(\Auth::user()->type == 1)
                 <div class="form-group pull-left" style="margin-left: 5px;">
                   <select name="user_id" class="col-sm-12 form-control">
                     <option value="">-- اختر اسم الموظف --</option>
                     @foreach($users as $user)
                     <option value="{{ $user->id }}">{{ $user->name }}</option>
                     @endforeach
                   </select>
                 </div>
                 @endif

                 <div class="form-group pull-left" style="margin-left: 5px">
                   <input type="submit" value="بحث" class="col-sm-12 form-control btn btn-success">
                 </div>
                </form>
                 <form action="{{ route('deleteallselectedsheets') }}" method="POST">
                 {{ csrf_field() }}
                   <input type='hidden' name='menuid' value="{{ $menuid }}" >
                  <table class="table table-bordered table-hover" id="actors">
                   @if($allsheets->count() > 0)
                    <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">الاسم</th>
                      <th class="text-center">البريد الالكتروني</th>
                      <th class="text-center">التيلفونات</th>
                      @if(\Auth::user()->type == 1)
                      <th class="text-center">الموظف</th>
                      @endif
                      <th class="text-center">تاريخ الانشاء</th>
                      <th class="text-center">تاريخ الترحيل</th>
                      @if($delete == "yes")
                      <th class="text-center">اختار للمسح</th>
                      @endif
                      <th class="text-center">الخيارات</th>
                    </tr>
                   </thead>
                    <tbody>
                    <?php $i= 1;?>
                  @foreach($allsheets as $cat)
                    <tr style="background-color: {{ $cat['color']  }}">
                      <td class="text-center">{{ $i }}</td>
                      <td class="text-center">{{ $cat['name'] }}</td>
                      <td class="text-center">{{ $cat['email'] }}</td>
                      <td class="text-center">
                       @if($cat->phones->count() > 0) 
                       @foreach($cat->phones as $phonenumber).
                        {{ $phonenumber['phone'] }}<br>
                       @endforeach
                       @else
                       لايوجد ارقام هاتف
                       @endif
                      </td>
                      @if(\Auth::user()->type == 1)
                      <td class="text-center">{{ $cat->userfun['name'] }}</td>
                      @endif
                      <td class="text-center">{{ date('d/m/Y',strtotime($cat['created_at'])) }}</td>
                      <td class="text-center">{{ date('d/m/Y',strtotime($cat['dynmicdate'])) }}</td>
                      <td class="text-center"> 
                      
                      <input type="checkbox" name="check{{ $i}}" value="{{ $cat['id'] }}">
               
                      </td> 
                     <td class="text-center">
                      @if($update == "yes")
                      <a href="{{ route('interest.edit',['interest' => $cat['id'] , 'menuid' => $menuid ] ) }}" class="label label-warning">تعديل <i class="fa fa-edit"></i></a>
                      @endif
                      @if($delete == "yes")
                      <a href="{{ route('interest.destory',['interest' => $cat['id'] , 'menuid' => $menuid ] ) }}" class="label label-danger">مسح <i class="fa fa-times"></i></a>
                      @endif
                      </td>
                    </tr>
                    <?php $i= $i + 1;?>
                  @endforeach
                  </tbody>

                  <tfoot>
                  <tr>
                     <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">الاسم</th>
                      <th class="text-center">البريد الالكتروني</th>
                      <th class="text-center">التيلفونات</th>
                      @if(\Auth::user()->type == 1)
                      <th class="text-center">الموظف</th>
                      @endif
                      <th class="text-center">تاريخ الانشاء</th>
                      <th class="text-center">تاريخ الترحيل</th>
                      @if($delete == "yes")
                      <th class="text-center">اختار للمسح</th>
                      @endif
                      <th class="text-center">الخيارات</th>
                    </tr>
                  </tfoot>
                  @else
                  <h3 class="text-center" style="color: red;">
                    <br>
                    <br>
                    <br>
                        لم تقم باادخال اي عملاء بعد
                    <br>
                    <br>
                    <br>
                  </h3>
                  @endif
                  </table>
                  @if($delete == "yes")
                  <button class="btn btn-danger col-sm-3 pull-left"> مسح ماتم اختياره </button>
                  @endif
                  </form>
                   @if(isset($pagination) && ($pagination == "no"))
                   @else
                   {{ $allsheets ->links() }}
                   @endif
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
<script type="text/javascript">
   function setAllCheckboxes(divId, sourceCheckbox) {
    
    divElement = document.getElementById(divId);
    
    inputElements = divElement.getElementsByTagName('input');
    for (i = 0; i < inputElements.length; i++) {
        if (inputElements[i].type != 'checkbox')
            continue;
        inputElements[i].checked = sourceCheckbox.checked;
    }
}
 </script>
@endsection
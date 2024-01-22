@extends ('admin.layouts.app')

@section('title', ' تعديل الاصل المتداول')

@section('admin-content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   <form action="{{ route('var_assets.update')}}" method="post">
         {{ csrf_field() }}
         <input type="hidden" name="menuid" value="{{$menuid}}">
     <div class="form-group">
       <label> الكود</label>
       <input type="text" name="id" value="@if($errors->any()){{ old('id') }}@else {{$varAsset->id}} @endif" class="form-control" required>
     </div>
     <div class="form-group">
         <label>الأسم </label>
         <input type="text" name="name" class="form-control" required value="{{ $varAsset->name}}">
         <input type="hidden" name="varAssetid" value="{{ $varAsset->id}}">

       </div>
       
       <div class="form-group">
         <label>النوع</label>
         <select name="type">
             @if($varAsset->type==1)
             <option value=1 selected>حساب بنكى</option>
             <option value=0>خزينة</option>
             @else
             <option value=1>حساب بنكى</option>
             <option value=0 selected>خزينة</option>
             @endif
         </select>
        </div>
     <input type="submit" class="butn" value="تعديل الخزن والحسابات البنكية ">

   </form>
@endsection

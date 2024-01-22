@extends ('admin.layouts.app')

@section('title', 'حساب الخزائن والحسابات البنكية')
@section('admin-content')
     @component('admin.layouts.components.panel')

<h3><strong>{{$var_asset->name}}</strong></h3>
<div class=" btn-group dropdown-btn-group">
    <a href="{{ route('var_assets.edit',['var_asset_id' =>$var_asset->id,'menuid'=>$menuid ]) }}" class="btn btn-default btn-sm btn-5 "><i class="fa fa-pencil"></i>  تعديل البيانات</a>
    <a href="{{ route('var_assets.addtransfer',['var_asset_id' =>$var_asset->id,'menuid'=>$menuid]) }}" class="btn btn-default btn-sm btn-5 "><i class="fa fa-recycle"></i> التحويل</a>
    <a href="{{ route('var_assets.destory',['var_asset_id' =>$var_asset->id,'menuid'=>$menuid ]) }}" class="btn btn-default btn-sm btn-5 "><i class="fa fa-trash-o"></i>  حذف</a>
</div>
<br><br>
<div role="tabpanel" >
    <ul class="nav nav-tabs responsive" role="tablist">
        <li role="presentation" class="active">
            <a  href="#home" aria-controls="home" role="tab" data-toggle="tab"><span class="one-line"></span>الحركات</a>
        </li>
        <li role="presentation" class="">
            <a href="#home1" aria-controls="home1" role="tab" data-toggle="tab"><span class="one-line"></span>التحويلات</a>
        </li>
    </ul>
</div>
<div class="tab-content">
       <div role="tabpanel" class="tab-pane active" id="home" class="active">
            <ul>
                <li>
                <table id="table_print" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>م</th>
                        <th>رقم المستند </th>
                        <th>نوع المستند</th>
                        <th>مدين</th>
                        <th>دائن </th>
                        <th>رصيد</th>
                        <th>الملاحظات</th>
                        <th>تاريخ الأنشاء</th>


                    </tr>
                    </thead>
                    <tbody id="tbody">

                    @for($i=0;$i<count($reciveds);$i++)

                        <tr>
                            <td>{{$i+1}}</td>
                            <td>

                                {{$reciveds[$i][0]}}


                            </td>
                            <td>
                                @if($reciveds[$i][1]==1)
                                    أذن استلام نقدية
                                @elseif($reciveds[$i][1]==2)
                                    أذن صرف خزينة
                                @elseif($reciveds[$i][1]==3 || $reciveds[$i][1]==4)
                                    قيد يومي
                                    @elseif($reciveds[$i][1]==5 )
                                   تحويلات مالية
                                @endif
                            </td>
                            <td>{{$reciveds[$i][2]}}</td>
                            <td>{{$reciveds[$i][3]}}</td>
                            <td>{{$reciveds[$i][4]}}</td>
                            <td>{{$reciveds[$i][5]}}</td>
                            <td>{{$reciveds[$i][6]}}</td>

                        </tr>
                    @endfor
                    </tbody>
                </table>
                </li>
            </ul>
        </div>
    <div role="tabpanel" class="tab-pane " id="home1">
        <ul><li>
        <table  class="display table table-condensed table-striped table-responsive"  style="width:100%">
                            <thead>
                            <tr  class="table-row">
                           
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            @for($i=0;$i< count($transferData);$i++)
                                <tr>  <td class="cell-row" >  {{$transferData[$i][0]}}</td>
                                    <td class="cell-row" >
                                          {{$transferData[$i][5]}}         
                                    </td>
                                  
                                      
                                    <td class="cell-row">{{$transferData[$i][3]}}</td>
                                  
                                    <td class="cell-row">{{$transferData[$i][4]}}</td>
                                    <td class="cell-row">{{$transferData[$i][2]}}</td>
                                     
                                </tr>
                              
                            @endfor
                            </tbody>
                        </table>
        </li></ul>
    </div>
</div>


@endsection

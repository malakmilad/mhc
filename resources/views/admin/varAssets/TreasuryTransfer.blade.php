@extends ('admin.layouts.app')

@section('title', 'تحويل من خزينة الى خزينة')

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
    <form action="{{ route('var_assets.transfer')}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="menuid" value="{{$menuid}}">
<div class="row">
        <div class="col-md-6 ">
            <div class="panel panel-default ">
                <div class="panel-body">
                    <label class="labl">من:</label>
                <br><br>
            <div class="row">
            <div class="form-group">
                <label class="labl">خزينة</label>
                <select name="varasset_from" class="form-control varasset_from" required>
                    <option value="" >اختار الخزينة او الحساب البنكى</option>
                    @foreach ($var_assets as $item)
                        @if($item->id==$varAsset->id)
                            <option value="{{$item->id}}" sum="{{$item->sum}}" selected>{{$item->name}}</option>
                        @else
                            <option value="{{$item->id}}" sum="{{$item->sum}}">{{$item->name}}</option>

                        @endif
                    @endforeach
                </select>

            </div>
            </div>
            <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="labl"> المبلغ</label>

            <input type="number" name="money_from" value="" class="form-control money_from" required min="1">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="labl"> المتاح قبل</label>

            <input type="number" name="money_before_from" value="{{$totalSelectedSafe}}" class="form-control money_before_from" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="labl"> المتاح بعد</label>

            <input type="number" name="money_after_from" value="" class="form-control money_after_from"/>
        </div>
    </div>
</div>
                </div>

        </div>
        </div>
        <div class="col-md-6 ">
        <div class="panel panel-default ">
            <div class="panel-body">
                <label class="labl">الى:</label>    <br><br>
                <div class="row">
                    <div class="form-group">
                        <label class="labl">خزينة</label>
                        <select name="varasset_to" class="form-control varasset_to" required>
                            <option value="" >اختار الخزينة او الحساب البنكى</option>
                            @foreach ($var_assets as $item)

                                    <option value="{{$item->id}}" sum="{{$item->sum}}">{{$item->name}}</option>


                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="labl"> المتاح قبل</label>

                            <input type="number" name="money_before_to" value="" class="form-control money_before_to"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="labl"> المتاح بعد</label>

                            <input type="number" name="money_after_to" value="" class="form-control money_after_to" />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="labl ">    تاريخ البداية</label>
                    <input type="date" name="start_date" class="form-control ">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="labl ">    وصف</label>
                    <input type="text" name="notes" class="form-control ">
                </div>
            </div>
        </div>


        <input type="submit" value="تحويل "  class="form-control save_trans add">

    </form>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).on('change',".varasset_to", function () {
   // alert($('.varasset_to').find('option').attr('sum'));
   // alert(this['sum']);
    alert(parseFloat($(this).children("option:selected").attr("sum")));
$('.money_before_to').val(parseFloat($(this).children("option:selected").attr("sum")));

});

$(document).on('change',".varasset_from", function () {
   // alert($('.varasset_to').find('option').attr('sum'));
   // alert(this['sum']);
    alert(parseFloat($(this).children("option:selected").attr("sum")));
$('.money_before_from').val(parseFloat($(this).children("option:selected").attr("sum")));

});
            $(document).on('change',".money_from", function () {
                if($(".varasset_to").val()=="")
                {
                alert("من فضلك اختار الخزينة");
            $(".money_from").val(0);
                }
                $('.money_after_from').val(parseFloat($('.money_before_from').val())-parseFloat($('.money_from').val()));

                $('.money_after_to').val(parseFloat($('.money_before_to').val())+parseFloat($('.money_from').val()));

            });

        });
    </script>
@endpush
@extends('layouts/app')
@section('title')
    Оплата
@endsection
@section('content')

    <form method="POST" action="https://www.liqpay.ua/api/3/checkout"
          accept-charset="utf-8">
        <input type="hidden" name="data" value="eyAidmVyc2lvbiIgOiAzLCAicHVibGljX2tleSIgOiAieW91cl9wdWJsaWNfa2V5IiwgImFjdGlv
biIgOiAicGF5IiwgImFtb3VudCIgOiAxLCAiY3VycmVuY3kiIDogIlVTRCIsICJkZXNjcmlwdGlv
biIgOiAiZGVzY3JpcHRpb24gdGV4dCIsICJvcmRlcl9pZCIgOiAib3JkZXJfaWRfMSIgfQ=="/>
        <input type="hidden" name="signature" value="QvJD5u9Fg55PCx/Hdz6lzWtYwcI="/>
        <input type="image"
               src="//static.liqpay.ua/buttons/payUk.png"/>
    </form>


@endsection

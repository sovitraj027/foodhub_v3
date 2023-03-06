<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
</head>
<style>
    * {
        margin: 0;
        padding: 0
    }

    body {
        background: #FFF;
        height: 100%;
        width: 100%;
        font-weight: 400;
        margin: 0;
        padding: 0;
        font-size: 14px;
        font-family: 'Open Sans', Arial, Helvetica, sans-serif
    }
</style>
<div style="margin:0 auto;padding:0;">
    <header
        style="background: rgba(14, 217, 17, 0.98);box-shadow: 0 2px 10px -2px rgba(0, 0, 0, 0.41);display: inline-block;line-height: 0;position: relative;width: 100%;z-index: 999;margin-bottom:20px;">
        <div style="width: 1100px;margin:0 auto;">
            <div style="margin: 12px 0;text-align:center;color:#fff;font-size:16px;"> <a href="{{ url('/') }}"
                    target="_blank"><img src="{{ URL::asset('upload/'.getcong('site_logo')) }}" alt=""></a> </div>
        </div>
    </header>
    <div style="width: 1100px;margin:0 auto;">
        <h2 style="color: #19b36b;font-size: 14px;font-weight: 600;padding:5px 10px;text-align:left;">Hi,</h2>
        <p style="padding:0 10px;margin: 0 0 10px;line-height:22px;color:#444"> {{ucfirst($data['fname'])}}! Your Esewa Payment has been successfully Done. Enjoy your Meal
            </p>
        <div style="clear:both">Paid Amount:- {{$data['amount']}} Thank You For choosing Us.</div>
    </div>
    <div style="clear:both"></div>
    <div style="background:#07d111;padding: 20px 0;margin-top:30px;text-transform: uppercase;">
        <div style="width: 1100px;margin:0 auto;">
            <p style="color: #fff;font-size: 13px;margin: 0;text-align: center;text-transform: none;">Copyright ©
                {{date('Y')}} {{getcong('site_name')}}. All rights reserved.</p>
        </div>
    </div>
    </body>

</html>
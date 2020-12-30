@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-12">
        <table border="0" cellpadding="0" cellspacing="0" style="margin:30px">
            <tr>
                <td>
                    <p style="color: Gray">
                        現在時間：
                        <span id="ctl00_ContentPlaceHolder1_loginDateTime" style="font-size:Small;">
                            <?php
                            date_default_timezone_set('Asia/Taipei');
                            echo date("Y/m/d h:i:s");
                            ?>
                        </span>
                        <br />
                        登入帳號：
                        <span id="ctl00_ContentPlaceHolder1_loginName" style="font-size:Small;">
                            {{ $user_name }}
                        </span>
                    </p>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection

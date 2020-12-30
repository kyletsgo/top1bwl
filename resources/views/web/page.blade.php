<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=768 ,user-scalable=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:title" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="">
    <meta property="og:type" content="website" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WireFrame</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/template/dist/css/index.min.css?v=20201201">
    <script src="/assets/template/src/js/layout/font.js"></script>
</head>

<body>
{!! $page_content !!}

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="/assets/template/src/js/layout/index.js"></script>
<script src="/assets/template/src/js/layout/swiper.js"></script>

<script src="/assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#myFormSubmit').click(function () {
            $.ajax({
                'type': "POST",
                'url': '/page/save_form',
                data: $('#myForm').serialize() + "&site_id=" + "{{ $site_id }}",
                dataType: 'json',
                success: function (_result) {
                    console.log(_result);
                    alert('表單送出成功');
                    location.reload();
                },
                error: function (e) {
                    console.log(e);
                }
            });
        });

    });
</script>

</body>

</html>
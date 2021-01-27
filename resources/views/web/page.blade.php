<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=768 ,user-scalable=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Meta -->
    <meta name="description" content="{{ $site->description }}">
    <meta name="keywords" content="{{ $site->og_meta }}">
    <meta property="og:title" content="{{ $site->title }}">
    <meta property="og:description" content="{{ $site->description }}">
    <meta property="og:type" content="website" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $site->title }}</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/template/dist/css/index.min.css?v=20201201">
    <script src="/assets/template/src/js/layout/font.js"></script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NL58F3J');</script>
    <!-- End Google Tag Manager -->
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

                    if (_result.code !== 0) {
                        alert('表單送出失敗');
                        return;
                    }

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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png" />
<title>{{ env('APP_NAME') }}</title>

<link rel="Stylesheet" type="text/css" href="{{ asset('assets/css/style.default.css') }}" />
<link rel="Stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}"/>
{{--<link rel="stylesheet" href="{{ asset('assets/css/awesome-bootstrap-checkbox.css') }}">--}}
{{--<link rel="stylesheet" href="{{ asset('assets/css/cropper.css')}}">--}}
<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui-1.10.3.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.cookies.js') }}"></script>
{{--<script src="{{ asset('assets/js/datepicker-en.js') }}"></script>--}}
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
{{--<script src="{{ asset('assets/js/bootstrap-clockpicker.min.js') }}"></script>--}}
{{--<link href="{{ asset('assets/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet" />--}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt"
	  crossorigin="anonymous">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="{{ asset('assets/js/html5shiv.js') }}"></script>
<script src="{{ asset('assets/js/respond.min.js') }}"></script>
<![endif]-->

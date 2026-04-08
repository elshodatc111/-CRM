<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="{{ asset('assets/img/logo1.png') }}" rel="icon">
  <link href="{{ asset('assets/img/logo1.png') }}" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo1.png') }}" alt="">
                <img class="d-none d-lg-block" src="{{ asset('assets/img/logo2.png') }}">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        @include('layouts.partials.header')
    </header>

    <aside id="sidebar" class="sidebar"><ul class="sidebar-nav" id="sidebar-nav">@include('layouts.partials.menu')</ul></aside>

    <main id="main" class="main">@yield('content')</main>
    
    <footer id="footer" class="footer">@include('layouts.partials.footer')</footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
    <script>
        $(".phone").inputmask("+998 99 999 9999");
        $(".phone2").inputmask("99 999 9999");
        $(".guvoxnoma_serya").inputmask("AAAA");
        $(".guvoxnoma_raqam").inputmask("999999999");
        $(".passport").inputmask("AA 9999999");
        
        $("#amount0").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#amount1").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#amount2").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#amount3").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#amount4").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#amount5").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});

        $("#price_0_1").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_0_2").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_0_3").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_0_4").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_0_5").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_0_6").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_0_7").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_0_8").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_0_9").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_0_10").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});

        $("#price_1_1").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_1_2").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_1_3").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_1_4").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_1_5").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_1_6").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_1_7").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_1_8").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_1_9").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_1_10").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});

        $("#price_2_1").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_2_2").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_2_3").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_2_4").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_2_5").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_2_6").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_2_7").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_2_8").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_2_9").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_2_10").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});

        $("#price_3_1").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_3_2").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_3_3").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_3_4").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_3_5").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_3_6").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_3_7").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_3_8").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_3_9").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#price_3_10").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});

        $("#item_oshpaz_1").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_2").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_3").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_4").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_5").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_6").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_7").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_8").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_9").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_10").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_11").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_12").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_13").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_14").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_15").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_16").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_17").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_18").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_19").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_20").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
        $("#item_oshpaz_21").inputmask({alias: "numeric",groupSeparator: " ",digits: 0,autoGroup: true,rightAlign: false,removeMaskOnSubmit: true});
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</body>

</html>
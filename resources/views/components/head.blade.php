@include('sweetalert::alert')
@php
    $config = DB::table('configs')->first();

           
            $service = DB::table('services')->get();
            $produit = DB::table('produits')->get();
        

@endphp
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('titre') - COACH BELLE</title>
    
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Storage::url($config->icon) }}">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180"href="{{ Storage::url($config->icon) }}">
    <link rel="icon" type="image/png" sizes="32x32"
    href="{{ Storage::url($config->icon) }}">
    <link rel="icon" type="image/png" sizes="16x16"
    href="{{ Storage::url($config->icon) }}">
    <link rel="manifest" href="{{ Storage::url($config->icon) }}">
    <meta name="description" content="COACH BELLE" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/animate/custom-animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/jarallax/jarallax.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/odometer/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/swiper/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/eventflow-icons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/bootstrap-select/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/nice-select/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/vendors/jquery-ui/jquery-ui.css') }}">

    <!-- Template Styles -->
    <link rel="stylesheet" href="{{ asset('/front/assets/css/eventflow.css') }}">
    <link rel="stylesheet" href="{{ asset('/front/assets/css/eventflow-responsive.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

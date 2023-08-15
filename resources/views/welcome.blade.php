<!DOCTYPE html>

<html lang="en" class="light theme-1">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="{{asset('images/icons/icon-72x72.png')}}" rel="shortcut icon">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('images/icons/icon-72x72.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A medical online application">
    <meta name="keywords" content="">
    <meta name="author" content="Damilare Odusanya">
    <title>Dashboard - Medpremises - A medical platform</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{asset('dist/css/app.css')}}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <!-- END: CSS Assets-->
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyD7y4c0913bWCgZmQzTn_yeHW2kr3eG0xU">
    </script>

</head>
<style>
    html body {
        -webkit-font-smoothing: antialiased;
        overflow-x: hidden;
        padding: 0.75rem 1.0rem;
        font-family: Roboto;
        font-size: .875rem;
        line-height: 1.25rem;
        opacity: 1;
        color: rgba(45, 55, 72);
        background: #f2f2f2f !important;
    }
</style>
<!-- END: Head -->

<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <!-- BEGIN: JS Assets-->

    <script src="{{ asset('js/app.js?version='.date(" ymdhis").'') }}"></script>
    <script
        src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>


    <script src="{{asset('dist/js/app.js')}}"></script>
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("/sw.js").then(function (reg) {
                    console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
    </script>

</body>

</html>
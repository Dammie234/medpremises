<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   

    <title>{{$data['customer_name']}} Laboratory Test</title>
  </head>
  <body>
    <style>
        
        .container{
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        
        @media (min-width: 576px) {
            .container, .container-sm {
            max-width: 540px;
            }
        }
        
        @media (min-width: 768px) {
            .container, .container-sm, .container-md {
            max-width: 720px;
            }
        }
        
        @media (min-width: 992px) {
            .container, .container-sm, .container-md, .container-lg {
            max-width: 960px;
            }
        }
        
        @media (min-width: 1200px) {
            .container, .container-sm, .container-md, .container-lg, .container-xl {
            max-width: 1140px;
            }
        }
  
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
          }
        .col-12{
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }
        .col-md-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
          }
          .col-md-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
          }
          .col-md-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%;
          }
          .col-md-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
          }
          .col-md-4, .col-md-8, .col-md-3, .col-md-6{
            position: relative;
            width: 100%;;
            
          }
          .text-center{
              text-align: center;
          }
          .img-fluid {
            max-width: 100%;
            height: auto;
          }
          .border-bottom {
            border-bottom: 1px solid #dee2e6 !important;
          }
          .py-2{
              padding: 20px 0px;
          }
          .pl-3{
              padding-left: 30px;
          }
          body{
              padding: 0px;
              margin: 0px;
              font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
              font-size: 16px;
          }
          .display-4{
              font-size: 35px;
              font-weight: 100;
          }
          .justify-content-between {
            -ms-flex-pack: justify !important;
            justify-content: space-between !important;
          }
          .mt-2{
              margin-top: 20px;
          }
          .fixed-bottom {
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1030;
          }
          .border-top {
            border-top: 1px solid #dee2e6 !important;
          }
          
    </style>
    <header class="container my-3 border-bottom py-2">
        <div class="row">
            <div class="col-md-4">
                <img src="https://www.sparksuite.com/images/logo.png" class="img-fluid" />
            </div>
            <div class="col-md-8">
                <h1 class="display-4 pl-3" style="margin-top:0px;">{{$data['registered_facility_name']}}</h1>
            </div>
        </div>
    </header>
    <section class="container">
        <div class="row justify-content-between mt-2">
            <div class="col-12 col-md-4">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td>Customer Name:</td>
                            <td><h4>{{$data['customer_name']}}</h4></td>
                        </tr>
                        <tr>
                            <td>Email Address:</td>
                            <td>{{$data['customer_email']}}</td>
                        </tr>
                        <tr>
                            <td>Phone Number (Mobile):</td>
                            <td>{{$data['customer_phone']}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td>Delivered By:</td>
                            <td>{{$data['delivered_by']}}</td>
                        </tr>
                        <tr>
                            <td>Delivered Date:</td>
                            <td>{{date('L j F, Y', strtotime($data['delivered_date']))}}</td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
        <div class="row my-3 ">
            <div class="col-12 col-md-12 border-bottom">
                <h2 class="text-center display-4" style="font-size: 30px;">{{$data['test_name']}} Medical Diagnostic / Laboratory Test Report</h2>
            </div>
            <div class="col-12 col-md-12 my-2">
                <h4>Result</h4>
                {{$data['test_result']}}
                <?php if(isset($data['images'])): ?>
                <h4 class="mt-4">Images</h4>
                <div class="row mt-2">
                    <?php foreach($data['images'] as $image): ?>
                        <div class="col-12 col-md-6">Coming Soon</div>
                    <?php endforeach ?>
                </div>
                <?php endif ?>
            </div>
            
        </div>
    </section>
    <footer class="fixed-bottom">
        <div class="container border-top">
            <div class="row my-3">
                <div class="col-12 text-center py-2" >
                    Address: {{$data['facility_location']}}, {{$data['postal_code']}} |  E-mail Address: {{$data['facility_email']}} | Phone Number:  {{$data['facility_phone']}}
                </div>
                
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  </body>
</html>
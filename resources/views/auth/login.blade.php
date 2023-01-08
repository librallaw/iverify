<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <title>
        Login
    </title>


    <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard-pro" />

  

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900%7CRoboto+Slab:400,700" />

    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link id="pagestyle" href="/assets/css/material-dashboard.min-v=3.0.6.css" rel="stylesheet" />

    <style>
        .async-hide {
            opacity: 0 !important
        }
    </style>




</head>
<body class="bg-gray-200">


<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>



<main class="main-content  mt-0">

    <div class="container mb-4" style="margin-top: 200px;">
        <div class="row mt-lg-n12 mt-md-n12 mt-n12 justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card mt-8">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg py-3 pe-1 text-center py-4">
                            <h4 class="font-weight-bolder text-white mt-1">Sign In</h4>
                            <p class="mb-1 text-sm text-white">Enter your email and password to Sign In</p>
                        </div>
                    </div>
                    <div class="card-body">
                        @include("alert")
                        <form role="form" method="post" action="/login" class="text-start">
                            @csrf
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Username / Email</label>
                                <input type="text" name="username" value="{{old('username')}}" class="form-control">
                            </div>


                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">Password</label>
                                <input type="password"  name="password" class="form-control">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Sign in</button>
                            </div>

                        </form>
                    </div>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                        <p class="mb-4 text-sm mx-auto">
                            Don't have an account?
                            <a href="/register" class="text-info text-gradient font-weight-bold">Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer position-absolute bottom-2 py-2 w-100"></footer>
</main>

<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>
<script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>

<script src="/assets/js/plugins/dragula/dragula.min.js"></script>
<script src="/assets/js/plugins/jkanban/jkanban.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="/assets/js/material-dashboard.min-v=3.0.6.js"></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"77527ee029a01c81","version":"2022.11.3","r":1,"token":"1b7cbb72744b40c580f8633c6b62637e","si":100}' crossorigin="anonymous"></script>
</body>
</html>



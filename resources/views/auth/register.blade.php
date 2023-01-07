

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <title>
        Register
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
            <div class="col-xl-6 col-lg-6 col-md-7 mx-auto">
                <div class="card mt-8">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg py-3 pe-1 text-center py-4">
                            <h4 class="font-weight-bolder text-white mt-1">Create New Account</h4>
                            <p class="mb-1 text-sm text-white">  <div class="alert alert-warning"><strong>NOTE:</strong>  Only CAC registered companies can subscribe to the service. And only the directors names as listed in the CAC document can act as the company representative</div></p>
                        </div>
                    </div>
                    <div class="card-body">
                        @include("alert")

                        <form method="post" action="">

                            @csrf

                            <div class="input-group input-group-outline mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" required placeholder="Enter your Organisation Name" />
                            </div>

                            <div class="input-group input-group-outline mb-3 mt-4">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email"  {{old('email')}}required placeholder="Email Address" required />
                            </div>

                            <div class="input-group input-group-outline mb-3 mt-4">
                                <label>Business/Company</label>
                                <input type="text" class="form-control" name="username" {{old('username')}} required placeholder="Enter your  Business/Company"/>
                            </div>

                            <div class="input-group input-group-outline mb-3 mt-4">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" {{old('phone')}} required placeholder="Enter your phone number"/>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required placeholder="Enter your password"  />
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <label>Confirm Password</label><br />
                                <input type="password" class="form-control" name="confirm_password" required placeholder="Confirm your password" />
                            </div>

                            <div class="btn-group mt-3 w-100">

                                <button type="submit"  class="btn btn-light btn-block">Register</button>
                                <button type="submit" class="btn btn-light"><i class="lni lni-arrow-right"></i>
                                </button>

                            </div>

                        </form>
                    </div>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                        <p class="mb-4 text-sm mx-auto">
                            Already have an account?
                            <a href="/login" class="text-info text-gradient font-weight-bold">Sign in</a>
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

</body>
</html>














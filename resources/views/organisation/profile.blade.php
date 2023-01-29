

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      I verify
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />


    <meta property="og:site_name" content="Creative Tim" />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700%7CRoboto+Slab:400,700%7CMaterial+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <link href="/assets/css/material-dashboard.min-v=2.1.2.css" rel="stylesheet" />

    <link href="/assets/demo/demo.css" rel="stylesheet" />


</head>
<body class="">


<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<div class="wrapper ">
@include("inc.sidebar")

    <div class="main-panel">

        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:;">Profile</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">

                    <ul class="navbar-nav">
                        <li class="nav-item"></li>
                        <li class="nav-item dropdown"></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                               
                                <a class="dropdown-item" href="#">Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="">
                <div class="container-fluid">

                    @include("alert")


                    <div class="row">




                        <div class="col-md-6">
                            <div class="card card-pricing">
                                <div class="card-header card-header-info card-header-icon">
                                    <div class="card-icon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <h4 class="card-title"> Wallet Credit(s)</h4>
                                </div>

                                <div class="card-body">
                                    <h3 class="">{{$main}}</h3>
                                </div>


                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="card card-pricing">
                                <div class="card-header card-header-warning card-header-icon">
                                    <div class="card-icon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <h4 class="card-title">Sub Wallet Credit(s)</h4>
                                </div>


                                <div class="card-body">
                                    <h3 class="">{{$balance}}</h3>
                                </div>


                            </div>

                        </div>



                        <div class="col-md-6">

                            <div class="card card-pricing">
                                <div class="card-header card-header-success card-header-icon">
                                    <div class="card-icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <h4 class="card-title">Add Credit</h4>
                                </div>





                                <div class="card-body">




                                    <form method="post" action="{{route("doCreditWalletOrg")}}">
                                        @csrf
                                        <div class="input-group input-group-dynamic my-3">
                                            <label class="form-label">Amount of credits</label>
                                            <input type="number" name="amount" min="0" class="form-control"
                                                   id="smscr-amountofcredits" required>
                                        </div>

                                        <div class="input-group input-group-dynamic my-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                   id="" required>
                                            <input type="hidden"
                                                   name="orgid" value="{{$account->unique_id}}" >
                                        </div>



                                        <button type="submit" class="btn btn-success" > Top Up
                                        </button>
                                    </form>
                                </div>

                            </div>


                        </div>


                        <div class="col-md-6">

                            <div class="card card-pricing">
                                <div class="card-header card-header-danger card-header-icon">
                                    <div class="card-icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <h4 class="card-title">Withdraw Credit</h4>
                                </div>





                                <div class="card-body">




                                    <form method="post" action="{{route("doWithdrawWalletOrg")}}">
                                        @csrf
                                        <div class="input-group input-group-dynamic my-3">
                                            <label class="form-label">Amount of credits</label>
                                            <input type="number" name="amount" min="0" class="form-control"
                                                   id="smscr-amountofcredits" required>
                                        </div>

                                        <div class="input-group input-group-dynamic my-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                   id="" required>
                                            <input type="hidden"
                                                   name="orgid" value="{{$account->unique_id}}" >
                                        </div>



                                        <button type="submit" class="btn  btn-danger" > Withdraw
                                        </button>
                                    </form>
                                </div>

                            </div>


                        </div>


                        <div class="col-md-6">


                            <div class="card card-pricing">





                                <div class="alert alert-rose">Edit
                                    Organisation Profile</div>

                                <div class="card-body">




                                    <div>
                                        <form method="post" action="{{route("doEditOrganisation")}}">
                                            @csrf
                                            <div class="input-group input-group-dynamic my-3">
                                                <label for="exampleEmail" class="form-label">Name</label>
                                                <input type="text" name="name"value="{{$account->name}}"
                                                       class="form-control"
                                                       id="examepleEmail">
                                            </div>


                                            <div class="input-group input-group-dynamic my-3">
                                                <label for="exampleEmail" class="form-label">Email</label>
                                                <input type="email" name="email" value="{{$account->email}}" class="form-control" id="examwpleEmail">
                                            </div>

                                            <div class="input-group input-group-dynamic my-3">
                                                <label for="exampleEmail" class="form-label">Phone</label>
                                                <input type="text" name="phone" value="{{$account->phone}}" class="form-control" id="examwpleEmail" >
                                            </div>
                                            <div class="input-group input-group-dynamic my-3">
                                                <label for="exampleEmail" class="form-label">Username</label>
                                                <input type="text" name="username"
                                                       value="{{$account->unique_id}}"  class="form-control"
                                                       id="exampleEemail" disabled="">

                                                <input type="hidden"
                                                       name="orgid" value="{{$account->unique_id}}" >
                                            </div>


                                            <div class="card-footer ">
                                                <button type="submit" class="btn btn-fill
                                                            btn-danger">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>

                    @if($account->active == 0)
                        <a href="{{route("ActivateOrganisationUser",['orgid'=>$account->unique_id])}}"><button class="btn btn-success">Click here to Activate</button></a>
                    @endif
                    @if($account->active == 1)
                        <br />
                        <a href="{{route("ActivateOrganisationUser",['orgid'=>$account->unique_id])}}"><button class="btn btn-danger">Click here to Deactivate</button></a>
                    @endif





                </div>
            </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left"></nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, made with <i class="material-icons">favorite</i>

                </div>
            </div>
        </footer>
    </div>
</div>

<script src="/assets/js/core/jquery.min.js"></script>
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap-material-design.min.js"></script>
<script src="/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

<script src="/assets/js/plugins/moment.min.js"></script>

<script src="/assets/js/plugins/sweetalert2.js"></script>

<script src="/assets/js/plugins/jquery.validate.min.js"></script>

<script src="/assets/js/plugins/jquery.bootstrap-wizard.js"></script>

<script src="/assets/js/plugins/bootstrap-selectpicker.js"></script>

<script src="/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>

<script src="/assets/js/plugins/jquery.dataTables.min.js"></script>

<script src="/assets/js/plugins/bootstrap-tagsinput.js"></script>

<script src="/assets/js/plugins/jasny-bootstrap.min.js"></script>

<script src="/assets/js/plugins/fullcalendar.min.js"></script>

<script src="/assets/js/plugins/jquery-jvectormap.js"></script>

<script src="/assets/js/plugins/nouislider.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<script src="/assets/js/plugins/arrive.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>

<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="/assets/js/plugins/chartist.min.js"></script>

<script src="/assets/js/plugins/bootstrap-notify.js"></script>

<script src="/assets/js/material-dashboard.min-v=2.1.2.js" type="text/javascript"></script>

<script src="/assets/demo/demo.js"></script>
<script>
    $(document).ready(function() {
        $().ready(function() {
            $sidebar = $('.sidebar');

            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                    $('.fixed-plugin .dropdown').addClass('open');
                }

            }

            $('.fixed-plugin a').click(function(event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .active-color span').click(function() {
                $full_page_background = $('.full-page-background');

                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });

            $('.fixed-plugin .background-color .badge').click(function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('background-color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-background-color', new_color);
                }
            });

            $('.fixed-plugin .img-holder').click(function() {
                $full_page_background = $('.full-page-background');

                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');


                var new_image = $(this).find("img").attr('src');

                if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function() {
                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }

                if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $full_page_background.fadeOut('fast', function() {
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }

                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });

            $('.switch-sidebar-image input').change(function() {
                $full_page_background = $('.full-page-background');

                $input = $(this);

                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                }
            });

            $('.switch-sidebar-mini input').change(function() {
                $body = $('body');

                $input = $(this);

                if (md.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    md.misc.sidebar_mini_active = false;

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                } else {

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                    setTimeout(function() {
                        $('body').addClass('sidebar-mini');

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function() {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function() {
                    clearInterval(simulateWindowResize);
                }, 1000);

            });
        });
    });
</script>

<script src="/assets/demo/jquery.sharrre.js"></script>
<script>
    $(document).ready(function() {

        $('#facebook').sharrre({
            share: {
                facebook: true
            },
            enableHover: false,
            enableTracking: false,
            enableCounter: false,
            click: function(api, options) {
                api.simulateClick();
                api.openPopup('facebook');
            },
            template: '<i class="fab fa-facebook-f"></i> Facebook',
            url: 'https://demos.creative-tim.com/material-dashboard/examples/dashboard.html'
        });

        $('#google').sharrre({
            share: {
                googlePlus: true
            },
            enableCounter: false,
            enableHover: false,
            enableTracking: true,
            click: function(api, options) {
                api.simulateClick();
                api.openPopup('googlePlus');
            },
            template: '<i class="fab fa-google-plus"></i> Google',
            url: 'https://demos.creative-tim.com/material-dashboard/examples/dashboard.html'
        });

        $('#twitter').sharrre({
            share: {
                twitter: true
            },
            enableHover: false,
            enableTracking: false,
            enableCounter: false,
            buttons: {
                twitter: {
                    via: 'CreativeTim'
                }
            },
            click: function(api, options) {
                api.simulateClick();
                api.openPopup('twitter');
            },
            template: '<i class="fab fa-twitter"></i> Twitter',
            url: 'https://demos.creative-tim.com/material-dashboard/examples/dashboard.html'
        });



        // Facebook Pixel Code Don't Delete
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
            document, 'script', '//connect.facebook.net/en_US/fbevents.js');

        try {
            fbq('init', '111649226022273');
            fbq('track', "PageView");

        } catch (err) {
            console.log('Facebook Track Error:', err);
        }

    });
</script>
<script>
    // Facebook Pixel Code Don't Delete
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window,
        document, 'script', '//connect.facebook.net/en_US/fbevents.js');

    try {
        fbq('init', '111649226022273');
        fbq('track', "PageView");

    } catch (err) {
        console.log('Facebook Track Error:', err);
    }
</script>
<noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
</noscript>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

    });
</script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      I verify || All Users
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
                    <a class="navbar-brand" href="javascript:;">All Users</a>
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
            <div class="container-fluid">

                @if(Auth::user()->level == 1)
                <div class="row">
                    <div class="col-md-3">
                        <input type="search" id="search" class="form-control" placeholder="search" style="border: 1px solid #ccc;">
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header card-header-warning">
                                <h4 class="card-title">All Organisation</h4>
                                
                            </div>
                            <nav class="card-body table-responsive">

                                <div id="search_result2" style="display:none;">
                                    <table id="" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Org Id</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>email</th>
                                            <th>password</th>
                                            <th>Balance</th>
                                            <th>Date Created</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody id="search_result_body">

                                        <div align="center" id="spin_spin">
                                            <i class="text-danger fa fa-spin fa-spinner"></i>

                                        </div>

                                        </tbody>


                                    </table>
                                </div>

                                @if(count($organisations) > 0)
                                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Org Id</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>email</th>
                                            <th>phone</th>
                                            <th>password</th>
                                            <th>Balance</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>




                                        @php $x = 1 @endphp
                                        @foreach($organisations as $organisation)

                                            <tr>
                                                <td>{{$x++}}</td>
                                                <td>{{$organisation->unique_id}}</td>
                                                <td>{{$organisation->name}}</td>
                                                <td>{{$organisation->unique_id}}</td>
                                                <td>{{$organisation->email}}</td>
                                                <td>{{$organisation->phone}}</td>
                                                <td>{{$organisation->plain}}</td>

                                                <td>
                                                    <strong class="">{{$organisation->balance}}</strong>
                                                </td>

                                                <td>
                                                    @if($organisation->active ==1)
                                                    <span class="btn btn-success">Active</span>
                                                    @endif

                                                        @if($organisation->active ==0)
                                                            <span class="btn btn-danger">InActive</span>
                                                        @endif
                                                </td>
                                                <td>{{$organisation->created_at}}</td>
                                                <td class="td-actions text-right">
                                                    <a href="{{route("showOrganisationProfile",['orgid'=>$organisation->unique_id])}}" ><button
                                                                type="button"
                                                                rel="tooltip" class="btn
                                               btn-warning"
                                                                data-original-title="" title="">
                                                            <i class="fa fa-eye"></i>
                                                            <div class="ripple-container"></div></button></a>


                                                </td>
                                            </tr>
                            @endforeach

                        </div>
                        </tbody>
                        </table>





                        {{$organisations->links()}}

                        @else
                            <div class="pt-3 pr-3 pl-3">
                                <div class="alert alert-danger col-12 text-center" role="alert">
                                    No data found
                                </div>
                            </div>
                        @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       @include("inc.footer")
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

@if(Auth::user()->level == 1)
<script>

    var term = document.getElementById("search").value


    //term.onclick(alert("ssss"));



    function addTextAreaCallback(textArea, delay) {
        var timer = null;
        textArea.onkeydown = function() {
            if (timer) {
                window.clearTimeout(timer);
            }
            timer = window.setTimeout( function() {
                timer = null;
                doSearch();
            }, delay );
        };
        textArea = null;
    }

    addTextAreaCallback( document.getElementById("search"), 1000 );





    function doSearch (){

        var search  = document.getElementById("search").value;

        if(search != ""){

            // alert(search)

            var formData = {

                'search'     : search,
            };



            jQuery("#datatables").hide(500);

            jQuery("#search_result2").show();



            jQuery.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : '/search', // the url where we want to POST
                data        : formData,
                dataType    : 'json', // what type of data do we expect back from the server
                encode          : true
            })

            //
            // using the done promise callback
                .done(function(data) {
                    console.log(data)

                    if(data.status ) {

                        var daa = "";

                        for(var i = 0; i < data.data.length; i++){

                            daa += `<tr>
                                                <td>${i + 1}</td>
                                                <td>${data.data[i].unique_id}</td>
                                                <td>${data.data[i].name}</td>
                                                <td>${data.data[i].username}</td>
                                                <td>${data.data[i].email}</td>
                                                <td>${data.data[i].plain}</td>

                                                <td>
                                                    <span class="alert alert-info">${data.data[i].balance}</span>
                                                </td>
                                                <td>${data.data[i].created_at}</td>
                                                <td class="td-actions text-right">
                                                    <a href="/users/view/${data.data[i].unique_id}" ><button
                                                                type="button"
                                                                rel="tooltip" class="btn
                                               btn-info"
                                                                data-original-title="" title="">
                                                           view
                                                            <div class="ripple-container"></div></button></a>


                                                </td>
                                            </tr>`

                        }

                        jQuery("#search_result_body").html(daa)
                        jQuery("#spin_spin").hide()




                    }else{
                        // alert("dom")
                        alert("an error occurred")
                    }
                });

        }else{



            jQuery("#datatables").show(700);

            jQuery("#search_result2").hide(500);
        }


    };

</script>

@endif
</body>
</html>
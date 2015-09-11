<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{url('images/bankMlogoOnly.png')}}">

    <!--=== CSS ===-->

    <!-- Bootstrap -->
    {!!HTML::style('bootstrap/css/bootstrap.min.css')!!}

    <!-- jQuery UI -->
    <!--<link href="plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
    <!--[if lt IE 9]>
    {!!HTML::style('plugins/jquery-ui/jquery.ui.1.10.2.ie.css') !!}
    <![endif]-->

    <!-- Theme -->
    {!!HTML::style('assets/css/main.css')!!}
    {!!HTML::style("assets/css/plugins.css" )!!}
    {!!HTML::style("assets/css/responsive.css" )!!}
    {!!HTML::style("assets/css/icons.css")!!}

    {!!HTML::style("assets/css/fontawesome/font-awesome.min.css")!!}
    <!--[if IE 7]>
    {!!HTML::style("assets/css/fontawesome/font-awesome-ie7.min.css")!!}
    <![endif]-->

    <!--[if IE 8]>
    {!!HTML::style("assets/css/ie8.css")!!}
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>

    <!--=== JavaScript ===-->

    {!!HTML::script("assets/js/libs/jquery-1.10.2.min.js") !!}
    {!!HTML::script("plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js") !!}
    {!!HTML::script("plugins/sparkline/jquery.sparkline.min.js") !!}

    {!!HTML::script("bootstrap/js/bootstrap.min.js") !!}
    {!!HTML::script("assets/js/libs/lodash.compat.min.js") !!}

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    {!!HTML::script("assets/js/libs/html5shiv.js") !!}
    <![endif]-->

    <!-- Smartphone Touch Events -->
    {!!HTML::script("plugins/touchpunch/jquery.ui.touch-punch.min.js") !!}
    {!!HTML::script("plugins/event.swipe/jquery.event.move.js") !!}
    {!!HTML::script("plugins/event.swipe/jquery.event.swipe.js") !!}

    <!-- General -->
    {!!HTML::script("assets/js/libs/breakpoints.js") !!}
    {!!HTML::script("plugins/respond/respond.min.js") !!} <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
    {!!HTML::script("plugins/cookie/jquery.cookie.min.js") !!}
    {!!HTML::script("plugins/slimscroll/jquery.slimscroll.min.js") !!}
    {!!HTML::script("plugins/slimscroll/jquery.slimscroll.horizontal.min.js") !!}

    <!-- Page specific plugins -->
    @yield('pagescripts')
    <!-- Charts -->
    <!--[if lt IE 9]>
    {!!HTML::script("plugins/flot/excanvas.min.js")!!}
    <![endif]-->

    {!!HTML::script("plugins/flot/jquery.flot.min.js")!!}
    {!!HTML::script("plugins/flot/jquery.flot.tooltip.min.js")!!}
    {!!HTML::script("plugins/flot/jquery.flot.resize.min.js")!!}
    {!!HTML::script("plugins/flot/jquery.flot.time.min.js")!!}
    {!!HTML::script("plugins/flot/jquery.flot.growraf.min.js")!!}
    {!!HTML::script("plugins/easy-pie-chart/jquery.easy-pie-chart.min.js")!!}

    {!!HTML::script("plugins/daterangepicker/moment.min.js")!!}
    {!!HTML::script("plugins/daterangepicker/daterangepicker.js")!!}
    {!!HTML::script("plugins/blockui/jquery.blockUI.min.js")!!}

    {!!HTML::script("plugins/fullcalendar/fullcalendar.min.js")!!}
    <!-- Pickers -->
    {!! HTML::script("plugins/pickadate/picker.js" )!!}
    {!! HTML::script("plugins/pickadate/picker.date.js" )!!}
    {!! HTML::script("plugins/pickadate/picker.time.js" )!!}
    {!! HTML::script("plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js" )!!}


    <!-- Noty -->
    {!!HTML::script("plugins/noty/jquery.noty.js")!!}
    {!!HTML::script("plugins/noty/layouts/top.js")!!}
    {!!HTML::script("plugins/noty/themes/default.js")!!}

    <!-- Forms -->
    {!!HTML::script("plugins/uniform/jquery.uniform.min.js")!!} <!-- Styled radio and checkboxes -->
    {!!HTML::script("plugins/select2/select2.min.js")!!} <!-- Styled select boxes -->
    {!!HTML::script("plugins/fileinput/fileinput.js")!!}

    <!-- Form Validation -->
    {!!HTML::script("plugins/validation/jquery.validate.min.js")!!}
    {!!HTML::script("plugins/validation/additional-methods.min.js")!!}

    <!-- App -->
    {!!HTML::script("assets/js/app.js")!!}
    {!!HTML::script("assets/js/plugins.js")!!}
    {!!HTML::script("assets/js/plugins.form-components.js")!!}

    <script>
        $(document).ready(function(){
            "use strict";

            App.init(); // Init layout and core plugins
            Plugins.init(); // Init all plugins
            FormComponents.init(); // Init all form-specific plugins


            // Sample Data
            var d1 = [[1262304000000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '01')->get();
                    ?>{{count($capp)}}], [1264982400000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '02')->get();
                    ?>{{count($capp)}}], [1267401600000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '03')->get();
                    ?>{{count($capp)}}], [1270080000000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '04')->get();
                    ?>{{count($capp)}}], [1272672000000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '05')->get();
                    ?>{{count($capp)}}], [1275350400000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '06')->get();
                    ?>{{count($capp)}}], [1277942400000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '07')->get();
                    ?>{{count($capp)}}], [1280620800000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '08')->get();
                    ?>{{count($capp)}}], [1283299200000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '09')->get();
                    ?>{{count($capp)}}], [1285891200000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '10')->get();
                    ?>{{count($capp)}}], [1288569600000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '11')->get();
                    ?>{{count($capp)}}], [1291161600000, <?php
                    $cyear=date('Y');
                    $capp=\App\CreditApp::where(DB::raw('YEAR(created_at)'), '=', $cyear)->where(DB::raw('MONTH(created_at)'), '=', '12')->get();
                    ?>{{count($capp)}}]];

            var data1 = [
                { label: "Credit Application", data: d1, color: App.getLayoutColorCode('blue') }
            ];

            $.plot("#chart_filled_blue", data1, $.extend(true, {}, Plugins.getFlotDefaults(), {
                xaxis: {
                    min: (new Date(2009, 12, 1)).getTime(),
                    max: (new Date(2010, 11, 2)).getTime(),
                    mode: "time",
                    tickSize: [1, "month"],
                    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    tickLength: 0
                },
                series: {
                    lines: {
                        fill: true,
                        lineWidth: 1.5
                    },
                    points: {
                        show: true,
                        radius: 2.5,
                        lineWidth: 1.1
                    },
                    grow: { active: true, growings:[ { stepMode: "maximum" } ] }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },
                tooltip: true,
                tooltipOpts: {
                    content: '%s: %y'
                }
            }));


        });
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-3d'
        });
    </script>

    <!-- Demo JS -->
    {!!HTML::script("assets/js/custom.js")!!}
    {!!HTML::script("assets/js/demo/pages_calendar.js")!!}
    {!!HTML::script("assets/js/demo/charts/chart_simple.js")!!}
    {!!HTML::script("assets/js/demo/form_validation.js")!!}

    {!!HTML::script("assets/js/tinymce/tinymce.min.js")!!}
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists   charmap   anchor",
                "insertdatetime  contextmenu paste"
            ],
            toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent "
        });
    </script>
    {!!HTML::script("assets/js/datepicker/js/bootstrap-datepicker.js")!!}
    <script>
        $('.datepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: '+5d',
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd"
        });
    </script>
</head>

<body>

<!-- Header -->
<header class="header navbar navbar-fixed-top" role="banner">
    <!-- Top Navigation Bar -->
    <div class="container">

        <!-- Only visible on smartphones, menu toggle -->
        <ul class="nav navbar-nav">
            <li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
        </ul>

        <!-- Logo -->
        <a class="navbar-brand" href="home">
            {!! HTML::image("assets/img/logo.png")!!}
             <strong>BANK (M) PORTAL</strong>
         </a>
         <!-- /logo -->

         <!-- Sidebar Toggler -->
         <a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation">
             <i class="icon-reorder"></i>
         </a>
         <!-- /Sidebar Toggler -->

         <!-- Top Left Menu -->
         <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
             <li>
                 <a href="{{url('home')}}">
                    Dashboard
                </a>
            </li>

        </ul>
        <!-- /Top Left Menu -->

        <!-- Top Right Menu -->
        <ul class="nav navbar-nav navbar-right">

            <!-- User Login Dropdown -->
            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!--<img alt="" src="assets/img/avatar1_small.jpg" />-->
                    <i class="icon-male"></i>
                    <span class="username"> {{$user= Auth::user()->firstname . " ". $user= Auth::user()->lastname}} </span>
                    <i class="icon-caret-down small"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('profile')}}"><i class="icon-user"></i> My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="{{url('logout')}}"><i class="icon-key"></i> Log Out</a></li>
                </ul>
            </li>
            <!-- /user login dropdown -->
        </ul>
        <!-- /Top Right Menu -->
    </div>
    <!-- /top navigation bar -->

</header> <!-- /.header -->

<div id="container">
    <div id="sidebar" class="sidebar-fixed">
        <div id="sidebar-content">


            <!--=== Navigation ===-->
            <ul id="nav">
                <li class="current">
                    <a href="{{url('home')}}">
                        <i class="icon-dashboard"></i>
                        Dashboard
                    </a>
                </li>
                @if(Auth::user()->role=="Inputer" || Auth::user()->role=="Administrator" || Auth::user()->role=="Authorizer")
                <li>
                    <a href="javascript:void(0);">
                        <i class="icon-edit"></i>
                       Customers
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{url('customers/create')}}">
                                <i class="icon-angle-right"></i>
                                 New Customer
                            </a>

                        </li>
                        <li>
                            <a href="{{url('customers')}}">
                                <i class="icon-angle-right"></i>
                               Manage Customers
                            </a>
                        </li>
                    </ul>
                </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="icon-edit"></i>
                            Credit Application
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{url('customers/credit-proposal/create')}}">
                                    <i class="icon-angle-right"></i>
                                    New Application
                                </a>
                            </li>
                            <li>
                                <a href="{{url('cap-manage')}}">
                                    <i class="icon-angle-right"></i>
                                    Manage Application
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif
                @if(Auth::user()->role=="Administrator" || Auth::user()->role=="Inputer")
                    <li>
                        <a href="javascript:void(0);">
                            <i class="icon-cogs"></i>
                            CREDIT SETTINGS
                        </a>
                        <ul class="sub-menu">
                            <li class="open-default">
                                <a href="{{url('department')}}">
                                    <i class="icon-cogs"></i>
                                    Setup Credit Department
                                    <span class="arrow"></span>
                                </a>

                            </li>
                            <li class="open-default">
                                <a href="{{url('committee')}}">
                                    <i class="icon-cogs"></i>
                                    Setup Credit Committee
                                    <span class="arrow"></span>
                                </a>

                            </li>
                            <li class="open-default">
                                <a href="{{url('directors')}}">
                                    <i class="icon-cogs"></i>
                                    Setup Credit Director
                                    <span class="arrow"></span>
                                </a>

                            </li>
                            <li class="open-default">
                                <a href="{{url('legal-entity')}}">
                                    <i class="icon-cogs"></i>
                                    Setup Legal Entity
                                    <span class="arrow"></span>
                                </a>

                            </li>
                            <li class="open-default">
                                <a href="{{url('serialno')}}">
                                    <i class="icon-cog"></i>
                                    Setup Serial Number
                                    <span class="arrow"></span>
                                </a>

                            </li>
                            <li class="open-default">
                                <a href="{{url('currency')}}">
                                    <i class="icon-usd text-warning"></i>
                                    Setup Currency
                                    <span class="arrow"></span>
                                </a>

                            </li>



                        </ul>
                    </li>
                @endif

                @if( \App\Http\Controllers\UserController::checkReportAccess(Auth::user()->id,3,1) )
                <li>
                    <a href="javascript:void(0);">
                        <i class="icon-bar-chart"></i>
                       General Reports
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{url('reports')}}">

                                <i class="icon-bar-chart"></i>
                               Credit Application Reports
                                <span class="arrow"></span>
                            </a>

                        </li>


                    </ul>
                </li>
                @endif
                @if(Auth::user()->role=="Administrator")
                <li>
                    <a href="javascript:void(0);">
                        <i class="icon-cog"></i>
                        User Management
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{url('users')}}">

                                <i class="icon-group"></i>
                                 User Administration
                                <span class="arrow"></span>
                            </a>

                        </li>


                    </ul>
                </li>
                @endif

                <li>
                    <a href="javascript:void(0);">
                        <i class="icon-male"></i>
                        Profile
                    </a>
                    <ul class="sub-menu">

                        <li>
                            <a href="{{url('profile')}}">
                                <i class="icon-angle-right"></i>
                                My Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{url('logout')}}">
                                <i class="icon-angle-right"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

            <!-- /Navigation -->
            <!-- Notification
            <div class="sidebar-title">
                <span>Notifications</span>
            </div>
            <ul class="notifications demo-slide-in">
                <li style="display: none;">
                    <div class="col-left">
                        <span class="label label-danger"><i class="icon-warning-sign"></i></span>
                    </div>
                    <div class="col-right with-margin">
                        <span class="message">Application <strong>#512</strong> Deleted.</span>
                        <span class="time">few seconds ago</span>
                    </div>
                </li>
                <li style="display: none;">
                    <div class="col-left">
                        <span class="label label-info"><i class="icon-envelope"></i></span>
                    </div>
                    <div class="col-right with-margin">
                        <span class="message"><strong>John</strong> sent you a message</span>
                        <span class="time">few second ago</span>
                    </div>
                </li>
                <li>
                    <div class="col-left">
                        <span class="label label-success"><i class="icon-plus"></i></span>
                    </div>
                    <div class="col-right with-margin">
                        <span class="message"><strong>Emma</strong>'s account was created</span>
                        <span class="time">4 hours ago</span>
                    </div>
                </li>
            </ul>

            <div class="sidebar-widget align-center">
                <div class="btn-group" data-toggle="buttons" id="theme-switcher">
                    <label class="btn active">
                        <input type="radio" name="theme-switcher" data-theme="bright"><i class="icon-sun"></i> Bright
                    </label>
                    <label class="btn">
                        <input type="radio" name="theme-switcher" data-theme="dark"><i class="icon-moon"></i> Dark
                    </label>
                </div>
            </div>
            -->
        </div>
        <div id="divider" class="resizeable"></div>
    </div>
    <!-- /Sidebar -->

    <div id="content">
        <div class="container">
            <!-- Breadcrumbs line -->
            <div class="crumbs">
                <ul id="breadcrumbs" class="breadcrumb">
                   @yield('breadcrumbs')
                </ul>
                <ul class="crumb-buttons">
                    <li><a href="#" title=""><i class="icon-signal"></i><span>Statistics</span></a></li>
                    <li ><a href="#">
                            <i class="icon-calendar"></i>
                           <span> {{date('F d,Y -H:m')}}</span>
                        </a></li>
                </ul>

            </div>
            <!-- /Breadcrumbs line -->

          @yield('contents')

            </div>
            <!-- /Page Content -->
        </div>
        <!-- /.container -->

    </div>
</div>

</body>
</html>
@yield('customload-jquery')
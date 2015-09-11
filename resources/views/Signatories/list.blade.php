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
{!!HTML::script("plugins/sparkline/jquery.sparkline.min.js")!!}
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

<!-- Noty -->
{!!HTML::script("plugins/noty/jquery.noty.js")!!}
{!!HTML::script("plugins/noty/layouts/top.js")!!}
{!!HTML::script("plugins/noty/themes/default.js")!!}

<!-- Forms -->
{!!HTML::script("plugins/uniform/jquery.uniform.min.js")!!}
{!!HTML::script("plugins/select2/select2.min.js")!!}

<!-- App -->
{!!HTML::script("assets/js/app.js")!!}
{!!HTML::script("assets/js/plugins.js")!!}
{!!HTML::script("assets/js/plugins.form-components.js")!!}
<!-- DataTables -->
{!!HTML::script("plugins/datatables/jquery.dataTables.min.js") !!}
{!!HTML::script("plugins/datatables/DT_bootstrap.js") !!}
{!!HTML::script("plugins/datatables/responsive/datatables.responsive.js") !!} <!-- optional -->

<script>
    $(document).ready(function(){
        "use strict";

        App.init(); // Init layout and core plugins
        Plugins.init(); // Init all plugins
        FormComponents.init(); // Init all form-specific plugins
    });
</script>

<!-- Demo JS -->
{!!HTML::script("assets/js/custom.js")!!}
{!!HTML::script("assets/js/demo/pages_calendar.js")!!}
{!!HTML::script("assets/js/demo/charts/chart_filled_blue.js")!!}
{!!HTML::script("assets/js/demo/charts/chart_simple.js")!!}

<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover table-checkable table-responsive">
            <thead>
            <tr>

                <th>SNO</th>
                <th data-class="expand">Signatory Name</th>
                <th class="checkbox-column">
                    <input type="checkbox" class="uniform">
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($signators as $sg)
                <tr>

                    <td>{{$sg->id}}</td>
                    <td>{{$sg->names}}</td>
                    <td class="checkbox-column">
                        <input type="checkbox" value="{{$sg->names}}" class="uniform" name="signat[]">
                    </td>

                </tr>

            @endforeach

            </tbody>
        </table>
</div>
</div>


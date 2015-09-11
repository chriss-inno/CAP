@extends('layout.master')
@section('title')
    Welcome | Credit Application System
    @stop
@section('breadcrumbs')

            <li>
                <i class="icon-home"></i>
                <a href="{{url('home')}}">Dashboard </a>
            </li>

    @stop
@section('contents')
    <!--=== Page Header ===-->
    <div class="page-header">
        <div class="page-title">
            <h3>Dashboard</h3>
            <span>{{"Welcome ".$user= Auth::user()->firstname . " ". $user= Auth::user()->lastname}}</span>
        </div>
    </div>
    <!-- /Page Header -->


    <!--=== Page Content ===-->
    <div class="row row-bg"> <!-- .row-bg -->
        <div class="col-sm-6 col-md-3">
            <div class="statbox widget box box-shadow">
                <div class="widget-content">
                    <div class="visual cyan">
                        <i class="icon-reorder"></i>
                    </div>
                    <div class="title">New Applications</div>
                    <div class="value"><?php
                        $capp=\App\CreditApp::where(DB::raw('DATEDIFF(sysdate(),created_at)'), '<=', 3)->get();
                        ?>{{count($capp)}}</div>
                    <a class="more" href="{{url('cap-new')}}">View More <i class="pull-right icon-angle-right"></i></a>
                </div>
            </div> <!-- /.smallstat -->
        </div> <!-- /.col-md-3 -->

        <div class="col-sm-6 col-md-3">
            <div class="statbox widget box box-shadow">
                <div class="widget-content">
                    <div class="visual yellow ">
                        <i class="icon-reorder"></i>
                    </div>
                    <div class="title"> Pending Applications</div>
                    <div class="value"> <?php
                        $capp=\App\CreditApp::where('autho', '=', 0)->get();
                        ?>{{count($capp)}}</div>
                    <a class="more" href="{{url('cap-pending')}}">View More <i class="pull-right icon-angle-right"></i></a>
                </div>
            </div> <!-- /.smallstat -->
        </div> <!-- /.col-md-3 -->

        <div class="col-sm-6 col-md-3 hidden-xs">
            <div class="statbox widget box box-shadow">
                <div class="widget-content">
                    <div class="visual red">
                        <i class="icon-reorder"></i>
                    </div>
                    <div class="title">Incomplete Applications </div>
                    <div class="value">
                        <?php
                        $capp=\App\CreditApp::where('status', '=', 'incomplete')->get();
                        ?>{{count($capp)}}
                       </div>
                    <a class="more" href="{{url('cap-incomplete')}}">View More <i class="pull-right icon-angle-right"></i></a>
                </div>
            </div> <!-- /.smallstat -->
        </div> <!-- /.col-md-3 -->

        <div class="col-sm-6 col-md-3 hidden-xs">
            <div class="statbox widget box box-shadow">
                <div class="widget-content">
                    <div class="visual green">
                        <i class="icon-reorder"></i>
                    </div>
                    <div class="title">Total Applications</div>
                    <div class="value">
                        <?php

                        $capp=\App\CreditApp::all();
                        ?>{{count($capp)}}
                       </div>
                    <a class="more" href="{{url('cap-manage')}}">View More <i class="pull-right icon-angle-right"></i></a>
                </div>
            </div> <!-- /.smallstat -->
        </div> <!-- /.col-md-3 -->
    </div> <!-- /.row -->
    <!-- /Statboxes -->
    <!--=== Blue Chart ===-->
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i>Credit Applications for {{date('Y')}}</h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content">
                    <div id="chart_filled_blue" class="chart"></div>
                </div>
                <div class="divider"></div>
                <div class="widget-content">
                    <ul class="stats"> <!-- .no-dividers -->
                        <li>
                            <strong><?php

                                $capp=\App\CreditApp::all();
                                ?>{{count($capp)}}</strong>
                            <small> <a href=" {{url('cap-manage')}}">Total</a></small>
                        </li>
                        <li class="light hidden-xs">
                            <strong><?php
                                $capp=\App\CreditApp::where(DB::raw('(HOUR(TIMEDIFF(sysdate(),created_at)))/24'), '>=', 7)->where(DB::raw('(HOUR(TIMEDIFF(sysdate(),created_at)))/24'), '<=', 14)->get();
                                ?>{{count($capp)}}</strong>
                            <small><a href=" {{url('lastweek')}}"> Last Week</a></small>
                        </li>
                        <li>
                            <strong><?php
                                $cappl=\App\CreditApp::where(DB::raw('HOUR(TIMEDIFF(sysdate(),created_at))'), '>=', 24)->where(DB::raw('HOUR(TIMEDIFF(sysdate(),created_at))'), '<=', 48)->get();
                                ?>{{count($cappl)}}</strong>
                            <small><a href=" {{url('last24hours')}}">Yesterday</a></small>
                        </li>
                        <li class="light hidden-xs">
                            <strong><?php
                                $capp=\App\CreditApp::where(DB::raw('HOUR(TIMEDIFF(sysdate(),created_at))'), '<=', 1)->get();
                                ?>{{count($capp)}}</strong>
                            <small> <a href=" {{url('lasthour')}}">Last hour</a></small>
                        </li>
                    </ul>
                </div>
            </div>
        </div> <!-- /.col-md-12 -->
    </div> <!-- /.row -->
    <!-- /Blue Chart -->


    @stop
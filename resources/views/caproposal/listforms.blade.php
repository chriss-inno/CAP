@extends('layout.master')
@section('title')
    CA  Lists | Credit Application System
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('profile')}}">CA lists</a>
    </li>
    <li>
        <i class="icon-home"></i>
        Manage CA Proposals
    </li>


@stop
@section('pagescripts')
    <!--dynamic table initialization -->
    {!! HTML::script("js/processorder.js") !!}
    <!-- DataTables -->
    {!!HTML::script("plugins/datatables/jquery.dataTables.min.js") !!}
    {!!HTML::script("plugins/datatables/DT_bootstrap.js") !!}
    {!!HTML::script("plugins/datatables/responsive/datatables.responsive.js") !!} <!-- optional -->


@stop
@section('contents')
    <div class="row row-bg">
        <!--=== Responsive DataTable ===-->
        <div class="row" style="margin-left: 20px; margin-bottom: 30px">
            <div class="col-md-11">
                <div class="col-md-2 pull-right">
                    <a href="{{url('cap-manage')}}" class="btn btn-primary btn-block">Manage Application</a>
                </div>
                <div class="col-md-2 pull-right">
                    <a href="#" class="btn btn-primary btn-block">View Lists</a>
                </div>
                <div class="col-md-2 pull-right">
                    <a href="{{url('credit-proposal')}}" class="btn btn-primary btn-block">New Application</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-left: 20px">
            <div class="col-md-11">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> List of Applications <code>Manage CA Applications</code></h4>
                        <div class="toolbar no-padding">
                            <div class="btn-group">
                                <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content no-padding">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Responsive DataTable -->
    @include('caproposal.list')
    @stop

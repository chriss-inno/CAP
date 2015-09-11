@extends('layout.master')
@section('title')
    Management  Credit Committee | Credit Application System
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('home')}}"> Home</a>
    </li>
    <li>
        <i class="icon-home"></i>
        <a href="{{url('department')}}">Credit Department Setting</a>
    </li>
    <li>Create Settings</li>

@stop

@section('contents')
    {!! Form::open(array('url' =>url('department'), 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}

    <div class="row row-bg">
        <div class="row" style="margin-left: 20px; margin-bottom: 30px">
            <div class="row" style="margin-left: 20px; margin-bottom: 30px">
                <div class="col-md-12">
                    <div class="col-md-2 pull-right">
                        <a href="{{url('department')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage</a>
                    </div>
                    <div class="col-md-2 pull-right">
                        <a href="{{url('dept-create')}}"  class="addform btn btn-primary btn-block"><i class="icon-file-alt"></i> Add New</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-left: 10px">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> Create New Member</h4>
                        <div class="toolbar no-padding">
                            <div class="btn-group">
                                <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content no-padding" id="listcommitee">
                        <div class="container">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="dpt_head">Head Credit Riskk</label>
                                        <input type="text" value="{{old('dpt_head')}}" name="dpt_head" class="form-control" placeholder="Enter Head Credit Riskk name">
                                        @if($errors->first('dpt_head'))
                                            <p class=" alert-danger">{{$errors->first('dpt_head')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="dpt_analyst">Credit Analyst</label>
                                        <input type="text" value="{{old('dpt_analyst')}}" name="dpt_analyst" class="form-control" placeholder="Enter Credit Analyst" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="dpt_chief">Chief Credit Officer</label>
                                        <input type="text" value="{{old('dpt_chief')}}" name="dpt_chief" class="form-control" placeholder="Enter Chief Credit Officer">
                                        @if($errors->first('dpt_chief'))
                                            <p class=" alert-danger">{{$errors->first('dpt_chief')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-2 pull-right">
                                        <input type="submit" name="submitsave" class="btn btn-primary btn-block" value="Register">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    {!! Form::close() !!}
@stop
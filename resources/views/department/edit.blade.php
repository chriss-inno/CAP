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
    {!! Form::open(array('url' =>url('department-edit'), 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}

    <?php
            $dpt_head="";
            $dpt_analyst="";
            $dpt_chief="";
            $id="";

            if(count($dp) > 0)
                {
                    $dpt_head=$dp->dpt_head;
                    $dpt_analyst=$dp->dpt_analyst;
                    $dpt_chief=$dp->dpt_chief;
                    $id=$dp->id;
                }
    ?>
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
                        <h4><i class="icon-reorder"></i>Update Credit Department  Settings</h4>
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
                                        <input type="text" value="@if(old('dpt_head')!= ""){{old('dpt_head')}} @else {{$dpt_head}} @endif" name="dpt_head" class="form-control required" placeholder="Enter Head Credit Riskk name">
                                        @if($errors->first('dpt_head'))
                                            <p class=" alert-danger">{{$errors->first('dpt_head')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="dpt_analyst">Credit Analyst</label>
                                        <input type="text" value="@if(old('dpt_analyst') !=""){{old('dpt_analyst')}} @else {{$dpt_analyst}} @endif" name="dpt_analyst" class="form-control required" placeholder="Enter Credit Analyst" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="dpt_chief">Chief Credit Officer</label>
                                        <input type="text" value="@if(old('dpt_chief') !=""){{old('dpt_chief')}} @else {{$dpt_chief}} @endif" name="dpt_chief" class="form-control" placeholder="Enter Chief Credit Officer">
                                        @if($errors->first('dpt_chief'))
                                            <p class=" alert-danger">{{$errors->first('dpt_chief')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-2 pull-right">
                                        <input type="submit" name="submitsave" class="btn btn-primary btn-block" value="Update">
                                        <input type="hidden" name="id" value="@if(old('id') != "") {{old('id')}} @else {{$id}} @endif ">
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
@extends('layout.master')
@section('title')
    Management  Credit Committee | Credit Application System
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('currency')}}"> Home</a>
    </li>
    <li>
        <i class="icon-home"></i>
        <a href="{{url('committee')}}">Currency</a>
    </li>
    <li>Add New Currency</li>

@stop

@section('contents')
    {!! Form::open(array('url' =>url('currency-edit'), 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}
     <?php
             $id="";
             $is_default="";
             $base_rate="";
             $ccy="";
         if(count($currency) >0)
             {
                 $id=$currency->id;
                 $is_default=$currency->is_default;
                 $base_rate=$currency->base_rate;
                 $ccy=$currency->ccy;
             }
     ?>
    <div class="row row-bg">
        <div class="row" style="margin-left: 20px; margin-bottom: 30px">
            <div class="col-md-12">
                <div class="col-md-2 pull-right">
                    <a href="{{url('currency')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage</a>
                </div>
                <div class="col-md-2 pull-right">
                    <a href="{{url('currency-create')}}"  class="addform btn btn-primary btn-block"><i class="icon-file-alt"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-left: 10px">
            <div class="col-md-10 col-md-offset-1">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> Add New Currency</h4>
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
                                        <label for="ccy">Currency</label>
                                        <input type="text" value="@if(old('ccy') !=""){{old('ccy')}} @else {{$ccy}} @endif" name="ccy" class="form-control" placeholder="Enter Currency" required="required">
                                        @if($errors->first('ccy'))
                                            <p class=" alert-danger">{{$errors->first('ccy')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="base_rate">Base Rate</label>
                                        <input type="text" value="@if(old('base_rate') !="" ){{old('base_rate')}} @else {{$base_rate}} @endif" name="base_rate" class="form-control" placeholder="Enter Base Rate" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="is_default">Is Default</label>
                                        <select name="is_default" class="form-control" required="required">
                                            @if(old('is_default') !="" || $is_default !="" )
                                                <option  selected="selected">@if(old('is_default') !=""){{old('is_default')}} @else {{$is_default}} @endif</option>
                                            @else
                                                <option value="" selected="selected">--Select--</option>
                                            @endif
                                            <option>No</option>
                                            <option>Yes</option>
                                        </select>
                                        @if($errors->first('is_default'))
                                            <p class=" alert-danger">{{$errors->first('is_default')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-2 pull-right">
                                        <input type="submit" name="submitsave" class="btn btn-primary btn-block" value="Update">
                                        <input type="hidden" name="id" value="@if(old('id') !="") {{old('id')}} @else {{$id}} @endif">
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
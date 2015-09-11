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
        <a href="{{url('legal-entity')}}">Legal Entity</a>
    </li>
    <li>Create New Entity</li>

@stop

@section('contents')
    {!! Form::open(array('url' =>url('legal-entity'), 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}

    <div class="row row-bg">
        <div class="row" style="margin-left: 20px; margin-bottom: 30px">
            <div class="col-md-12">
                <div class="col-md-2 pull-right">
                    <a href="{{url('legal-entity')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage</a>
                </div>
                <div class="col-md-2 pull-right">
                    <a href="{{url('legal-entity/create')}}"  class="addform btn btn-primary btn-block"><i class="icon-file-alt"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-left: 10px">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> Create New Entity</h4>
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
                                        <label for="entity">Legal Entity</label>
                                        <input type="text" value="{{old('entity')}}" name="entity" class="form-control" placeholder="Enter Legal Entity" required="required">
                                        @if($errors->first('firstname'))
                                            <p class=" alert-danger">{{$errors->first('entity')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="descriptions">Descriptions</label>
                                        <textarea rows="5" name="descriptions" class="form-control">{{old('descriptions')}} </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-2 pull-right">
                                        <input type="submit" name="submitsave" class="btn btn-primary btn-block" value="Submit">
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
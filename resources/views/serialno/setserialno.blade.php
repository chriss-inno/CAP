@extends('layout.master')
@section('title')
    Generate Serial Number | CA Proposal
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('home')}}">Home</a>
    </li>
    <li>
        <a href="{{url('caproposal')}}">Serial Number Setting</a>
    </li>

@stop
@section('contents')
    {!! Form::open(array('url' => 'serialno', 'class' => 'form-horizontal row-border')) !!}
    <div class="row row-bg">

        <div class="row" style="margin-left: 100px">
            <div class="col-md-8">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> Serial Number Setup</h4>
                    </div>
                    <div class="widget-content">

                        <div class="form-group">

                            <div class="col-md-3 control-label">Serial Number:</div>
                            <div class="col-md-7">
                                 {!! Form::text('serial_no',$snos,array('class'=>'form-control','placeholder'=>'Please enter number for serial number to start with')) !!}
                                @if($errors->first('serial_no'))
                                    <p class=" alert-danger">{{ $errors->first('serial_no')}}</p>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                             <div class="col-md-4 col-md-offset-3">
                                 <input type="submit" name="btnSet" value="Set Serial Number" class="btn btn-primary btn-block">
                             </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
 {!! Form::close() !!}
@stop
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
        <a href="{{url('directors')}}"> Director Credit Committee</a>
    </li>
    <li>Update Member</li>

@stop

@section('contents')

    <?php
            $firstname="";
            $middlename="";
            $surname="";
            $phone="";
            $email="";
            $id="";




     if(count($cm) >0)
         {
             $firstname=$cm->firstname;
             $middlename=$cm->middlename;
             $surname=$cm->surname;
             $phone=$cm->phone;
             $email=$cm->email;
             $id=$cm->id;
         }
    ?>
    {!! Form::open(array('url' =>url('directors-edit'), 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}

    <div class="row row-bg">
        <div class="row" style="margin-left: 20px; margin-bottom: 30px">
            <div class="col-md-12">
                <div class="col-md-2 pull-right">
                    <a href="{{url('directors')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage</a>
                </div>
                <div class="col-md-2 pull-right">
                    <a href="{{url('directors/create')}}"  class="addform btn btn-primary btn-block"><i class="icon-file-alt"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-left: 10px">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> Update Credit  Member</h4>
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
                                        <label for="firstname">Full Name</label>
                                        <input type="text" value="@if(old('firstname') !=""){{old('firstname')}} @else {{$firstname}} @endif" name="firstname" class="form-control" placeholder="Enter full name" required="required">
                                        @if($errors->first('firstname'))
                                            <p class=" alert-danger">{{$errors->first('firstname')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2 col-md-offset-4">
                                        <input type="submit"  name="submitsave" class="btn btn-primary btn-block" value="Save">
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
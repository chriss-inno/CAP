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
    $entity="";
    $descriptions="";
    $id="";




     if(count($cm) >0)
         {
             $entity=$cm->entity;
             $descriptions=$cm->descriptions;
             $id=$cm->id;
         }
    ?>
    {!! Form::open(array('url' =>url('legal-entity'), 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}

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
            <div class="col-md-8 col-md-offset-2">
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
                                        <label for="firstname">Firstname</label>
                                        <input type="text" value="@if(old('entity') !=""){{old('entity')}} @else {{$entity}} @endif" name="entity" class="form-control" placeholder="Enter firstname" required="required">
                                        @if($errors->first('entity'))
                                            <p class=" alert-danger">{{$errors->first('entity')}}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="middlename">Descriptions</label>
                                        <textarea rows="5" name="descriptions" class="form-control">{{old('descriptions')}} @if(old('descriptions') != "") {{old('descriptions')}} @else {{$descriptions}} @endif </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2 pull-right">
                                        <input type="submit"  name="submitsave" class="btn btn-primary btn-block" value="Register">
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
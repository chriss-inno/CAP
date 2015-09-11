@extends('layout.master')
@section('title')
    My Profile | Credit Application System
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('home')}}">Home</a>
    </li>
    <li>
        <i class="icon-home"></i>
        My Profile
    </li>

@stop
@section('contents')
    <div class="row">
        <div class="col-md-12">
            <!-- Tabs-->
            <div class="tabbable tabbable-custom tabbable-full-width">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_overview" data-toggle="tab">Overview</a></li>
                    <li><a href="#tab_edit_account" data-toggle="tab">My  Account</a></li>
                </ul>
                <div class="tab-content row">
                    <!--=== Overview ===-->
                    <div class="tab-pane active" id="tab_overview">
                        <div class="col-md-3">
                            <div class="list-group">
                                <li class="list-group-item no-padding">
                                    <img src="assets/img/demo/avatar-large.jpg" alt="">
                                </li>

                            </div>
                            <div class="col-md-8"><input type="file"> </div>
                            <div class="col-md-4"><button class="btn btn-block btn-success">Change </button> </div>
                        </div>

                        <div class="col-md-9">
                            <div class="row profile-info">
                                <div class="col-md-7">
                                    <div class="alert alert-info">Welcome to Bank M portal !</div>
                                    <h1>{{$user= Auth::user()->firstname . " ". $user= Auth::user()->lastname}}</h1>

                                         <p>Dear {{Auth::user()->lastname}}, Welcome to Credit portal system.</p>
                                        <p>The system allows you to create and mange Credit Applications. This is your profile page for updating your details, You can change all other fields but not your username</p>
                                     </div>
                                     <div class="col-md-5">
                                         <div class="widget">
                                             <div class="widget-header">
                                                 <h4><i class="icon-reorder"></i>Credit Application for year {{date('Y')}}</h4>
                                             </div>
                                             <div class="widget-content">
                                                 <div id="chart_filled_blue" class="chart"></div>
                                             </div>
                                         </div>
                                     </div>
                                 </div> <!-- /.row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget">
                                        <div class="widget-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span class="text-primary"><h3><strong>You're Recent Activities</strong></h3>  </span>
                                                </div>
                                            </div>
                                            <div class="row"><div class="col-md-12">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Activity</th>
                                                    <th >Module</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $c=1; ?>
                                                @foreach(App\Audit::where('user_id','=',Auth::user()->id)->orderBy('created_at','desc')->take(10)->get() as $au)
                                                <tr>
                                                    <td><a href="#"> {{$c}} </a></td>
                                                    <td><a href="#">{{$au->action}} </a></td>
                                                    <td><a href="#">{{$au->module}} </a></td>
                                                    <td><a href="#">{{$au->created_at}} </a></td>
                                                </tr>
                                                <?php $c++; ?>
                                                @endforeach
                                                </tbody>
                                            </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Striped Table -->
                            </div> <!-- /.row -->
                        </div> <!-- /.col-md-9 -->
                    </div>
                    <!-- /Overview -->

                    <!--=== Edit Account ===-->
                    <div class="tab-pane" id="tab_edit_account">
                        {!! Form::open(array('url' => 'changepass', 'class' => 'form-horizontal')) !!}
                            <div class="col-md-12">
                                <div class="widget">
                                    <div class="widget-header">
                                        <h4>General Information</h4>
                                    </div>
                                    <div class="widget-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">First name:</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="firstname" class="form-control" value="@if(old('firstname') !=""){{old('firstname')}}@else{{Auth::user()->firstname}}@endif">
                                                        @if($errors->first('firstname'))
                                                            <p class=" alert-danger">{{$errors->first('firstname')}}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Last name:</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="lastname" class="form-control" value="@if(old('lastname') !=""){{old('lastname')}}@else{{Auth::user()->lastname}}@endif">
                                                        @if($errors->first('lastname'))
                                                            <p class=" alert-danger">{{$errors->first('lastname')}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Email:</label>
                                                    <div class="col-md-8">
                                                        <div class="col-md-8">
                                                            <input type="text" name="email" class="form-control" value="@if(old('email') !=""){{old('email')}}@else{{Auth::user()->email}}@endif">
                                                            @if($errors->first('email'))
                                                                <p class=" alert-danger">{{$errors->first('email')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Phone</label>
                                                    <div class="col-md-8">
                                                        <div class="col-md-8">
                                                            <input type="text" name="phone" class="form-control" value="@if(old('phone') !="" ){{old('phone')}} @else{{Auth::user()->phone}}@endif">
                                                            @if($errors->first('phone'))
                                                                <p class=" alert-danger">{{$errors->first('phone')}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /.row -->
                                    </div> <!-- /.widget-content -->
                                </div> <!-- /.widget -->
                            </div> <!-- /.col-md-12 -->

                            <div class="col-md-12 form-vertical no-margin">
                                <div class="widget">
                                    <div class="widget-header">
                                        <h4>Settings</h4>
                                    </div>
                                    <div class="widget-content">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-2">
                                                <strong class="subtitle padding-top-10px">Permanent username</strong>
                                                <p class="text-muted">Permanent username</p>
                                            </div>

                                            <div class="col-md-8 col-lg-10">
                                                <div class="form-group">
                                                    <label class="control-label padding-top-10px">Username:</label>
                                                    <input type="text" name="username" class="form-control" value="{{Auth::user()->username}}" disabled="disabled">
                                                    @if($errors->first('username'))
                                                        <p class=" alert-danger">{{$errors->first('username')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> <!-- /.row -->
                                        <div class="row">
                                            <div class="col-md-4 col-lg-2">
                                                <strong class="subtitle">Change password</strong>
                                                <p class="text-muted">Change your account password.</p>
                                            </div>

                                            <div class="col-md-8 col-lg-10">
                                                <div class="form-group">
                                                    <label class="control-label">Old password:</label>
                                                    <input type="password" name="old_password" class="form-control" placeholder="Leave empty for no password-change">
                                                    @if($errors->first('old_password'))
                                                        <p class=" alert-danger">{{$errors->first('old_password')}}</p>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">New password:</label>
                                                    <input type="password" name="new_password" class="form-control" placeholder="Leave empty for no password-change">
                                                    @if($errors->first('new_password'))
                                                        <p class=" alert-danger">{{$errors->first('new_password')}}</p>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Repeat new password:</label>
                                                    <input type="password" name="new_password_repeat" class="form-control" placeholder="Leave empty for no password-change">
                                                    @if($errors->first('new_password_repeat'))
                                                        <p class=" alert-danger">{{$errors->first('new_password_repeat')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> <!-- /.row -->
                                    </div> <!-- /.widget-content -->
                                </div> <!-- /.widget -->

                                <div class="form-actions">
                                    <input type="submit" value="Update Account" class="btn btn-primary pull-right">
                                    <input type="hidden" name="userid" value="@if(old('userid') !=""){{old('userid')}}@else{{Auth::user()->id}}@endif"
                                </div>
                            </div> <!-- /.col-md-12 -->
                        {!! Form::close() !!}
                    </div>
                    <!-- /Edit Account -->
                </div> <!-- /.tab-content -->
            </div>
            <!--END TABS-->
        </div>
    </div> <!-- /.row -->
    @stop
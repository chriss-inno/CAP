@extends('layout.master')
@section('title')
    Register New User | Credit Application System
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('profile')}}">User Profile</a>
    </li>
    <li>
        <i class="icon-home"></i>
       Registartion
    </li>

@stop
@section('contents')
    <div class="row row-bg">
    <div class="row" style="margin-left: 20px; margin-bottom: 30px">
        <div class="col-md-12">
            <div class="col-md-2 pull-right">
                <a href="{{url('users')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage user</a>
            </div>
            <div class="col-md-2 pull-right">
                <a href="{{url('users/create')}}"  class="btn btn-primary btn-block"><i class="icon-file-alt"></i> Create New User</a>
            </div>
        </div>
    </div>
    <div class="row" style="margin-left: 20px">
        <div class="col-md-12">

                        {!! Form::open(array('route' => 'users.store', 'class' => 'form-horizontal')) !!}
                             <div class="row">
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
                                                    <div class="col-md-8"><input type="text" name="firstname" class="form-control" value="{{old('firstname')}}">
                                                        @if($errors->first('firstname'))
                                                            <p class=" alert-danger">{{$errors->first('firstname')}}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Last name:</label>
                                                    <div class="col-md-8"><input type="text" name="lastname" class="form-control" value="{{old('lastname')}}">
                                                        @if($errors->first('lastname'))
                                                            <p class=" alert-danger">{{$errors->first('lastname')}}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Phone Number:</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-4 control-label">Email:</label>
                                                    <div class="col-md-8"><input type="email" name="email" class="form-control" value="{{old('email')}}"  >
                                                        @if($errors->first('email'))
                                                            <p class=" alert-danger">{{$errors->first('email')}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /.row -->
                                    </div> <!-- /.widget-content -->
                                </div> <!-- /.widget -->
                            </div> <!-- /.col-md-12 -->
                             </div>
                            <div class="row">
                                  <div class="col-md-12 form-vertical no-margin">
                                <div class="widget">
                                    <div class="widget-header">
                                        <h4>Settings</h4>
                                    </div>
                                    <div class="widget-content">
                                        <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-2">
                                                <strong class="subtitle padding-top-10px">Permanent username</strong>

                                            </div>

                                            <div class="col-md-8 col-lg-8">
                                                <div class="form-group">
                                                    <label class="control-label padding-top-10px">Username:</label>
                                                    <input type="text" name="username" class="form-control" value="{{old('username')}}" >
                                                    @if($errors->first('username'))
                                                        <p class=" alert-danger">{{$errors->first('username')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> <!-- /.row -->
                                        <div class="row">
                                            <div class="col-md-4 col-lg-2">
                                                <strong class="subtitle">Password</strong>

                                            </div>

                                            <div class="col-md-8 col-lg-8">
                                               <div class="form-group">
                                                    <label class="control-label">New password:</label>

                                                    <input type="password" name="password" class="form-control" >
                                                   @if($errors->first('password'))
                                                       <p class=" alert-danger">{{$errors->first('password')}}</p>
                                                   @endif
                                                </div>

                                                <div class="form-group">

                                                    <label class="control-label">Repeat new password:</label>

                                                    <input type="password" name="password_repeat" class="form-control" >
                                                    @if($errors->first('password_repeat'))
                                                        <p class=" alert-danger">{{$errors->first('password_repeat')}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> <!-- /.row -->

                                       </div>
                                            <div class="col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-md-1 control-label">Role:</label>
                                                    <div class="col-md-10">
                                                        {!! Form::select('role', array(''=>'--Select user role--','Inputer'=>'Inputer','Authorizer'=>'Authorizer','Viewer'=>'Viewer','Administrator'=>'Administrator'), old('role'), array('class' => 'form-control')) !!}
                                                        @if($errors->first('role'))
                                                            <p class=" alert-danger">{{$errors->first('role')}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                      <table class="table table-bordered">
                                                          <tr>
                                                              <th colspan="2">Module Access</th>
                                                              <th>Create</th>
                                                              <th>View</th>
                                                              <th>Update</th>
                                                              <th>Delete</th>
                                                              <th>Authorize</th>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Credit</strong></td>
                                                              <td align="center" valign="middle"><input name="credit_module" type="checkbox" id="credit_module" value="1" @if(old('credit_module') !="") checked="checked" @endif/>
                                                              <label for="module"></label></td>
                                                              <td align="center" valign="middle"><input name="credit_create" type="checkbox" id="credit_create" value="1" @if(old('credit_create') !="") checked="checked" @endif/></td>
                                                              <td align="center" valign="middle"><input name="credit_view" type="checkbox" id="credit_view" value="1" @if(old('credit_view') !="") checked="checked" @endif/></td>
                                                              <td align="center" valign="middle"><input name="credit_update" type="checkbox" id="credit_update" value="1" @if(old('credit_update') !="") checked="checked" @endif /></td>
                                                              <td align="center" valign="middle"><input name="credit_dele" type="checkbox" id="credit_dele" value="1" @if(old('credit_dele') !="") checked="checked" @endif/></td>
                                                              <td align="center" valign="middle"><input name="credit_authorizer" type="checkbox" id="credit_authorizer" value="1" @if(old('credit_authorizer') !="") checked="checked" @endif/></td>
                                                          </tr>
                                                          <tr>
                                                              <td><strong>Credit Settings</strong></td>
                                                              <td align="center" valign="middle"><input name="settings_module" type="checkbox" id="module" value="2" @if(old('settings_module') !="") checked="checked" @endif/>
                                                                  <label for="module"></label></td>
                                                              <td align="center" valign="middle"><input name="settings_create" type="checkbox" id="settings_create" value="1" @if(old('settings_create') !="") checked="checked" @endif/></td>
                                                              <td align="center" valign="middle"><input name="settings_view" type="checkbox" id="settings_view" value="1" @if(old('settings_view') !="") checked="checked" @endif/></td>
                                                              <td align="center" valign="middle"><input name="settings_update" type="checkbox" id="settings_update" value="1" @if(old('settings_update') !="") checked="checked" @endif/></td>
                                                              <td align="center" valign="middle"><input name="settings_dele" type="checkbox" id="settings_dele" value="1" @if(old('settings_dele') !="") checked="checked" @endif /></td>
                                                              <td align="center" valign="middle"><input name="settings_authorizer" type="checkbox" id="settings_authorizer" value="1" @if(old('settings_authorizer') !="") checked="checked" @endif /></td>
                                                          </tr>
                                                           <tr>
                                                              <td><strong>Reports</strong></td>
                                                              <td align="center" valign="middle"><input name="reports_module" type="checkbox" id="reports_module" value="3" @if(old('reports_module') !="") checked="checked" @endif />
                                                             <label for="module"></label></td>
                                                              <td align="center" valign="middle"><input name="reports_create" type="checkbox" id="reports_create" value="1" @if(old('reports_create') !="") checked="checked" @endif /></td>
                                                              <td align="center" valign="middle"><input name="reports_view" type="checkbox" id="reports_view" value="1" @if(old('reports_view') !="") checked="checked" @endif/></td>
                                                              <td align="center" valign="middle"><input name="reports_update" type="checkbox" id="reports_update" value="1" @if(old('reports_update') !="") checked="checked" @endif/></td>
                                                              <td align="center" valign="middle"><input name="reports_dele" type="checkbox" id="reports_dele" value="1" @if(old('reports_dele') !="") checked="checked" @endif/></td>
                                                              <td align="center" valign="middle"><input name="reports_authorizer" type="checkbox" id="reports_authorizer" value="1" @if(old('reports_authorizer') !="") checked="checked" @endif/></td>
                                                          </tr>

                                                      </table>
                                                    </div>
                                                </div>
                                            </div>
                                    </div> <!-- /.widget-content -->

                                </div> <!-- /.widget -->
                                </div>
                                    <div class="row">
                                <div class="form-actions">
                                    <input type="submit" value="Register User" class="btn btn-primary col-md-offset-10">
                                </div>
                                    </div>
                            </div> <!-- /.col-md-12 -->
                            </div>
                        {!! Form::close() !!}

        </div>
    </div> <!-- /.row -->
  </div>
@stop
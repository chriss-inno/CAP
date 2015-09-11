@extends('layout.master')
@section('title')
    Modify User | Credit Application System
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('profile')}}">User Profile</a>
    </li>
    <li>
        <i class="icon-home"></i>
       User Modification
    </li>

@stop
@section('contents')
    <?php
    $id="";
    $rights="";
    $firstname="";
    $lastname="";
    $phone="";
    $email="";
    $role="";
    $username="";
    if(count($user) > 0)
    {
        $id=$user->id;
        $firstname=$user->firstname;
        $lastname=$user->lastname;
        $phone=$user->phone;
        $email=$user->email;
        $role=$user->role;
        $username=$user->username;

        $rights=\App\UserRights::where('user_id','=',$user->id)->get();
    }

    ?>
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

            {!! Form::open(array('url' => 'edit-user', 'class' => 'form-horizontal')) !!}
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
                                        <div class="col-md-8"><input type="text" name="firstname" class="form-control" value="@if(old('firstname') !=""){{old('firstname')}}@else{{$firstname}}@endif">
                                            @if($errors->first('firstname'))
                                                <p class=" alert-danger">{{$errors->first('firstname')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Last name:</label>
                                        <div class="col-md-8"><input type="text" name="lastname" class="form-control" value="@if(old('lastname') !=""){{old('lastname')}}@else{{$lastname}}@endif">
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
                                            <input type="text" name="phone" class="form-control" value="@if(old('phone') !=""){{ old('phone') }}@else{{$phone}}@endif">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Email:</label>
                                        <div class="col-md-8"><input type="text" name="email" class="form-control" value="@if(old('email') !=""){{ old('email') }}@else{{$email}}@endif"  >
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
                                                <input type="text" name="username" class="form-control" value="@if(old('username') !=""){{old('username')}} @else {{$username}} @endif" readonly="readonly">
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
                                            <?php if(old('role') !=""){$role=old('role');} ?>
                                            {!! Form::select('role', array(''=>'--Select user role--','Inputer'=>'Inputer','Authorizer'=>'Authorizer','Viewer'=>'Viewer','Administrator'=>'Administrator'), $role, array('class' => 'form-control')) !!}
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
                                                <?php
                                                $credit_create="";
                                                $credit_update="";
                                                $credit_dele="";
                                                $credit_view="";
                                                $credit_authorizer="";
                                                $credit_module="";

                                                $settings_create="";
                                                $settings_update="";
                                                $settings_dele="";
                                                $settings_view="";
                                                $settings_authorizer="";
                                                $settings_module="";

                                                $reports_create="";
                                                $reports_update="";
                                                $reports_dele="";
                                                $reports_view="";
                                                $reports_authorizer="";
                                                $reports_module="";
                                                ?>
                                             @if($rights !="")
                                                  <?php
                                                     foreach($rights as $rs)
                                                         {
                                                                if($rs->modulecode ==1)
                                                                 {
                                                                     $credit_module=1;

                                                                     if($rs->cr ==1)
                                                                     {
                                                                         $credit_create=1;
                                                                     }
                                                                     if($rs->edit ==1)
                                                                     {
                                                                         $credit_update=1;
                                                                     }
                                                                     if($rs->dl ==1)
                                                                     {
                                                                         $credit_dele=1;
                                                                     }
                                                                     if($rs->vw ==1)
                                                                     {
                                                                         $credit_view=1;
                                                                     }
                                                                     if($rs->authorize ==1)
                                                                     {
                                                                       $credit_authorizer=1;
                                                                     }
                                                                 }
                                                                if($rs->modulecode ==2)
                                                             {
                                                                 $settings_module=1;

                                                                 if($rs->cr ==1)
                                                                 {
                                                                     $settings_create=1;
                                                                 }
                                                                 if($rs->edit ==1)
                                                                 {
                                                                     $settings_update=1;
                                                                 }
                                                                 if($rs->dl ==1)
                                                                 {
                                                                     $settings_dele=1;
                                                                 }
                                                                 if($rs->vw ==1)
                                                                 {
                                                                     $settings_view=1;
                                                                 }
                                                                 if($rs->authorize ==1)
                                                                 {
                                                                     $settings_authorizer=1;
                                                                 }
                                                             }
                                                                if($rs->modulecode ==3)
                                                             {
                                                                 $reports_module=3;

                                                                 if($rs->cr ==1)
                                                                 {
                                                                     $reports_create=1;
                                                                 }
                                                                 if($rs->edit ==1)
                                                                 {
                                                                     $reports_update=1;
                                                                 }
                                                                 if($rs->dl ==1)
                                                                 {
                                                                     $reports_dele=1;
                                                                 }
                                                                 if($rs->vw ==1)
                                                                 {
                                                                     $reports_view=1;
                                                                 }
                                                                 if($rs->authorize ==1)
                                                                 {
                                                                     $reports_authorizer=1;
                                                                 }
                                                             }
                                                         }
                                                    ?>
                                                 @endif
                                                <tr>
                                                    <td><strong>Credit</strong></td>
                                                    <td align="center" valign="middle"><input name="credit_module" type="checkbox" id="credit_module" value="1" @if(old('credit_module') !="" || $credit_module ==1) checked="checked" @endif/>
                                                        <label for="module"></label></td>
                                                    <td align="center" valign="middle"><input name="credit_create" type="checkbox" id="credit_create" value="1" @if(old('credit_create') !="" || $credit_create==1) checked="checked" @endif/></td>
                                                    <td align="center" valign="middle"><input name="credit_view" type="checkbox" id="credit_view" value="1" @if(old('credit_view') !="" || $credit_view ==1) checked="checked" @endif/></td>
                                                    <td align="center" valign="middle"><input name="credit_update" type="checkbox" id="credit_update" value="1" @if(old('credit_update') !="" || $credit_update ==1) checked="checked" @endif /></td>
                                                    <td align="center" valign="middle"><input name="credit_dele" type="checkbox" id="credit_dele" value="1" @if(old('credit_dele') !="" || $credit_dele ==1) checked="checked" @endif/></td>
                                                    <td align="center" valign="middle"><input name="credit_authorizer" type="checkbox" id="credit_authorizer" value="1" @if(old('credit_authorizer') !="" || $credit_authorizer ==1) checked="checked" @endif/></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Credit Settings</strong></td>
                                                    <td align="center" valign="middle"><input name="settings_module" type="checkbox" id="module" value="2" @if(old('settings_module') !="" || $settings_module ==1) checked="checked" @endif/>
                                                        <label for="module"></label></td>
                                                    <td align="center" valign="middle"><input name="settings_create" type="checkbox" id="settings_create" value="1" @if(old('settings_create') !="" || $settings_create==1) checked="checked" @endif/></td>
                                                    <td align="center" valign="middle"><input name="settings_view" type="checkbox" id="settings_view" value="1" @if(old('settings_view') !="" || $settings_view ==1) checked="checked" @endif/></td>
                                                    <td align="center" valign="middle"><input name="settings_update" type="checkbox" id="settings_update" value="1" @if(old('settings_update') !="" || $settings_update ==1) checked="checked" @endif/></td>
                                                    <td align="center" valign="middle"><input name="settings_dele" type="checkbox" id="settings_dele" value="1" @if(old('settings_dele') !="" || $settings_dele ==1) checked="checked" @endif /></td>
                                                    <td align="center" valign="middle"><input name="settings_authorizer" type="checkbox" id="settings_authorizer" value="1" @if(old('settings_authorizer') !="" || $settings_authorizer ==1) checked="checked" @endif /></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Reports</strong></td>
                                                    <td align="center" valign="middle"><input name="reports_module" type="checkbox" id="reports_module" value="3" @if(old('reports_module') !=""  || $reports_module ==3) checked="checked" @endif />
                                                        <label for="module"></label></td>
                                                    <td align="center" valign="middle"><input name="reports_create" type="checkbox" id="reports_create" value="1" @if(old('reports_create') !=""  || $reports_create==1) checked="checked" @endif /></td>
                                                    <td align="center" valign="middle"><input name="reports_view" type="checkbox" id="reports_view" value="1" @if(old('reports_view') !="" || $reports_view ==1) checked="checked" @endif/></td>
                                                    <td align="center" valign="middle"><input name="reports_update" type="checkbox" id="reports_update" value="1" @if(old('reports_update') !="" || $reports_update ==1) checked="checked" @endif/></td>
                                                    <td align="center" valign="middle"><input name="reports_dele" type="checkbox" id="reports_dele" value="1" @if(old('reports_dele') !="" || $reports_dele ==1) checked="checked" @endif/></td>
                                                    <td align="center" valign="middle"><input name="reports_authorizer" type="checkbox" id="reports_authorizer" value="1" @if(old('reports_authorizer') !="" || $reports_authorizer ==1) checked="checked" @endif/></td>
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
                            <button class="btn btn-primary col-md-offset-10"> Save  </button>
                            <input type="hidden" name="id" value="@if(old('id') !="" ) {{old('id')}} @else {{$id}} @endif">
                        </div>
                    </div>
                </div> <!-- /.col-md-12 -->
            </div>
            {!! Form::close() !!}

        </div>
    </div>
    </div>
@stop
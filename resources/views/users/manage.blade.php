@extends('layout.master')
@section('title')
    User Lists | Credit Application System
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('profile')}}">User List</a>
    </li>
    <li>
        <i class="icon-home"></i>
        Manage Users
    </li>

@stop
@section('pagescripts')
    <!-- DataTables -->
     {!!HTML::script("plugins/datatables/jquery.dataTables.min.js") !!}
     {!!HTML::script("plugins/datatables/DT_bootstrap.js") !!}
     {!!HTML::script("plugins/datatables/responsive/datatables.responsive.js") !!} <!-- optional -->
    
    @stop
@section('contents')
    <div class="row row-bg">
    <!--=== Responsive DataTable ===-->
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
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> List of System users <code>Manage user</code></h4>
                    <div class="toolbar no-padding">
                        <div class="btn-group">
                            <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                        </div>
                    </div>
                </div>
                <div class="widget-content no-padding">
                    <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                        <thead>
                        <tr>
                            <th data-class="expand" >
                                SNO
                            </th>
                            <th data-class="expand">First Name</th>
                            <th>Last Name</th>
                            <th data-hide="phone">Username</th>
                            <th data-hide="phone">Email</th>
                            <th data-hide="phone">Phone</th>
                            <th data-hide="phone">Role</th>
                            <th data-hide="phone,tablet">Status</th>

                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $co=0;?>
                        @if(count($users) !=0)
                            @foreach($users as $usr)
                                <?php $co++; ?>
                        <tr>
                            <td >
                                {{$co}}
                            </td>
                            <td>{{$usr->firstname}}</td>
                            <td>{{$usr->lastname}}</td>
                            <td>{{$usr->username}}</td>
                            <td>{{$usr->email}}</td>
                            <td>{{$usr->phone}}</td>
                            <td>{{$usr->role}}</td>
                            <td>
                                @if($usr->block ==0)
                                    <span class="label label-success">Approved</span>
                                @else
                                    <span class="label label-danger">Blocked</span>
                                @endif
                            </td>
                            @if(Auth::user()->id==$usr->id)
                            <td id="{{ $usr->id }}">
                                <a href="#" title="edit Application" ><i class="icon-pencil text-info"></i> edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="#" title="delete Application" ><i class="icon-trash text-danger"></i> delete </a>
                            </td>
                                @else
                                <td id="{{ $usr->id }}">
                                <a href="{{url('edit-user')}}/{{ $usr->id }}" title="edit Application" class="editapp "><i class="icon-pencil text-info"></i> edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="#b" title="delete Application" class="deleteapp "><i class="icon-trash text-danger"></i> delete </a>
                            </td>
                                @endif
                        </tr>

                        @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        //Delete Application
        $(".deleteapp").click(function(){
            var id1 = $(this).parent().attr('id');
            $(".deleteuser").show("slow").parent().parent().find("span").remove();
            var btn = $(this).parent().parent();
            $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
            $("#no").click(function(){
                $(this).parent().parent().find(".deleteapp").show("slow");
                $(this).parent().parent().find("span").remove();
            });
            $("#yes").click(function(){
                $(this).parent().html("<br><i class='icon-spinner icon-spin'></i>deleting...");
                $.get("<?php echo url('remove-user') ?>/"+id1,function(data){
                    btn.hide("slow").next("hr").hide("slow");
                });
            });
        });
    </script>

    @stop
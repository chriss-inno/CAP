@extends('layout.master')
@section('title')
    CA  Lists | Credit Application System
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('profile')}}">CA lists</a>
    </li>
    <li>
        <i class="icon-home"></i>
        Manage Memo
    </li>

@stop
@section('pagescripts')
    <!--dynamic table initialization -->
    {!! HTML::script("js/processorder.js") !!}
    <!-- DataTables -->
    {!!HTML::script("plugins/datatables/jquery.dataTables.min.js") !!}
    {!!HTML::script("plugins/datatables/DT_bootstrap.js") !!}
    {!!HTML::script("plugins/datatables/responsive/datatables.responsive.js") !!} <!-- optional -->
@stop
@section('contents')
    @if(Session::has('message'))

        <script>

            var modal = '<div class="modal fade" id="myModalconfig" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%;margin-top: 15%">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<h4 class="modal-title" id="myModalLabel">Authorization Confirmation</h4>';
            modal+= '</div>';
            modal+= '<div class="modal-body"> <center> <p> <h1 class="text-danger">{{Session::get('message')}} </h1> </p>';
            modal+= ' </div>';
            modal+= '</div>';
            modal+= '</div>';

            $("body").append(modal);
            $("#myModalconfig").modal("show");
            $("#myModalconfig").on('hidden.bs.modal',function(){
                $("#myModalconfig").remove();
            })


        </script>
    @endif
    <div class="row row-bg">
        <!--=== Responsive DataTable ===-->
        <div class="row" style="margin-left: 20px; margin-bottom: 30px">
            <div class="col-md-12">
                <div class="col-md-2 pull-right">
                    <a href="{{url('cap-manage')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage </a>
                </div>
                <div class="col-md-2 pull-right">
                    <a href="#" class="btn btn-success btn-block"><i class="icon-bar-chart"></i> View Lists </a>
                </div>
                @if( Auth::user()->role !="Authorizer" && \App\Http\Controllers\UserController::checkViewAccess(Auth::user()->id,1,1) )
                    <div class="col-md-2 pull-right">
                        <a href="{{url('credit-proposal')}}" class="btn btn-primary btn-block"><i class="icon-folder-open-alt"></i> New Application</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> List of Applications <code>Manage CA Applications</code></h4>
                        <div class="toolbar no-padding">
                            <div class="btn-group">
                                <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content no-padding">
                        <div class="row"> <div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px;">
                                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info" >
                                    <thead>
                                    <tr>
                                        <th class="checkbox-column">
                                            ID
                                        </th>
                                        <th>Serial Number</th>
                                        <th data-hide="expand">Application Date</th>
                                        <th data-class="expand">Account Name</th>
                                        <th data-hide="expand">Address</th>
                                        <th data-hide="expand">Management contact person</th>
                                        <th data-hide="expand">Relationship manager</th>
                                        <th>Standard Report </th>
                                        <th>Custom  Report </th>

                                        <th >Authorized</th>

                                        <th data-hide="expand">Status</th>
                                        @if( Auth::user()->role !="Authorizer")
                                            <th data-hide="expand">Actions</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; ?>
                                    @foreach($creditapp as $cap)
                                        <tr>
                                            <td class="checkbox-column">
                                                {{$cap->id}}
                                            </td>
                                            <td>{{$cap->sno}}</td>
                                            <td>{{$cap->app_date}}</td>
                                            <td>{{$cap->ac_name}}</td>
                                            <td>{{$cap->ac_address}}</td>
                                            <td>{{$cap->contact_person}}</td>
                                            <td>{{$cap->rm}}</td>
                                            <td><a href="{{url("download/pdf/st-report/".$cap->id)}}" title="Download Report"  class="text-success"> <i class='icon-download-alt'> </i> </a></td>
                                            <td><a href="{{url("download/pdf/report/".$cap->id)}}" title="Download Report"  class="text-success"> <i class='icon-download-alt'> </i> </a></td>
                                            @if( Auth::user()->role=="Authorizer")
                                                <td>

                                                    @if($cap->autho ==1)

                                                        <span class="label label-success"> <i class="icon-lock"></i> Authorized</span>
                                                    @else
                                                        <a href="{{url('authorize-manage').'/'.$cap->id}}" title="Authorize Application" ><i class="icon-unlock"></i>Authorize </a>
                                                    @endif

                                                </td>
                                            @else
                                                <td>
                                                    @if($cap->autho ==1)

                                                        <span class="label label-success"> <i class="icon-lock"></i> Authorized</span>
                                                    @else
                                                        <span class="label label-danger"><i class="icon-unlock"></i> Not Authorized</span>
                                                    @endif

                                                </td>

                                            @endif

                                            <td>
                                                @if($cap->autho ==1)
                                                    <span class="label label-success">Approved</span>
                                                @else
                                                    <span class="label label-danger">Pending</span>
                                                @endif
                                            </td>
                                            @if(  \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1)|| \App\Http\Controllers\UserController::checkViewAccess(Auth::user()->id,1,1) || \App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1))
                                                <td id="{{ $cap->id }}">
                                                    @if(  \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1)|| \App\Http\Controllers\UserController::checkViewAccess(Auth::user()->id,1,1) )
                                                        <a href="credit-proposal/{{ $cap->id }}" title="edit Application" class="editapp "><i class="icon-pencil text-info"></i> edit</a>&nbsp;&nbsp;&nbsp;
                                                    @endif
                                                    @if(  \App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1) )
                                                        <a href="#b" title="delete Application" class="deleteapp "><i class="icon-trash text-danger"></i> delete </a>
                                                    @endif
                                                </td>
                                            @endif

                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                            </div> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Responsive DataTable -->

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
                $.get("<?php echo url('credit-proposal/delete') ?>/"+id1,function(data){
                    btn.hide("slow").next("hr").hide("slow");
                });
            });
        });
    </script>
@stop
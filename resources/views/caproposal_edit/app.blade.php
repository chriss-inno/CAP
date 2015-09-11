@extends('layout.master')
@section('title')
    CA  Lists | Credit Application System
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('proposal/list')}}">CA lists</a>
    </li>
    <li>
        <i class="icon-home"></i>
        Manage CA Proposals
    </li>

@stop
@section('customload-jquery')
    <script>

        $('#FileUploader').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output',
                success:  afterSuccess
            });

        });


        function afterSuccess(){
            setTimeout(function() {
                $("#myModal").modal("hide");
            }, 3000);

        }

    </script>
    @stop
@section('pagescripts')

    <!--dynamic table initialization -->
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
                @if( \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1) ||\App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1) )
                <div class="col-md-2 pull-right">
                    <a href="{{url('cap-manage')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage </a>
                </div>
                @endif
                @if(\App\Http\Controllers\UserController::checkCreateAccess(Auth::user()->id,1,1) )
                <div class="col-md-2 pull-right">
                    <a href="{{url('customers')}}" class="btn btn-primary btn-block"><i class="icon-folder-open-alt"></i> New Application</a>
                </div>
                @endif
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> Credit Application progress <code>Manage Appication forms details</code></h4>
                        <div class="toolbar no-padding">
                            <div class="btn-group">
                                <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content no-padding" id="appcontentslist">
                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="example2" >
                            <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th data-class="expand">Reference No</th>
                                <th data-hide="expand">Application Date</th>
                                <th data-class="expand">Account Name</th>
                                <th>Status</th>
                                <th>Reports </th>
                                @if( \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1) ||\App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1) )
                                    <th >Action</th>
                                @endif


                            </tr>
                            </thead>
                            <tbody>


                                <tr>

                                    <td>{{$cap->sno}}</td>
                                    <td>{{$cap->reference_no}}</td>
                                    <td>{{$cap->app_date}}</td>
                                    <td>{{$cap->customer->customer_name}}</td>
                                    <td>
                                        @if($cap->autho ==1)
                                            <span class="label label-success">Approved</span>
                                        @else
                                            <span class="label label-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td><a href="{{url("download/pdf/st-report/".$cap->id)}}" title="Download Standard Report"  class="col-md-6 pull-right text-success"> <i class='icon-download-alt'> </i> </a>
                                    <a href="{{url("download/pdf/report/".$cap->id)}}" title="Download Custom Report"  class="col-md-6 pull-left text-info"> <i class='icon-download-alt'> </i> </a></td>


                                    @if( \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1) || \App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1))
                                    <td id="{{ $cap->id }}">
                                        <div class="row" >
                                            @if(  \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1) )
                                            <div class="col-md-6" id="{{ $cap->id }}">
                                               <a href="#edit" title="edit Application" class="editapp "><i class="icon-pencil text-info"></i> edit</a>
                                            </div>
                                            @endif
                                            @if( \App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1))
                                                    <div class="col-md-6" id="{{ $cap->id }}">
                                                       <a href="#b" title="delete Application" class="deleteapp "><i class="icon-trash text-danger"></i> delete </a>
                                                    </div>
                                            @endif
                                        </div>
                                    </td>
                                    @endif


                                </tr>
                                <tr id="stforms"><td colspan="12"><h3 class="text-primary">Add necessary forms to Application </h3></td></tr>
                             <tr>
                                 <td colspan="12" style="background-color: #eee;">
                                     <?php
                                     echo '<table style="width: 100%" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                                     echo "<tr>";
                                     echo "<th style='width: 20%'>Form type</th>";
                                     echo "<th>Complete(%)</th>";
                                     echo "<th style='width: 20%'>Add/Update</th>";
                                     echo "<th style='width: 20%'>Remove/Clear</th>";
                                     echo "<th style='width: 20%'>View</th>";
                                     echo "<th style='width: 10%' align='center'>Get Report</th>";
                                     echo "</tr>";

                                     foreach($cap->formstage as $s)
                                     {
                                         if( $s->completed >= 80 &&  $s->completed <= 100 ){
                                             $class = "success";
                                         }elseif( $s->completed >= 60 &&  $s->completed <= 80){
                                             $class = "primary";
                                         }elseif( $s->completed >= 40 &&  $s->completed <= 60){
                                             $class = "info";
                                         } elseif( $s->completed >= 20 &&  $s->completed <= 40){
                                             $class = "warning";
                                         }else{
                                             $class = "danger";
                                         }
                                         $prog = '<div class="progress" id="pro'.$s->id.'">
                    <div title="'.$s->completed.'%" class="progress-bar progress-bar-striped active progress-bar-'.$class.'" role="progressbar" aria-valuenow="'.$s->completed.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$s->completed.'%">
                   '.$s->completed.'
                    </div>
                    </div>';
                                         echo "<tr>";
                                         echo "<td >". $s->stage_name."</td>";
                                         echo "<td>".$prog."</td>";

                                         if( \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1))
                                         {
                                             echo "<td id='".$s->id."'><a href='#' class='addform text-info' title='Add new or update form to the application '> <i class='icon-pencil'></i>Add/Update</a></td>";
                                         }
                                         else
                                         {

                                             echo "<td id='".$s->id."'> Not Allowed </td>";

                                         }
                                         if(  \App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1))
                                         {

                                             echo "<td id='".$s->id."'><a href='#' class='delform text-danger' title='Remove form from application'> <i class='icon-remove text-danger'></i>Remove/Clear </a></td>";
                                         }
                                         else
                                         {

                                             echo "<td id='".$s->id."'> Not Allowed </td>";
                                         }

                                         echo "<td id='".$s->id."'><a href='#' class='summary text-success'> <i class='icon-list''></i> view Report </a></td>";
                                         echo "<td><a href='".url("download/pdf/".$s->id)."' class=' text-warning''> <i class='icon-download-alt'> </i> Download </a></td>";
                                         echo "</tr>";
                                     }
                                     echo "</table>";
                                     ?>
                                 </td>
                             </tr>

                            </tbody>
                        </table>
                        <script>
                            $(".summary").click(function(){
                                var id1 = $(this).parent().attr('id');
                                var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                                modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                                modal+= '<div class="modal-content">';
                                modal+= '<div class="modal-header">';
                                modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                                modal+= '<h4 class="modal-title" id="myModalLabel">Application Form preview</h4>';
                                modal+= '</div>';
                                modal+= '<div class="modal-body">';
                                modal+= ' </div>';
                                modal+= '</div>';
                                modal+= '</div>';

                                $("body").append(modal);
                                $("#myModal").modal("show");
                                $(".modal-body").html("<h3><i class='icon-spinner'></i><span>loading...</span><h3>");
                                $(".modal-body").load("<?php echo url("formsummary") ?>/"+id1);
                                $("#myModal").on('hidden.bs.modal',function(){
                                    $("#myModal").remove();
                                })

                            })
                            $(".addform").click(function(){
                                var id1 = $(this).parent().attr('id');
                                var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                                modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                                modal+= '<div class="modal-content">';
                                modal+= '<div class="modal-header">';
                                modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                                modal+= '<h4 class="modal-title" id="myModalLabel">Application form add new/Update</h4>';
                                modal+= '</div>';
                                modal+= '<div class="modal-body">';
                                modal+= ' </div>';
                                modal+= '</div>';
                                modal+= '</div>';

                                $("body").append(modal);
                                $("#myModal").modal("show");
                                $(".modal-body").html("<h3><span><i class='icon-spinner'></i> loading...</span><h3>");
                                $(".modal-body").load("<?php echo url("processform"); ?>/"+id1);
                                $("#myModal").on('hidden.bs.modal',function(){
                                    $("#myModal").remove();
                                })

                            })
                            //Edit Application
                            $(".editapp").click(function(){
                                var id1 = $(this).parent().attr('id');

                                var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                                modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
                                modal+= '<div class="modal-content">';
                                modal+= '<div class="modal-header">';
                                modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                                modal+= '<h2 class="modal-title" id="myModalLabel">Update Application Information</h2>';
                                modal+= '</div>';
                                modal+= '<div class="modal-body">';
                                modal+= ' </div>';
                                modal+= '</div>';
                                modal+= '</div>';

                                $("body").append(modal);
                                $("#myModal").modal("show");
                                $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                                $(".modal-body").load("<?php echo url("credit-proposal/edit"); ?>/"+id1);
                                $("#myModal").on('hidden.bs.modal',function(){
                                    $("#myModal").remove();
                                })
                            });

                                //Delete Application
                            $(".deleteapp").click(function(){
                                var id1 = $(this).parent().attr('id');
                                $(".deleteapp").show("slow").parent().parent().find("span").remove();
                                var btn = $(this).parent().parent();
                                var frm=$('#stforms');

                                $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                                $("#no").click(function(){
                                    $(this).parent().parent().find(".deleteapp").show("slow");
                                    $(this).parent().parent().find("span").remove();
                                });
                                $("#yes").click(function(){
                                    $(this).parent().html("<br><i class='icon-spinner icon-spin'></i>deleting...");
                                    $.get("<?php echo url('credit-proposal/delete'); ?>/"+id1,function(data){
                                        btn.hide("slow").next("hr").hide("slow");
                                        frm.hide("slow").next("hr").hide("slow");
                                    });
                                });
                            });


                            $(".delform").click(function(){
                                var id1 = $(this).parent().attr('id');
                                var previ = $(this).parent().html();
                                $(".delform").show("slow").parent().parent().find("span").remove();
                                var btn = $(this).parent();
                                var idsel="pro"+ id1;
                                var pro= document.getElementById(idsel);
                                $(this).hide("slow").parent().append("<span><br>Are You Sure <br /><br><a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                                $("#no").click(function(){
                                    $(this).parent().parent().find(".delform").show("slow");
                                    $(this).parent().parent().find("span").remove();
                                });
                                $("#yes").click(function(){
                                    $(".delform").show("slow").parent().parent().find("span").remove();
                                    // $(this).parent().html("<br><i class='icon-spinner icon-spin'></i> Removing...");
                                    $.get("<?php echo url('removeform') ?>/"+id1,function(data){
                                        $(".delform").show("slow").parent().parent().find("span").remove();
                                        pro.innerHTML="<div title='0%' class='progress-bar progress-bar-striped active progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%'>0 </div>";

                                    });

                                });
                            });
                            $(".publishall").click(function(){
                                var id1 = $(this).attr('id');
                                $(".publishall").show("slow").parent().find("span").remove();
                                var btn = $(this).parent();
                                $(this).hide("slow").parent().append("<span><br>Are You Sure <br /><br><a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                                $("#no").click(function(){
                                    $(this).parent().parent().find(".publishall").show("slow");
                                    $(this).parent().parent().find("span").remove();
                                });
                                $("#yes").click(function(){
                                    $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>publishing...");
                                    $.post("<?php echo url('order/publishall') ?>/"+id1,function(data){
                                        btn.html("<i class='fa fa-check'></i> Published");
                                    });
                                });
                            });
                        </script>
                        <!-- /Responsive DataTable -->


                        <!--script to process the list of users-->
                        <script>
                            /* Table initialisation */
                            $(document).ready(function() {
                                $('#example2').dataTable({
                                    "fnDrawCallback": function( oSettings ) {
                                        //editing a room
                                        $(".edituser").click(function(){
                                            var id1 = $(this).parent().attr('id');

                                            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                                            modal+= '<div class="modal-dialog">';
                                            modal+= '<div class="modal-content">';
                                            modal+= '<div class="modal-header">';
                                            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                                            modal+= '<h2 class="modal-title" id="myModalLabel">Update Application Information</h2>';
                                            modal+= '</div>';
                                            modal+= '<div class="modal-body">';
                                            modal+= ' </div>';
                                            modal+= '</div>';
                                            modal+= '</div>';

                                            $("body").append(modal);
                                            $("#myModal").modal("show");
                                            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                                            $(".modal-body").load("<?php echo url("company/edit") ?>/"+id1);
                                            $("#myModal").on('hidden.bs.modal',function(){
                                                $("#myModal").remove();
                                            })
                                        })

                                        //adding company user
                                        $(".adduser").click(function(){
                                            var name = $(this).parent().parent().parent().parent().find("td.name").text();
                                            var id1 = $(this).parent().attr('id');
                                            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                                            modal+= '<div class="modal-dialog">';
                                            modal+= '<div class="modal-content">';
                                            modal+= '<div class="modal-header">';
                                            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                                            modal+= '<h2 class="modal-title" id="myModalLabel">New User For '+name+'</h2>';
                                            modal+= '</div>';
                                            modal+= '<div class="modal-body">';
                                            modal+= ' </div>';
                                            modal+= '</div>';
                                            modal+= '</div>';

                                            $("body").append(modal);
                                            $("#myModal").modal("show");
                                            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                                            $(".modal-body").load("<?php echo url("company/user/add") ?>/"+id1);
                                            $("#myModal").on('hidden.bs.modal',function(){
                                                $("#myModal").remove();
                                            })

                                        })

                                        $(".listuser").click(function(){
                                            var name = $(this).parent().parent().parent().parent().find("td.name").text();
                                            var id1 = $(this).parent().attr('id');
                                            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                                            modal+= '<div class="modal-dialog" style="width:80%;margin-right: 10% ;margin-left: 10%">';
                                            modal+= '<div class="modal-content">';
                                            modal+= '<div class="modal-header">';
                                            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                                            modal+= '<h2 class="modal-title" id="myModalLabel">Company Users</h2>';
                                            modal+= '</div>';
                                            modal+= '<div class="modal-body">';
                                            modal+= ' </div>';
                                            modal+= '</div>';
                                            modal+= '</div>';

                                            $("body").append(modal);
                                            $("#myModal").modal("show");
                                            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                                            $(".modal-body").load("<?php echo url("company/user/list") ?>/"+id1);
                                            $("#myModal").on('hidden.bs.modal',function(){
                                                $("#myModal").remove();
                                            })

                                        })

                                        $(".deleteuser").click(function(){
                                            var id1 = $(this).parent().attr('id');
                                            $(".deleteuser").show("slow").parent().parent().find("span").remove();
                                            var btn = $(this).parent().parent();
                                            $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                                            $("#no").click(function(){
                                                $(this).parent().parent().find(".deleteuser").show("slow");
                                                $(this).parent().parent().find("span").remove();
                                            });
                                            $("#yes").click(function(){
                                                $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                                                $.get("<?php echo url('credit-proposal/delete') ?>/"+id1,function(data){
                                                    btn.hide("slow").next("hr").hide("slow");
                                                });
                                            });
                                        });//endof deleting category
                                    }
                                });

                                $('input[type="text"]').addClass("form-control");
                                $('select').addClass("form-control");

                                //managing the add button
                                $(".add").click(function(){
                                    var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                                    modal+= '<div class="modal-dialog">';
                                    modal+= '<div class="modal-content">';
                                    modal+= '<div class="modal-header">';
                                    modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                                    modal+= '<h2 class="modal-title" id="myModalLabel">Company Registration</h2>';
                                    modal+= '</div>';
                                    modal+= '<div class="modal-body">';
                                    modal+= ' </div>';
                                    modal+= '</div>';
                                    modal+= '</div>';

                                    $("body").append(modal);
                                    $("#myModal").modal("show");
                                    $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                                    $(".modal-body").load("<?php echo url("company/add/") ?>");
                                    $("#myModal").on('hidden.bs.modal',function(){
                                        $("#myModal").remove();
                                    })

                                })

                            } );
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop
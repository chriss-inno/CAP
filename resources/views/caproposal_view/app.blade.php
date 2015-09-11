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
        Manage CA Proposals
    </li>

@stop
@section('pagescripts')
    <!--dynamic table initialization -->
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
                    <a href="{{url('cap-manage')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage </a>
                </div>
                <div class="col-md-2 pull-right">
                    <a href="#" class="btn btn-success btn-block"><i class="icon-bar-chart"></i> View Lists </a>
                </div>
                <div class="col-md-2 pull-right">
                    <a href="{{url('credit-proposal')}}" class="btn btn-primary btn-block"><i class="icon-folder-open-alt"></i> New Application</a>
                </div>
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
                                <th class="checkbox-column">
                                    ID
                                </th>
                                <th>Serial Number</th>
                                <th data-hide="expand">Application Date</th>
                                <th data-class="expand">Account Name</th>
                                <th data-hide="expand">Address</th>
                                <th data-hide="expand">Management contact person</th>
                                <th data-hide="expand">Relationship manager</th>

                                <th data-hide="expand">Status</th>
                                <th>Report</th>
                                <th data-hide="expand">Action</th>

                            </tr>
                            </thead>
                            <tbody>


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
                                    <td>
                                        @if($cap->autho ==1)
                                            <span class="label label-success">Approved</span>
                                        @else
                                            <span class="label label-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td><a href="{{url("download/pdf/report".$cap->id)}}" class="text-success"> <i class='icon-download-alt'> </i> Download </a></td>
                                    <td id="{{ $cap->id }}">
                                        <a href="#edit" title="edit Application" class="editapp "><i class="icon-pencil text-info"></i> edit</a>&nbsp;&nbsp;&nbsp;
                                        <a href="#b" title="delete Application" class="deleteapp "><i class="icon-trash text-danger"></i> delete </a>
                                    </td>

                                </tr>
                                <tr><td colspan="8"><h3 class="text-primary">Add necessary forms to Application </h3></td></tr>
                             <tr>
                                 <td colspan="10" style="background-color: #eee;">
                                     <?php
                                     echo '<table style="width: 100%" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                                     echo "<tr>";
                                     echo "<th style='width: 20%'>Form type</th>";
                                     echo "<th>Complete(%)</th>";
                                     echo "<th style='width: 20%'>Update</th>";
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
                                         $prog = '<div class="progress">
                    <div title="'.$s->completed.'%" class="progress-bar progress-bar-striped active progress-bar-'.$class.'" role="progressbar" aria-valuenow="'.$s->completed.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$s->completed.'%">
                    <span class="sr-only">'.$s->completed.'</span>
                    </div>
                    </div>';
                                         echo "<tr>";
                                         echo "<td >". $s->stage_name."</td>";
                                         echo "<td>".$prog."</td>";
                                         echo "<td id='".$s->id."'><a href='#' class='addform text-info'> <i class='icon-pencil'></i> Add/Update Form </a></td>";
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
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            $(".modal-body").load("<?php echo url("processform") ?>/"+id1);
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
            $(".modal-body").load("<?php echo url("processform") ?>/"+id1);
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
            $(".modal-body").load("<?php echo url("credit-proposal/edit") ?>/"+id1);
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })
        });
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
                $.post("<?php echo url('company/delete') ?>/"+id1,function(data){
                    btn.hide("slow").next("hr").hide("slow");
                });
            });
        });

        $(".publish").click(function(){
            var id1 = $(this).parent().attr('id');
            $(".publish").show("slow").parent().parent().find("span").remove();
            var btn = $(this).parent();
            $(this).hide("slow").parent().append("<span><br>Are You Sure <br /><br><a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
            $("#no").click(function(){
                $(this).parent().parent().find(".publish").show("slow");
                $(this).parent().parent().find("span").remove();
            });
            $("#yes").click(function(){
                $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>publishing...");
                $.post("<?php echo url('order/publish') ?>/"+id1,function(data){
                    btn.html("Published");
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
                            $.post("<?php echo url('company/delete') ?>/"+id1,function(data){
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


@stop
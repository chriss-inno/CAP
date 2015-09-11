@extends('layout.master')
@section('title')
    CA  Lists | Credit Application System
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('customers')}}">Customer List</a>
    </li>
    <li>
        <i class="icon-home"></i>
        Customers
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
                @if( \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1) ||\App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1) )
                    <div class="col-md-2 pull-right">
                        <a href="{{url('customers')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage </a>
                    </div>
                @endif
                @if( Auth::user()->role !="Authorizer" && \App\Http\Controllers\UserController::checkViewAccess(Auth::user()->id,1,1) )
                    <div class="col-md-2 pull-right">
                        <a href="{{url('customers/create')}}" class="btn btn-primary btn-block"><i class="icon-folder-open-alt"></i> New Customer</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> List of <code>CA Applications Customers</code></h4>
                        <div class="toolbar no-padding">
                            <div class="btn-group">
                                <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content no-padding">
                        <div class="row"> <div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px;">
                                <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                                    <thead>
                                    <tr>
                                        <th class="checkbox-column">
                                           SNO
                                        </th>
                                        <th data-class="expand">customer No</th>
                                        <th data-class="expand">customer name</th>
                                        <th data-class="expand">customer address</th>
                                        <th data-class="expand">Contact person</th>
                                        <th data-hide="expand">Relationship manager</th>
                                        <th>Existing CA </th>
                                        <th>New Application</th>
                                        <th data-hide="expand">Account Profile</th>
                                        <th data-hide="expand">Status</th>
                                        @if(  \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1)|| \App\Http\Controllers\UserController::checkViewAccess(Auth::user()->id,1,1) || \App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1))
                                            <th data-hide="expand">Actions</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; ?>
                                    @foreach($customers as $cust)
                                        <tr>
                                            <td class="checkbox-column">
                                                {{$i}}
                                            </td>
                                            <td class="checkbox-column">
                                                {{$cust->customer_no}}
                                            </td>
                                            <td class="checkbox-column">
                                                {{$cust->customer_name}}
                                            </td>
                                            <td> <?php echo $cust->customer_address; ?></td>
                                            <td>{{$cust->contact_person}}</td>
                                            <td>{{$cust->rm}}</td>
                                            <td><a href="{{url('customer-creaditapp').'/'.$cust->id}}" class="btn btn-success">View</a> </td>
                                            <td><a href="{{url('proposal/create').'/'.$cust->id}}" class="btn btn-primary">Create</a> </td>
                                            <td id="{{$cust->id}}"><a href="#" class="addprofile btn btn-success" title="Link Account Profile">Add/Update</a></td>
                                            <td>
                                                @if($cust->autho ==1)
                                                    <span class="label label-success">Approved</span>
                                                @else
                                                    <span class="label label-danger">Pending</span>
                                                @endif
                                            </td>
                                            @if(  \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1)|| \App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1))
                                                <td id="{{ $cust->id }}">
                                                    <div class="row">

                                                        @if(  \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1)|| \App\Http\Controllers\UserController::checkViewAccess(Auth::user()->id,1,1) )
                                                            <div class="col-md-6" id="{{ $cust->id }}">
                                                                <a href="customers/edit/{{ $cust->id }}" title="edit Customer" class="editapp "><i class="icon-pencil text-info"></i> edit</a>&nbsp;&nbsp;&nbsp;
                                                            </div>
                                                        @endif
                                                        @if(  \App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1) )
                                                            <div class="col-md-6" id="{{ $cust->id }}">
                                                                <a href="#b" title="delete Customer" class="deleteapp "><i class="icon-trash text-danger"></i> delete </a>
                                                            </div>
                                                        @endif
                                                    </div>
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
                $.get("<?php echo url('customers/remove') ?>/"+id1,function(data){
                    btn.hide("slow").next("hr").hide("slow");
                });
            });
        });

        $(".addprofile").click(function(){
            var id1 = $(this).parent().attr('id');

            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<h2 class="modal-title" id="myModalLabel">Customer Profile</h2>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+= ' </div>';
            modal+= '</div>';
            modal+= '</div>';

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("customer/profile"); ?>/"+id1);
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })
        });
    </script>
@stop
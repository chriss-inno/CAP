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
        Legal Entity
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
        <div class="row" style="margin-left: 20px; margin-bottom: 30px">
            <div class="col-md-12">
                <div class="col-md-2 pull-right">
                    <a href="{{url('legal-entity')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage</a>
                </div>
                <div class="col-md-2 pull-right">
                    <a href="{{url('legal-entity/create')}}"  class="addform btn btn-primary btn-block"><i class="icon-file-alt"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-left: 10px">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> Legal Entity</h4>
                        <div class="toolbar no-padding">
                            <div class="btn-group">
                                <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content no-padding" id="listcommitee">
                        <table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable">
                            <thead>
                              <tr>
                                  <th>SNO</th>
                                  <th>Entity</th>
                                  <th>Descriptions</th>
                                  <th>Action</th>

                               </tr>
                            </thead>
                            <tbody>
                               <?php $c=0;?>
                               @if(count($cm) > 0)
                                   @foreach($cm as $ct)
                                       <?php $c++;?>
                               <tr>
                                   <td>{{$c }}</td>
                                   <td>{{$ct->entity }}</td>
                                   <td>{{$ct->descriptions }}</td>
                                   <td id="{{ $ct->id }}">
                                       <a href="{{url('legal-entity/edit')}}/{{ $ct->id }}" title="edit Application" class="editapp "><i class="icon-pencil text-info"></i> edit</a>&nbsp;&nbsp;&nbsp;
                                       <a href="{{url('legal-entity/delete')}}/{{ $ct->id }}" title="delete Application" class="deleteapp "><i class="icon-trash text-danger"></i> delete </a>
                                   </td>
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
@stop
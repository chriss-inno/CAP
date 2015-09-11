<!-- Bootstrap -->
{!!HTML::style('bootstrap/css/bootstrap.min.css')!!}
<div class="container">
    <div class="row">
        <div class="col-md-12">
@if(count($ca) > 0)
<div class="row">
<div class="col-md-12" style="text-align: center;border-color: #FFFFFF" ><p></P><strong>BANK M (TANZANIA) PLC  <br/> CREDIT PROPOSAL APPLICATIONS <br/> REPORT </strong> <p></p></div>
</div>
                <div class="row">
<table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                            <thead>

                                      <tr>
                                        <th>SNO</th>
                                        <th>Serial Number</th>
                                        <th data-hide="expand">Application Date</th>
                                        <th data-class="expand">Account Name</th>
                                        <th data-hide="expand">Address</th>
                                        <th data-hide="expand">Management contact person</th>
                                        <th data-hide="expand">Relationship manager</th>
                                        <th>Application Type</th>

                                     </tr>
                            </thead>
                            <tbody role="alert" aria-live="polite" aria-relevant="all"><tr class="odd">
   <?php  $cou = 1;?>
   @foreach ($ca as $c)
        <tr>
        <td>  {{$cou}}  </td>
        <td>  {{$c->sno}}   </td>
        <td>  {{$c->app_date}}  </td>
        <td>  {{$c->ac_name}}  </td>
        <td>  <?php $c->ac_address;?>  </td>
        <td>  {{$c->contact_person}}   </td>
        <td>  {{$c->rm}}   </td>
        <td>  {{ $c->open_type }} </td>
        </tr>
      <?php   $cou ++;?>
    @endforeach
    </tbody></table>


    @endif
                </div>
        </div>
    </div>
</div>

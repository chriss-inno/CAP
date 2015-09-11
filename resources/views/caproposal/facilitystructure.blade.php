@extends('layout.master')
@section('title')
    Credit Application | CA Proposal
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('home')}}">Home</a>
    </li>
    <li>
        <a href="{{url('caproposal')}}">CA Proposal</a>
    </li>
    <li>
        Facility Structure
    </li>

@stop
@section('contents')
    {!! Form::open(array('url' => 'facility-structure', 'class' => 'form-horizontal row-border')) !!}
    <div class="row row-bg">
        <div class="row" style="margin-left: 100px">
            <div class="col-md-10">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> B: Facility Structure </h4>
                    </div>
                    <div class="widget-content">

                            <div class="form-group">

                                <div class="col-md-4 text-info" >TYPE OF APPLICATION</div>
                                <div class="col-md-4 text-info pull-right" ><input type="date" class="form-control"/> </div>
                                <div class="col-md-4 text-info pull-right" style="text-align: right">VALID UP TO </div>

                            </div>

                            <div class="form-group">

                                <div class="col-md-12">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4">
                                                New
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control"/>
                                            </div>
                                            <div class="col-md-4">
                                                Existing level
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control"/>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Renewal
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control"/>
                                            </div>
                                            <div class="col-md-4">
                                                Enhancement
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control"/>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Interim
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control"/>
                                            </div>
                                            <div class="col-md-4">
                                                Amendment
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control"/>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-md-12 text-info" style="text-align: right" ><h2>Limit in ACY | Outstanding in LCY </h2> </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-12">
                                    <table class="table" id="fsapp">
                                        <thead>
                                            <th class="col-md-3">Facility</th>
                                            <th class="col-md-1">CCY</th>
                                            <th>Current limits</th>
                                            <th class="col-md-1">CCY</th>
                                            <th>Out Standing </th>
                                            <th class="col-md-1">Proposed </th>
                                            <th>Tenor / expiry </th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><input type="text" name="facility[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_1[]" class="form-control"></td>
                                            <td><input type="text" name="cr_limits[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_2[]" class="form-control"></td>
                                            <td><input type="text" name="presentos[]" class="form-control"></td>
                                            <td><input type="text" name="proposed[]" class="form-control"></td>
                                            <td><input type="text" name="expire[]" class="form-control"></td>
                                            <td> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS();" /></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="facility[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_1[]" class="form-control"></td>
                                            <td><input type="text" name="cr_limits[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_2[]" class="form-control"></td>
                                            <td><input type="text" name="presentos[]" class="form-control"></td>
                                            <td><input type="text" name="proposed[]" class="form-control"></td>
                                            <td><input type="text" name="expire[]" class="form-control"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="facility[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_1[]" class="form-control"></td>
                                            <td><input type="text" name="cr_limits[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_2[]" class="form-control"></td>
                                            <td><input type="text" name="presentos[]" class="form-control"></td>
                                            <td><input type="text" name="proposed[]" class="form-control"></td>
                                            <td><input type="text" name="expire[]" class="form-control"></td>
                                            <td></td>
                                        </tr>

                                        </tbody>

                                    </table>
                                </div>
                                </div>

                            </div>
                            <div class="form-group">

                                <div class="col-md-2" >Rate Applied </div>
                                <div class="col-md-1"><input type="text" class="form-control" value="" name="rate_applied" > </div>

                            </div>
                            <div class="form-group">

                                <div class="col-md-2">Remarks </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea name="remarks" id="remarks" cols="45" rows="8" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 ">As per the BOT guideline on Credit Concentration, Our Single Borrower Limit (SBL) AND group exposer limit (GEL) of the bank at 25% of the core capital works out at TZS 14.79 billion. Accordingly the proposal may be considered for the full amount applied as per the details above. </div>

                            </div>
                            <div class="form-group">

                                <div class="col-md-12 text-info" style="text-align: right" ><h2>Group exposure  figures in tzs "mio" and usd"000"</h2> </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-12">
                                    <table class="table" id="fsge">
                                        <thead>
                                        <th class="col-md-2">Client</th>
                                        <th class="col-md-2">Facility</th>
                                        <th class="col-md-1">Ccy</th>
                                        <th>Existing limit </th>
                                        <th>O/s bal as of  </th>
                                        <th>Proposed limit </th>
                                        <th class="col-md-1">GEL</th>
                                        <th></th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><input type="text" name="g_client[]" class="form-control"></td>
                                            <td><input type="text" name="g_facility[]" class="form-control"></td>
                                            <td><input type="text" name="g_ccy[]" class="form-control"></td>
                                            <td><input type="text" name="g_existing_limit[]" class="form-control"></td>

                                            <td><input type="text" name="g_osbalance[]" class="form-control"></td>
                                            <td><input type="text" name="g_proposed_limit[]" class="form-control"></td>
                                            <td><input type="text" name="g_gel[]" class="form-control"></td>
                                            <td class="col-md-2"><input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFSGE();" /></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="g_client[]" class="form-control"></td>
                                            <td><input type="text" name="g_facility[]" class="form-control"></td>
                                            <td><input type="text" name="g_ccy[]" class="form-control"></td>
                                            <td><input type="text" name="g_existing_limit[]" class="form-control"></td>

                                            <td><input type="text" name="g_osbalance[]" class="form-control"></td>
                                            <td><input type="text" name="g_proposed_limit[]" class="form-control"></td>
                                            <td><input type="text" name="g_gel[]" class="form-control"></td>
                                            <td class="col-md-2"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="g_client[]" class="form-control"></td>
                                            <td><input type="text" name="g_facility[]" class="form-control"></td>
                                            <td><input type="text" name="g_ccy[]" class="form-control"></td>
                                            <td><input type="text" name="g_existing_limit[]" class="form-control"></td>

                                            <td><input type="text" name="g_osbalance[]" class="form-control"></td>
                                            <td><input type="text" name="g_proposed_limit[]" class="form-control"></td>
                                            <td><input type="text" name="g_gel[]" class="form-control"></td>
                                            <td class="col-md-2"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="g_client[]" class="form-control"></td>
                                            <td><input type="text" name="g_facility[]" class="form-control"></td>
                                            <td><input type="text" name="g_ccy[]" class="form-control"></td>
                                            <td><input type="text" name="g_existing_limit[]" class="form-control"></td>

                                            <td><input type="text" name="g_osbalance[]" class="form-control"></td>
                                            <td><input type="text" name="g_proposed_limit[]" class="form-control"></td>
                                            <td><input type="text" name="g_gel[]" class="form-control"></td>
                                            <td class="col-md-2"></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-12 ">As per the bot guidelines on credit concentration, our single borrower limit (sbl) and group exposure limit (gel) of the bank at 25% of the core capital works out at tzs 15.93 billion. The proposed facilities are within our current sbl / gel. </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-2 control-label">Purpose</div>
                                <div class="col-md-9"><input type="text" name="purpose" class="form-control"></div>
                            </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row row-bg">
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-1 col-md-offset-1" >
                <a href="{{url('form1')}}" class="btn btn-primary"><< Previous</a>
            </div>
            <div class="col-md-1 col-md-offset-7">
                <input type="submit" name="Submit" class="btn btn-primary"  value="Next >>" />
                <input type="hidden" value="{{$id}}" name="crp_id" id="crp_id">
            </div>

        </div>
    </div>
    {!! Form::close() !!}
    <script>
        function addRowFS()
        {
            var table = document.getElementById('fsapp');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            var cel3 = row.insertCell(2);
            var cel4 = row.insertCell(3);
            var cel5 = row.insertCell(4);
            var cel6 = row.insertCell(5);
            var cel7 = row.insertCell(6);
            var cel8 = row.insertCell(7);

            cell.innerHTML="<input type='text' name='facility[]' class='form-control'>";
            cel2.innerHTML="<input type='text' name='ccy_1[]' class='form-control'>";
            cel3.innerHTML="<input type='text' name='cr_limits[]' class='form-control'>";
            cel4.innerHTML="<input type='text' name='ccy_2[]' class='form-control'>";
            cel5.innerHTML="<input type='text' name='presentos[]' class='form-control'>";
            cel6.innerHTML="<input type='text' name='proposed[]' class='form-control'>";
            cel7.innerHTML="<input type='text' name='expire[]' class='form-control'>";

            cel8.innerHTML="<input type='button' name='button' id='delbtn' value='Delete' class='btn btn-danger' />";
        }

        function addRowFSGE()
        {
            var table = document.getElementById('fsge');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            var cel3 = row.insertCell(2);
            var cel4 = row.insertCell(3);
            var cel5 = row.insertCell(4);
            var cel6 = row.insertCell(5);
            var cel7 = row.insertCell(6);
            var cel8 = row.insertCell(7);

            cell.innerHTML="<input type='text' name='g_client[]' class='form-control'>";
            cel2.innerHTML="<input type='text' name='g_facility[]' class='form-control'>";
            cel3.innerHTML="<input type='text' name='g_ccy[]' class='form-control'>";
            cel4.innerHTML="<input type='text' name='g_existing_limit[]' class='form-control'>";

            cel5.innerHTML="<input type='text' name='g_osbalance[]' class='form-control'>";
            cel6.innerHTML="<input type='text' name='g_proposed_limit[]' class='form-control'>";
            cel7.innerHTML="<input type='text' name='g_gel[]' class='form-control'>";
            cel8.innerHTML="<input type='button' name='button' id='button' value='Delete' class='btn btn-danger' />";

        }
        function removeCurrentRow(btn)
        {
            var pr= btn.parentNode.parentNode.nodeName;
            alert(pr);
        }
        $('#delbtn').click(function(e){
            $(this).closest('tr').remove()
        })
    </script>
@stop
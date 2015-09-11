@extends('layout.master')
@section('title')
    Credit Application | CA Proposal-Account performance
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
        Account performance
    </li>

@stop
@section('contents')
    <?php if(old('crp_id') !="" || old('crp_id') != null){$id=old('crp_id');}?>

    {!! Form::open(array('url' => 'account-performance', 'class' => 'form-horizontal row-border')) !!}
    <div class="row row-bg">
        <div class="row" style="margin-left: 100px">
            <div class="col-md-9">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>F: Account performance</h4>
                    </div>
                    <div class="widget-content">

                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <table id="dubu" class="table">
                                        <tr>
                                            <td>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                        <th>1)	Names of the banks where the accounts are maintained. </th>
                                        <th colspan="2" align="right"><input type="text"class="form-control" name="bank_maintained[]"></th>
                                            <th> </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th colspan="4" style="text-align: right;"><strong><h2 class="text-primary">Figures in TZS  "000" </h2></strong></th>

                                        </tr>

                                        <tr>
                                            <th>Month</th>
                                            <th>Low balance</th>
                                            <th>High balance</th>
                                            <th>Turnover</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                        </tr>

                                        <tr>
                                            <td  colspan="3"><strong>Total</strong></td>
                                            <td><input type="text" class="form-control"  name="total[]"/></td>
                                        </tr>
                                        <tr>
                                            <td  colspan="3" ><strong>Less term loan disbursement
                                                    <small>Internal fund transfers</small>
                                                </strong></td>

                                            <td ><input type="text" class="form-control" name="loarn_disbursement[]" /></td>
                                        </tr>
                                        <tr>
                                            <td  colspan="3" ><strong>Actual credit turnover
                                                </strong></td>

                                            <td><input type="text" class="form-control" name="Credit_turnover[]" /></td>
                                        </tr>




                                        </tbody>
                                    </table>
                                            </td>
                                            <td> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS();" /></td>

                                        </tr>
                                    </table>
                                </div>

                            </div>
                            </div>

                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <table id="dubu2" class="table">
                                        <tr>
                                            <td>
                                    <table class="table">
                                        <thead>

                                        <td colspan="4" align="right"> <strong><h2 class="text-primary">Figures in USD  "000" </h2></strong></th>

                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>Month</th>
                                            <th>Low balance</th>
                                            <th>High balance</th>
                                            <th>Turnover</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                            <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                            <td><input type="text" class="form-control" name="usd_hbalance[]"></td>
                                            <td><input type="text" class="form-control" name="usd_turnover[]"></td>
                                        </tr>



                                        <tr>
                                            <td  colspan="3"><strong>Total</strong></td>

                                            <td><input type="text" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td  colspan="3" ><strong>Less term loan disbursement</strong>
                                                    <small>Internal fund transfers</small>
                                                </td>

                                            <td><input type="text" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td  colspan="3" ><strong>Actual credit turnover
                                                </strong></td>

                                            <td><input type="text" class="form-control"></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                            </td>
                                            <td> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS2();" /></td>

                                        </tr>
                                    </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <td class="col-md-6" >
                                                    <ol>
                                                        <li>Do the summations indicate adequate banking in comparison to  the volume of sales</li>
                                                        <li>If too low, the reasons there for.</li>
                                                    </ol>
                                                </td>

                                                <td class="col-md-6" ><textarea name="comments" cols="4" rows="4" class="form-control"></textarea></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>


                    </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="row row-bg">
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-1 col-md-offset-1" >
                <a href="{{url('form4')}}" class="btn btn-primary"><< Previous</a>
            </div>
            <div class="col-md-1 col-md-offset-6">
                <input type="submit" name="Submit" class="btn btn-primary"  value="Next >>" />
                <input type="hidden" value="{{$id}}" name="crp_id" id="crp_id">
            </div>

        </div>
    </div>
    {!! Form::close() !!}
    <script>
        function addRowFS()
        {
            var table = document.getElementById('dubu');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);

            cell.innerHTML="  <table class='table'>       <thead>       <tr>       <th>1)	Names of the banks where the accounts are maintained. </th>       <th colspan='2' align='right'><input type='text'class='form-control' name='bank_maintained[]'></th><th> </th>       </tr>       </thead>       <tbody>       <tr><th colspan='4' style='text-align: right;'><strong><h2 class='text-primary'>Figures in TZS '000' </h2></strong></th>       </tr>       <tr><th>Month</th><th>Low balance</th><th>High balance</th><th>Turnover</th>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td colspan='3'><strong>Total</strong></td><td><input type='text' class='form-control' name='total[]'/></td>       </tr>       <tr><td colspan='3' ><strong>Less term loan disbursement  <small>Internal fund transfers</small> </strong></td><td ><input type='text' class='form-control' name='loarn_disbursement[]' /></td>       </tr>       <tr><td colspan='3' ><strong>Actual credit turnover </strong></td><td><input type='text' class='form-control' name='Credit_turnover[]' /></td>       </tr>       </tbody>      </table>";
            cel2.innerHTML="<input type='button' name='button' id='delbtn' value='Delete' class='btn btn-danger' />";
        }
        function addRowFS2()
        {
            var table = document.getElementById('dubu2');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);

            cell.innerHTML="  <table class='table'><thead><td colspan='4' align='right'> <strong><h2 class='text-primary'>Figures in USD  '000' </h2></strong></th></thead><tbody><tr> <th>Month</th> <th>Low balance</th> <th>High balance</th> <th>Turnover</th></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td  colspan='3'><strong>Total</strong></td> <td><input type='text' class='form-control'></td></tr><tr> <td  colspan='3' ><strong>Less term loan disbursement</strong><small>Internal fund transfers</small>  </td> <td><input type='text' class='form-control'></td></tr><tr> <td  colspan='3' ><strong>Actual credit turnover  </strong></td> <td><input type='text' class='form-control'></td></tr></tbody></table>";

            cel2.innerHTML="<input type='button' name='button' id='delbtn' value='Delete' class='btn btn-danger' />";
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

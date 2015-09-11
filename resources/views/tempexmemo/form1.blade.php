@extends('layout.master')
@section('title')
    Credit Application | CA Proposal-Final recommendations
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('home')}}">Home</a>
    </li>
    <li>
        <a href="{{url('caproposal')}}">MEMO – EXTENSION/SANCTION OF TEMPORARY EXCESS </a>
    </li>
    <li>
        Final recommendations
    </li>

@stop
@section('contents')

    <div class="row row-bg">
        <div class="row">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>MEMO – EXTENSION/SANCTION OF TEMPORARY EXCESS
                        </h4>
                    </div>
                    <div class="widget-content">
                        <form class="form-horizontal row-border" action="#">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <table class="table">
                                        <tr>
                                            <td > 1</td>
                                            <td class="col-md-3">Name of the company / firm</td>
                                            <td class="col-md-9"><input type="text" class="form-control"/></td>
                                        </tr>
                                        <tr>
                                            <td > 2</td>
                                            <td class="col-md-3">Names of major share-holders / directors </td>
                                            <td class="col-md-9">
                                                <table class="table">
                                                    <tr>
                                                        <td>1.</td>
                                                        <td><input type="text" class="form-control"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2.</td>
                                                        <td><input type="text" class="form-control"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3.</td>
                                                        <td><input type="text" class="form-control"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4.</td>
                                                        <td><input type="text" class="form-control"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>5.</td>
                                                        <td><input type="text" class="form-control"/></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td > 3</td>
                                            <td colspan="2">
                                                <table class="table">
                                                    <tr>
                                                        <td>Details of credit facilities</td>
                                                        <td>Figures in TZS "bln"</td>
                                                    </tr>
                                                    <tr>
                                                        <table class="table">
                                                           <tr>
                                                            <th>Facility</th>
                                                            <th>CCY</th>
                                                            <th>Limit</th>
                                                            <th>Outstanding
                                                                As on

                                                                {{date("m.d.Y")}}
                                                            </th>
                                                            <th>Proposed</th>
                                                            <th>ROI/ Comm</th>
                                                            <th>Expiry date</th>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td>TZS Equiv. @ 1,850 </td>
                                                                <td>TZS </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                                <td><input type="text" class="form-control"> </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">Facility Fees: 1% of the ____Facilities. </td>
                                                                <td colspan="5"><input type="text" class="form-control"> </td>

                                                            </tr>
                                                        </table>
                                                    </tr>
                                                </table>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="col-md-3"> 4</td>
                                            <td class="col-md-9" colspan="2">
                                                <table class="table">
                                                    <tr>
                                                        <td colspan="2">Credit Summations in last 12 months (TZS in mio / USD in 000’s)</td>
                                                        <td colspan="2">Tallies company’s turnover</td>
                                                        <td>Yes √</td>
                                                        <td>No </td>
                                                    </tr>
                                                    <tr>
                                                        <td>•	USD Account:</td>
                                                        <td><input type="text" class="form-control"></td>
                                                        <td>Variance</td>
                                                        <td><input type="text" class="form-control"></td>
                                                        <td><input type="checkbox" class="form-control"/> </td>
                                                        <td><input type="checkbox" class="form-control"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td>•	TZS Account:</td>
                                                        <td><input type="text" class="form-control"></td>
                                                        <td>Variance</td>
                                                        <td><input type="text" class="form-control"></td>
                                                        <td><input type="checkbox" class="form-control"/></td>
                                                        <td><input type="checkbox" class="form-control"/> </td>
                                                    </tr>
                                                </table>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td rowspan="2">5.</td>
                                            <td colspan="2">Security summary (TZS in “mio” )</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                            <table class="table">
                                               <thead>
                                                  <tr>
                                                       <th class="col-md-8"></th>
                                                       <th class="col-md-2">OMV</th>
                                                       <th class="col-md-2"> FSV</th>
                                                  </tr>
                                               </thead>
                                                <tbody>
                                                <tr>
                                                     <td>
                                                         <table class="table">
                                                             <tr>
                                                                 <td colspan="2">Immovable Property</td>

                                                             </tr>
                                                             <tr>
                                                                 <td colspan="2">First legal mortgage over land and Building on </td>

                                                             </tr>
                                                             <tr>
                                                                 <td >Plot No. </td>
                                                                 <td><input type="text" name="plotno" class="form-control"></td>

                                                             </tr>
                                                             <tr>
                                                                 <td >Area. </td>
                                                                 <td><input type="text" name="plotno" class="form-control"></td>
                                                             </tr>
                                                             <tr>
                                                                 <td >Certificate of Title No: . </td>
                                                                 <td><input type="text" name="plotno" class="form-control"></td>
                                                             </tr>
                                                             <tr>
                                                                 <td >Ownership:  It is registered in the name of. </td>
                                                                 <td><input type="text" name="plotno" class="form-control"></td>
                                                             </tr>
                                                             <tr>
                                                                 <td >Plot size  (Acres/Hectares). </td>
                                                                 <td><input type="text" name="plotno" class="form-control"></td>
                                                             </tr>
                                                             <tr>
                                                                 <td >Valuation date: Plot size  (Acres/Hectares). </td>
                                                                 <td><input type="text" name="plotno" class="form-control"></td>
                                                             </tr>
                                                             <tr>
                                                                 <td >Valuation date: Plot size  (Acres/Hectares). </td>
                                                                 <td><input type="text" name="plotno" class="form-control"></td>
                                                             </tr>
                                                             <tr>
                                                                 <td >Valued by. </td>
                                                                 <td><input type="text" name="plotno" class="form-control"></td>
                                                             </tr>
                                                             <tr>
                                                                 <td >Valuer estimate: </td>
                                                                 <td><input type="text" name="plotno" class="form-control"></td>
                                                             </tr>

                                                         </table>
                                                     </td>
                                                     <td><input name="" type="text" /> </td>
                                                     <td> <input name="" type="text" /></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            </td>

                                        </tr>

                                    </table>
                                </div>

                            </div>


                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="row row-bg">
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-1 col-md-offset-1" >
                <a href="#" class="btn btn-default ">Previous</a>
            </div>
            <div class="col-md-1 col-md-offset-7">
                <a href="{{url('tempex-form2')}}" class="btn btn-primary">Next >></a>
            </div>

        </div>
    </div>
@stop

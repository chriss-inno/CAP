@extends('layout.master')
@section('title')
    Credit Application | CA Proposal-Covenants
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
        Covenants
    </li>

@stop
@section('contents')
    {!! Form::open(array('url' => 'conventanty', 'class' => 'form-horizontal row-border')) !!}
    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-8" style="margin-left: 100px">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>D: Covenants</h4>
                    </div>
                    <div class="widget-content">

                            <div class="form-group">
                                <div class="col-md-12">
                                    @if($errors->has())
                                        <p><ol>
                                            @foreach ($errors->all() as $error)
                                                <li>  <p class=" alert-danger"> {{ $error }} </p>  </li>
                                            @endforeach
                                        </ol> </p>
                                    @endif
                                    <table class="table" id="convTB">
                                         <tr>
                                             <th>Pricing</th>
                                             <th>Facility</th>
                                             <th>Spread</th>
                                             <th>Effective rate</th>
                                             <th></th>
                                         </tr>
                                        <tr>
                                            <td><strong><small>Rate of Interest</small></strong></td>
                                            <td><strong><small>Funded</small></strong></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                        $crp_id=old('crp_id');
                                            if($crp_id)
                                                {$id=$crp_id;}

                                        $pricing=old('pricing');
                                        $facility=old('facility');
                                        $spread=old('pricing');
                                        $effective_rate=old('effective_rate');
                                           //Check if the array contents has some values
                                           $hasValue=0;
                                            $vdata="";
                                            for($i=0; $i<sizeof($pricing); $i++)
                                                {
                                                   if($pricing[$i] !=""  || $facility[$i] !="" || $spread[$i] !="")
                                                       {


                                                          $vdata .='<tr>
                                            <td><input type="text" class="form-control" name="pricing[]" value="'.$pricing[$i].'"></td>
                                            <td><input type="text" class="form-control" name="facility[]" value="'.$facility[$i].'"></td>
                                            <td><input type="text" class="form-control" name="spread[]" value="'.$spread[$i].'"></td>
                                            <td><input type="text" class="form-control" name="effective_rate[]" value="'.$effective_rate[$i].'"></td>
                                            <td></td>
                                        </tr>' ;
                                                           $hasValue ++;
                                                       }
                                                }
                                           if($hasValue >0)
                                               {
                                                   echo $vdata;

                                              ?>
                                        <tr>
                                            <td><input type="text" class="form-control" name="pricing[]"></td>
                                            <td><input type="text" class="form-control" name="facility[]"></td>
                                            <td><input type="text" class="form-control" name="spread[]"></td>
                                            <td><input type="text" class="form-control" name="effective_rate[]"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="pricing[]"></td>
                                            <td><input type="text" class="form-control" name="facility[]"></td>
                                            <td><input type="text" class="form-control" name="spread[]"></td>
                                            <td><input type="text" class="form-control" name="effective_rate[]"></td>
                                            <td><input type="button" value="Add" class="btn btn-primary" onclick="addRowCon();"></td>
                                        </tr>
                                        <?php
                                               }
                                           else
                                               {



                                        ?>

                                        <tr>
                                            <td><input type="text" class="form-control" name="pricing[]"></td>
                                            <td><input type="text" class="form-control" name="facility[]"></td>
                                            <td><input type="text" class="form-control" name="spread[]"></td>
                                            <td><input type="text" class="form-control" name="effective_rate[]"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="pricing[]"></td>
                                            <td><input type="text" class="form-control" name="facility[]"></td>
                                            <td><input type="text" class="form-control" name="spread[]"></td>
                                            <td><input type="text" class="form-control" name="effective_rate[]"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="pricing[]"></td>
                                            <td><input type="text" class="form-control" name="facility[]"></td>
                                            <td><input type="text" class="form-control" name="spread[]"></td>
                                            <td><input type="text" class="form-control" name="effective_rate[]"></td>
                                            <td><input type="button" value="Add" class="btn btn-primary" onclick="addRowCon();"></td>
                                        </tr>
                                    <?php }?>

                                    </table>
                                    <table class="table">

                                        <tbody>
                                        <tr>
                                            <td align="right"> <strong> Appraisal fee </strong> </td>
                                            <td ><input type="text" class="form-control"  name="appraisal_fee_1"></td>
                                            <td ><input type="text" class="form-control"  name="appraisal_fee_2"></td>
                                            <td ><input type="text"  class="form-control" name="appraisal_fee_3"></td>


                                        </tr>

                                        <tr>
                                            <td align="right"><strong>Disbursal</strong></td>
                                            <td colspan="4"><textarea name="disbursal" cols="4" rows="4" class="form-control"></textarea>
                                                @if($errors->first('disbursal'))
                                                    <p class=" alert-danger">{{$errors->first('disbursal')}}</p>
                                                @endif
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>


                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-8" style="margin-left: 100px">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>E: Pricing rationale</h4>
                    </div>
                    <div class="widget-content">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <h3 class="text-info">Account profitability  estimated at 80% utilization of the overdraft)
                                        figures in tzs "mio"
                                    </h3>
                                    </div>
                                </div>
                            <div class="form-group">
                                <div class="col-md-12">

                                    <table class="table" id="princingTB">
                                        <tr>
                                            <th>Facility</th>
                                            <th>Total annual interest</th>
                                            <th>Fees</th>

                                            <th></th>
                                        </tr>
                                        <?php
                                        $p_facility=old('p_facility');
                                        $p_interest=old('p_interest');
                                        $p_fees=old('p_fees');

                                        //Check if the array contents has some values
                                        $hasValue1=0;
                                        $vdata1="";
                                        for($i=0; $i<sizeof($pricing); $i++)
                                        {
                                            if($p_facility[$i] !=""  || $p_interest[$i] !="" || $p_fees[$i] !="")
                                            {
                                              $vdata1.='<tr>
                                            <td><input type="text" class="form-control" name="p_facility[]" value="'.$p_facility[$i].'"></td>
                                            <td><input type="text" class="form-control" name="p_interest[]" value="'.$p_interest[$i].'"></td>
                                            <td><input type="text" class="form-control" name="p_fees[]" value="'.$p_fees[$i].'"></td>
                                            <td></td>
                                        </tr>' ;
                                                $hasValue1++;
                                            }
                                        }
                                            if($hasValue1 >0)
                                                {

                                                 echo $vdata1;
                                            ?>
                                        <tr>
                                            <td><input type="text" class="form-control" name="p_facility[]"></td>
                                            <td><input type="text" class="form-control" name="p_interest[]"></td>
                                            <td><input type="text" class="form-control" name="p_fees[]"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="p_facility[]"></td>
                                            <td><input type="text" class="form-control" name="p_interest[]"></td>
                                            <td><input type="text" class="form-control" name="p_fees[]"></td>
                                            <td><input type="button" value="Add" class="btn btn-primary" onclick="addRowPricing();"></td>
                                        </tr>
                                        <?php
                                            }
                                            else
                                                {

                                                ?>
                                        <tr>
                                            <td><input type="text" class="form-control" name="p_facility[]"></td>
                                            <td><input type="text" class="form-control" name="p_interest[]"></td>
                                            <td><input type="text" class="form-control" name="p_fees[]"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="p_facility[]"></td>
                                            <td><input type="text" class="form-control" name="p_interest[]"></td>
                                            <td><input type="text" class="form-control" name="p_fees[]"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control" name="p_facility[]"></td>
                                            <td><input type="text" class="form-control" name="p_interest[]"></td>
                                            <td><input type="text" class="form-control" name="p_fees[]"></td>
                                            <td><input type="button" value="Add" class="btn btn-primary" onclick="addRowPricing();"></td>
                                        </tr>
                                        <?php }?>
                                    </table>
                                    <table class="table">

                                        <tr>
                                            <td class="col-md-6">1)	If the earnings in fees and commission adequately supplement the interest income.</td>
                                            <td class="col-md-6" rowspan="3"><textarea name="coments" cols="4" rows="8" class="form-control"></textarea>
                                                @if($errors->first('coments'))
                                                    <p class=" alert-danger">{{$errors->first('coments')}}</p>
                                                @endif</td>
                                        </tr>
                                        <tr>
                                            <td >2)	Is there any other reason to justify the proposed pricing- competition, market condition</td>

                                        </tr>
                                        <tr>
                                            <td >3)	Comment if there is any exceptions to the pricing grid as mentioned in the credit grading norm and the credit policy</td>

                                        </tr>


                                    </table>
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
                <a href="{{url('form3')}}" class="btn btn-primary"><< Previous</a>
            </div>
            <div class="col-md-1 col-md-offset-6">
                <input type="submit" name="Submit" class="btn btn-primary"  value="Next >>" />
                <input type="hidden" value="{{$id}}" name="crp_id" id="crp_id">
            </div>

        </div>
    </div>
    {!! Form::close() !!}
    <script>
        function addRowCon()
        {
            var table = document.getElementById('convTB');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            var cel3 = row.insertCell(2);
            var cel4 = row.insertCell(3);
            var cel5 = row.insertCell(4);

            cell.innerHTML=" <input type='text' class='form-control' name='pricing[]'>";
            cel2.innerHTML="<input type='text' class='form-control' name='facility[]'>";
            cel3.innerHTML="<input type='text' class='form-control' name='spread[]'>";
            cel4.innerHTML="<input type='text' class='form-control' name='effective_rate[]'>";
            cel5.innerHTML="<input type='button' name='button' id='button' value='Delete' class='btn btn-danger' />";
        }

        function addRowPricing()
        {
            var table = document.getElementById('princingTB');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            var cel3 = row.insertCell(2);
            var cel4 = row.insertCell(3);


            cell.innerHTML=" <input type='text' class='form-control' name='p_facility[]'>";
            cel2.innerHTML="<input type='text' class='form-control' name='p_interest[]'>";
            cel3.innerHTML="<input type='text' class='form-control' name='p_fees[]'>";
            cel4.innerHTML="<input type='button' name='button' id='button' value='Delete' class='btn btn-danger' />";
        }
    </script>
@stop

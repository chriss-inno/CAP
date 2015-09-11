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
        <a href="{{url('caproposal')}}">CA Proposal</a>
    </li>
    <li>
        Final recommendations
    </li>

@stop
@section('contents')
    <?php
            use App\CreditApp;
           $cr=CreditApp::find($id);


    ?>
    <div class="row row-bg">
        <div class="row" style="margin-left: 100px">
            <div class="col-md-8">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>G: Final recommendations</h4>
                    </div>
                    <div class="widget-content">
                        <form class="form-horizontal row-border" action="#">

                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <table id="freco" class="table">


                                        @foreach($cr->facility as $fc)

                                        @foreach( $fc->facilitylimits as $fl)


                                        <tr>
                                            <td>
                                      <table class="table">
                                           <tr>
                                               <td class="col-md-2"> <strong>Facility</strong></td>
                                               <td class="col-md-10"><input type="text" name="facility[]" class="form-control" value=" {{ $fl->facility}}"/></td>
                                           </tr>
                                          <tr>
                                              <td class="col-md-2">Amount</td>
                                              <td class="col-md-10"><input type="text" name="amount[]" class="form-control"/></td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Tenor</td>
                                              <td class="col-md-10"><input type="text"  name="tenor[]" class="form-control"/></td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Rate of interest</td>
                                              <td class="col-md-10"><input type="text" name="rate_interest[]" class="form-control"/></td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Credit rating and pricing</td>
                                              <td class="col-md-10">
                                                  <textarea name="cr_pricing[]"  cols="45" rows="8" class="form-control"></textarea>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Repayment</td>
                                              <td class="col-md-10"><input type="text" name="repayment[]" class="form-control"/></td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Facility fee</td>
                                              <td class="col-md-10"><input type="text" name="facility_fee[]" class="form-control"/></td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Review Date</td>
                                              <td class="col-md-10"><input type="text" name="review_date[]" class="form-control"/></td>
                                          </tr>
                                      </table>
                                            </td>

                                        </tr>

                                            @endforeach
                                        @endforeach
                                    </table>
                                </div>

                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-3">
                                    <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS();" />
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
                <a href="{{url('form5')}}" class="btn btn-primary"><< Previous</a>
            </div>
            <div class="col-md-1 col-md-offset-5">
                <a href="{{url('form6')}}" class="btn btn-primary">Finish</a>
            </div>

        </div>
    </div>
    <script>
        function addRowFS()
        {
            var table = document.getElementById('freco');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            cell.innerHTML  =" <table class='table'><tr><td class='col-md-2'> <strong>Facility</strong></td><td class='col-md-10'><input type='text' name='facility[]' class='form-control'/></td></tr><tr><td class='col-md-2'>Amount</td><td class='col-md-10'><input type='text' name='amount[]' class='form-control'/></td></tr><tr><td class='col-md-2'>Tenor</td><td class='col-md-10'><input type='text'  name='tenor[]' class='form-control'/></td></tr><tr><td class='col-md-2'>Rate of interest</td><td class='col-md-10'><input type='text' name='rate_interest[]' class='form-control'/></td></tr><tr><td class='col-md-2'>Credit rating and pricing</td><td class='col-md-10'><input type='text' name='cr_pricing[]' class='form-control'/></td></tr><tr><td class='col-md-2'>Repayment</td><td class='col-md-10'><input type='text' name='replayment[]' class='form-control'/></td></tr><tr><td class='col-md-2'>Facility fee</td><td class='col-md-10'><input type='text' name='facility_fee[]' class='form-control'/></td></tr>  </table>";
            cel2.innerHTML ="<input type='button' name='button' id='delbtn' value='Delete' class='btn btn-danger' />";
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


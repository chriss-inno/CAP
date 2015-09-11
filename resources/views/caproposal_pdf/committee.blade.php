
{!!HTML::style('bootstrap/css/bootstrap.min.css')!!}
<?php

        $st=\App\CreditDepartmentSetting::all()->first();
        $dpt_head="";
        $dpt_analyst="";
        $dpt_chief="";

        if(count($st) >0 )
        {
            $dpt_head=$st->dpt_head;
            $dpt_analyst=$st->dpt_analyst;
            $dpt_chief=$st->dpt_chief;
        }
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            Submitted for Approval
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-3 pull-left">
            <hr style="background-color: #000000; height: 1px; "/>
            <p>
               <strong> {{$dpt_head}} <br/> Head Credit Risk</strong>
            </p>
        </div>
        <div class="col-md-3 pull-right">
            <hr style="background-color: #000000; height: 1px; "/>
            <p>
                <strong> {{$dpt_analyst}} <br/>  Credit Analyst</strong>
            </p>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-4 col-lg-offset-4">
            <center><strong> Recommended by:</strong> <br/></center>
            <hr style="background-color: #000000; height: 1px; width: 200px;"/>
            <center><strong> Chief Credit Officer</strong></center>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" style="border: 1px solid #000; background-color: #EEEEEE">

                <tr>
                    <td class="col-md-4" colspan="3"  align="center" ><strong>RECOMMENDED BY MANAGEMENT CREDIT COMMITTEE (MCC)</strong></td>

                </tr>
                <tr>
                    <td ></td>
                    <td class="col-md-4"  align="center"><strong>NAME</strong></td>
                    <td class="col-md-4" align="center"><strong>SIGNATURE</strong></td>
                </tr>

                <?php $cmt=\App\CreditCommitee::all();?>
                @if(count($cmt) >0)
                    <?php $c=0; ?>
                    @foreach($cmt as $ct)
                            <?php $c++; ?>
                          <tr>
                            <td  class="col-md-1">{{$c}}</td>
                            <td class="col-md-6"  ><strong>{{$ct->firstname}}</strong></td>
                            <td class="col-md-5"  ></td>
                          </tr>
                    @endforeach
                @endif

            </table>
        </div>
    </div>
        @if($crp->approval_limit != 0)
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <table class="table table-bordered" style="border: 1px solid #000; background-color: #EEEEEE">

                <tr>
                    <td class="col-md-4" colspan="3"  align="center" ><strong>APPROVED  BY DIRECTOR  CREDIT COMMITTEE (DCC)</strong></td>

                </tr>
                <tr>
                    <td ></td>
                    <td class="col-md-4"  align="center"><strong>NAME</strong></td>
                    <td class="col-md-4" align="center"><strong>SIGNATURE</strong></td>
                </tr>

                <?php $dcm=\App\DirectorCommmittee::all();?>
                @if(count($dcm) >0)
                    <?php $c=0; ?>
                    @foreach($dcm as $ct)
                        <?php $c++; ?>
                        <tr>
                            <td  class="col-md-1">{{$c}}</td>
                            <td class="col-md-6"  ><strong>{{$ct->firstname}}</strong></td>
                            <td class="col-md-5"  ></td>
                        </tr>
                    @endforeach
                @endif

            </table>
        </div>
    </div>
        @endif
</div>

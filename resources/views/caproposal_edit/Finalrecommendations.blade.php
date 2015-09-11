<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$fr="";
$fcl="";
        $fs_id="";
if( count($crp->facilitystructure) >0 )
{
    $fr=$crp->facilitystructure->finalrecommendations;
    $fs_id=$crp->facilitystructure->id;
    $apprequest=1;
}
$rules = ['coments'=>'required'];
?>
{!! Form::open(array('url' => 'final-recommendations', 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules ) !!}
    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>G: Final recommendations</h4>
                    </div>
                    <div class="widget-content">

                           @if( $fr  !="" && count($fr) != 0 )



                                        @if( count($fr) >0 )

                                            @foreach($fr as $frec)
                                    <div class="form-group" style="padding: 10px;">
                                                       <div class="row" style="margin-top: 5px;">
                                                           <div  class="col-md-2"> <strong>Facility</strong></div >
                                                           <div  class="col-md-5"><input type="text" name="facility[]" class="form-control" readonly="readonly" value="{{$frec->facility}}"/></div >
                                                           <div  class="col-md-5"><input name="facility_comments[]" value="{{$frec->facility_comments}}" class="form-control" placeholder="Write Comments(Option)"></div >
                                                        </div>
                                                        <div class="row" style="margin-top: 5px;">
                                                           <div  class="col-md-2">Amount</div >
                                                           <div  class="col-md-10"><input type="text" name="amount[]" class="form-control" value="{{$frec->amount}}"/></div >
                                                        </div>
                                                        <div class="row" style="margin-top: 5px;">
                                                           <div  class="col-md-2">Tenor </div >
                                                           <div  class="col-md-10"><input type="text"  name="tenor[]" class="form-control" value="{{$frec->tenor}}"/></div >
                                                        </div>
                                                        <div class="row" style="margin-top: 5px;">
                                                           <div  class="col-md-2">
                                                               @if( \App\Http\Controllers\FinalRecommendationsController::checkOverdraft($frec->facility) )
                                                               Rate of interest/commission
                                                                   @else
                                                                   Rate of interest/commission
                                                               @endif
                                                           </div >
                                                           <div  class="col-md-10"><input type="text" name="rate_interest[]" class="form-control" value="{{$frec->rate_interest}}"/></div >
                                                        </div>
                                                        <div class="row" style="margin-top: 5px;">
                                                           <div  class="col-md-2">Credit rating and pricing</div >
                                                           <div  class="col-md-10">
                                                                <textarea name="cr_pricing[]"  cols="45" rows="8" class="form-control">{{$frec->cr_pricing}}</textarea>
                                                            </div >
                                                        </div>
                                                        <div class="row" style="margin-top: 5px;">
                                                           <div  class="col-md-2">Repayment</div >
                                                           <div  class="col-md-10"><input type="text" name="repayment[]" class="form-control" value="{{$frec->repayment}}"/></div >
                                                        </div>
                                                        <div class="row" style="margin-top: 5px;">
                                                           <div  class="col-md-2">Facility fee</div >
                                                           <div  class="col-md-10"><input type="text" name="facility_fee[]" class="form-control" value="{{$frec->facility_fee}}"/></div >
                                                        </div>
                                                        <div class="row" style="margin-top: 5px;">
                                                           <div  class="col-md-2">Review Date</div >
                                                           <div  class="col-md-10"><input type="text" name="review_date[]" class="form-control" value="{{$frec->review_date}}"/></div >
                                                        </div>
                                    </div>
                                            @endforeach
                                       @endif


                            </div>



                    </div>
                    @else
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1"> <h1 class="text-danger text-uppercase"> Please you're not allowed to proceed here before completing Facility Structure form </h1> </div>
                        </div>
                        @endif
                </div>
            </div>

        </div>

    </div>
    <div class="row" style="margin-left: 20px; margin-bottom: 30px">
        <div class="col-md-12">
            <div class="col-md-2 pull-right">
                <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
            </div>
            @if( $fr != null && count($fr) != 0 )
            <div class="col-md-2 pull-right">
                <button type="submit" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
                <input type="hidden" name="id" value="@if(old('id') != "") {{old('id')}} @else {{$id}} @endif"/>
                <input type="hidden" name="crp_id" value="@if(old('crp_id') != "") {{old('crp_id')}} @else {{$crid}} @endif"/>
                <input type="hidden" name="fs_id" value="@if(old('fs_id') != "") {{old('fs_id')}} @else {{$fs_id}} @endif"/>
                <input type="hidden" name="apprequest" value="@if(old('apprequest') != "") {{old('apprequest')}} @else {{$apprequest}} @endif"/>
            </div>
            <div id="output" class="col-md-8"></div>
                @endif
        </div>
    </div>
    {!! Form::close() !!}
    <script>

        //Callback handler for form submit event

        //Callback handler for form submit event
        $("#ajax-form").validate({
            submitHandler: function(form) {
                $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
                var postData = $('#ajax-form').serializeArray();
                var formURL = $('#ajax-form').attr("action");
                $.ajax(
                        {
                            url : formURL,
                            type: "POST",
                            data : postData,
                            success:function(data)
                            {
                                console.log(data);
                                //data: return data from server
                                $("#appcontentslist").load("<?php echo url("credit-proposal/app")."/".$crid; ?>");
                                $("#output").html(data);
                                setTimeout(function() {
                                    $("#myModal").modal("hide");
                                }, 3000);
                            },
                            error: function(data)
                            {
                                console.log(data.responseJSON);
                                //in the responseJSON you get the form validation back.
                                $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Error in processing data try again...</span><h3>");
                                $("#appcontentslist").load("<?php echo url("credit-proposal/app")."/".$crid; ?>");
                                $("#output").html(data);
                                setTimeout(function() {
                                    $("#myModal").modal("hide");
                                }, 3000);
                            }
                        });
            }
        });
    </script>



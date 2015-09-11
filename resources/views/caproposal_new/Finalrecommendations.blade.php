<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$fr="";
$fcl="";
if( count($crp->finalRecommendations) >0 )
{
    $fr=$crp->finalRecommendations;

    $apprequest=1;
}

?>
{!! Form::open(array('url' => 'final-recommendations', 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}
    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>G: Final recommendations</h4>
                    </div>
                    <div class="widget-content">

                           @if( $crp->facilitystructure != null && count($crp->facilitystructure) != 0 )

                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <table id="freco" class="table">

                                        @if( count($crp->finalRecommendations) >0 )
                                            @foreach($fr as $frec)
                                            <tr>
                                                <td>
                                                    <table class="table">
                                                        <tr>
                                                            <td class="col-md-2"> <strong>Facility</strong></td>
                                                            <td class="col-md-10"><input type="text" name="facility[]" class="form-control" readonly="readonly" value=" {{ $frec->facility}}"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-2">Amount</td>
                                                            <td class="col-md-10"><input type="text" name="amount[]" class="form-control" value=" {{ $frec->amount}}"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-2">Tenor</td>
                                                            <td class="col-md-10"><input type="text"  name="tenor[]" class="form-control" value=" {{ $frec->tenor}}"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-2">Rate of interest</td>
                                                            <td class="col-md-10"><input type="text" name="rate_interest[]" class="form-control" value=" {{ $frec->rate_interest}}"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-2">Credit rating and pricing</td>
                                                            <td class="col-md-10">
                                                                <textarea name="cr_pricing[]"  cols="45" rows="8" class="form-control">{{ $frec->cr_pricing}}</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-2">Repayment</td>
                                                            <td class="col-md-10"><input type="text" name="repayment[]" class="form-control" value=" {{ $frec->repayment}}"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-2">Facility fee</td>
                                                            <td class="col-md-10"><input type="text" name="facility_fee[]" class="form-control" value=" {{ $frec->facility_fee}}"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-2">Review Date</td>
                                                            <td class="col-md-10"><input type="text" name="review_date[]" class="form-control" value=" {{ $frec->review_date}}"/></td>
                                                        </tr>
                                                    </table>
                                                </td>

                                            </tr>
                                            @endforeach
                                            @else
                                        @foreach($crp->facilitystructure->facilitylimits as $fc)
                                        <tr>
                                            <td>
                                      <table class="table">
                                           <tr>
                                               <td class="col-md-2"> <strong>Facility</strong></td>
                                               <td class="col-md-10"><input type="text" name="facility[]" class="form-control" readonly="readonly" value=" {{ $fc->facility}}"/></td>
                                           </tr>
                                          <tr>
                                              <td class="col-md-2">Amount</td>
                                              <td class="col-md-10"><input type="text" name="amount[]" class="form-control" value=" "/></td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Tenor</td>
                                              <td class="col-md-10"><input type="text"  name="tenor[]" class="form-control" value=" "/></td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Rate of interest</td>
                                              <td class="col-md-10"><input type="text" name="rate_interest[]" class="form-control" value=" "/></td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Credit rating and pricing</td>
                                              <td class="col-md-10">
                                                  <textarea name="cr_pricing[]"  cols="45" rows="8" class="form-control"></textarea>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Repayment</td>
                                              <td class="col-md-10"><input type="text" name="repayment[]" class="form-control" value=" "/></td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Facility fee</td>
                                              <td class="col-md-10"><input type="text" name="facility_fee[]" class="form-control" value=" "/></td>
                                          </tr>
                                          <tr>
                                              <td class="col-md-2">Review Date</td>
                                              <td class="col-md-10"><input type="text" name="review_date[]" class="form-control" value=" "/></td>
                                          </tr>
                                      </table>
                                            </td>

                                        </tr>

                                            @endforeach
                                       @endif
                                    </table>
                                </div>

                            </div>
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
            @if( $crp->facilitystructure != null && count($crp->facilitystructure) != 0 )
            <div class="col-md-2 pull-right">
                <button type="button" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
                <input type="hidden" name="id" value="@if(old('id') != "") {{old('id')}} @else {{$id}} @endif"/>
                <input type="hidden" name="crp_id" value="@if(old('crp_id') != "") {{old('crp_id')}} @else {{$crid}} @endif"/>
                <input type="hidden" name="apprequest" value="@if(old('apprequest') != "") {{old('apprequest')}} @else {{$apprequest}} @endif"/>
            </div>
            <div id="output" class="col-md-8"></div>
                @endif
        </div>
    </div>
    {!! Form::close() !!}
    <script>

        //Callback handler for form submit event
        $('#submitButton').click( function() {

            function getDoc(frame) {
                var doc = null;

                // IE8 cascading access check
                try {
                    if (frame.contentWindow) {
                        doc = frame.contentWindow.document;
                    }
                } catch(err) {
                }

                if (doc) { // successful getting content
                    return doc;
                }

                try { // simply checking may throw in ie8 under ssl or mismatched protocol
                    doc = frame.contentDocument ? frame.contentDocument : frame.document;
                } catch(err) {
                    // last attempt
                    doc = frame.document;
                }
                return doc;
            }
            $("#FileUploader").submit(function(e)
            {

                var formObj = $(this);
                var formURL = formObj.attr("action");

                if(window.FormData !== undefined)  // for HTML5 browsers
                {

                    var formData = new FormData(this);
                    $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
                    $.ajax({
                        url: '<?php echo url('final-recommendations') ?>',
                        type: 'POST',
                        data:  formData,
                        mimeType:"multipart/form-data",
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data, textStatus, jqXHR)
                        {
                            $("#appcontentslist").load("<?php echo url("credit-proposal/app/").$crid; ?>");
                            $("#output").html("<h3><span class='text-success'>Successiful saved <h3>");
                            setTimeout(function() {
                                $("#myModal").modal("hide");
                            }, 3000);
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Error in processing data try again...</span><h3>");
                            $("#appcontentslist").load("<?php echo url("credit-proposal/app/").$crid; ?>");
                            $("#output").html("<h3><span class='text-success'>Successiful saved <h3>");
                            setTimeout(function() {
                                $("#myModal").modal("hide");
                            }, 3000);
                        }
                    });
                    e.preventDefault();
                    e.unbind();
                }
                else  //for olden browsers
                {
                    //generate a random id
                    var  iframeId = 'unique' + (new Date().getTime());

                    //create an empty iframe
                    var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

                    //hide it
                    iframe.hide();

                    //set form target to iframe
                    formObj.attr('target',iframeId);

                    //Add iframe to body
                    iframe.appendTo('body');
                    iframe.load(function(e)
                    {
                        var doc = getDoc(iframe[0]);
                        var docRoot = doc.body ? doc.body : doc.documentElement;
                        var data = docRoot.innerHTML;
                        //data is returned from server.

                    });

                }
            });
            $("#FileUploader").submit();
        });

    </script>



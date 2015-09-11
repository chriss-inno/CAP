<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$covs="";
$pricing="";
$disbursal="";
$appraisal_fee_3="";
$appraisal_fee_2="";
$appraisal_fee_1="";
if( count($crp->covenants) !=0 )
{
    $covs=$crp->covenants;
    $pricing=$crp->covenants->pricing;
    $disbursal=$covs->disbursal;
    $appraisal_fee_3=$covs->appraisal_fee_1;
    $appraisal_fee_2=$covs->appraisal_fee_2;
    $appraisal_fee_1=$covs->appraisal_fee_3;
    $id=$covs->id;
    $apprequest=1;
}
?>
    {!! Form::open(array('url' => 'conventanty', 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}
    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-12">
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

                                        @if(count($pricing) > 0 && $pricing != null)
                                            <?php $c=0; ?>
                                            @foreach($pricing as $pc)
                                        <tr>
                                            <td><input type="text" class="form-control" name="pricing[]" value="{{$pc->pricing}}"></td>
                                            <td><input type="text" class="form-control" name="facility[]" value="{{$pc->facility}}"></td>
                                            <td><input type="text" class="form-control" name="spread[]" value="{{$pc->spread}}"></td>
                                            <td><input type="text" class="form-control" name="effective_rate[]" value="{{$pc->effective_rate}}"></td>
                                            <td></td>
                                        </tr>
                                                <?php $c++; ?>
                                            @endforeach


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
                                            @else
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
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="pricing[]"></td>
                                                <td><input type="text" class="form-control" name="facility[]"></td>
                                                <td><input type="text" class="form-control" name="spread[]"></td>
                                                <td><input type="text" class="form-control" name="effective_rate[]"></td>
                                                <td><input type="button" value="Add" class="btn btn-primary" onclick="addRowCon();"></td>
                                            </tr>
                                        @endif

                                    </table>
                                    <table class="table">

                                        <tbody>
                                        <tr>
                                            <td align="right"> <strong> Appraisal fee </strong> </td>
                                            <td ><input type="text" class="form-control"  name="appraisal_fee_1" value="{{$appraisal_fee_1}}"></td>
                                            <td ><input type="text" class="form-control"  name="appraisal_fee_2" value="{{$appraisal_fee_2}}"></td>
                                            <td ><input type="text"  class="form-control" name="appraisal_fee_3" value="{{$appraisal_fee_3}}"></td>


                                        </tr>

                                        <tr>
                                            <td align="right"><strong>Disbursal</strong></td>
                                            <td colspan="4"><textarea name="disbursal" cols="4" rows="4" class="form-control">{{$disbursal}}</textarea>
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


    </div>
<div class="row" style="margin-left: 20px; margin-bottom: 30px">
    <div class="col-md-12">
        <div class="col-md-2 pull-right">
            <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
        </div>
        <div class="col-md-2 pull-right">
            <button type="button" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
            <input type="hidden" name="id" value="@if(old('id') != "") {{old('id')}} @else {{$id}} @endif"/>
            <input type="hidden" name="crp_id" value="@if(old('crp_id') != "") {{old('crp_id')}} @else {{$crid}} @endif"/>
            <input type="hidden" name="apprequest" value="@if(old('apprequest') != "") {{old('apprequest')}} @else {{$apprequest}} @endif"/>
        </div>
        <div id="output" class="col-md-8"></div>
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
                        url: '<?php echo url('conventanty') ?>',
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


<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$political_economic="";
$sector_performance="";
$position_sector="";
$regulatory="";
$environmental_issues="";

if( count($crp->environment) !=0 )
{

    $id=$crp->environment->id;
    $political_economic=$crp->environment->political_economic;
    $sector_performance=$crp->environment->sector_performance;
    $position_sector=$crp->environment->position_sector;
    $regulatory=$crp->environment->regulatory;
    $environmental_issues=$crp->environment->environmental_issues;
    $apprequest=1;
}
?>

{!! Form::open(array('url' =>url('environment'), 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}
<div class="row row-bg">
    <div class="row" >
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i>Environment</h4>
                </div>
                <div class="widget-content">

                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Political and economic </strong>
                            <p><ol>
                                <li>General economic environment GDP growth rate, industrial climate state of infrastructure political stability</li>
                            </ol>
                            </p>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="political_economic" >{{$political_economic}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Sector (Industry) Performance</strong>
                            <p><ol>
                                <li>Is the sector growth rate in sync with the growth in national economy- what is the growth rate is it steady.</li>
                            </ol></p>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="sector_performance" >{{$sector_performance}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Position with business ector/ Industry</strong>
                            <p><ol>

                            </ol></p>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="position_sector" >{{$position_sector}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Regulatory</strong>
                            <p><ol>

                            </ol></p>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="regulatory" >{{$regulatory}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Ecological/ Environmental issues</strong>
                            <p><ol>

                            </ol></p>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="environmental_issues" >{{$environmental_issues}}</textarea>
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
                    url: '<?php echo url('environment') ?>',
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



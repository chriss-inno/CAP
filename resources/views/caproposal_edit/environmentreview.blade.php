
{!!HTML::script("assets/js/tinymce/tinymce.min.js")!!}
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        plugins: [
            "advlist autolink lists   charmap   anchor",
            "insertdatetime  contextmenu paste"
        ],
        toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent "
    });
</script>
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
$rules = ['political_economic'=>'required','sector_performance'=>'required','position_sector'=>'required','regulatory'=>'required','environmental_issues'=>'required'];
?>
{!! Form::open(array('url' =>url('environment'), 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules) !!}
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
                            {!! Form::textarea('political_economic', $political_economic, array('class' => 'form-control','placeholder'=>'Enter Political and economic'))  !!}

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

                            {!! Form::textarea('sector_performance', $sector_performance, array('class' => 'form-control','placeholder'=>'Enter Sector (Industry) Performance'))  !!}

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Position with business sector/ Industry</strong>
                            <p><ol>
                                <li>Markrt share /Position</li>
                                <li>is steady, declining, improving?</li>
                                <li>Any specific strategies to improve it</li>
                                <li>Name of the main competitors, if possible with their market share</li>
                            </ol></p>
                        </div>
                        <div class="col-md-9">
                            {!! Form::textarea('position_sector', $position_sector, array('class' => 'form-control','placeholder'=>'Enter Position with business sector'))  !!}

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Regulatory</strong>
                            <p><ol>
                                <li>Any regulatory body governing the sector, name it</li>
                                <li>Is there any fresh directive from such bodies or Govt current or imminent to affect business either positively or negatively?</li>
                            </ol></p>
                        </div>
                        <div class="col-md-9">
                            {!! Form::textarea('regulatory', $regulatory, array('class' => 'form-control','placeholder'=>'Enter Regulatory'))  !!}

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Ecological/ Environmental issues</strong>
                            <p><ol>
                                <li>If the operation of the company have any environmental impact.</li>
                                <li>If the company has all the clearance from the respective authorities</li>
                            </ol></p>
                        </div>
                        <div class="col-md-9">
                            {!! Form::textarea('environmental_issues', $environmental_issues, array('class' => 'form-control','placeholder'=>'Enter Ecological/ Environmental issues'))  !!}

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
            <button type="submit" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
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




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
$swot_strength="";
$swot_weaknesses="";
$swot_opportunities="";
$swot_threats="";
$swot_issues="";

if( count($crp->swotanalysis) !=0 )
{

    $id=$crp->swotanalysis->id;
    $swot_strength=$crp->swotanalysis->swot_strength;
    $swot_weaknesses=$crp->swotanalysis->swot_weaknesses;
    $swot_opportunities=$crp->swotanalysis->swot_opportunities;
    $swot_threats=$crp->swotanalysis->swot_threats;

    $apprequest=1;
}
$rules = ['swot_strength'=>'required','swot_weaknesses'=>'required','swot_opportunities'=>'required','swot_threats'=>'required'];
?>

{!! Form::open(array('url' =>url('swot-analysis'), 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules) !!}
<div class="row row-bg">
    <div class="row" >
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> (D) SWOT ANALYSIS</h4>
                </div>
                <div class="widget-content">


                        <div class="form-group">
                        <div class="col-md-12">
                            <strong>Strength </strong>

                        </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::textarea('swot_strength',$swot_strength,array('class'=>'form-control')) !!}

                        </div>
                            </div>


                        <div class="form-group">
                        <div class="col-md-12">
                            <strong>Weaknesses</strong>

                        </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::textarea('swot_weaknesses',$swot_weaknesses,array('class'=>'form-control')) !!}

                        </div>
                        </div>


                        <div class="form-group">
                        <div class="col-md-12">
                            <strong>Opportunities</strong>

                        </div>
                        </div>
                        <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::textarea('swot_opportunities',$swot_opportunities,array('class'=>'form-control')) !!}

                        </div>
                        </div>


                    <div class="form-group">
                        <div class="col-md-12">
                            <strong>Threats</strong>

                        </div>
                        </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::textarea('swot_threats',$swot_threats,array('class'=>'form-control')) !!}

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



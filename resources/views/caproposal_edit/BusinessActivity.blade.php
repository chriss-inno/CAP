
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
$sales_distributions="";
$credit_terms="";
$product_traded="";
$org_hq="";
$business_activity="";

if( count($crp->businessactivity) !=0 )
{
    $sales_distributions=$crp->businessactivity->sales_distributions;
    $credit_terms=$crp->businessactivity->credit_terms;
    $product_traded=$crp->businessactivity->product_traded;
    $org_hq=$crp->businessactivity->org_hq;
    $business_activity=$crp->businessactivity->business_activity;
    $id=$crp->businessactivity->id;
    $apprequest=1;
}
$rules = ['business_activity'=>'required','org_hq'=>'required','sales_distributions'=>'required','credit_terms'=>'required','product_traded'=>'required'];
?>
{!! Form::open(array('url' =>url('business-activity'), 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules) !!}
    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>G: Business Activity</h4>
                    </div>
                    <div class="widget-content">

                                <div class="form-group">

                                           <div class="col-md-12">Business Activity</div>
                                </div>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            {!! Form::textarea('business_activity',$business_activity,array('class'=>'form-control')) !!}
                                        </div>
                                </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                 <strong>Organization Headquarters and hubs</strong>
                                <p><ol>
                                    <li>Location of the HO.</li>
                                    <li>Location of the central yard.</li>
                                    <li>Project site office.</li>
                                </ol></p>
                            </div>
                            <div class="col-md-9">

                                {!! Form::textarea('org_hq',$org_hq,array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <strong>Products Traded</strong>
                                <p><ol>
                                    <li>List of the products, the parent company of the products, and their share in the company Turnover, Local or imported.</li>
                                </ol></p>
                            </div>
                            <div class="col-md-9">
                                {!! Form::textarea('product_traded',$product_traded,array('class'=>'form-control')) !!}

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <strong>Procurement and Credit terms</strong>
                                <p><ol>
                                    <li>Mostly imported or local. What is the % of import content.</li>
                                    <li>Any fixed supply arrangement with any supplier.</li>
                                    <li>Name  important suppliers.</li>
                                </ol></p>
                            </div>
                            <div class="col-md-9">
                                {!! Form::textarea('credit_terms',$credit_terms,array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <strong>Sales and Distribution</strong>
                                <p><ol>
                                    <li>How is the contract procured. Who  or which department handles the biding process</li>
                                    <li>Does the company have adequate skilled manpower.</li>
                                    <li>Main clients , percentage of sales contributed</li>
                                </ol></p>
                            </div>
                            <div class="col-md-9">
                               {!! Form::textarea('sales_distributions',$sales_distributions,array('class'=>'form-control')) !!}
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



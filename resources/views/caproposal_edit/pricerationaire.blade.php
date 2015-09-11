
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
$pric="";
$details="";
$coments="";
if( count($crp->pricingrationale) >0 )
{
    $apprequest=1;
    $pric=$crp->pricingrationale;
    $id=$pric->id;
    $details=$pric->details;
    $coments=$pric->coments;
}
$rules = ['coments'=>'required'];
?>
{!! Form::open(array('url' => 'pricingrationale', 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules) !!}
<div class="row row-bg">
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i>E: Pricing rationale</h4>
                </div>
                <div class="widget-content">

                    <div class="form-group">
                        <div class="col-md-12">
                            <h3 class="text-info">Account profitability  estimated at 80% utilization of the overdraft)
                                figures in TZS  "mio"
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
                                @if($details !="" && count($details) >0)
                                   <?php  $countD=1; ?>
                                    @foreach($details as $dt)
                                <tr>
                                    <td><input type="text" class="form-control" name="p_facility[]" value="{{$dt->facility}}"></td>
                                    <td><input type="text" class="form-control" name="p_interest[]" value="{{$dt->anual_interest}}"></td>
                                    <td><input type="text" class="form-control" name="p_fees[]" value="{{$dt->fees}}"></td>
                                    <td>
                                        @if($countD ==1)
                                            <input type="button" value="Add" class="btn btn-primary" onclick="addRowPricing();">
                                      @else
                                            <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove</a>
                                        @endif
                                    </td>
                                </tr>
                                           <?php  $countD++; ?>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td><input type="text" class="form-control" name="p_facility[]"></td>
                                        <td><input type="text" class="form-control" name="p_interest[]"></td>
                                        <td><input type="text" class="form-control" name="p_fees[]"></td>
                                        <td><input type="button" value="Add" class="btn btn-primary" onclick="addRowPricing();"></td>
                                    </tr>
                                @endif

                            </table>
                            <table class="table">

                                <tr>
                                    <td class="col-md-4">
                                        <ol>
                                            <li> If the earnings in fees and commission adequately supplement the interest income.</li>
                                            <li>Is there any other reason to justify the proposed pricing- competition, market condition</li>
                                            <li>Comment if there is any exceptions to the pricing grid as mentioned in the credit grading norm and the credit policy</li>
                                        </ol>
                                       </td>
                                    <td class="col-md-8">
                                        {!! Form::textarea('coments', $coments, array('class' => 'form-control','placeholder'=>'Enter purpose','required'=>'required'))  !!}

                                       </td>
                                </tr>


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
        cel5.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove</a>";
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
        cel4.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove</a>";
    }
    function rmOption(o)
    {
        var p=o.parentNode.parentNode;
        p.parentNode.removeChild(p);
    }
</script>


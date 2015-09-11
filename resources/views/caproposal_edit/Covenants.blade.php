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
    $appraisal_fee_1=$covs->appraisal_fee_1;
    $appraisal_fee_2=$covs->appraisal_fee_2;
    $appraisal_fee_3=$covs->appraisal_fee_3;
    $id=$covs->id;
    $apprequest=1;
}
$rules = ['disbursal'=>'required'];
?>
    {!! Form::open(array('url' => 'conventanty', 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules) !!}
    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>D: Covenants</h4>
                    </div>
                    <div class="widget-content">
                        <div class="form-group">
                            <div class="col-md-2 pull-right text-info">
                                <input type="button" value="Add Facility Type" class="btn btn-primary btn-block" onclick="addSecsRows();">
                            </div>
                            <div class="col-md-3 pull-right ">
                                <select name="secSelectOpt" id="secSelectOpt"  class="form-control" onchange="getSecsOPT(this);">
                                    <option value="">--Select facility type to add--</option>
                                    <option>Funded</option>
                                    <option>Non Funded</option>
                                </select>
                            </div>
                            <div class="col-md-3 pull-right text-right text-info">
                                <strong>Select facility type to add:</strong>
                            </div>
                        </div>

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
                                             <th class="col-md-4">Pricing</th>
                                             <th class="col-md-3">Facility</th>
                                             <th class="col-md-3">Spread</th>
                                             <th class="col-md-2">Effective rate</th>
                                             <th></th>
                                         </tr>

                                        @if(count($pricing) > 0 && $pricing != null)
                                            <?php $c=0; ?>
                                            @foreach($pricing as $pc)
                                                @if($pc->fund_type =="Funded")
                                                        <tr>
                                                            <td><strong><small>Rate of Interest</small></strong></td>
                                                            <td><strong><small>Funded</small></strong></td>
                                                            <td><input type='hidden' name='fund_type[]' value='{{$pc->fund_type}}'/></td>
                                                            <td><input type='hidden' class='form-control' name='type_nonfunded[]' value='{{$pc->type_nonfunded}}'></td>
                                                            <td><a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove {{$pc->fund_type}}</a></td>
                                                        </tr>

                                                        <tr>
                                                            <td><input type='text' class='form-control' name='pricing[]' value='{{$pc->pricing}}'></td>
                                                            <td><input type='text' class='form-control' name='facility[]' value='{{$pc->facility}}'></td>
                                                            <td><input type='text' class='form-control' name='spread[]' value='{{$pc->spread}}'></td>
                                                            <td><input type='text' class='form-control' name='effective_rate[]' value='{{$pc->effective_rate}}'></td>
                                                            <td><a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove {{$pc->fund_type}}</a></td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td><strong><small>Type of non funded facility</small></strong></td>
                                                            <td><strong><input type='text' class='form-control' name='type_nonfunded[]' value='{{$pc->type_nonfunded}}'></strong></td>
                                                            <td><input type='text' class='form-control' name='nonfunded_spread[]' value='{{$pc->nonfunded_spread}}'><input type='hidden' name='fund_type[]' value='{{$pc->fund_type}}'/></td>
                                                            <td><input type='text' class='form-control' name='nonfunded_ef_rate[]' value='{{$pc->nonfunded_ef_rate}}'></td>
                                                            <td><a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove {{$pc->fund_type}}</a></td>
                                                        </tr>

                                                        <tr>
                                                            <td><input type='text' class='form-control' name='pricing[]' value='{{$pc->pricing}}'></td>
                                                            <td><input type='text' class='form-control' name='facility[]' value='{{$pc->facility}}'></td>
                                                            <td><input type='text' class='form-control' name='spread[]' value='{{$pc->spread}}'></td>
                                                            <td><input type='text' class='form-control' name='effective_rate[]' value='{{$pc->effective_rate}}'></td>
                                                            <td><a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove {{$pc->fund_type}}</a></td>
                                                        </tr>
                                                    @endif
                                                <?php $c++; ?>
                                            @endforeach

                                            @else
                                        @endif

                                    </table>

                                </div>

                            </div>
                        <div class="form-group">
                            <div class="col-md-2 ">
                                <strong> Appraisal fee </strong>
                            </div>
                            <div class="col-md-5">
                                <input type="text"  class="form-control" name="appraisal_fee_3" value="{{$appraisal_fee_3}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2" >
                                <strong>Disbursal</strong>
                            </div>
                            <div class="col-md-10">
                                {!! Form::textarea('disbursal', $disbursal, array('class' => 'form-control','placeholder'=>'Enter purpose'))  !!}

                                @if($errors->first('disbursal'))
                                    <p class=" alert-danger">{{$errors->first('disbursal')}}</p>
                                @endif
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

        function addSecsRows()
        {
            var data=$("#secSelectOpt").val();

            if( data=="Funded")
            {
                var table = document.getElementById('convTB');
                var row = table.insertRow(-1);
                var row2 = table.insertRow(-1);

                var cell1 = row.insertCell(0);
                var cel21 = row.insertCell(1);
                var cel31 = row.insertCell(2);
                var cel41 = row.insertCell(3);
                var cel51 = row.insertCell(4);

                var cell = row2.insertCell(0);
                var cel2 = row2.insertCell(1);
                var cel3 = row2.insertCell(2);
                var cel4 = row2.insertCell(3);
                var cel5 = row2.insertCell(4);

                cell1.innerHTML="<strong><small>Rate of Interest</small></strong>";
                cel21.innerHTML="<strong><small>Funded</small></strong><input type='hidden' name='fund_type[]' value='" + data + "'/>";
                cel31.innerHTML="<input type='hidden' class='form-control' name='type_nonfunded[]' value=''>";
                cel41.innerHTML="";
                cel51.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove " + data + "</a>";

                cell.innerHTML="<input type='text' class='form-control' name='pricing[]' value=''>";
                cel2.innerHTML="<input type='text' class='form-control' name='facility[]' value=''>";
                cel3.innerHTML="<input type='text' class='form-control' name='spread[]' value=''>";
                cel4.innerHTML="<input type='text' class='form-control' name='effective_rate[]' value=''>";
                cel5.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove " + data + "</a>";

            }
            else
            {

                var table = document.getElementById('convTB');
                var row = table.insertRow(-1);

                var row2 = table.insertRow(-1);

                var cell1 = row.insertCell(0);
                var cel21 = row.insertCell(1);
                var cel31 = row.insertCell(2);
                var cel41 = row.insertCell(3);
                var cel51 = row.insertCell(4);

                var cell = row2.insertCell(0);
                var cel2 = row2.insertCell(1);
                var cel3 = row2.insertCell(2);
                var cel4 = row2.insertCell(3);
                var cel5 = row2.insertCell(4);

                cell1.innerHTML="<strong><small>Type of non funded facility</small></strong><input type='hidden' name='fund_type[]' value='" + data + "'/>";
                cell1.className="text-right";
                cel21.innerHTML="<strong><small><input type='text' class='form-control' name='type_nonfunded[]' value=''></small></strong>";
                cel31.innerHTML="<input type='text' class='form-control' name='nonfunded_spread[]' value=''>";
                cel41.innerHTML="<input type='text' class='form-control' name='nonfunded_ef_rate[]' value=''>";
                cel51.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove " + data + "</a>";

                cell.innerHTML="<input type='text' class='form-control' name='pricing[]' value=''>";
                cel2.innerHTML="<input type='text' class='form-control' name='facility[]' value=''>";
                cel3.innerHTML="<input type='text' class='form-control' name='spread[]' value=''>";
                cel4.innerHTML="<input type='text' class='form-control' name='effective_rate[]' value=''>";
                cel5.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove " + data + "</a>";

            }

        }

        function rmOption(o)
        {
            var p=o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }

    </script>


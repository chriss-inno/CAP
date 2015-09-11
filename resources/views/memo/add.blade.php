<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$open_type="";
$app_type="";
$valid_date="";
$Limits="";
$purpose="";
$remarks="";
$rate_applied="";
$fsg="";
//Get initial
$open_type=$crp->open_type;
$app_type=$crp->app_type;
if( count($crp->facilitystructure) !=0 )
{
    $apprequest=1;

    $valid_date=$crp->facilitystructure->valid_date;

    $purpose=$crp->facilitystructure->purpose;
    $valid_date=$crp->facilitystructure->valid_date;
    $remarks=$crp->facilitystructure->remarks;
    $rate_applied=$crp->facilitystructure->rate_applied;
    $fsg=$crp->facilitystructure->facilitygroups;
    $Limits =$crp->facilitystructure->facilitylimits;
    $id=$crp->facilitystructure->id;

}
$rules = ['app_date'=>'required|date','$company_name'=>'required','rate_applied' => 'required|numeric', 'remarks' => 'required', 'g_indicator' => 'required', 'business_activity' => 'required'];
?>
{!! Form::open(array('url' => 'facility-structure', 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules) !!}
<div class="row row-bg">
    <div class="row" >
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> B: Facility Structure </h4>
                </div>
                <div class="widget-content">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 pull-right">
                                <strong>Application Date</strong>
                            </div>
                            <div class="col-md-3 pull-right">
                                {!! Form::text('app_date',$app_date,array('class'=>'form-control')) !!}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Name of the company/firm</strong>
                            </div>
                            <div class="col-md-3">
                                {!! Form::text('company_name',$company_name,array('class'=>'form-control')) !!}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-12 text-info" ><h2>Details of credit facilities (USD in "000") </h2> </div>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table" id="fsapp">
                                    <thead>
                                    <th class="col-md-3">Facility</th>
                                    <th class="col-md-1">CCY</th>
                                    <th>Current limits</th>
                                    <th class="col-md-1">CCY</th>
                                    <th>Out Standing </th>
                                    <th class="col-md-1">Proposed </th>
                                    <th>Tenor / expiry </th>
                                    <th></th>
                                    </thead>
                                    <tbody>

                                    @if($Limits != null && count($Limits) >0 )
                                        @foreach($Limits as $l)

                                            <tr>
                                                <td><input type="text" data-msg-alpha_dash="The facility may only contain letters, numbers, and dashes."  name="facility[]" class="form-control" value="{{$l->facility}}"></td>
                                                <td>
                                                    <select name="ccy_1[]" class="form-control" >
                                                        <option value="" >--CCY-- </option>
                                                        @if($l->ccy_1 !="")
                                                            <option selected="selected" >{{$l->ccy_1}} </option>
                                                        @else
                                                            @foreach(\App\Currency::all() AS $cur)
                                                                <option  >{{$cur->ccy}} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td><input type="text" name="cr_limits[]" class="form-control" value="{{$l->cr_limits}}"></td>
                                                <td>
                                                    <select name="ccy_2[]" class="form-control" >
                                                        <option value="" >--CCY-- </option>
                                                        @if($l->ccy_1 !="")
                                                            <option selected="selected" >{{$l->ccy_1}} </option>
                                                        @else
                                                            @foreach(\App\Currency::all() AS $cur)
                                                                <option  >{{$cur->ccy}} </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td><input type="text" data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  name="presentos[]" class="form-control" value="{{$l->presentos}}"></td>
                                                <td><input type="text" data-rule-number="true" data-msg-numeric="The Proposed must be a number." name="proposed[]" class="form-control" value="{{$l->proposed}}"></td>
                                                <td><input type="text" data-rule-date="true" data-msg-date="The Tenor / expiry is not a valid date." name="expire[]" class="form-control" value="{{$l->expire}}"></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr>
                                        <td><input type="text" data-msg-alpha_dash="The facility may only contain letters, numbers, and dashes."  name="facility[]" class="form-control"></td>
                                        <td>  <select name="ccy_1[]" class="form-control" >
                                                <option value="" >--CCY-- </option>
                                                @foreach(\App\Currency::all() AS $cur)
                                                    <option  >{{$cur->ccy}} </option>
                                                @endforeach

                                            </select></td>
                                        <td><input type="text" data-rule-number="true" data-msg-numeric="The Current limits must be a number."  name="cr_limits[]" class="form-control"></td>
                                        <td>  <select name="ccy_2[]" class="form-control" >
                                                <option value="" >--CCY-- </option>
                                                @foreach(\App\Currency::all() AS $cur)
                                                    <option  >{{$cur->ccy}} </option>
                                                @endforeach

                                            </select></td>
                                        <td><input type="text" data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  name="presentos[]" class="form-control"></td>
                                        <td><input type="text" data-rule-number="true" data-msg-numeric="The Proposed must be a number." name="proposed[]" class="form-control"></td>
                                        <td><input type="text" data-rule-date="true" data-msg-date="The Tenor / expiry is not a valid date." name="expire[]" class="form-control"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" data-msg-alpha_dash="The facility may only contain letters, numbers, and dashes."  name="facility[]" class="form-control"></td>
                                        <td>  <select name="ccy_1[]" class="form-control" >
                                                <option value="" >--CCY-- </option>
                                                @foreach(\App\Currency::all() AS $cur)
                                                    <option  >{{$cur->ccy}} </option>
                                                @endforeach

                                            </select></td>
                                        <td><input type="text" data-rule-number="true" data-msg-numeric="The Current limits must be a number."  name="cr_limits[]" class="form-control"></td>
                                        <td>  <select name="ccy_2[]" class="form-control" >
                                                <option value="" >--CCY-- </option>
                                                @foreach(\App\Currency::all() AS $cur)
                                                    <option  >{{$cur->ccy}} </option>
                                                @endforeach

                                            </select></td>
                                        <td><input type="text" data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  name="presentos[]" class="form-control"></td>
                                        <td><input type="text" data-rule-number="true" data-msg-numeric="The Proposed must be a number." name="proposed[]" class="form-control"></td>
                                        <td><input type="text" data-rule-date="true" data-msg-date="The Tenor / expiry is not a valid date." name="expire[]" class="form-control"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" data-msg-alpha_dash="The facility may only contain letters, numbers, and dashes."  name="facility[]" class="form-control"></td>
                                        <td>  <select name="ccy_1[]" class="form-control" >
                                                <option value="" >--CCY-- </option>
                                                @foreach(\App\Currency::all() AS $cur)
                                                    <option  >{{$cur->ccy}} </option>
                                                @endforeach

                                            </select></td>
                                        <td><input type="text" data-rule-number="true" data-msg-numeric="The Current limits must be a number." name="cr_limits[]" class="form-control"></td>
                                        <td>  <select name="ccy_2[]" class="form-control" >
                                                <option value="" >--CCY-- </option>
                                                @foreach(\App\Currency::all() AS $cur)
                                                    <option  >{{$cur->ccy}} </option>
                                                @endforeach

                                            </select></td>
                                        <td><input type="text" data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  name="presentos[]" class="form-control"></td>
                                        <td><input type="text" data-rule-number="true" data-msg-numeric="The Proposed must be a number." name="proposed[]" class="form-control"></td>
                                        <td><input type="text" data-rule-date="true" data-msg-date="The Tenor / expiry is not a valid date." name="expire[]" class="form-control"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" data-msg-alpha_dash="The facility may only contain letters, numbers, and dashes."  name="facility[]" class="form-control"></td>
                                        <td>  <select name="ccy_1[]" class="form-control" >
                                                <option value="" >--CCY-- </option>
                                                @foreach(\App\Currency::all() AS $cur)
                                                    <option  >{{$cur->ccy}} </option>
                                                @endforeach

                                            </select></td>
                                        <td><input type="text"  data-rule-number="true" data-msg-numeric="The Current limits must be a number." name="cr_limits[]" class="form-control"></td>
                                        <td>  <select name="ccy_2[]" class="form-control" >
                                                <option value="" >--CCY-- </option>
                                                @foreach(\App\Currency::all() AS $cur)
                                                    <option  >{{$cur->ccy}} </option>
                                                @endforeach

                                            </select></td>
                                        <td><input type="text" data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  name="presentos[]" class="form-control"></td>
                                        <td><input type="text" data-rule-number="true" data-msg-numeric="The Proposed must be a number." name="proposed[]" class="form-control"></td>
                                        <td><input type="text" data-rule-date="true" data-msg-date="The Tenor / expiry is not a valid date." name="expire[]" class="form-control"></td>
                                        <td> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS();" /></td>
                                    </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6" >

                            </div>
                            <div class="col-md-6">
                                {!! Form::text('rate_applied',$rate_applied,array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" >

                            </div>
                            <div class="col-md-6">
                                {!! Form::text('rate_applied',$rate_applied,array('class'=>'form-control')) !!}
                            </div>
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
            <input type="hidden" name="crid" value="@if(old('crid') != "") {{old('crid')}} @else {{$crid}} @endif"/>
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


    function addRowFS()
    {
        var table = document.getElementById('fsapp');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);
        var cel6 = row.insertCell(5);
        var cel7 = row.insertCell(6);
        var cel8 = row.insertCell(7);

        cell.innerHTML="<input type='text' name='facility[]' class='form-control'>";
        cel2.innerHTML=" <select name='ccy_1[]' class='form-control' > <option value='' >--CCY-- </option>  @foreach(\App\Currency::all() AS $cur) <option  >{{$cur->ccy}} </option> @endforeach </select>";
        cel3.innerHTML="<input type='text' name='cr_limits[]' class='form-control'>";
        cel4.innerHTML="<select name='ccy_2[]' class='form-control' > <option value='' >--CCY-- </option>  @foreach(\App\Currency::all() AS $cur) <option  >{{$cur->ccy}} </option> @endforeach </select>";
        cel5.innerHTML="<input type='text' name='presentos[]' class='form-control'>";
        cel6.innerHTML="<input type='text' name='proposed[]' class='form-control'>";
        cel7.innerHTML="<input type='text' name='expire[]' class='form-control'>";

        cel8.innerHTML="<input type='button' name='button' id='delbtn' value='Delete' class='btn btn-danger' />";
    }

    function addRowFSGE()
    {
        var table = document.getElementById('fsge');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);
        var cel6 = row.insertCell(5);
        var cel7 = row.insertCell(6);
        var cel8 = row.insertCell(7);

        cell.innerHTML="<input type='text' name='g_client[]' class='form-control'>";
        cel2.innerHTML="<input type='text' name='g_facility[]' class='form-control'>";
        cel3.innerHTML=" <select name='g_ccy[]' class='form-control' > <option value='' >--CCY-- </option>  @foreach(\App\Currency::all() AS $cur) <option  >{{$cur->ccy}} </option> @endforeach</select>";
        cel4.innerHTML="<input type='text' name='g_existing_limit[]' class='form-control'>";

        cel5.innerHTML="<input type='text' name='g_osbalance[]' class='form-control'>";
        cel6.innerHTML="<input type='text' name='g_proposed_limit[]' class='form-control'>";
        cel7.innerHTML="<input type='text' name='g_gel[]' class='form-control'>";
        cel8.innerHTML="<input type='button' name='button' id='button' value='Delete' class='btn btn-danger' />";

    }
    function removeCurrentRow(btn)
    {
        var pr= btn.parentNode.parentNode.nodeName;
        alert(pr);
    }
    $('#delbtn').click(function(e){
        $(this).closest('tr').remove()
    })
</script>

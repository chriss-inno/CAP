
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
$g_indicator="";
$msg="";
$msged="";


if( count($crp->facilitystructure) >0 )
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
    $msg=$crp->facilitystructure->msg;

}

       $g_indicator =$crp->accountprofile->g_indicator;

       //Check for bot message availability
        if($msg =="")
            {
                $msged='As per the BOT guideline on Credit Concentration, Our Single Borrower Limit (SBL) AND group exposer limit (GEL) of the bank at 25% of the core capital works out at TZS 14.79 billion. Accordingly the proposal may be considered for the full amount applied as per the details above.';
            }
        else{$msged=$msg;}
$rules = ['valid_date'=>'date','purpose'=>'required','rate_applied' => 'required|numeric', 'business_activity' => 'required'];
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

                                <div class="col-md-4 text-info" >TYPE OF APPLICATION</div>
                                <div class="col-md-4 text-info pull-right" >
                                    {!! Form::text('valid_date',$valid_date,array('class'=>'form-control  datepicker has-success')) !!}
                                   </div>
                                <div class="col-md-4 text-info pull-right" style="text-align: right">VALID UP TO </div>

                            </div>

                            <div class="form-group">

                                <div class="col-md-12">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4">
                                                New
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control" @if($open_type =="New") checked="checked" @endif disabled="disabled" />
                                            </div>
                                            <div class="col-md-4">
                                                Existing level
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control" @if($app_type =="Existing level") checked="checked" @endif disabled="disabled"/>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Renewal
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control" @if($open_type =="Renewal") checked="checked" @endif disabled="disabled"/>
                                            </div>
                                            <div class="col-md-4">
                                                Enhancement
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" @if($app_type =="Enhancement") checked="checked" @endif class="form-control" disabled="disabled"/>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Interim
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control"  @if($open_type =="Interim") checked="checked" @endif disabled="disabled"/>
                                            </div>
                                            <div class="col-md-4">
                                                Amendment
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" @if($app_type =="Amendment") checked="checked" @endif class="form-control" disabled="disabled"/>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-md-12 text-info" style="text-align: right" ><h2>Limit in ACY | Outstanding in LCY </h2> </div>

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
                                            <th class="col-md-1">Proposed Limit </th>
                                            <th>Tenor / expiry </th>
                                            <th></th>
                                        </thead>
                                        <tbody>

                                        @if($Limits != null && count($Limits) >0 )
                                            <?php $idadi=1; ?>
                                            @foreach($Limits as $l)

                                        <tr>
                                            <td><input type="text" data-msg-alpha_dash="The facility may only contain letters, numbers, and dashes."  name="facility[]" class="form-control" value="{{$l->facility}}"></td>
                                            <td>
                                                <select name="ccy_1[]" class="form-control" >
                                                    <option value="" >--CCY-- </option>
                                                    @if($l->ccy_1 !="")
                                                    <option selected="selected" >{{$l->ccy_1}} </option>
                                                        @foreach(\App\Currency::all() AS $cur)
                                                            <option  >{{$cur->ccy}} </option>
                                                        @endforeach

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
                                                        @foreach(\App\Currency::all() AS $cur)
                                                            <option  >{{$cur->ccy}} </option>
                                                        @endforeach
                                                    @else
                                                        @foreach(\App\Currency::all() AS $cur)
                                                            <option  >{{$cur->ccy}} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                </td>
                                            <td><input type="text" data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  data-rule-number="true" data-msg-numeric="The Out Standing must be a number."  name="presentos[]" class="form-control" value="{{$l->presentos}}"></td>
                                            <td><input type="text" data-rule-number="true" data-msg-numeric="The Proposed must be a number." name="proposed[]" class="form-control" value="{{$l->proposed}}"></td>
                                            <td><input type="text"  name="expire[]" class="form-control" value="{{$l->expire}}"></td>
                                            <td>@if($idadi ==1) <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS();" />
                                                @else
                                                    <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>
                                                @endif </td>
                                        </tr>
                                                <?php $idadi++; ?>
                                        @endforeach
                                            @else
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
                                                <td><input type="text"  name="expire[]" class="form-control"></td>
                                                <td> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS();" /></td>
                                            </tr>
                                        @endif


                                        </tbody>

                                    </table>
                                </div>
                                </div>

                            </div>
                            <div class="form-group">

                                <div class="col-md-3" ><strong>Rate Applied </strong> </div>
                                <div class="col-md-3">
                                    {!! Form::text('rate_applied',$rate_applied,array('class'=>'form-control')) !!}
                                    </div>

                            </div>
                            <div class="form-group">

                                <div class="col-md-2"><strong>Remarks</strong> </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    {!! Form::textarea('remarks', $remarks, array('class' => 'form-control','placeholder'=>'Enter Remarks'))  !!}

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row" style="margin: 5px">
                                <div class="col-md-11 " id="smsmain">{{$msged}}</div>

                                <div class="col-md-1" id="editmsg">
                                    <a href="#" title="Edit"  onclick="showEdit()"><i class="icon-pencil "></i> edit</a>
                                </div>
                                </div>
                            </div>
                           @if($g_indicator != "" && $g_indicator =="Yes")
                            <div class="form-group">

                                <div class="col-md-12 text-info" style="text-align: right" ><h2>Group exposure  figures in tzs "mio" and usd"000"</h2> </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-12">
                                    <table class="table" id="fsge">
                                        <thead>
                                        <th class="col-md-2">Client</th>
                                        <th class="col-md-2">Facility</th>
                                        <th class="col-md-1">Ccy</th>
                                        <th>Existing limit </th>
                                        <th>O/s bal as of  </th>
                                        <th>Proposed limit </th>
                                        <th class="col-md-1">GEL</th>
                                        <th></th>
                                        </thead>
                                        <tbody>

                                        @if($fsg != null && count($fsg) >0)
                                            <?php $idadi_2=1; ?>
                                         @foreach($fsg as $g)
                                        <tr>
                                            <td><input type="text" data-msg-alpha_dash="The Client may only contain letters, numbers, and dashes."  name="g_client[]" class="form-control" value="{{$g->client}}"></td>
                                            <td><input type="text" data-msg-alpha_dash="The facility may only contain letters, numbers, and dashes."  name="g_facility[]" class="form-control" value="{{$g->facility}}"></td>
                                            <td>
                                                <select name="g_ccy[]" class="form-control" >
                                                    <option value="" >--CCY-- </option>
                                                    @if($g->ccy !="")
                                                        <option selected="selected" >{{$g->ccy}} </option>
                                                        @foreach(\App\Currency::all() AS $cur)
                                                            <option  >{{$cur->ccy}} </option>
                                                        @endforeach
                                                    @else
                                                        @foreach(\App\Currency::all() AS $cur)
                                                            <option  >{{$cur->ccy}} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                </td>
                                            <td><input type="text" data-rule-number="true" data-msg-numeric="The Existing limit must be a number."    name="g_existing_limit[]" class="form-control" value="{{$g->existing_limit}}"></td>

                                            <td><input type="text" data-rule-number="true" data-msg-numeric="The O/s bal as of must be a number."   name="g_osbalance[]" class="form-control" value="{{$g->osbalance}}"></td>
                                            <td><input type="text" name="g_proposed_limit[]" class="form-control" value="{{$g->proposed_limit}}"></td>
                                            <td><input type="text" name="g_gel[]" class="form-control" value="{{$g->gel}}"></td>
                                            <td class="col-md-2">
                                                @if($idadi_2 ==1)
                                                    <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFSGE();" />
                                                    @else
                                                    <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $idadi_2++; ?>
                                         @endforeach
                                            @else
                                            <tr>
                                                <td><input type="text" data-msg-alpha_dash="The Client may only contain letters, numbers, and dashes."  name="g_client[]" class="form-control"></td>
                                                <td><input type="text" data-msg-alpha_dash="The facility may only contain letters, numbers, and dashes."  name="g_facility[]" class="form-control"></td>
                                                <td>
                                                    <select name="g_ccy[]" class="form-control" >
                                                        <option value="" >--CCY-- </option>
                                                        @foreach(\App\Currency::all() AS $cur)
                                                            <option  >{{$cur->ccy}} </option>
                                                        @endforeach

                                                    </select>
                                                </td>
                                                <td><input type="text" data-rule-number="true" data-msg-numeric="The Existing limit must be a number."    name="g_existing_limit[]" class="form-control"></td>

                                                <td><input type="text" data-rule-number="true" data-msg-numeric="The O/s bal as of must be a number."   name="g_osbalance[]" class="form-control"></td>
                                                <td><input type="text" name="g_proposed_limit[]" class="form-control"></td>
                                                <td><input type="text" name="g_gel[]" class="form-control"></td>
                                                <td class="col-md-2"><input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFSGE();" /></td>
                                            </tr>
                                        @endif




                                        </tbody>
                                    </table>
                                </div>
                                </div>

                            </div>
                           @endif
                           <div class="form-group">
                            <div class="col-md-12 "><strong>Purpose</strong></div>
                            </div>
                            <div class="form-group">

                                <div class="col-md-12">

                                    {!! Form::textarea('purpose', $purpose, array('class' => 'form-control','placeholder'=>'Enter purpose'))  !!}
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
                <input type="hidden" name="id" value="@if(old('id') != ""){{old('id')}}@else{{$id}}@endif"/>
                <input type="hidden" id="msg" name="msg" value="@if(old('msg') != ""){{old('msg')}}@else{{$msged}}@endif"/>
                <input type="hidden" name="g_indicator" value="@if(old('g_indicator') != ""){{old('g_indicator')}}@else{{$g_indicator}}@endif"/>
                <input type="hidden" name="crid" value="@if(old('crid') != ""){{old('crid')}}@else {{$crid}}@endif"/>
                <input type="hidden" name="apprequest" value="@if(old('apprequest') != ""){{old('apprequest')}}@else {{$apprequest}}@endif"/>
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

            cel8.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
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
            cel8.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";

        }
        function showEdit()
        {
            document.getElementById('editmsg').innerHTML="<a href='#' onclick='saveHide();' class='btn btn-primary' id='btnSavebtn'>Save </a>";
            var predata=document.getElementById('smsmain').innerHTML;
            var newdata="<textarea class='form-control' id='textMsg' onkeyup='onEditSave();' onblur='onEditSave()'>" + predata + " </textarea>";
            document.getElementById('smsmain').innerHTML=newdata;
            document.getElementById('msg').value=predata;

        }
        function removeCurrentRow(btn)
        {
            var pr= btn.parentNode.parentNode.nodeName;

        }
        function saveHide()
        {
            document.getElementById('editmsg').innerHTML="<a href='#' title='Edit'  onclick='showEdit()'><i class='icon-pencil '></i> edit</a>";
            var savedata=document.getElementById('textMsg').value;
            document.getElementById('smsmain').innerHTML=savedata;
            document.getElementById('msg').value=savedata;
        }
        function onEditSave()
        {
            var savedata=document.getElementById('textMsg').value;
            document.getElementById('msg').value=savedata;
        }
        function rmOption(o)
        {
            var p=o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }
        $('#delbtn').click(function(e){
            $(this).closest('tr').remove()
        })
    </script>

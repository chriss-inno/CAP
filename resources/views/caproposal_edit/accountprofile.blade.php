<?php
        //Get profile

$sno = $crp->sno;
$app_date=$crp->app_date;
$open_type=$crp->open_type;
$app_type=$crp->app_type;
$ac_name=$crp->ac_name;
$acaddress=$crp->ac_address;

$crid=$crp->id;
        $apprequest =0;
        $id=0;

        $borrowerid="";
        $credit_rating="";
        $legal_entity="";
        $business_activity="";
        $g_indicator ="";
        $group ="";
        $emanagement="";
        $cr_bankers ="";
        $shareholders ="";
        $directors ="";

        if( count($crp->accountprofile) !=0)
        {
            $apprequest =1;

            $borrowerid=$crp->accountprofile->borrowerid;
            $credit_rating=$crp->accountprofile->credit_rating;
            $legal_entity=$crp->accountprofile->legal_entity;
            $business_activity =$crp->accountprofile->business_activity;
            $g_indicator =$crp->accountprofile->g_indicator;
            $group =$crp->accountprofile->app_group;
            $emanagement =$crp->accountprofile->emanagement;

            $cr_bankers =$crp->accountprofile->borrowerid;
            $shareholders =$crp->shareholders;
            $directors =$crp->directors;
            $cr_bankers =$crp->currentbankers;
            $id= $crp->accountprofile->id;
        }


  $rules = ['credit_rating'=>'required|between:1,3','borrowerid'=>'alpha_num','legal_entity' => 'required', 'business_activity' => 'required', 'g_indicator' => 'required', 'business_activity' => 'required', 'shareholders' => 'required', 'directors' => 'required','emanagement'=> 'required||alpha'];
?>
    {!! Form::open(array('url' => 'account-profile', 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules) !!}

    <div class="row row-bg">
        <div class="row">
            <div class="col-md-11">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> A: Account profile </h4>
                    </div>
                    <div class="widget-content">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 control-label">Borrower ID:</div>
                                <div class="col-md-3">
                                    {!! Form::text('borrowerid',$borrowerid,array('class'=>'form-control')) !!}
                                    </div>

                                <div class="col-md-3 control-label">Credit rating:</div>
                                <div class="col-md-2">
                                    {!! Form::text('credit_rating',$credit_rating,array('class'=>'form-control'))!!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 control-label">Legal Entity</div>

                                <div class="col-md-8">
                                    <?php $dr=\App\LegalEntity::all()->lists('entity'); ?>

                                        {!! Form::select('clients', $dr , $legal_entity,array('class'=>'form-control'))  !!}

                                    @if($errors->first('legal_entity'))
                                        <p class=" alert-danger">Legal entity is required</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 control-label">Business activity</div>
                                <div class="col-md-8">
                                    {!! Form::textarea('business_activity', $business_activity, array('class' => 'form-control','placeholder'=>''))  !!}
                                    @if($errors->first('business_activity'))
                                        <p class=" alert-danger">business_activity is required</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 control-label">Group</div>
                                <div class="col-md-9">
                                    <div class="col-md-2"><input data-rule-required="true" data-msg-required="The g_indicator field is required."  type="radio" name="g_indicator" id="yes" value="Yes" class="form-control" onclick="showGtext();"  <?php if( $g_indicator =="Yes"){echo 'checked="checked"';}?>/></div>
                                    <div class="col-md-1"><label for="yes">Yes</label></div>
                                    <div class="col-md-2"><input data-rule-required="true" data-msg-required="The g_indicator field is required."  type="radio" name="g_indicator" id="no"  value="No" class="form-control" onclick="hideGtext();"  <?php if( $g_indicator =="No"){echo 'checked="checked"';}?>/></div>
                                    <div class="col-md-1"><label for="no">No</label></div>
                                    <div class="col-md-6" id="gtext"><?php if( $g_indicator =="Yes"){echo "<input name='group' class='form-control' value='".$group."' />";} ?></div>
                                    @if($errors->first('g_indicator'))
                                        <p class=" alert-danger">Please group selection is required</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 control-label">Shareholders</div>
                                <div class="col-md-9">
                                    <table class="table" id="Shareholders">
                                        <thead>
                                        <tr>
                                            <td>Name</td>
                                            <td colspan="2">% Holding</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $sh_count =0; $sh_data="";
                                        if( $shareholders !=NULL && count($shareholders) >0){
                                            foreach($shareholders as $sh)
                                            {

                                                echo '<tr>
                                                    <td><input type="text" name="shareholders[]" class="form-control" value="'.$sh->name.'" /></td>
                                                    <td><input type="text" name="holdings[]" class="form-control" value="'. $sh->holding.'"></td>
                                                    <td class="col-md-2"> </td>
                                                </tr>';
                                            }

                                        }
                                        else
                                        {
                                        ?>
                                        <tr>
                                            <td><input type="text" name="shareholders[]" class="form-control"  required="required" ></td>
                                            <td><input type="text" name="holdings[]" class="form-control"  required="required" ></td>
                                            <td class="col-md-2"> </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="shareholders[]" class="form-control"  required="required" ></td>
                                            <td><input type="text" name="holdings[]" class="form-control"  required="required" ></td>
                                            <td class="col-md-2"> </td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                            <td><input type="text" name="shareholders[]" class="form-control"></td>
                                            <td><input type="text" name="holdings[]" class="form-control"></td>
                                            <td class="col-md-2"> </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="shareholders[]" class="form-control"></td>
                                            <td><input type="text" name="holdings[]" class="form-control"></td>
                                            <td class="col-md-2"> </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="shareholders[]" class="form-control"></td>
                                            <td><input type="text" name="holdings[]" class="form-control"></td>
                                            <td class="col-md-2"> </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="shareholders[]" class="form-control"></td>
                                            <td><input type="text" name="holdings[]" class="form-control"></td>
                                            <td class="col-md-2"> </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="shareholders[]" class="form-control"></td>
                                            <td><input type="text" name="holdings[]" class="form-control"></td>
                                            <td class="col-md-2"> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowShareholders();" /> </td>
                                        </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 control-label">Directors</div>
                                <div class="col-md-9">
                                    <table class="table" id="Directors">
                                        <thead>

                                        </thead>
                                        <tbody>
                                        <?php $dr_count =0; $dr_data="";
                                        if( $directors !=NULL && count($directors) >0){


                                            foreach($directors as $dr){

                                                echo '<tr>
                                                        <td class="col-md-10"><input type="text" name="directors[]" class="form-control" value="'.$dr->fullname.'"/></td>
                                                        <td class="col-md-2"> </td>
                                                    </tr>';

                                            }
                                        }
                                        else{



                                        ?>
                                        <tr>
                                            <td class="col-md-10"><input type="text" name="directors[]" class="form-control"  required="required" ></td>
                                            <td class="col-md-2"> </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-10"><input type="text" name="directors[]" class="form-control"  required="required" ></td>
                                            <td class="col-md-2">
                                            </td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                            <td class="col-md-10"><input type="text" name="directors[]" class="form-control"></td>
                                            <td class="col-md-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-10"><input type="text" name="directors[]" class="form-control"></td>
                                            <td class="col-md-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-10"><input type="text" name="directors[]" class="form-control"></td>
                                            <td class="col-md-2"> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowDirectors();" />
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-3 control-label">Executive management</div>
                            <div class="col-md-9">
                                <textarea name="emanagement" id="emanagement" class="form-control"   required="required"  cols="45" rows="2">{{$emanagement}}</textarea>

                                @if($errors->first('emanagement'))
                                    <p class=" alert-danger">Executive management is required</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 control-label">Current Banker</div>
                                <div class="col-md-9">
                                    <table class="table" id="cr_bankers">
                                        <thead>

                                        </thead>
                                        <tbody>
                                        <?php
                                        if( $cr_bankers !=NULL && sizeof($cr_bankers) >0)
                                        {


                                            foreach($cr_bankers as $b){

                                                echo ' <tr>
                                                        <td class="col-md-10"><input type="text" name="cr_bankers[]" class="form-control" value="'.$b->bankname.'"/></td>
                                                        <td class="col-md-2"> </td>
                                                    </tr>
                                                   ' ;

                                            }

                                        }
                                        else{
                                        ?>
                                        <tr>
                                            <td class="col-md-10"><input type="text" name="cr_bankers[]" class="form-control"  required="required" ></td>
                                            <td class="col-md-2"> </td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                            <td class="col-md-10"><input type="text" name="cr_bankers[]" class="form-control"></td>
                                            <td class="col-md-2"> </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-10"><input type="text" name="cr_bankers[]" class="form-control"></td>
                                            <td class="col-md-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-10"><input type="text" name="cr_bankers[]" class="form-control"></td>
                                            <td class="col-md-2">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-10"><input type="text" name="cr_bankers[]" class="form-control"></td>
                                            <td class="col-md-2"> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowCRBankers();" />
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                </div>
                            </div>


                            @if($errors->first('cr_bankers'))
                                <p class=" alert-danger">Current Banker is required</p>
                            @endif
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

<script type="text/javascript">

</script>
    <script>
        function addRowDirectors()
        {
            var table = document.getElementById('Directors');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            var cel3 = row.insertCell(2);

            cell.innerHTML="<input type='text' name='directors[]' class='form-control'>";
            cel2.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
        }

        function addRowShareholders()
        {
            var table = document.getElementById('Shareholders');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            var cel3 = row.insertCell(2);

            cell.innerHTML="<input type='text' name='shareholders[]' class='form-control'>";
            cel2.innerHTML="<input type='text' name='holdings[]' class='form-control'>";
            cel3.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
        }
        function addRowCRBankers()
        {
            var table = document.getElementById('cr_bankers');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            var cel3 = row.insertCell(2);

            cell.innerHTML="<input type='text' name='cr_bankers[]' class='form-control'>";
            cel2.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
        }

        function removeCurrentRow(btn)
        {
            var pr= btn.parentNode.parentNode.nodeName;

        }
        $('#btnOk').click(function(e){

        })

        //Process adding signature
        $('#btnAddSignature').click(function(e){

        })


    </script>

    <script type="text/javascript">

        //Populate dynamic data
        function populatedata(sl)
        {
            if(sl.value =="NEW")
            {
               var sl2 =document.getElementById('app_type').innerHTML="";
            }
            else{
                var sl2 =document.getElementById('app_type').innerHTML="<option value=''>--Select Type--</option><option>Existing</option><option>Enhencement</option><option>Amendment</option>";
            }


        }

        //Show group indicator
        function showGtext()
        {
            document.getElementById('gtext').innerHTML="<input name='group' class='form-control' />";
        }
        function hideGtext()
        {
            document.getElementById('gtext').innerHTML="";
        }
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
        //Ajax form upload, check validation before.
        $("#ajax-form9").submit(function(e)
        {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
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
            e.preventDefault(); //STOP default action
            e.unbind(); //unbind. to stop multiple form submit.
        });

        function rmOption(o)
        {
            var p=o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }

    </script>

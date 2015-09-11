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

?>
    {!! Form::open(array('url' => 'account-profile', 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}

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
                                <div class="col-md-3"><input type="text" name="borrowerid" class="form-control" value="{{$borrowerid}}"></div>

                                <div class="col-md-3 control-label">Credit rating:</div>
                                <div class="col-md-2"><input type="text" name="credit_rating" class="form-control" value="{{$credit_rating}}"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                  <div class="row">
                                     <div class="col-md-3 control-label">Legal Entity</div>

                                        <div class="col-md-8">
                                             <select class="form-control" name="legal_entity"  required="required" >
                                               <option value="">--Select Legal entity--</option>
                                                 @if( old('legal_entity') !=NULL)
                                                     <option selected> {{ old('legal_entity')}}</option>
                                                 @elseif($legal_entity !="")
                                                     <option selected> {{ $legal_entity }}</option>
                                                 @endif
                                                 <option>Individual</option>
                                                 <option>Public Limited Compony</option>
                                                 <option>Trustee</option>
                                                 <option>Multinational Company</option>
                                                 <option>Limited company</option>
                                                 <option>Propietoship</option>
                                                 <option>Partnership</option>
                                             </select>
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
                                        <textarea name="business_activity"  required="required"  id="textarea" cols="4" rows="5" class="form-control" placeholder="The principal business activity is providing data communication services.">{{$business_activity}}</textarea>
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
                                    <div class="col-md-2"><input type="radio" name="g_indicator" id="yes" value="Yes" class="form-control" onclick="showGtext();"  <?php if( $g_indicator =="Yes"){echo 'checked="checked"';}?>/></div>
                                    <div class="col-md-1"><label for="yes">Yes</label></div>
                                    <div class="col-md-2"><input type="radio" name="g_indicator" id="no"  value="No" class="form-control" onclick="hideGtext();"  <?php if( $g_indicator =="No"){echo 'checked="checked"';}?>/></div>
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
                                        if( $shareholders !=NULL && sizeof($shareholders) >0){
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
                                            if( $directors !=NULL && sizeof($directors) >0){


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
                    <button type="button" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
                    <input type="hidden" name="id" value="@if(old('id') != "") {{old('id')}} @else {{$id}} @endif"/>
                    <input type="hidden" name="crid" value="@if(old('crid') != "") {{old('crid')}} @else {{$crid}} @endif"/>
                    <input type="hidden" name="apprequest" value="@if(old('apprequest') != "") {{old('apprequest')}} @else {{$apprequest}} @endif"/>
                </div>
                <div id="output" class="col-md-8"></div>
            </div>
        </div>
    {!! Form::close() !!}
    <script>
        function addRowDirectors()
        {
            var table = document.getElementById('Directors');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            var cel3 = row.insertCell(2);

            cell.innerHTML="<input type='text' name='directors[]' class='form-control'>";
            cel2.innerHTML="<input type='button' name='button' id='delbtn' value='Delete' class='btn btn-danger' />";
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
            cel3.innerHTML="<input type='button' name='button' id='delbtn' value='Delete' class='btn btn-danger' />";
        }
        function addRowCRBankers()
        {
            var table = document.getElementById('cr_bankers');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            var cel3 = row.insertCell(2);

            cell.innerHTML="<input type='text' name='cr_bankers[]' class='form-control'>";
            cel2.innerHTML="<input type='button' name='button' id='delbtn' value='Delete' class='btn btn-danger' />";
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
                        url: '<?php echo url('account-profile') ?>',
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

    <script type="text/javascript">
        $(document).ready(function(){
            $("#myModal").on('show.bs.modal', function(event){
                var button = $(event.relatedTarget);  // Button that triggered the modal
                var titleData = button.data('title'); // Extract value from data-* attributes
                $(this).find('.modal-title').text(titleData + ' Form');
            });
        });

        $(function () {
            $(".custom-close").on('click', function() {
                $('#myModal').modal('hide');
            });
        });

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
    </script>

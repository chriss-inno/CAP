@extends('layout.master')
@section('title')
    Credit Application | CA Proposal
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('home')}}">Home</a>
    </li>
    <li>
        <a href="{{url('caproposal')}}">CA Proposal</a>
    </li>

@stop
@section('contents')

    {!! Form::open(array('url' => 'credit-proposal', 'class' => 'form-horizontal row-border')) !!}
    <div class="row row-bg">

        <div class="row" style="margin-left: 50px">
            <div class="col-md-8">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> Credit Proposal</h4>
                    </div>
                    <div class="widget-content">

                            <div class="form-group">

                                <div class="col-md-2 control-label">Serial Number:</div>

                                <div class="col-md-4"><input type="text" name="sno" class="form-control" value="@if(old('sno') ==""){{$sno}} @else  {{old('sno')}} @endif" readonly="readonly"></div>
                                <div class="col-md-2 control-label">Date:</div>
                                <div class="col-md-4 control-label"><input type="text" name="ap_date" class="form-control" value="{{date('jS M Y')}}"/> </div>
                            </div>
                        <div class="form-group">
                            <div class="col-md-3 control-label">Type</div>
                            <div class="col-md-4 control-label">
                                <select name="open_type" class="form-control" onchange="populatedata(this);" >
                                    <option value="">--Select Open Type--</option>
                                    @if( old('open_type') !=NULL)
                                        <option selected> {{ old('open_type')}}</option>
                                    @endif
                                    <option>NEW</option>
                                    <option>RENEWAL</option>
                                    <option>INTERIM</option>
                                </select>
                                @if($errors->first('open_type'))
                                    <p class=" alert-danger">open_type is required</p>
                                @endif
                            </div>
                            <div class="col-md-5 control-label">
                                <select name="app_type" class="form-control" id="app_type">
                                    <option value="">--Select Type--</option>

                                    @if( old('app_type') !=NULL)
                                       <option selected> {{ old('app_type')}}</option>
                                    @endif
                                    <option>Existing</option>
                                    <option>Enhencement</option>
                                    <option>Amendment</option>
                                </select>
                            </div>
                        </div>

                            <div class="form-group">
                                <div class="col-md-3 control-label">Account name</div>
                                <div class="col-md-9"><input type="text" name="ac_name" value="{{old('ac_name')}}" class="form-control">
                                    @if($errors->first('ac_name'))
                                        <p class=" alert-danger">Account name is required</p>
                                    @endif
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-3 control-label">Address</div>
                                <div class="col-md-9">
                                    <textarea name="ac_address" class="form-control" id="ac_address" cols="4" rows="5">{{old('acaddress')}}</textarea>

                                    @if($errors->first('ac_address'))
                                        <p class=" alert-danger">Address is required</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 control-label">Management contact person</div>
                                <div class="col-md-9"><input type="text" name="contact_person" class="form-control" value="{{old('contact_person')}}">
                                    @if($errors->first('contact_person'))
                                        <p class=" alert-danger">Contact Person is required</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 control-label">Relationship manager</div>
                                <div class="col-md-9"><input type="text" name="rm" class="form-control" value="{{old('rm')}}">
                                    @if($errors->first('rm'))
                                        <p class=" alert-danger">Relational Manager is required</p>
                                    @endif
                                </div>
                            </div>


                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>Signatory Setup</h4>
                    </div>
                    <div class="widget-content">

                        <div class="form-group">


                        </div>
                        <div class="form-group" id="signator-form">

                            <div class="col-md-3 control-label">
                                <input type="button" id="btnAddSignature" class="button  btn-primary" value="Add new" />
                            </div>
                            <div class="col-md-9"><input type="text" name="sig_name" id="sig_name" value="{{old('sig_name')}}" class="form-control">
                                @if($errors->first('sig_name'))
                                    <p class=" alert-danger signame">Please enter signatory named</p>
                                @endif
                            </div>

                        </div>
                        <div class="form-group">

                            <div class="col-md-12">
                                <textarea name="ac_address" class="form-control" id="crs_ignatoriess" cols="4" rows="5">{{old('ac_address')}}</textarea>

                            </div>
                        </div>
                        <div class="form-group">
                          
                            <div class="col-md-12 pull-right">
                                    <a href="#" class="col-md-3 btn btn-primary" id="sigselects"><i class="icon-eye-open"></i> Select </a>
                                    <a href="#" class="col-md-3 btn btn-primary"><i class="icon-edit"></i>  Update</a>
                                    <a href="#" class="col-md-3 btn btn-primary"><i class="icon-remove"></i> Delete</a>
                            </div>
                    
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-bg">
        <div class="row" style="margin-left: 50px">
            <div class="col-md-8">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> A: Account profile </h4>
                    </div>
                    <div class="widget-content">

                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-3 control-label">Borrower ID:</div>
                                <div class="col-md-3"><input type="text" name="borrowerid" class="form-control"></div>

                                <div class="col-md-3 control-label">Credit rating:</div>
                                <div class="col-md-2"><input type="text" name="credit_rating" class="form-control"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                  <div class="row">
                                     <div class="col-md-3 control-label">Legal Entity</div>

                                        <div class="col-md-8">
                                             <select class="form-control" name="legal_entity">
                                               <option value="">--Select Legal entity--</option>
                                                 @if( old('legal_entity') !=NULL)
                                                     <option selected> {{ old('legal_entity')}}</option>
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
                                        <textarea name="business_activity" id="textarea" cols="4" rows="5" class="form-control" placeholder="The principal business activity is providing data communication services.">{{old('business_activity')}}</textarea>
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
                                    <div class="col-md-2"><input type="radio" name="g_indicator" id="yes" value="Yes" class="form-control" onclick="showGtext();"  <?php if( old('g_indicator') =="Yes"){echo 'checked="checked"';}?>/></div>
                                    <div class="col-md-1"><label for="yes">Yes</label></div>
                                    <div class="col-md-2"><input type="radio" name="g_indicator" id="no"  value="No" class="form-control" onclick="hideGtext();"  <?php if( old('g_indicator') =="No"){echo 'checked="checked"';}?>/></div>
                                    <div class="col-md-1"><label for="no">No</label></div>
                                    <div class="col-md-6" id="gtext"><?php if( old('g_indicator') =="Yes"){echo "<input name='group' class='form-control' value='".old('group')."' />";} ?></div>
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
                                        if( old('shareholders') !=NULL && sizeof(old('shareholders')) >0){
                                                  $arr_shareholders =old('shareholders') ;
                                                  $arr_holdings =old('holdings') ;



                                           for($i=0 ;$i < sizeof(old('shareholders')); $i++){
                                               if($arr_shareholders[$i] !=NULL && !empty($arr_shareholders[$i]) ){

                                                   $sh_data.='<tr>
                                                    <td><input type="text" name="shareholders[]" class="form-control" value="'. $arr_shareholders[$i].'" /></td>
                                                    <td><input type="text" name="holdings[]" class="form-control" value="'. $arr_holdings[$i].'"></td>
                                                    <td class="col-md-2"> </td>
                                                </tr>';
                                                   $sh_count++;
                                              }
                                            }
                                       }
                                                if($sh_count > 0){
                                            $sh_data.=' <tr>
                                            <td><input type="text" name="shareholders[]" class="form-control"></td>
                                            <td><input type="text" name="holdings[]" class="form-control"></td>
                                            <td class="col-md-2"> </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="shareholders[]" class="form-control"></td>
                                            <td><input type="text" name="holdings[]" class="form-control"></td>
                                            <td class="col-md-2"> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowShareholders();" /> </td>
                                        </tr>' ;

                                            echo $sh_data;

                                                }else{
                                                ?>
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
                                        <?php }?>
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
                                            if( old('directors') !=NULL && sizeof(old('directors')) >0){
                                                $arr_directors =old('directors');

                                               foreach($arr_directors as $dr){

                                                   if($dr != Null && $dr != ""){
                                                       $dr_data.='<tr>
                                                        <td class="col-md-10"><input type="text" name="directors[]" class="form-control" value="'.$dr.'"/></td>
                                                        <td class="col-md-2"> </td>
                                                    </tr>';
                                                       $dr_count++;
                                                 }
                                                }
                                            }
                                            if($dr_count > 0)
                                            {
                                                $dr_data.='<tr>
                                                <td class="col-md-10"><input type="text" name="directors[]" class="form-control"></td>
                                                <td class="col-md-2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-10"><input type="text" name="directors[]" class="form-control"></td>
                                                <td class="col-md-2"> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowDirectors();" />
                                                </td>
                                            </tr>';

                                                echo $dr_data;
                                            }
                                            else
                                                {

                                                ?>
                                            <tr>
                                                <td class="col-md-10"><input type="text" name="directors[]" class="form-control"></td>
                                                <td class="col-md-2"> </td>
                                            </tr>
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
                                                <td class="col-md-2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-10"><input type="text" name="directors[]" class="form-control"></td>
                                                <td class="col-md-2"> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowDirectors();" />
                                                </td>
                                            </tr>
                                            <?php }?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-3 control-label">Executive management</div>
                                <div class="col-md-9">
                                    <textarea name="emanagement" id="emanagement" class="form-control"  cols="45" rows="2">{{old('emanagement')}}</textarea>

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
                                        <?php $crb_count =0; $crb_data="";
                                         if( old('cr_bankers') !=NULL && sizeof(old('cr_bankers')) >0)
                                         {
                                            $arr_cr_bankers =old('cr_bankers') ;

                                            foreach($arr_cr_bankers as $crb){

                                               if($crb != Null && $crb != "")
                                                      {

                                                          $crb_data .=' <tr>
                                                        <td class="col-md-10"><input type="text" name="cr_bankers[]" class="form-control" value="'.$crb.'"/></td>
                                                        <td class="col-md-2"> </td>
                                                    </tr>
                                                   ' ;
                                                     $crb_count ++;
                                                }

                                           }
                                             $crb_data .='
                                                    <tr>
                                                        <td class="col-md-10"><input type="text" name="cr_bankers[]" class="form-control"></td>
                                                        <td class="col-md-2">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-10"><input type="text" name="cr_bankers[]" class="form-control"></td>
                                                        <td class="col-md-2"> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowCRBankers();" />
                                                        </td>
                                                    </tr>' ;
                                                }
                                           if($crb_count >0 )
                                               {
                                                   echo $crb_data;
                                         }else{
                                        ?>
                                        <tr>
                                            <td class="col-md-10"><input type="text" name="cr_bankers[]" class="form-control"></td>
                                            <td class="col-md-2"> </td>
                                        </tr>
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
                                      <?php }?>
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

    <div class="row row-bg">
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-1 col-md-offset-1" >
                <a href="#" class="btn btn-default">Previous</a>
            </div>
            <div class="col-md-1 col-md-offset-5">
                <input type="submit" name="Submit" class="btn btn-primary"  value="Next >>" />

            </div>

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

        //adding company user
        $("#sigselects").click(function(){

            var id1 = $(this).parent().attr('id');
            var modal = '<div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<h2 class="modal-title" id="myModalLabel">Select Signatories </h2>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+= ' </div>';
            modal+=' <div class="modal-footer">';
            modal+='<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
            modal+=' <button type="button" class="custom-close btn btn-primary" id="btnOk" data-dismiss="modal" >Ok</button>';
            modal+=' </div>';
            modal+= '</div>';
            modal+= '</div>';

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url('signatories') ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        })

        //Submit signatory


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
@stop

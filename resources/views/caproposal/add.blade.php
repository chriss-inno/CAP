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
    <li>
        <a href="#">Create new application</a>
    </li>

@stop
@section('contents')


    <?php $rules = ['ac_name' => 'required|max:100', 'app_date' => 'date'];
    $app_limit="";
    $st=\App\CreditDepartmentSetting::all()->first();
            if(count($st) > 0) {$app_limit =$st->app_limit;}

    $rules = ['app_date'=>'required|date','ac_name'=>'required','ac_address'=>'required','contact_person'=>'required','rm'=>'required'];
    ?>
    {!! Form::open(array('url' => 'credit-proposal', 'class' => 'form-horizontal row-border','id'=>'validate-form'),$rules) !!}



        <div class="row" style="margin-top: 10px">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> Credit Application Proposal:New application</h4>
                    </div>
                    <div class="widget-content">

                        <div class="form-group">
                            <div class="col-md-2 control-label">Application Date:</div>
                            <div class="col-md-4 control-label">
                                {!! Form::text('app_date',old('app_date'),array('id'=>'ac_name','class'=>'form-control datepicker')) !!}
                                @if($errors->first('open_type'))
                                    <p class=" alert-danger">{{$errors->first('app_date')}}</p>
                                @endif
                            </div>
                            <div class="col-md-3 text-justify text-info"> Valid format (dd-mm-yyy)</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 control-label">Type</div>
                            <div class="col-md-4 control-label">
                                <select name="open_type" class="form-control" onchange="populatedata(this);"  required="required" >
                                    <option value="">--Select Open Type--</option>
                                    @if( old('open_type') !=NULL)
                                        <option selected> {{ old('open_type')}}</option>
                                    @endif
                                    <option>New</option>
                                    <option>Renewal</option>
                                    <option>Interim</option>
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
                                    <option>Existing level</option>
                                    <option>Enhancement</option>
                                    <option>Amendment</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 control-label">Account name</div>
                            <div class="col-md-9">
                                {!! Form::text('ac_name',$customer->customer_name,array('id'=>'ac_name','class'=>'form-control','readonly'=>'readonly')) !!}

                                @if($errors->first('ac_name'))
                                    <p class=" alert-danger">{{$errors->first('ac_name')}}</p>
                                @endif
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-2 control-label">Management contact person</div>
                            <div class="col-md-9">
                                {!! Form::text('contact_person',$customer->contact_person,array('id'=>'contact_person','class'=>'form-control','readonly'=>'readonly')) !!}

                                @if($errors->first('contact_person'))
                                    <p class=" alert-danger">{{$errors->first('contact_person')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 control-label">Relationship manager</div>
                            <div class="col-md-9">
                                {!! Form::text('rm',$customer->rm,array('id'=>'rm','class'=>'form-control','readonly'=>'readonly')) !!}

                                @if($errors->first('rm'))
                                    <p class=" alert-danger">Relational Manager is required</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 control-label">Check for application Limit for consideration for Approval by Director Credit Committee (DCC): <strong class="text-info">Is application Above {{$app_limit}} USD</strong></div>
                            <div class="col-md-2">
                                <input type="radio" name="approval_limit" id="limitcheck1" value="0" checked="checked" >
                                <label for="limitcheck1">No</label>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="approval_limit" id="limitcheck2" value="1" >
                                <label for="limitcheck2">Yes</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    <div class="row" style=" margin-bottom: 30px">
        <div class="col-md-6 pull-right">

            <div class="col-md-3">
                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                <button type="submit" name="Submit" class="btn btn-success btn-block"> <i class="icon-save"></i> Save </button>
            </div>
            <div class="col-md-3">
                <a href="{{url('customers')}}" class="btn btn-danger btn-block"> <i class="icon-folder-close-alt"></i>  Cancel</a>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
    <!-- Demo JS -->
    {!! HTML::script("assets/js/custom.js")!!}
    {!! HTML::script("assets/js/demo/ui_general.js")!!}
    <script>

            // Setup form validation on the #register-form element
            $("#validate-form").validate({


                submitHandler: function(form) {
                    form.submit();
                }
            });



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
        $('form').validate({onkeyup: true}); //while using remote validation, remember to set onkeyup false
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
            if(sl.value =="New")
            {
                var sl2 =document.getElementById('app_type').innerHTML="";
            }
            else{
                var sl2 =document.getElementById('app_type').innerHTML="<option value=''>--Select Type--</option><option>Existing level</option><option>Enhancement</option><option>Amendment</option>";
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

        function addNewSignatory()
        {
           //Capture inputs
            var signamedata=document.getElementById("sig_name").value;
            var desdata=document.getElementById("designation").value;

            if(signamedata !="" && desdata !="")
            {
                var table = document.getElementById('signatorTable');
                var row = table.insertRow(-1);
                var cell = row.insertCell(0);
                var cel2 = row.insertCell(1);
                var cel3 = row.insertCell(2);


                cell.innerHTML=  "<input type='hidden' name='sig_name[]'> " + desdata;
                cel2.innerHTML= "<input type='hidden' name='designation[]'> " + desdata;
                cel3.innerHTML="<input type='checkbox' name='sigscheck[]' class='uniform' value='"+ signamedata + "###" +desdata+ " '>";

                //Reset the controls
                document.getElementById("sig_name").value="";
                document.getElementById("designation").value="";
            }
        }

    </script>

@stop

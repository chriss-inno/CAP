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
        <a href="{{url('customers')}}">Customers</a>
    </li>
    <li>
        <a href="#">New Customer</a>
    </li>

@stop
@section('contents')


    <?php
    $rules = ['customer_name'=>'required','contact_person'=>'required','rm'=>'required'];
    ?>
    {!! Form::open(array('url' => 'customers/edit', 'class' => 'form-horizontal row-border','id'=>'validate-form'),$rules) !!}
    <div class="row row-bg">
        <div class="row" style=" margin-bottom: 30px">
            <div class="col-md-12">


                <div class="col-md-2 pull-right">
                    <a href="{{url('customers')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage</a>
                </div>
                <div class="col-md-2 pull-right">
                    <a href="{{url('customers/create')}}" class="btn btn-primary btn-block"><i class="icon-file-alt"></i> New Customers</a>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Register Customer</h4>
                </div>
                <div class="widget-content">


                    <div class="form-group">
                        <div class="col-md-2 control-label">Customer Name</div>
                        <div class="col-md-9">
                            {!! Form::text('customer_name',$customer->customer_name,array('id'=>'ac_name','class'=>'form-control')) !!}

                            @if($errors->first('customer_name'))
                                <p class=" alert-danger">{{$errors->first('customer_name')}}</p>
                            @endif
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-md-2 control-label">Address</div>
                        <div class="col-md-9">
                            {!! Form::textarea('customer_address',$customer->customer_address,array('id'=>'customer_address','class'=>'form-control')) !!}

                            @if($errors->first('customer_address'))
                                <p class=" alert-danger">{{$errors->first('customer_address')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2 control-label">Management contact person</div>
                        <div class="col-md-9">
                            {!! Form::text('contact_person',$customer->contact_person,array('id'=>'contact_person','class'=>'form-control')) !!}

                            @if($errors->first('contact_person'))
                                <p class=" alert-danger">{{$errors->first('contact_person')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-2 control-label">Relationship manager</div>
                        <div class="col-md-9">
                            {!! Form::text('rm',$customer->rm,array('id'=>'rm','class'=>'form-control')) !!}

                            @if($errors->first('rm'))
                                <p class=" alert-danger">Relational Manager is required</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i>Add Signatory </h4>
                </div>
                <div class="widget-content">
                    <div class="row" style="margin-left: 10px">
                        <p>
                            <strong class="text-danger">Note:</strong> <span class="text-info">Signatories will appear at the bottom of each report page, you can add more than one signatory, follow the bellow steps to add signatories
                                <ol class="text-info">
                                    <li>Write Signatory full name and their designation</li>
                                    <li>Click Add Signatory button </li>
                                    <li>Newly added signatory will appear bellow with check box on the right side </li>
                                    <li>Check the check box of each signatory to be added to application</li>
                                </ol></span>
                        </p>

                    </div>
                    <div class="form-group" id="signator-form">
                        <div class="col-md-9">
                            <div class="container">
                                <div class="row" style="margin: 5px">
                                    <div class="form-group">
                                        <label for="sig_name">Name</label>
                                        <input type="text" name="sig_name" id="sig_name" value="{{old('sig_name')}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="designation">Designation</label>

                                        <input type="text" name="designation" id="designation" value="{{old('designation')}}" class="form-control">
                                    </div>


                                    @if($errors->first('sig_name'))
                                        <p class=" alert-danger signame">Please enter signatory named</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 control-label">
                            <input type="button" id="btnAddSignature" class="button  btn-primary" value="Add Signatory" onclick="addNewSignatory();" />
                        </div>


                    </div>
                    <div class="form-group">

                        <div class="col-md-12" id="signatorytb">
                            <table class="table table-striped table-bordered table-hover table-checkable table-responsive" id="signatorTable">
                                <thead>
                                <tr>

                                    <th data-class="expand">Signatory Name</th>
                                    <th data-class="expand">Designation</th>
                                    <th class="checkbox-column">

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                   @if(count($customer->Signatories) > 0)
                                         @foreach($customer->Signatories as $sg)
                                             <tr>
                                                 <td>{{$sg->names}}</td>
                                                 <td>{{$sg->designation}}</td>
                                                 <td><input type='checkbox' name='sigscheck[]' checked='checked' class='uniform' value='{{$sg->names}}###{{$sg->designation}}'></td>
                                             </tr>
                                             @endforeach
                                       @endif
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row" style=" margin-bottom: 30px">
        <div class="col-md-6 col-md-offset-3">

            <div class="col-md-3">
                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                <button type="submit" name="Submit" class="btn btn-success btn-block"> <i class="icon-save"></i> Save </button>
            </div>
            <div class="col-md-3">
                <a href="{{url('cap-manage')}}" class="btn btn-danger btn-block"> <i class="icon-folder-close-alt"></i>  Cancel</a>
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

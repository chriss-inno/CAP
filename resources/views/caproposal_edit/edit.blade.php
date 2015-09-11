
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
$sno = $crp->sno;
$app_date=$crp->app_date;
$open_type=$crp->open_type;
$app_type=$crp->app_type;
$ac_name=$crp->customer->customer_name;
$contact_person=$crp->customer->contact_person;
$rm=$crp->customer->rm;
$crid=$crp->id;
$approval_limit="";
$crSignatories="";
$app_limit="";
        if(count($crp->crSignatories) >0)
            {
                $crSignatories=$crp->crSignatories;
                $approval_limit=$crp->approval_limit;

            }
$app_limit="";
$st=\App\CreditDepartmentSetting::all()->first();
if(count($st) > 0) {$app_limit =$st->app_limit;}

$rules = ['app_date'=>'required|date','open_type'=>'required|alpha_num','ac_name' => 'required|alpha_num', 'ac_address' => 'required', 'contact_person' => 'required|alpha', 'rm' => 'required|alpha'];
?>

{!! Form::open(array('url' =>url('cap/edit'), 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules) !!}

<div class="row row-bg">
    <div class="row" style="margin-left: 10px">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Credit Proposal</h4>
                </div>
                <div class="widget-content">

                    <div class="form-group">

                        <div class="col-md-2 control-label">Serial Number:</div>

                        <div class="col-md-4"><input type="text" name="sno" class="form-control" value="@if(old('sno') ==""){{$sno}} @else  {{old('sno')}} @endif" readonly="readonly"></div>
                        <div class="col-md-2 control-label">Application Date:</div>
                        <div class="col-md-4 control-label"><input type="text" name="app_date" required="required" id="datepicker" class="form-control datepicker"  value="@if(old('app_date') !="") {{old('app_date')}} @elseif($app_date !="") {{$app_date}} @else {{date('Y-m-d')}} @endif"/> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 control-label">Type</div>
                        <div class="col-md-4 control-label">
                            <select name="open_type" class="form-control" onchange="populatedata(this);" required="required" >
                                <option value="">--Select Open Type--</option>
                                @if( old('open_type') !=NULL)
                                    <option selected>{{ old('open_type')}}</option>
                                @elseif($open_type !="")
                                    <option selected>{{ $open_type}}</option>
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
                                    <option selected>{{ old('app_type')}}</option>
                                @elseif($app_type !="")
                                    <option selected>{{ $app_type }}</option>
                                @endif
                                <option>Existing level</option>
                                <option>Enhancement</option>
                                <option>Amendment</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-3 control-label">Account name</div>
                        <div class="col-md-9"><input type="text" name="ac_name" required="required" readonly="readonly" value="@if(old('ac_name') !=""){{old('ac_name')}}@elseif($ac_name !=""){{$ac_name}}@endif  " class="form-control">
                            @if($errors->first('ac_name'))
                                <p class=" alert-danger">Account name is required</p>
                            @endif
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-3 control-label">Management contact person</div>
                        <div class="col-md-9"><input type="text" name="contact_person" readonly="readonly" class="form-control" required="required" value="@if(old('contact_person') !=""){{old('contact_person')}}@elseif($contact_person !=""){{$contact_person}} @endif  ">
                            @if($errors->first('contact_person'))
                                <p class=" alert-danger">Contact Person is required</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 control-label">Relationship manager</div>
                        <div class="col-md-9"><input type="text" name="rm" required="required" readonly="readonly" class="form-control" value="@if(old('rm') !=""){{old('rm')}}@elseif($rm !=""){{$rm}}@endif">
                            @if($errors->first('rm'))
                                <p class=" alert-danger">Relational Manager is required</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 control-label">Check for application Limit for consideration for Approval by Director Credit Committee (DCC): <strong class="text-info">Is application Above {{$app_limit}} USD</strong></div>
                        <div class="col-md-2">
                            <input type="radio" name="approval_limit" id="limitcheck1" @if($approval_limit ==0) checked="checked" @endif value="0"  >
                            <label for="limitcheck1">No</label>
                        </div>
                        <div class="col-md-2">
                            <input type="radio" name="approval_limit" id="approval_limit" value="1"  @if($approval_limit ==1) checked="checked" @endif >
                            <label for="approval_limit">Yes</label>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>

</div>
<div class="row" style=" margin-bottom: 30px">
    <div id="output" class="col-md-6"></div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" name="customer_id" value="{{$crp->customer->id}}">
                <button type="submit" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
            </div>
            <div class="col-md-6">
                <input type="hidden" value="@if(old('crid') !="") {{old('crid')}} @else {{$crid}} @endif " name="crid">
                <a href="#" data-dismiss="modal"  class=" btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
            </div>


    </div>

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
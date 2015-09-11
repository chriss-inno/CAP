<?php
$sno = $crp->sno;
$app_date=$crp->app_date;
$open_type=$crp->open_type;
$app_type=$crp->app_type;
$ac_name=$crp->ac_name;
$ac_address=$crp->ac_address;
$contact_person=$crp->ac_address;
$rm=$crp->ac_address;
$apsarr= App\AppSignator::where('crp_id','=',$crp->id);
$crid=$crp->id;
?>

{!! Form::open(array('url' =>url('cap/edit'), 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}

<div class="row row-bg">
    <div class="row" style="margin-left: 10px">
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
                        <div class="col-md-4 control-label"><input type="text" name="app_date" required="required" class="form-control datepicker" value="@if(old('app_date') !="") {{old('app_date')}} @elseif($app_date !="") {{$app_date}} @else {{date('Y-m-d')}} @endif"/> </div>
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
                        <div class="col-md-9"><input type="text" name="ac_name" required="required" value="@if(old('ac_name') !="") {{old('ac_name')}} @elseif($ac_name !="") {{$ac_name}} @endif  " class="form-control">
                            @if($errors->first('ac_name'))
                                <p class=" alert-danger">Account name is required</p>
                            @endif
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-md-3 control-label">Address</div>
                        <div class="col-md-9">
                            <textarea name="ac_address" class="form-control" id="ac_address" required="required" cols="4" rows="5">@if(old('ac_address') !="") {{old('ac_address')}} @elseif($ac_address !="") {{$ac_address}} @endif</textarea>

                            @if($errors->first('ac_address'))
                                <p class=" alert-danger">Address is required</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 control-label">Management contact person</div>
                        <div class="col-md-9"><input type="text" name="contact_person" class="form-control" required="required" value="@if(old('contact_person') !="") {{old('contact_person')}} @elseif($contact_person !="") {{$contact_person}} @endif  ">
                            @if($errors->first('contact_person'))
                                <p class=" alert-danger">Contact Person is required</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 control-label">Relationship manager</div>
                        <div class="col-md-9"><input type="text" name="rm" required="required" class="form-control" value="@if(old('rm') !="") {{old('rm')}} @elseif($rm !="") {{$rm}} @endif">
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
                    <h4><i class="icon-reorder"></i>Select Signatory</h4>
                </div>
                <div class="widget-content">

                    <div class="form-group">


                    </div>
                    <div class="form-group" id="signator-form">

                        <div class="col-md-3 control-label">
                            <input type="button" id="btnAddSignature" class="button  btn-primary" value="Add new" onclick="addNewSignatory();" />
                        </div>
                        <div class="col-md-9"><input type="text" name="sig_name" id="sig_name" value="{{old('sig_name')}}" class="form-control">
                            @if($errors->first('sig_name'))
                                <p class=" alert-danger signame">Please enter signatory named</p>
                            @endif
                        </div>

                    </div>
                    <div class="form-group">

                        <div class="col-md-12" id="signatorytb">
                            <table class="table table-striped table-bordered table-hover table-checkable table-responsive">
                                <thead>
                                <tr>

                                    <th data-class="expand">Signatory Name</th>
                                    <th class="checkbox-column">
                                        <input type="checkbox" class="uniform">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(old('signat') != "")
                                {
                                    $sigcount=0;
                                    $sigarr=old('signat');
                                    $dt="";
                                    foreach($sigarr as $id)
                                    {
                                        if($id !="")
                                        {
                                            $sg=App\Signator::find($id);
                                            $dt='<tr>

                                                                <td>{{$sg->names}}</td>
                                                                <td class="checkbox-column">
                                                                    <input type="checkbox" value="'.$sg->id.'" class="uniform" name="signat[]">
                                                                </td>

                                                                </tr>';
                                            $sigcount ++;
                                        }
                                    }
                                }
                                else
                                {


                                    foreach( $apsarr  as $sg)
                                    {


                                        echo '<tr>

                                                                <td>{{$sg->names}}</td>
                                                                <td class="checkbox-column">
                                                                    <input type="checkbox" value="'.$sg->id.'" class="uniform" name="signat[]" checked="checked" />
                                                                </td>

                                                                </tr>';

                                    }
                                }


                                $signators =App\Signator::all(); ?>
                                @foreach($signators as $sg)
                                    <tr>

                                        <td>{{$sg->names}}</td>
                                        <td class="checkbox-column">
                                            <input type="checkbox" value="{{$sg->id}}" class="uniform" name="signat[]">
                                        </td>

                                    </tr>

                                @endforeach

                                </tbody>
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
            <button type="button" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
            <input type="hidden" value="@if(old('crid') !="") {{old('crid')}} @else {{$crid}} @endif " name="crid">
        </div>
        <div id="output" class="col-md-8"></div>
    </div>
</div>


{!! Form::close() !!}
<script>


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
                        url: '<?php echo url('cap/edit') ?>',
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
        var sigData=document.getElementById("sig_name").value;
        alert(sigData);
        document.getElementById("sig_name").value="";
        $.get("signatoriespost/"+sigData ,function(data){

            document.getElementById("signatorytb").innerHTML=data;

        })

    }


</script>
<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$details="";
$security_status="";
if( count($crp->proposedsecurity) !=0 )
{

    $id=$crp->proposedsecurity->id;
    $ps=$crp->proposedsecurity;
    $details=$ps->details;
    $security_status=$ps->status;
    $apprequest=1;
}
?>
    {!! Form::open(array('url' => 'proposed-security', 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}
    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>C: Proposed security
                            </h4>
                    </div>
                    <div class="widget-content">

                            <div class="form-group">
                                <div class="col-md-12">
                                    @if($errors->has())
                                        <p><ol>
                                        @foreach ($errors->all() as $error)
                                                <li>  <p class=" alert-danger"> {{ $error }} </p>  </li>
                                        @endforeach
                                        </ol> </p>
                                    @endif

                                    <table class="table" id="exsec">
                                        <tr>
                                            <td colspan="4">
                                                <table class="table" id="tbproposed">
                                                    @if($details !="" && count($details)> 0)
                                                        @foreach($details as $d)
                                                    <tr>
                                                        <td>  <table class="table">
                                                                <thead>

                                                                <th class="col-md-6">Proposed security </th>
                                                                <th class="col-md-2">Open market value</th>
                                                                <th class="col-md-2">Forced sale Value </th>
                                                                <th class="col-md-2">To be charged for  </th>
                                                                <th></th>
                                                                </thead>
                                                                <tbody>
                                                                <tr>

                                                                    <td>
                                                                        <table class="table">

                                                                            <tr>
                                                                                <td>Location:   </td>
                                                                                <td><input type="text" class="form-control" name="location[]" value="{{$d->location}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Area:  </td>
                                                                                <td><input type="text" class="form-control" name="area[]" value="{{$d->area}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Certificate of title no:   </td>
                                                                                <td><input type="text" class="form-control" name="certificate[]" value="{{$d->certificate}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Owner:   </td>
                                                                                <td><input type="text" class="form-control" name="owner[]" value="{{$d->owner}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Tenor: status:   </td>
                                                                                <td><input type="text" class="form-control" name="status[]" value="{{$d->plot_area}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Area of plot:   </td>
                                                                                <td><input type="text" class="form-control" name="plot_area[]" value="{{$d->plot_area}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Valued by:   </td>
                                                                                <td><input type="text" class="form-control" name="valued_by[]" value="{{$d->valued_by}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Valued on:   </td>
                                                                                <td><input type="text" class="form-control" name="valued_on[]" value="{{$d->valued_on}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Valued at:   </td>
                                                                                <td><input type="text" class="form-control" name="valued_at[]" value="{{$d->valued_at}}"/> </td>

                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td><input type="text" name="open_marketvalue[]" class="form-control" value="{{$d->open_marketvalue}}"></td>
                                                                    <td><input type="text" name="forced_salevalue[]" class="form-control" value="{{$d->forced_salevalue}}"></td>
                                                                    <td><input type="text" name="tobe_charges[]" class="form-control" value="{{$d->tobe_charges}}"></td>

                                                                </tr>

                                                                </tbody>

                                                            </table>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                        @endforeach

                                                    @else
                                                    <tr>
                                                        <td>  <table class="table">
                                                                <thead>

                                                                <th class="col-md-6">Proposed security </th>
                                                                <th class="col-md-2">Open market value</th>
                                                                <th class="col-md-2">Forced sale Value </th>
                                                                <th class="col-md-2">To be charged for  </th>
                                                                <th></th>
                                                                </thead>
                                                                <tbody>
                                                                <tr>

                                                                    <td>
                                                                        <table class="table">


                                                                            <tr>
                                                                                <td>Location:   </td>
                                                                                <td><input type="text" class="form-control" name="location[]"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Area:  </td>
                                                                                <td><input type="text" class="form-control" name="area[]"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Certificate of title no:   </td>
                                                                                <td><input type="text" class="form-control" name="certificate[]"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Owner:   </td>
                                                                                <td><input type="text" class="form-control" name="owner[]"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Tenor: status:   </td>
                                                                                <td><input type="text" class="form-control" name="status[]"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Area of plot:   </td>
                                                                                <td><input type="text" class="form-control" name="plot_area[]"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Valued by:   </td>
                                                                                <td><input type="text" class="form-control" name="valued_by[]"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Valued on:   </td>
                                                                                <td><input type="text" class="form-control" name="valued_on[]"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Valued at:   </td>
                                                                                <td><input type="text" class="form-control" name="valued_at[]"/> </td>

                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td><input type="text" name="open_marketvalue[]" class="form-control"></td>
                                                                    <td><input type="text" name="forced_salevalue[]" class="form-control"></td>
                                                                    <td><input type="text" name="tobe_charges[]" class="form-control"></td>

                                                                </tr>

                                                                </tbody>

                                                            </table>
                                                        </td>

                                                    </tr>
                                                    @endif

                                                </table>

                                            </td>
                                            <td> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS();" /> </td>
                                        </tr>

                                    </table>

                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-2">
                                    Security status
                                </div>
                                <div class="col-md-10">
                                    <textarea name="security_status" id="security_status" cols="45" rows="10" class="form-control">{{$security_status}}</textarea>
                                    @if($errors->first('security_status'))
                                        <p class=" alert-danger">Security status is required</p>
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
            <button type="button" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
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
                        url: '<?php echo url('proposed-security') ?>',
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


        function addRowFS()
        {
            var table = document.getElementById('tbproposed');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);

            cel2.innerHTML="<input type='button' name='button' id='button' value='Delete' class='btn btn-danger' />";
            cell.innerHTML="  <table class='table'><thead><th class='col-md-6'>Proposed security </th><th class='col-md-2'>Open market value</th><th class='col-md-2'>Forced sale Value </th><th class='col-md-2'>To be charged for  </th><th></th></thead><tbody><tr><td><table class='table'><tr><td>Location:   </td><td><input type='text' class='form-control' name='location[]'/> </td></tr><tr><td>Area:  </td><td><input type='text' class='form-control' name='area[]'/> </td></tr><tr><td>Certificate of title no:   </td><td><input type='text' class='form-control' name='certificate[]'/> </td></tr><tr><td>Owner:   </td><td><input type='text' class='form-control' name='owner[]'/> </td></tr><tr><td>Tenor: status:   </td><td><input type='text' class='form-control' name='status[]'/> </td></tr><tr><td>Area of plot:   </td><td><input type='text' class='form-control' name='plot_area[]'/> </td></tr><tr><td>Valued by:   </td><td><input type='text' class='form-control' name='valued_by[]'/> </td></tr><tr><td>Valued on:   </td><td><input type='text' class='form-control' name='valued_on[]'/> </td></tr><tr><td>Valued at:   </td><td><input type='text' class='form-control' name='valued_at[]'/> </td></tr></table></td><td><input type='text' name='open_marketvalue[]' class='form-control'></td><td><input type='text' name='forced_salevalue[]' class='form-control'></td><td><input type='text' name='tobe_charges[]' class='form-control'></td></tr></tbody>  </table>"
        }
    </script>

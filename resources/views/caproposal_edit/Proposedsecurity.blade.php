
{!!HTML::script("assets/js/tinymce/tinymce.min.js")!!}
<script type="text/javascript">
    tinymce.init({
        mode : "specific_textareas",
        editor_selector : "mceEditor",
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
$details="";
$security_status="";
$rate_applied="";
if( count($crp->proposedsecurity) !=0 )
{

    $id=$crp->proposedsecurity->id;
    $ps=$crp->proposedsecurity;
    $details=$ps->details;
    $security_status=$ps->status;
    $apprequest=1;
    $rate_applied=$crp->proposedsecurity->rate_applied;
}
 $rules = ['security_status'=>'required'];
?>
    {!! Form::open(array('url' => 'proposed-security', 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules ) !!}

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
                            <div class="col-md-2 pull-right text-info">
                                <input type="button" value="Add Security" class="btn btn-primary btn-block" onclick="addSecsRows();">
                            </div>
                            <div class="col-md-3 pull-right ">
                                <select name="secSelectOpt" id="secSelectOpt"  class="form-control" onchange="getSecsOPT(this);">
                                    <option value="">--Select securities to add--</option>
                                    <option>Landed Property</option>
                                    <option>Debenture</option>
                                    <option>Specific Debenture</option>
                                    <option>Personal Guarantee</option>
                                    <option>Corporate Guarantee</option>
                                </select>
                            </div>
                            <div class="col-md-3 pull-right text-right text-info">
                               <strong>Select Security to add:</strong>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                  <table class="table  table-full-width" id="securities">
                                       <thead>
                                       <tr>
                                           <th class="col-md-6 text-center text-capitalize"> EXISTING SECURITY</th>
                                           <th class="col-md-2 text-center text-capitalize"> CURRENCY</th>
                                           <th class="col-md-2 text-center text-capitalize"> OPEN MARKET VALUE</th>
                                           <th class="col-md-2 text-center text-capitalize"> FORCED SALE VALUE</th>
                                           <th  class="col-md-2 text-center text-capitalize"> TO BE CHARGED FOR </th>
                                           <th></th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                       @if($details !="" && count($details)> 0)
                                           @foreach($details as $d)
                                               @if($d->security_type =="Landed Property")
                                                   <tr>
                                                       <td><table class='table'>
                                                               <tr>
                                                                   <td colspan='2'>Immovable Property</td>
                                                               </tr>
                                                               <tr>
                                                                   <td colspan='2"'><input type='text' class='form-control' name='immovable[]' value='{{$d->immovable}}'/></td>
                                                               </tr>
                                                               <tr><td>Location:   </td><td><input name='location[]' type='text' class='form-control' value="{{$d->location}}"/> </td>
                                                               </tr>
                                                               <tr>
                                                                   <td>Certificate of title no:   </td><td><input name='certificate[]' type='text' class='form-control' value="{{$d->certificate}}"/> </td>
                                                               </tr>
                                                               <tr><td>Ownership:   </td><td><input name='owner[]' type='text' class='form-control' value="{{$d->owner}}"/> </td>
                                                               </tr>
                                                               <tr><td>Area:  </td><td><input name='area[]' type='text' class='form-control' value="{{$d->area}}"/> </td>
                                                               </tr>
                                                               <tr><td>Tenor: status:   </td><td><input name='status[]' type='text' class='form-control' value="{{$d->tennor}}"/> </td>
                                                               </tr>
                                                               <tr><td>Built up Area:   </td><td><input name='plot_area[]' type='text' class='form-control' value="{{$d->plot_area}}"/> </td>
                                                               </tr>
                                                               <tr><td>Valued by:   </td><td><input name='valued_by[]' type='text' class='form-control' value="{{$d->valued_by}}"/> </td>
                                                               </tr>
                                                               <tr><td>Valued on:   </td><td><input name='valued_on[]' type='text' class='form-control' value="{{$d->valued_on}}"/> </td>
                                                               </tr>
                                                               <tr><td>Valued at:   </td><td><input name='valued_at[]' type='text' class='form-control' value="{{$d->valued_at}}"/> </td>
                                                               </tr>
                                                           </table>
                                                       </td>
                                                       <td>
                                                           <select name="ccy_1[]" class="form-control" >
                                                               <option value="" >--CCY-- </option>
                                                               @if($d->ccy_1 !="")
                                                                   <option selected="selected" >{{$d->ccy_1}} </option>
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
                                                       <td> <input type='text' name='open_value[]' class='form-control' value="{{$d->open_marketvalue}}"/></td>
                                                       <td> <input type='text' name='forced_value[]' class='form-control' value="{{$d->forced_salevalue}}"/><input type='hidden' name='existing_security[]' value=''/></td>
                                                       <td> <input type='text' name='tobe_charged[]' class='form-control' value="{{$d->tobe_charges}}" /><input type='hidden' name='security_type[]' value='{{$d->security_type}}'/></td>
                                                       <td> <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove {{$d->security_type}}</a></td>
                                                   </tr>
                                                   </tr>
                                               @else
                                                   <tr>
                                                       <td><textarea name='existing_security[]' class='form-control'>{{$d->existing_security}}</textarea></td>
                                                       <td>
                                                           <select name="ccy_1[]" class="form-control" >
                                                               <option value="" >--CCY-- </option>
                                                               @if($d->ccy_1 !="")
                                                                   <option selected="selected" >{{$d->ccy_1}} </option>
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
                                                       <td><input type='text' name='open_value[]' class='form-control' value='{{$d->open_marketvalue}}'/></td>
                                                       <td><input type='text' name='forced_value[]' class='form-control' value='{{$d->forced_salevalue}}'/></td>
                                                       <td><input type='text' name='tobe_charged[]' class='form-control' value='{{$d->tobe_charges}}'/><input type='hidden' name='security_type[]' value='{{$d->security_type}}'/></td>
                                                       <td><a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove {{$d->security_type}}</a></td>
                                                   </tr>
                                               @endif
                                           @endforeach
                                       @endif
                                       </tbody>
                                  </table>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-md-3" ><strong>Rate Applied </strong> </div>
                            <div class="col-md-3">
                                {!! Form::text('rate_applied',$rate_applied,array('class'=>'form-control')) !!}
                            </div>

                        </div>
                            <div class="form-group">
                                <div class="col-md-2">
                                    Security status
                                </div>
                                <div class="col-md-10">
                                    {!! Form::textarea('security_status', $security_status, array('class' => 'mceEditor form-control','placeholder'=>'Enter  Security status'))  !!}
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
            <button type="submit" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
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

        function addSecsRows()
        {
            var data=$("#secSelectOpt").val();
if(data !="") {
    if (data == "Landed Property") {
        var table = document.getElementById('securities');
        var row = table.insertRow(-1);

        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);
        var cel6 = row.insertCell(5);

        cell.innerHTML = "<table class='table' style='border: none'><tr><td colspan='2'>Immovable Property</td> </tr> <tr><td colspan='2'><input type='text' class='form-control' name='immovable[]'/></td></tr><tr><td>Location:   </td><td><input type='text' class='form-control' name='location[]'/> </td></tr><tr><td>Certificate of title no:   </td><td><input type='text' class='form-control' name='certificate[]'/> </td></tr><tr><td>Ownership:   </td><td><input type='text' class='form-control' name='owner[]'/> </td></tr><tr><td>Area:  </td><td><input type='text' class='form-control' name='area[]'/> </td></tr><tr><td>Tenor: status:   </td><td><input type='text' class='form-control' name='status[]'/> </td></tr><tr><td>Built up Area:   </td><td><input type='text' class='form-control' name='plot_area[]'/> </td></tr><tr><td>Valued by:   </td><td><input type='text' class='form-control' name='valued_by[]'/> </td></tr><tr><td>Valued on:   </td><td><input type='text' class='form-control' name='valued_on[]'/> </td></tr><tr><td>Valued at:   </td><td><input type='text' class='form-control' name='valued_at[]'/> </td></tr></table>"
        cel2.innerHTML = " <select name='ccy_1[]' class='form-control' > <option value='' >--CCY-- </option>  @foreach(\App\Currency::all() AS $cur) <option  >{{$cur->ccy}} </option> @endforeach </select>";
        cel3.innerHTML = "<input type='text' name='open_value[]' class='form-control'/>";
        cel4.innerHTML = "<input type='text' name='forced_value[]' class='form-control'/><input type='hidden' name='existing_security[]' value=''/>";
        cel5.innerHTML = "<input type='text' name='tobe_charged[]' class='form-control'/><input type='hidden' name='security_type[]' value='" + data + "'/>";
        cel6.innerHTML = "<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove " + data + "</a>";

    }
    else {

        var table = document.getElementById('securities');
        var row = table.insertRow(-1);

        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);
        var cel6 = row.insertCell(5);

        cell.innerHTML = "<textarea name='existing_security[]' class='form-control'></textarea>";
        cel2.innerHTML = " <select name='ccy_1[]' class='form-control' > <option value='' >--CCY-- </option>  @foreach(\App\Currency::all() AS $cur) <option  >{{$cur->ccy}} </option> @endforeach </select>";
        cel3.innerHTML = "<input type='text' name='open_value[]' class='form-control'/>";
        cel4.innerHTML = "<input type='text' name='forced_value[]' class='form-control'/>";
        cel5.innerHTML = "<input type='text' name='tobe_charged[]' class='form-control'/><input type='hidden' name='security_type[]' value='" + data + "'/>";
        cel6.innerHTML = "<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove " + data + "</a>";

    }
}

        }



        function getSecsOPT(d)
        {

        }

        function rmOption(o)
        {
            var p=o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }

    </script>


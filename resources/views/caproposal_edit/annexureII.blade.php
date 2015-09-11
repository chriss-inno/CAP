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
$title="";
$contents="";
$annexure="";

if( count($crp->annexure_ii) !=0 )
{
    $annexure=$crp->annexure_ii;
    $title=$annexure->title;
    $contents=$annexure->contents;
    $id=$annexure->id;
    $apprequest=1;

}
$rules = ['contents'=>'required'];
?>
{!! Form::open(array('url' => 'annexure_ii', 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules) !!}
<div class="row row-bg">
    <div class="row" >
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i> Annexure-II</h4>
                </div>
                <div class="widget-content">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="title">Title</label>
                            {!! Form::text('title',$title,array('class'=>'form-control','placeholder'=>'Enter title of this form ie BALANCE SHEET')) !!}
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <label for="contents">Contents</label>
                            <textarea name="contents" class="form-control" rows="30" placeholder="Enter form contents details"><?php echo $contents; ?> </textarea>
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

        if( data=="Funded")
        {
            var table = document.getElementById('convTB');
            var row = table.insertRow(-1);
            var row2 = table.insertRow(-1);

            var cell1 = row.insertCell(0);
            var cel21 = row.insertCell(1);
            var cel31 = row.insertCell(2);
            var cel41 = row.insertCell(3);
            var cel51 = row.insertCell(4);

            var cell = row2.insertCell(0);
            var cel2 = row2.insertCell(1);
            var cel3 = row2.insertCell(2);
            var cel4 = row2.insertCell(3);
            var cel5 = row2.insertCell(4);

            cell1.innerHTML="<strong><small>Rate of Interest</small></strong>";
            cel21.innerHTML="<strong><small>Funded</small></strong><input type='z' name='fund_type[]' value='" + data + "'/>";
            cel31.innerHTML="<input type='hidden' class='form-control' name='type_nonfunded[]' value=''>";
            cel41.innerHTML="";
            cel51.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove " + data + "</a>";

            cell.innerHTML="<input type='text' class='form-control' name='pricing[]' value=''>";
            cel2.innerHTML="<input type='text' class='form-control' name='facility[]' value=''>";
            cel3.innerHTML="<input type='text' class='form-control' name='spread[]' value=''>";
            cel4.innerHTML="<input type='text' class='form-control' name='effective_rate[]' value=''>";
            cel5.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove " + data + "</a>";

        }
        else
        {

            var table = document.getElementById('convTB');
            var row = table.insertRow(-1);

            var row2 = table.insertRow(-1);

            var cell1 = row.insertCell(0);
            var cel21 = row.insertCell(1);
            var cel31 = row.insertCell(2);
            var cel41 = row.insertCell(3);
            var cel51 = row.insertCell(4);

            var cell = row2.insertCell(0);
            var cel2 = row2.insertCell(1);
            var cel3 = row2.insertCell(2);
            var cel4 = row2.insertCell(3);
            var cel5 = row2.insertCell(4);

            cell1.innerHTML="<strong><small>Type of non funded facility</small></strong><input type='hidden' name='fund_type[]' value='" + data + "'/>";
            cell1.className="text-right";
            cel21.innerHTML="<strong><small><input type='text' class='form-control' name='type_nonfunded[]' value=''></small></strong>";
            cel31.innerHTML="<input type='text' class='form-control' name='nonfunded_spread[]' value=''>";
            cel41.innerHTML="<input type='text' class='form-control' name='nonfunded_ef_rate[]' value=''>";
            cel51.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove " + data + "</a>";

            cell.innerHTML="<input type='text' class='form-control' name='pricing[]' value=''>";
            cel2.innerHTML="<input type='text' class='form-control' name='facility[]' value=''>";
            cel3.innerHTML="<input type='text' class='form-control' name='spread[]' value=''>";
            cel4.innerHTML="<input type='text' class='form-control' name='effective_rate[]' value=''>";
            cel5.innerHTML="<a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove " + data + "</a>";

        }

    }

    function rmOption(o)
    {
        var p=o.parentNode.parentNode;
        p.parentNode.removeChild(p);
    }

</script>
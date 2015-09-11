@extends('layout.master')
@section('title')
General Repots | Credit Application System
@stop
@section('breadcrumbs')

<li>
    <i class="icon-home"></i>
    <a href="{{url('home')}}">Home</a>
</li>
<li>
    <i class="icon-bar-chart"></i>
    Credit Application Reports
</li>

@stop
@section('contents')
    <style>

    </style>

    <div class="row row-bg">
        <div class="contents" style="margin: 10px">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php
                    $rules = ['search_text'=>'alpha_dash','date_from'=>'date','date_to'=>'date'];
                    ?>

                    {!! Form::open(array('url'=>'reports','id'=>'ajax-form'),$rules) !!}
                    <fieldset>
                        <legend class="text-info" >Advanced Report Generation:</legend>
                         <div class="row">
                             <div class="col-md-2 ">Search Text</div>
                             <div class="col-md-8 ">
                                 {!! Form::text('search_text',old('search_text'),array('class'=>'form-control')) !!}
                             </div>
                         </div>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-md-2 ">Date range</div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                      <span>Date From</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Form::text('date_from',old('date_from'),array('class'=>'form-control','placeholder'=>'YYYY-MM-DD')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                       <span>Date To</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Form::text('date_to',old('date_to'),array('class'=>'form-control','placeholder'=>'YYYY-MM-DD')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-md-2 ">Application status</div>
                            <div class="col-md-8 ">
                                <select name="apptype" class="form-control">
                                    <option selected="selected" value="All">All</option>
                                    <option>New</option>
                                    <option>Renewal</option>
                                    <option>Interim</option>
                                    <option>Existing level</option>
                                    <option>Enhancement</option>
                                    <option>Amendment</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-4 col-md-offset-3">
                                <button class="btn btn-primary btn-block">Search</button>
                            </div>
                            <div class="col-md-4" id="output">

                            </div>
                        </div>
                    </fieldset>
                </div>
                {!! Form::close()!!}
                <script>

                    $("#ajax-form").validate({
                        submitHandler: function(form) {
                            $("#display").html("");
                            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i>Please wait...</span><h3>");
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
                                            $("#display").html(data);
                                            setTimeout(function() {
                                                $("#output").html("");
                                            }, 3000);
                                        },
                                        error: function(data)
                                        {
                                            console.log(data.responseJSON);
                                            //in the responseJSON you get the form validation back.
                                            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Error in processing data try again...</span><h3>");
                                            $("#output").html(data);
                                            setTimeout(function() {
                                                $("#myModal").modal("hide");
                                            }, 3000);
                                        }
                                    });
                        }
                    });
                                </script>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="contents" style="margin: 10px">
            {!! Form::open(array('url'=>'excelExport','id'=>'ajax-search-form'),$rules) !!}
             <div class="col-md-12" id="display">
             </div>
            {!! Form::close()!!}
        </div>
    </div>

    @stop
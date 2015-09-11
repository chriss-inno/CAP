@extends('layout.master')
@section('title')
    Credit Application | Proposed security
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
        Proposed security
    </li>

@stop
@section('contents')
    {!! Form::open(array('url' => 'proposed-security', 'class' => 'form-horizontal row-border')) !!}
    <div class="row row-bg">
        <div class="row" style="margin-left: 100px">
            <div class="col-md-8">
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

                                                    @if( old('location') !=NULL && sizeof(old('location')) >0)
                                                        <?php
                                                        $location =old('location') ;
                                                        $area=old('area');
                                                        $certificate=old('certificate');
                                                        $owner=old('owner');
                                                        $status=old('status');
                                                        $plot_area=old('plot_area');
                                                        $plot_area=old('plot_area');
                                                        $valued_by=old('valued_by');
                                                        $valued_on=old('valued_on');
                                                        $valued_at=old('valued_at');
                                                        $open_marketvalue=old('open_marketvalue');
                                                        $forced_salevalue=old('forced_salevalue');
                                                        $tobe_charges=old('tobe_charges');                                                        ?>
                                                       @for($i=0; $i< sizeof($location) ; $i++)

                                                            @if($location[$i] != Null && $location[$i] != "")
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
                                                                                <td><input type="text" class="form-control" name="location[]" value="{{$location[$i]}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Area:  </td>
                                                                                <td><input type="text" class="form-control" name="area[]" value="{{$area[$i]}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Certificate of title no:   </td>
                                                                                <td><input type="text" class="form-control" name="certificate[]" value="{{$certificate[$i]}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Owner:   </td>
                                                                                <td><input type="text" class="form-control" name="owner[]" value="{{$owner[$i]}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Tenor: status:   </td>
                                                                                <td><input type="text" class="form-control" name="status[]" value="{{$status[$i]}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Area of plot:   </td>
                                                                                <td><input type="text" class="form-control" name="plot_area[]" value="{{$plot_area[$i]}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Valued by:   </td>
                                                                                <td><input type="text" class="form-control" name="valued_by[]" value="{{$valued_by[$i]}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Valued on:   </td>
                                                                                <td><input type="text" class="form-control" name="valued_on[]" value="{{$valued_on[$i]}}"/> </td>

                                                                            </tr>
                                                                            <tr>
                                                                                <td>Valued at:   </td>
                                                                                <td><input type="text" class="form-control" name="valued_at[]" value="{{$valued_at[$i]}}"/> </td>

                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td><input type="text" name="open_marketvalue[]" class="form-control" value="{{$open_marketvalue[$i]}}"></td>
                                                                    <td><input type="text" name="forced_salevalue[]" class="form-control" value="{{$forced_salevalue[$i]}}"></td>
                                                                    <td><input type="text" name="tobe_charges[]" class="form-control" value="{{$tobe_charges[$i]}}"></td>

                                                                </tr>

                                                                </tbody>

                                                            </table>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                                @endif
                                                           @endfor
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
                                                        <td> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS();" /> </td>
                                                    </tr>
                                                    @endif

                                                </table>

                                            </td>

                                        </tr>

                                    </table>

                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-2">
                                    Security status
                                </div>
                                <div class="col-md-10">
                                    <textarea name="security_status" id="security_status" cols="45" rows="10" class="form-control"></textarea>
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
    <div class="row row-bg">
        <div class="row" style="margin-bottom: 20px">
            <div class="col-md-1 col-md-offset-1" >
                <a href="{{url('form2')}}" class="btn btn-primary"><< Previous</a>
            </div>
            <div class="col-md-1 col-md-offset-5">
                <input type="submit" name="Submit" class="btn btn-primary"  value="Next >>" />
                <input type="hidden" value="{{$id}}" name="crp_id" id="crp_id">
            </div>

        </div>
    </div>
    {!! Form::close() !!}
    <script>
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
@stop
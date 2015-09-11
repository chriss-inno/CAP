
                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="example2" >
                            <thead>
                            <tr>
                                <th class="checkbox-column">
                                    ID
                                </th>
                                <th>Serial Number</th>
                                <th data-hide="expand">Application Date</th>
                                <th data-class="expand">Account Name</th>
                                <th data-hide="expand">Address</th>
                                <th data-hide="expand">Management contact person</th>
                                <th data-hide="expand">Relationship manager</th>

                                <th data-hide="expand">Status</th>
                                <th>Report</th>
                                <th data-hide="expand">Action</th>

                            </tr>
                            </thead>
                            <tbody>


                            <tr>
                                <td class="checkbox-column">
                                    {{$cap->id}}
                                </td>
                                <td>{{$cap->sno}}</td>
                                <td>{{$cap->ap_date}}</td>
                                <td>{{$cap->ac_name}}</td>
                                <td>{{$cap->ac_address}}</td>
                                <td>{{$cap->contact_person}}</td>
                                <td>{{$cap->rm}}</td>
                                <td>
                                    @if($cap->autho ==1)
                                        <span class="label label-success">Approved</span>
                                    @else
                                        <span class="label label-warning">Pending</span>
                                    @endif
                                </td>
                                <td><a href="{{url("download/pdf/report".$cap->id)}}" class="text-success"> <i class='icon-download-alt'> </i> Download </a></td>
                                <td id="{{ $cap->id }}">
                                    <a href="#edit" title="edit Application" class="editapp "><i class="icon-pencil text-info"></i> edit</a>&nbsp;&nbsp;&nbsp;
                                    <a href="#b" title="delete Application" class="deleteapp "><i class="icon-trash text-danger"></i> delete </a>
                                </td>

                            </tr>
                            <tr><td colspan="8"><h3 class="text-primary">Add necessary forms to Application </h3></td></tr>
                            <tr>
                                <td colspan="10" style="background-color: #eee;">
                                    <?php
                                    echo '<table style="width: 100%" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                                    echo "<tr>";
                                    echo "<th style='width: 20%'>Form type</th>";
                                    echo "<th>Complete(%)</th>";
                                    echo "<th style='width: 20%'>Update</th>";
                                    echo "<th style='width: 20%'>View</th>";
                                    echo "<th style='width: 10%' align='center'>Get Report</th>";
                                    echo "</tr>";

                                    foreach($cap->formstage as $s)
                                    {
                                        if( $s->completed >= 80 &&  $s->completed <= 100 ){
                                            $class = "success";
                                        }elseif( $s->completed >= 60 &&  $s->completed <= 80){
                                            $class = "primary";
                                        }elseif( $s->completed >= 40 &&  $s->completed <= 60){
                                            $class = "info";
                                        } elseif( $s->completed >= 20 &&  $s->completed <= 40){
                                            $class = "warning";
                                        }else{
                                            $class = "danger";
                                        }
                                        $prog = '<div class="progress">
                    <div title="'.$s->completed.'%" class="progress-bar progress-bar-striped active progress-bar-'.$class.'" role="progressbar" aria-valuenow="'.$s->completed.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$s->completed.'%">
                    <span class="sr-only">'.$s->completed.'</span>
                    </div>
                    </div>';
                                        echo "<tr>";
                                        echo "<td >". $s->stage_name."</td>";
                                        echo "<td>".$prog."</td>";
                                        echo "<td id='".$s->id."'><a href='#' class='addform text-info'> <i class='icon-pencil'></i> Add/Update Form </a></td>";
                                        echo "<td id='".$s->id."'><a href='#' class='summary text-success'> <i class='icon-list''></i> view Report </a></td>";
                                        echo "<td><a href='".url("download/pdf/".$s->id)."' class=' text-warning''> <i class='icon-download-alt'> </i> Download </a></td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                    ?>
                                </td>
                            </tr>

                            </tbody>
                        </table>


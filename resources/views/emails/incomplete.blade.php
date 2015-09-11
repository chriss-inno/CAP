
    <div class="row">
        <div class="col-md-12">
            @if(count($ca) > 0)
                <table border="0" cellspacing="1" cellpadding="1" align="left" width="90%" bgcolor="#CCCCCC" style="margin-bottom: 20px; clear: both;">
            <thead>

            <tr style="background-color: #000066; color: #FFFFFF">
                <th>Serial Number</th>
                <th >Application Date</th>
                <th >Account Name</th>
                <th >Address</th>
                <th >Management contact person</th>
                <th >Relationship manager</th>
                <th>Application Type</th>
                <th>Incomplete/Missing Forms</th>

            </tr>
            </thead>
            <tbody role="alert" aria-live="polite" aria-relevant="all"><tr class="odd">
              <?php
               //Get incomplete forms
                $forms="";
                if (count($ca->accountprofile) == 0)
                {
                    $forms .="<li><a href='".url('credit-proposal').'/'.$ca->id."'> Account profile</a></li>";
                }
                if (count($ca->facilitystructure) == 0  )
                {
                    $forms .="<li><a href='".url('credit-proposal').'/'.$ca->id."'>Facility Structure</a></li>";
                }
                if (count($ca->proposedsecurity) == 0)
                {
                    $forms .="<li><a href='".url('credit-proposal').'/'.$ca->id."'>Proposed security</a></li>";
                }
                if ( count($ca->covenants) == 0  )
                {
                    $forms .="<li><a href='".url('credit-proposal').'/'.$ca->id."'>Covenants</a></li>";
                }
                if (count($ca->pricingrationale) == 0 )
                {
                    $forms .="<li><a href='".url('credit-proposal').'/'.$ca->id."'>Pricing Rationale</a></li>";
                }
                if (count($ca->accountperformance) == 0  )
                {
                    $forms .="<li><a href='".url('credit-proposal').'/'.$ca->id."'>Account performance</a></li>";
                }
                if ( count($ca->finalRecommendations) == 0)
                {
                    $forms .="<li><a href='".url('credit-proposal').'/'.$ca->id."'>Final recommendations</li>";
                }
                    ?>


            <tr>
                <td>  {{$ca->sno}}   </td>
                <td>  {{$ca->app_date}}  </td>
                <td>  {{$ca->ac_name}}  </td>
                <td>  <?php echo $ca->ac_address;?>  </td>
                <td>  {{$ca->contact_person}}   </td>
                <td>  {{$ca->rm}}   </td>
                <td>  {{ $ca->open_type }} </td>
                <td> <ol>
                        <?php echo $forms; ?>
                    </ol> </td>
            </tr>


            </tbody></table>
         <div style="margin-top: 20px; width: 100%"></div>

        @endif
    </div>
    </div>

<?php include 'participant/participant-content_header'.PL;?>
<?php include 'participant/participant-content_navbar'.PL;?>

<!-- Main content -->
<section class="content">
    <?php

      $femaleParticipant = $maleParticipant = 0;
      $eventParticipantFemale = new Participant();
      $eventParticipantFemale ->selectQuery("SELECT `ID`, `state` FROM `events_participant` WHERE `gender`='Female' AND `pass_type`!='No pass'");
      $femaleParticipant = $eventParticipantFemale ->count();

      $eventParticipantMale = new Participant();
      $eventParticipantMale ->selectQuery("SELECT `ID`, `state` FROM `events_participant` WHERE `gender`='Male' AND `pass_type`!='No pass'");
      $maleParticipant = $eventParticipantMale ->count();

      $totalParticipant = ($femaleParticipant + $maleParticipant);
        
      if($totalParticipant){
          $femaleParticipant = ($femaleParticipant * 100 / $totalParticipant);
          $maleParticipant = ($maleParticipant * 100 / $totalParticipant);
          $femaleParticipant = round($femaleParticipant,0,PHP_ROUND_HALF_UP);
          $maleParticipant = round($maleParticipant,0,PHP_ROUND_HALF_UP);
      }


      $eventParticipant = new Participant();
      $eventParticipant ->selectQuery("SELECT `ID`, `state` FROM `events_participant` WHERE `state`='Confirmed' AND `pass_type`!='No pass'");
      $ConfirmedParticipant = $eventParticipant ->count();

      $eventParticipant = new Participant();
      $eventParticipant ->selectQuery("SELECT `ID`, `state` FROM `events_participant` WHERE `state`='Pending' AND `pass_type`!='No pass'");
      $PendingParticipant = $eventParticipant ->count();

      $eventParticipant = new Participant();
      $eventParticipant ->selectQuery("SELECT `ID`, `state` FROM `events_participant` WHERE `state`='Denied' AND `pass_type`!='No pass'");
      $DeniedParticipant = $eventParticipant ->count();

      $totalParticipant = $DeniedParticipant + $PendingParticipant + $ConfirmedParticipant;
    ?>

    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$totalParticipant?></h3>

              <p>Total registered delegates</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$ConfirmedParticipant?></h3>

              <p>Approved</p>
            </div>
            <div class="icon">
              <i class="fa fa-thumbs-o-up"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-approved" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$PendingParticipant?></h3>

              <p>Pending</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-pending" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$DeniedParticipant?></h3>

              <p>Denied</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-denied" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>
    <hr class="navbar_content">
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-warning">
                    
            <?php

                $participantTable = new Participant();
                // $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE `payment_state`='Confirmed' OR `payment_state`='Free' AND `payment_state`!='Pending' AND `pass_type`!='No pass' AND `state`!='Confirmed' AND `category`!='Government' OR (`state`!='Confirmed' AND `category`='Government' AND `payment_state`='Confirmed') ");
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE (`payment_state`='Confirmed' AND `state`!='Confirmed' AND `payment_state`!='Pending') OR (`payment_state`='Free' AND `pass_type`!='No pass' AND `state`!='Confirmed' AND `category`!='Government') OR (`state`!='Confirmed' AND `category`='Government' AND `payment_state`='Confirmed') ");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Total to be approved</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-delegate">
                    
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE  (`pass_type`='Silver' || `pass_type`='Gold' || `pass_type`='Platinum') ");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Delegate</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-delegate" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-exhibitor">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE  `category`='Exhibitor' || `category`='Exhibitor-Silver-Discounted'");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Exhibitor</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-exhibitor" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-visitor">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE  `pass_type`='Visitor'");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Visitor</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-visitor" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-msgeek">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE `category`='media' || `category`='Media'");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Media</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-media" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          <!-- small box -->
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-msgeek">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE `category`='Government'");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Government</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-government" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          <!-- small box -->
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-msgeek">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE `category`='Organiser'");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Organiser</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-organiser" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          <!-- small box -->
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-msgeek">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE `category`='NOC'");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>NOC</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-noc" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          <!-- small box -->
        </div>
        <!-- ./col -->
    </div>
    <hr class="navbar_content">
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-participants">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE (`pass_type` = 'Visitor' || `pass_type` = 'Silver' || `pass_type` = 'Gold' || `pass_type` = 'Platinum' || `pass_type` = 'Speakers') AND `pass_type`!='No pass'");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Participants</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-participants" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          <!-- small box -->
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6"> 
          <!-- small box -->
          <div class="small-box bg-delegate">
                    
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE  (`pass_type`='Silver' || `pass_type`='Gold' || `pass_type`='Platinum') AND `payment_method`='Debit/Credit Card' ");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Debit/Credit Card</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-delegate" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-exhibitor">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE   (`pass_type`='Silver' || `pass_type`='Gold' || `pass_type`='Platinum') AND `payment_method`='Bank-Transfer' ");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Bank-Transfer</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-exhibitor" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-visitor">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE   (`pass_type`='Silver' || `pass_type`='Gold' || `pass_type`='Platinum' || `pass_type`='Visitor' || `pass_type` = 'Speakers') AND `payment_method`='' ");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Complimentary</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-visitor" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

    </div>
    <hr class="navbar_content">
    <div class="row">
      </div>
      <!-- ./col -->

 <!-- Small boxes (Stat box) -->
    <div class="row">

        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <!-- <div class="small-box bg-speaker">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE `category`='Government'");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Government</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-government" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div> -->
          <!-- small box -->
          <!-- <div class="small-box bg-msgeek">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE `category`='Msgeek' || `category`='Ms-geek-Applicant'");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Ms geek</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-msgeek" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div> -->
          <!-- small box -->
          <!-- <div class="small-box bg-ftg">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE `category`='Ftg' || `category`='Face-the-Gorillas-Applicant'");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Ftg</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-ftg" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div> -->
        </div>
        <!-- ./col -->
          <div class="col-sm-4">

          <!-- small box -->
          <div class="small-box bg-backtransfer">
            <?php

                $participantTable = new Participant();
                $participantTable->selectQuery("SELECT * FROM `events_participant` WHERE `category`='Speaker-Applicant'");
                $participantApprovalNumber = $participantTable ->count();
            ?>
            <div class="inner">
              <h3><?=$participantApprovalNumber?></h3>

              <p>Bank transfer</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="<?=DN?>/app/EventApp/<?=$event_ID?>/participant-backtransfer" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>

              <section class="connectedSortable ui-sortable">
                      <!-- Custom tabs (Charts with tabs)-->
                  <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                      <li class="pull-left header"><i class="fa fa-inbox"></i> Gender</li>
                    </ul>
                    <div class="tab-content no-padding">


                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">
                            <div class="col-xs-12 col-md-6 text-center">
                              <input type="text" class="knob" value="<?=$maleParticipant?>" data-skin="tron" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true">

                              <div class="knob-label">Male</div>
                            </div>
                            <!-- ./col -->

                            <div class="col-xs-12 col-md-6 text-center">
                              <input type="text" class="knob" value="<?=$femaleParticipant?>" data-skin="tron" data-thickness="0.2" data-width="90" data-height="90" data-fgColor="#f56954" data-readonly="true">

                              <div class="knob-label">Female</div>
                            </div>
                            <!-- ./col -->
                          </div>
                          <!-- /.row -->
                          <!-- /.row -->
                        </div>

                    </div>
                    <!-- page script -->
                    <script>
                      $(function () {
                        /* jQueryKnob */

                        $(".knob").knob({
                          /*change : function (value) {
                           //console.log("change : " + value);
                           },
                           release : function (value) {
                           console.log("release : " + value);
                           },
                           cancel : function () {
                           console.log("cancel : " + this.value);
                           },*/
                          draw: function () {

                            // "tron" case
                            if (this.$.data('skin') == 'tron') {

                              var a = this.angle(this.cv)  // Angle
                                  , sa = this.startAngle          // Previous start angle
                                  , sat = this.startAngle         // Start angle
                                  , ea                            // Previous end angle
                                  , eat = sat + a                 // End angle
                                  , r = true;

                              this.g.lineWidth = this.lineWidth;

                              this.o.cursor
                              && (sat = eat - 0.3)
                              && (eat = eat + 0.3);

                              if (this.o.displayPrevious) {
                                ea = this.startAngle + this.angle(this.value);
                                this.o.cursor
                                && (sa = ea - 0.3)
                                && (ea = ea + 0.3);
                                this.g.beginPath();
                                this.g.strokeStyle = this.previousColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                                this.g.stroke();
                              }

                              this.g.beginPath();
                              this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                              this.g.stroke();

                              this.g.lineWidth = 2;
                              this.g.beginPath();
                              this.g.strokeStyle = this.o.fgColor;
                              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                              this.g.stroke();

                              return false;
                            }
                          }
                        });
                        /* END JQUERY KNOB */

                        //INITIALIZE SPARKLINE CHARTS
                        $(".sparkline").each(function () {
                          var $this = $(this);
                          $this.sparkline('html', $this.data());
                        });

                        /* SPARKLINE DOCUMENTATION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
                        drawDocSparklines();
                        drawMouseSpeedDemo();

                      });
                      function drawDocSparklines() {

                        // Bar + line composite charts
                        $('#compositebar').sparkline('html', {type: 'bar', barColor: '#aaf'});
                        $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
                            {composite: true, fillColor: false, lineColor: 'red'});


                        // Line charts taking their values from the tag
                        $('.sparkline-1').sparkline();

                        // Larger line charts for the docs
                        $('.largeline').sparkline('html',
                            {type: 'line', height: '2.5em', width: '4em'});

                        // Customized line chart
                        $('#linecustom').sparkline('html',
                            {
                              height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
                              minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3
                            });

                        // Bar charts using inline values
                        $('.sparkbar').sparkline('html', {type: 'bar'});

                        $('.barformat').sparkline([1, 3, 5, 3, 8], {
                          type: 'bar',
                          tooltipFormat: '{{value:levels}} - {{value}}',
                          tooltipValueLookups: {
                            levels: $.range_map({':2': 'Low', '3:6': 'Medium', '7:': 'High'})
                          }
                        });

                        // Tri-state charts using inline values
                        $('.sparktristate').sparkline('html', {type: 'tristate'});
                        $('.sparktristatecols').sparkline('html',
                            {type: 'tristate', colorMap: {'-2': '#fa7', '2': '#44f'}});

                        // Composite line charts, the second using values supplied via javascript
                        $('#compositeline').sparkline('html', {fillColor: false, changeRangeMin: 0, chartRangeMax: 10});
                        $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
                            {composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10});

                        // Line charts with normal range marker
                        $('#normalline').sparkline('html',
                            {fillColor: false, normalRangeMin: -1, normalRangeMax: 8});
                        $('#normalExample').sparkline('html',
                            {fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4'});

                        // Discrete charts
                        $('.discrete1').sparkline('html',
                            {type: 'discrete', lineColor: 'blue', xwidth: 18});
                        $('#discrete2').sparkline('html',
                            {type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4});

                        // Bullet charts
                        $('.sparkbullet').sparkline('html', {type: 'bullet'});

                        // Pie charts
                        $('.sparkpie').sparkline('html', {type: 'pie', height: '1.0em'});

                        // Box plots
                        $('.sparkboxplot').sparkline('html', {type: 'box'});
                        $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
                            {type: 'box', raw: true, showOutliers: true, target: 6});

                        // Box plot with specific field order
                        $('.boxfieldorder').sparkline('html', {
                          type: 'box',
                          tooltipFormatFieldlist: ['med', 'lq', 'uq'],
                          tooltipFormatFieldlistKey: 'field'
                        });

                        // click event demo sparkline
                        $('.clickdemo').sparkline();
                        $('.clickdemo').bind('sparklineClick', function (ev) {
                          var sparkline = ev.sparklines[0],
                              region = sparkline.getCurrentRegionFields();
                          value = region.y;
                          alert("Clicked on x=" + region.x + " y=" + region.y);
                        });

                        // mouseover event demo sparkline
                        $('.mouseoverdemo').sparkline();
                        $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
                          var sparkline = ev.sparklines[0],
                              region = sparkline.getCurrentRegionFields();
                          value = region.y;
                          $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
                        }).bind('mouseleave', function () {
                          $('.mouseoverregion').text('');
                        });
                      }

                      /**
                       ** Draw the little mouse speed animated graph
                       ** This just attaches a handler to the mousemove event to see
                       ** (roughly) how far the mouse has moved
                       ** and then updates the display a couple of times a second via
                       ** setTimeout()
                       **/
                      function drawMouseSpeedDemo() {
                        var mrefreshinterval = 500; // update display every 500ms
                        var lastmousex = -1;
                        var lastmousey = -1;
                        var lastmousetime;
                        var mousetravel = 0;
                        var mpoints = [];
                        var mpoints_max = 30;
                        $('html').mousemove(function (e) {
                          var mousex = e.pageX;
                          var mousey = e.pageY;
                          if (lastmousex > -1) {
                            mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
                          }
                          lastmousex = mousex;
                          lastmousey = mousey;
                        });
                        var mdraw = function () {
                          var md = new Date();
                          var timenow = md.getTime();
                          if (lastmousetime && lastmousetime != timenow) {
                            var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
                            mpoints.push(pps);
                            if (mpoints.length > mpoints_max)
                              mpoints.splice(0, 1);
                            mousetravel = 0;
                            $('#mousespeed').sparkline(mpoints, {width: mpoints.length * 2, tooltipSuffix: ' pixels per second'});
                          }
                          lastmousetime = timenow;
                          setTimeout(mdraw, mrefreshinterval);
                        };
                        // We could use setInterval instead, but I prefer to do it this way
                        setTimeout(mdraw, mrefreshinterval);
                      }
                    </script>
                  </div>
              </section>
          </div>
          <div class="col-sm-6">

              <section class="connectedSortable ui-sortable">
                      <!-- Custom tabs (Charts with tabs)-->
                  <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                      <li class="pull-left header"><i class="fa fa-inbox"></i> Continents Participant</li>
                    </ul>
                    <div class="tab-content no-padding">


                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="row">

                            <?php
                              $AfricanParticipant = 0;
                              $eventParticipant = new Participant();
                              $eventParticipant ->selectQuery("SELECT `ID` FROM `events_participant` WHERE `residence_country` LIKE 'Rwanda' || `residence_country` LIKE 'Algeria' || `residence_country` LIKE 'Angola'
                                || `residence_country` LIKE 'Benin' || `residence_country` LIKE 'Botswana' || `residence_country` LIKE 'Burkina Faso' || `residence_country` LIKE 'Burundi'
                                || `residence_country` LIKE 'Cabo Verde' || `residence_country` LIKE 'Cameroon' || `residence_country` LIKE 'Central African Republic' || `residence_country` LIKE 'Chad'
                                || `residence_country` LIKE 'Comoros' || `residence_country` LIKE 'Democratic Republic of the Congo' || `residence_country` LIKE 'Republic of the Congo' 
                                || `residence_country` LIKE 'Cote d Ivoire'
                                || `residence_country` LIKE 'Djibouti' || `residence_country` LIKE 'Egypt' || `residence_country` LIKE 'Equatorial Guinea'
                                || `residence_country` LIKE 'Eritrea' || `residence_country` LIKE 'Ethiopia' || `residence_country` LIKE 'Gabon'
                                || `residence_country` LIKE 'Gambia' || `residence_country` LIKE 'Ghana' || `residence_country` LIKE 'Guinea'
                                || `residence_country` LIKE 'Guinea-Bissau' || `residence_country` LIKE 'Kenya' || `residence_country` LIKE 'Lesotho'
                                || `residence_country` LIKE 'Liberia' || `residence_country` LIKE 'Libya' || `residence_country` LIKE 'Madagascar'
                                || `residence_country` LIKE 'Malawi' || `residence_country` LIKE 'Mali' || `residence_country` LIKE 'Mauritania'
                                || `residence_country` LIKE 'Mauritius' || `residence_country` LIKE 'Morocco'  || `residence_country` LIKE 'Mozambique'
                                || `residence_country` LIKE 'Namibia' || `residence_country` LIKE 'Niger' || `residence_country` LIKE 'Nigeria'
                                || `residence_country` LIKE 'Sao Tome and Principe' || `residence_country` LIKE 'Senegal' || `residence_country` LIKE 'Seychelles'
                                || `residence_country` LIKE 'Sierra Leone' || `residence_country` LIKE 'Somalia' || `residence_country` LIKE 'South Africa' 
                                || `residence_country` LIKE 'South Sudan' || `residence_country` LIKE 'Sudan' || `residence_country` LIKE 'Swaziland' 
                                || `residence_country` LIKE 'Tanzania' || `residence_country` LIKE 'Togo' || `residence_country` LIKE 'Tunisia' 
                                || `residence_country` LIKE 'Uganda' || `residence_country` LIKE 'Zambia' || `residence_country` LIKE 'Zimbabwe'  AND `pass_type`!='No pass'
                                        ");
                              $AfricanParticipant = $eventParticipant ->count();


                              $NorthAmericaParticipant = 0;
                              $eventParticipant = new Participant();
                              $eventParticipant ->selectQuery("SELECT `ID` FROM `events_participant` WHERE `residence_country` LIKE 'Antigua & Barbuda' 
                                || `residence_country` LIKE 'Bahamas' || `residence_country` LIKE 'Barbados' 
                                || `residence_country` LIKE 'Belize' || `residence_country` LIKE 'Canada' || `residence_country` LIKE 'Costa Rica' 
                                || `residence_country` LIKE 'Cuba' || `residence_country` LIKE 'Dominica' || `residence_country` LIKE 'Dominican Republic' 
                                || `residence_country` LIKE 'El Salvador' || `residence_country` LIKE 'Grenada' || `residence_country` LIKE 'Guatemala' 
                                || `residence_country` LIKE 'Haiti' || `residence_country` LIKE 'Honduras' || `residence_country` LIKE 'Jamaica' 
                                || `residence_country` LIKE 'Mexico' || `residence_country` LIKE 'Nicaragua' || `residence_country` LIKE 'Panama' 
                                || `residence_country` LIKE 'Saint Kitts and Nevis' || `residence_country` LIKE 'Saint Lucia' || `residence_country` LIKE 'Saint Vincent and the Grenadines' 
                                || `residence_country` LIKE 'Trinidad and Tobago' || `residence_country` LIKE 'United States of America'  AND `pass_type`!='No pass'
                                        ");
                              $NorthAmericaParticipant = $eventParticipant ->count();


                              $SouthAmericaParticipant = 0;
                              $eventParticipant = new Participant();
                              $eventParticipant ->selectQuery("SELECT `ID` FROM `events_participant` WHERE `residence_country` LIKE 'Argentina' 
                                || `residence_country` LIKE 'Bolivia' || `residence_country` LIKE 'Brazil' || `residence_country` LIKE 'Chile' 
                                || `residence_country` LIKE 'Colombia' || `residence_country` LIKE 'Ecuador' || `residence_country` LIKE 'Guyana' 
                                || `residence_country` LIKE 'Paraguay' || `residence_country` LIKE 'Peru' || `residence_country` LIKE 'Suriname' 
                                || `residence_country` LIKE 'Uruguay' || `residence_country` LIKE 'Venezuela'  AND `pass_type`!='No pass'
                                        ");
                              $SouthAmericaParticipant = $eventParticipant ->count();


                              $AsianParticipant = 0;
                              $eventParticipant = new Participant();
                              $eventParticipant ->selectQuery("SELECT `ID` FROM `events_participant` WHERE `residence_country` LIKE 'Afghanistan' 
                                || `residence_country` LIKE 'Armenia' || `residence_country` LIKE 'Azerbaijan' || `residence_country` LIKE 'Bahrain' 
                                || `residence_country` LIKE 'Bangladesh' || `residence_country` LIKE 'Bhutan' || `residence_country` LIKE 'Brunei' 
                                || `residence_country` LIKE 'Cambodia' || `residence_country` LIKE 'China' || `residence_country` LIKE 'Cyprus' 
                                || `residence_country` LIKE 'Georgia' || `residence_country` LIKE 'India' || `residence_country` LIKE 'Indonesia' 
                                || `residence_country` LIKE 'Iran' || `residence_country` LIKE 'Iraq' || `residence_country` LIKE 'Israel' 
                                || `residence_country` LIKE 'Japan' || `residence_country` LIKE 'Jordan' || `residence_country` LIKE 'Kazakhstan' 
                                || `residence_country` LIKE 'Kuwait' || `residence_country` LIKE 'Kyrgyzstan' || `residence_country` LIKE 'Laos' 
                                || `residence_country` LIKE 'Lebanon' || `residence_country` LIKE 'Malaysia' || `residence_country` LIKE 'Maldives' 
                                || `residence_country` LIKE 'Mongolia' || `residence_country` LIKE 'Burma Myanmar' || `residence_country` LIKE 'Nepal' 
                                || `residence_country` LIKE 'North Korea' || `residence_country` LIKE 'Oman' || `residence_country` LIKE 'Pakistan' 
                                || `residence_country` LIKE 'Palestine' || `residence_country` LIKE 'Philippines' || `residence_country` LIKE 'Qatar' 
                                || `residence_country` LIKE 'Russia' || `residence_country` LIKE 'Saudi Arabia' || `residence_country` LIKE 'Singapore' 
                                || `residence_country` LIKE 'South Korea' || `residence_country` LIKE 'Sri Lanka' || `residence_country` LIKE 'Syria' 
                                || `residence_country` LIKE 'Taiwan' || `residence_country` LIKE 'Tajikistan' || `residence_country` LIKE 'Thailand' 
                                || `residence_country` LIKE 'Timor-Leste' || `residence_country` LIKE 'Turkey' 
                                || `residence_country` LIKE 'Turkmenistan' || `residence_country` LIKE 'United Arab Emirates' || `residence_country` LIKE 'Uzbekistan' 
                                || `residence_country` LIKE 'Vietnam' || `residence_country` LIKE 'Yemen'  AND `pass_type`!='No pass'
                                        ");
                              $AsianParticipant = $eventParticipant ->count();


                              $AustraliaParticipant = 0;
                              $eventParticipant = new Participant();
                              $eventParticipant ->selectQuery("SELECT `ID` FROM `events_participant` WHERE `residence_country` LIKE 'Australia' 
                                || `residence_country` LIKE 'Fiji' || `residence_country` LIKE 'Kiribati' || `residence_country` LIKE 'Marshall Islands' 
                                || `residence_country` LIKE 'Micronesia' || `residence_country` LIKE 'Nauru' || `residence_country` LIKE 'New Zealand' 
                                || `residence_country` LIKE 'Palau' || `residence_country` LIKE 'Papua New Guinea' || `residence_country` LIKE 'Samoa' 
                                || `residence_country` LIKE 'Solomon Islands' || `residence_country` LIKE 'Tonga' 
                                || `residence_country` LIKE 'Tuvalu' || `residence_country` LIKE 'Vanuatu'  AND `pass_type`!='No pass'
                                        ");
                              $AustraliaParticipant = $eventParticipant ->count();


                              $EuropeanParticipant = 0;
                              $eventParticipant = new Participant();
                              $eventParticipant ->selectQuery("SELECT `ID` FROM `events_participant` WHERE `residence_country` LIKE 'Albania' 
                                || `residence_country` LIKE 'Andorra' || `residence_country` LIKE 'Armenia' || `residence_country` LIKE 'Austria' 
                                || `residence_country` LIKE 'Azerbaijan' || `residence_country` LIKE 'Belarus' || `residence_country` LIKE 'Belgium' 
                                || `residence_country` LIKE 'Bosnia and Herzegovina' || `residence_country` LIKE 'Bulgaria' || `residence_country` LIKE 'Croatia' 
                                || `residence_country` LIKE 'Cyprus' || `residence_country` LIKE 'Czech Republic' 
                                || `residence_country` LIKE 'Denmark' || `residence_country` LIKE 'Estonia' || `residence_country` LIKE 'Finland' 
                                || `residence_country` LIKE 'France' || `residence_country` LIKE 'Georgia' || `residence_country` LIKE 'Germany' 
                                || `residence_country` LIKE 'Greece' || `residence_country` LIKE 'Hungary' || `residence_country` LIKE 'Iceland' 
                                || `residence_country` LIKE 'Ireland' || `residence_country` LIKE 'Italy' || `residence_country` LIKE 'Kazakhstan' 
                                || `residence_country` LIKE 'Kosovo' || `residence_country` LIKE 'Latvia' || `residence_country` LIKE 'Liechtenstein' 
                                || `residence_country` LIKE 'Lithuania' || `residence_country` LIKE 'Luxembourg' || `residence_country` LIKE 'Macedonia' 
                                || `residence_country` LIKE 'Malta' || `residence_country` LIKE 'Moldova' || `residence_country` LIKE 'Monaco' 
                                || `residence_country` LIKE 'Montenegro' || `residence_country` LIKE 'Netherlands' || `residence_country` LIKE 'Norway' 
                                || `residence_country` LIKE 'Poland' || `residence_country` LIKE 'Portugal' || `residence_country` LIKE 'Romania' 
                                || `residence_country` LIKE 'Russia' || `residence_country` LIKE 'San Marino' || `residence_country` LIKE 'Serbia' 
                                || `residence_country` LIKE 'Slovakia' || `residence_country` LIKE 'Slovenia' || `residence_country` LIKE 'Spain' 
                                || `residence_country` LIKE 'Sweden' || `residence_country` LIKE 'Switzerland' || `residence_country` LIKE 'Turkey' 
                                || `residence_country` LIKE 'Ukraine' || `residence_country` LIKE 'United Kingdom' || `residence_country` LIKE 'Vatican City'  AND `pass_type`!='No pass'
                                        ");
                              $EuropeanParticipant = $eventParticipant ->count();

                              $TotalParticipant = ($EuropeanParticipant + $NorthAmericaParticipant + $SouthAmericaParticipant
                                + $AsianParticipant + $AfricanParticipant + $AustraliaParticipant);

                              $AfricanParticipant = round($AfricanParticipant * 100 / $TotalParticipant,2);
                              $EuropeanParticipant = round($EuropeanParticipant * 100 / $TotalParticipant,2);
                              $NorthAmericaParticipant = round($NorthAmericaParticipant * 100 / $TotalParticipant,2);
                              $SouthAmericaParticipant = round($SouthAmericaParticipant * 100 / $TotalParticipant,2);
                              $AsianParticipant = round($AsianParticipant * 100 / $TotalParticipant,2);
                              $AustraliaParticipant = round($AustraliaParticipant * 100 / $TotalParticipant,2);

                            ?>

                            <style>
                              #chartContainer .canvasjs-chart-canvas{
                                width: 100% !important;
                              }
                            </style>
                            <script type="text/javascript">
                            window.onload = function () {
                              var chart = new CanvasJS.Chart("chartContainer",
                              {
                                title:{
                                  text: ""
                                },
                                exportFileName: "Pie Chart",
                                exportEnabled: true,
                                            animationEnabled: true,
                                legend:{
                                  verticalAlign: "bottom",
                                  horizontalAlign: "center"
                                },
                                data: [
                                {       
                                  type: "pie",
                                  showInLegend: true,
                                  toolTipContent: "{name}: <strong>{y}%</strong>",
                                  indexLabel: "{name} {y}%",
                                  dataPoints: [
                                    {  y: <?=$AsianParticipant?>, name: "Asian", exploded: true},
                                    {  y: <?=$AfricanParticipant?>, name: "African"},
                                    {  y: <?=$NorthAmericaParticipant?>, name: "North American"},
                                    {  y: <?=$SouthAmericaParticipant?>, name: "South American"},
                                    {  y: <?=$EuropeanParticipant?>,  name: "European"},
                                    {  y: <?=$AustraliaParticipant?>,  name: "Australian"}
                                  ]
                              }
                              ]
                              });
                              chart.render();
                            }
                            </script>

                            <div id="chartContainer" class="col-xs-12" style="height: 300px;"></div>
                          </div>
                        </div>
                    </div>
                  </div>
              </section>
          </div>


          <div class="col-sm-12">

              
              <section class="connectedSortable ui-sortable">
                      <!-- Custom tabs (Charts with tabs)-->
                  <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                      <li class=""><a href="#category-donut-chart" data-toggle="tab">Donut</a></li>
                      <li class="active"><a href="#chart_tab-2" data-toggle="tab">Bar</a></li>
                      <li class="pull-left header"><i class="fa fa-inbox"></i> Chart</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <?php
                            $categValues = array('Delegates'=>0,'Speakers'=>0,'Visitors'=>0,'Media'=>0,'Exhibitors'=>0,'Government'=>0); 
                            $categColors = array('Delegates'=>'#dd4b39','Speakers'=>'#01aef0','Visitors'=>'#95a9b3','Media'=>'#f78c2a','Exhibitors'=>'#18ab86','Government'=>'#d896c3'); 
                            $color_js = '"'.implode('","',$categColors).'"';
                   
                            $eventsTable = new Events();
                            $eventsTable->selectQuery("SELECT `ID` FROM `events_participant` WHERE `event_ID` = ? AND `pass_type`='Visitor' AND `pass_type`!='No pass' ORDER BY `ID` DESC",array($event_ID));
                            if($eventsTable->count()){
                                $categValues['Visitors'] = $eventsTable->count();
                            }
                   
                            $eventsTable = new Events();
                            $eventsTable->selectQuery("SELECT `ID` FROM `events_participant` WHERE `event_ID` = ? AND (`pass_type`='Silver' || `pass_type`='Gold' || `pass_type`='Platinum') AND `pass_type`!='No pass' ORDER BY `ID` DESC",array($event_ID));
                            if($eventsTable->count()){
                                $categValues['Delegates'] = $eventsTable->count();
                            }
                   
                            $eventsTable = new Events();
                            $eventsTable->selectQuery("SELECT `ID` FROM `events_participant` WHERE `event_ID` = ? AND `pass_type`='Media' AND `pass_type`!='No pass' ORDER BY `ID` DESC",array($event_ID));
                            if($eventsTable->count()){
                                $categValues['Media'] = $eventsTable->count();
                            }
                   
                            $eventsTable = new Events();
                            $eventsTable->selectQuery("SELECT `ID` FROM `events_participant` WHERE `event_ID` = ? AND `pass_type`='Exhibitor' AND `pass_type`!='No pass' ORDER BY `ID` DESC",array($event_ID));
                            if($eventsTable->count()){
                                $categValues['Exhibitors'] = $eventsTable->count();
                            }
                   
                            $eventsTable = new Events();
                            $eventsTable->selectQuery("SELECT `ID` FROM `events_participant` WHERE `event_ID` = ? AND `pass_type`='Speaker' AND `pass_type`!='No pass' ORDER BY `ID` DESC",array($event_ID));
                            if($eventsTable->count()){
                                 $categValues['Speakers'] = $eventsTable->count();
                            }
                            
                            $eventsTable = new Events();
                            $eventsTable->selectQuery("SELECT `ID` FROM `events_participant` WHERE `event_ID` = ? AND `pass_type`='Government' AND `pass_type`!='No pass' ORDER BY `ID` DESC",array($event_ID));
                            if($eventsTable->count()){
                                 $categValues['Government'] = $eventsTable->count();
                            }
                        ?>
                      <!-- Morris chart - Sales -->                                
                                
                        <script>
                             $(document).ready(function(){ 
//                              Donut Chart
                               Morris.Donut({
                                  element: 'category-donut-chart',
                                  resize: true,
                                  colors: [<?=$color_js?>],
                                  data: [
                                      <?php  $d=0; foreach((object)$categValues as $categ_i=>$categ_v){ $d +=1; echo '{label: "'.$categ_i.'", value: '.$categ_v.'}'; if($d!=count($categValues)){ echo ',';}?><?php }?>],
                                  hideHover: 'auto'
                                });

                                      
                                 //BAR CHART
                                var bar = new Morris.Bar({
                                  element: 'category-bars-chart',
                                  resize: true,
                                  data: [
                                    {y: 'Categories', <?php  $d=0; foreach((object)$categValues as $categ_i=>$categ_v){ $d +=1; echo $categ_i.': '.$categ_v;?><?php if($d!=count($categValues)){ echo ',';}?><?php }?>}
                                  ],
                                  barColors: [<?=$color_js?>],
                                  xkey: 'y',
                                  ykeys: [<?php  $d=0; foreach((object)$categValues as $categ_i=>$categ_v){ $d +=1; echo '"'.$categ_i.'"';?><?php if($d!=count($categValues)){ echo ',';}?><?php }?>],
                                  labels: [<?php  $d=0; foreach((object)$categValues as $categ_i=>$categ_v){ $d +=1; echo '"'.$categ_i.'"';?><?php if($d!=count($categValues)){ echo ',';}?><?php }?>],
                                  hideHover: 'auto'
                                });
                                      
                            });
                             $(document).ready(function(){ 
                                $('#category-donut-chart').ready(function(){
                                    $('#category-donut-chart').removeClass('active');
                                });
                            });
                        </script>
                      <div class="chart tab-pane active" id="category-donut-chart"  style="position: relative; height: 350px; width: 100%">
                          
                      </div>
                      <div class="chart tab-pane active" id="chart_tab-2" style="position: relative;">
                          
                        <style>
                            .morris-default-style{
                                display: none!important;
                            }
                            #resum .morris-hover-row-label{
                                font-size: 17px;
                                padding: 5px 10px; 
                                background: #f7f7f7;
                                font-family: 'Roboto-Bold';
                            }
                            #resum .morris-hover-point{
                                padding: 5px 10px; 
                            }
                            #resum{
                                padding-top: 20px; 
                                margin-right: 15px;
                            }
                        </style>
                          <div class="box-body chart-responsive">
                              
                              <div class="row">
                                  <div class="col-sm-9">
                                    <div class="chart" id="category-bars-chart" style="height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
                                  </div>
                                  <div class="col-sm-3">
                                       <div id="resum">
                                           <div class="morris-hover-row-label">Categories</div>
                                        <?php 
                                           $d=0; 
                                           $total_part = 0;
                                           foreach((object)$categValues as $categ_i=>$categ_v){
                                               $d +=1; 
                                                $total_part+=$categ_v;?>
                                            <div class="morris-hover-point" style="color: <?=$categColors[$categ_i]?>">
                                                <?=$categ_i?>: <?=$categ_v?>
                                            </div>
                                        <?php }?>
                                           <div class="morris-hover-point" style="color: #000; font-weight: bold">
                                                Total: <?=$total_part;?>
                                            </div>
                                           <hr>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                        
                    </div>
                  </div>
                  <!-- /.nav-tabs-custom -->
              </section>
              
              <?php if ($session_user_data->groups != 'OGS-User') { ?>
              <section class="connectedSortable ui-sortable">
                <div class="box box-default">
                    <div class="box-header with-border">
                      <h3 class="box-title">Payment status</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="box-body" style="padding: 15px;">
                       
                        <div class="row">
                            <div class="col-sm-4"  style="padding-top: 5px">
                                
                                <?php
                                    $delegateTotal = $delegateTotalCon = $delegateTotalCent = 0;
                                    $silverTotal = $silverTotalCon = $silverTotalCent = 0;
                                    $goldTotal = $goldTotalCon = $goldTotalCent = 0;
                                    $platinumTotal = $platinumTotalCon = $platinumTotalCent = 0;
                                    $UsdTotal = $RwfTotal = 0;
                                
                                    $eventsTable = new Events();
                                    $eventsTable->selectQuery("SELECT `state`, `payment_state`, `status`, `pass_type`, `residence_country`, `amount`, `category`, `currency` FROM `events_participant` WHERE `event_ID` = ? AND (`pass_type`='Silver' || `pass_type`='Gold' || `pass_type`='Platinum') AND `pass_type`!='No pass' ORDER BY `ID` DESC",array($event_ID));
                                    if($eventsTable->count()){
                                        $delegateTotal = $eventsTable->count();
                                        foreach($eventsTable->data() as $item_delagate_data){
                                            if($item_delagate_data->payment_state == 'Confirmed'){
                                                $delegateTotalCon +=1;
                                                // if($item_delagate_data->residence_country == 'Rwanda'){
                                                if($item_delagate_data->currency == 'RWF'){
                                                   $RwfTotal += $item_delagate_data->amount;
                                                }elseif($item_delagate_data->currency == 'USD'){
                                                    $UsdTotal += $item_delagate_data->amount;
                                                }else{
                                                    // $UsdTotal += $item_delagate_data->amount;
                                                }
                                            }
                                            if($item_delagate_data->pass_type == 'Silver'){
                                                $silverTotal +=1;
                                                if($item_delagate_data->payment_state == 'Confirmed'){
                                                    $silverTotalCon +=1;
                                                }
                                                $silverTotalCent = round($silverTotalCon*100/$silverTotal,2);
                                            }
                                            if($item_delagate_data->pass_type == 'Gold'){
                                                $goldTotal +=1;
                                                if($item_delagate_data->payment_state == 'Confirmed'){
                                                    $goldTotalCon +=1;
                                                }
                                                $goldTotalCent = round($goldTotalCon*100/$goldTotal,2);
                                            }
                                            if($item_delagate_data->pass_type == 'Platinum'){
                                                $platinumTotal +=1;
                                                if($item_delagate_data->payment_state == 'Confirmed'){
                                                    $platinumTotalCon +=1;
                                                }
                                                $platinumTotalCent = round($platinumTotalCon*100/$platinumTotal,2);
                                            }
                                        }
                                        $delegateTotalCent = round($delegateTotalCon*100/$delegateTotal,2);
                                    }
                                ?>
                                
                                
                                <div class="progress-group">
                                    <span class="progress-text">Silver <small><?=$silverTotalCent?>%</small></span>
                                    <span class="progress-number"><b><?=$silverTotalCon?></b>/<?=$silverTotal?></span>

                                    <div class="progress sm">
                                      <div class="progress-bar progress-bar-aqua" style="width: <?=$silverTotalCent?>%"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">Gold <small><?=$goldTotalCent?>%</small></span>
                                    <span class="progress-number"><b><?=$goldTotalCon?></b>/<?=$goldTotal?></span>

                                    <div class="progress sm">
                                      <div class="progress-bar progress-bar-yellow" style="width: <?=$goldTotalCent?>%"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">Platinum <small><?=$platinumTotalCent?>%</small></span>
                                    <span class="progress-number"><b><?=$platinumTotalCon?></b>/<?=$platinumTotal?></span>

                                    <div class="progress sm">
                                      <div class="progress-bar progress-bar-red" style="width: <?=$platinumTotalCent?>%;"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">Total <small><?=$delegateTotalCent?>%</small></span>
                                    <span class="progress-number"><b><?=$delegateTotalCon?></b>/<?=$delegateTotal?></span>

                                    <div class="progress sm">
                                      <div class="progress-bar progress-bar-red" style="width: <?=$delegateTotalCent?>%; background-color: #95a9b3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4" style="padding-top: 5px">
                                <div class="info-box" style="background-color: #d896c3; color: #fff">
                                    <span class="info-box-icon"><i class="ion ion-ios-cart-outline"></i></span>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Rwandan Francs</span>
                                      <span class="info-box-number"><?=number_format($RwfTotal)?> Rwf</span>

                                      <div class="progress">
                                        <div class="progress-bar" style="width: 50%"></div>
                                      </div>
                                          <span class="progress-description">
                                            
                                          </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <div class="info-box" style="background-color: #18ab86; color: #fff">
                                    <span class="info-box-icon"><i class="ion ion-social-usd"></i></span>

                                    <div class="info-box-content">
                                      <span class="info-box-text">US Dollars</span>
                                      <span class="info-box-number">$ <?=number_format($UsdTotal)?></span>

                                      <div class="progress">
                                        <div class="progress-bar" style="width: 50%"></div>
                                      </div>
                                          <span class="progress-description">
                                            
                                          </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </section>
              <?php } ?>
          </div>
          
          <div class="col-sm-12">
                 <!--RECENT REGISTER -->
                <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">Description</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="box-body" style="padding: 15px;">
                        <?=$event_data->description;?>
                    </div>
                </div>
          </div>
    </div><!-- /.row -->
    
</section>
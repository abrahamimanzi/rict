
<?php include 'payment-content_header'.PL;?>
<?php include 'payment-content_navbar'.PL;?>

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



      $registrar = new User();
      $registrar ->selectQuery("SELECT `ID` FROM `app_users` ");
      $registrar = $registrar ->count();
    ?>

    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$registrar?></h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?=DN?>/company/users/list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>Payment</h3>

              <p>Recharge account</p>
            </div>
            <div class="icon">
              <i class="fa fa-thumbs-o-up"></i>
            </div>
            <a href="<?=DN?>/company/users/buy" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>Historical</h3>

              <p>.</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="<?=DN?>/company/payment" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>.</h3>

              <p>.</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>
    <hr class="navbar_content">
    
    

    
</section>
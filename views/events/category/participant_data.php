
        <div class="participant_details">
            <div class="row">
            <div class="col-xs-6">
              <div>
                <?php if($participant_data->photo){?>
                    <img src="<?=DN._.$participant_data->photo?>" class="img " style="width: 100px; padding-bottom: 10px">
                <?php }?>
              </div>
            </div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Names</div>
              <div class="participant_details-a"><?=$participant_data->firstname?> <?=$participant_data->lastname?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Email</div>
              <div class="participant_details-a"><?=$participant_data->email?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Telephone</div>
              <div class="participant_details-a"><?=$participant_data->telephone?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Telephone office</div>
              <div class="participant_details-a"><?=$participant_data->telephone_office?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Registration ID</div>
              <div class="participant_details-a"><?=$participant_data->code?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Registration Type</div>
              <div class="participant_details-a"><?=$participant_data->registration_type?></div>
            </div>
        </div>
        <?php if($participant_data->registration_type != "Single"){?>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Group Size</div>
              <div class="participant_details-a"><?=$participant_data->group_size?></div>
            </div>
        </div>
        <?php }?>
        <?php if($participant_data->host_ID){?>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Host ID</div>
              <div class="participant_details-a"><?=$host_data->code?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Host Name</div>
              <div class="participant_details-a"><?=$host_data->firstname.' '.$host_data->firstname?></div>
            </div>
        </div>
        <?php }?>
        <div class="participant_details">
            <div class="participant_details-i">
              <div class="participant_details-q">Category</div>
              <div class="participant_details-a">
                    <?php
                        echo $participant_data->category;
                    ?>             
                </div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Pass type</div>
              <div class="participant_details-a"><?=$participant_data->pass_type?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Company name</div>
              <div class="participant_details-a"><?=$participant_data->company_name?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Company category</div>
              <div class="participant_details-a"><?=$participant_data->company_category?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Company Address</div>
              <div class="participant_details-a"><?=$participant_data->company_address?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Job title</div>
              <div class="participant_details-a"><?=$participant_data->jobtitle?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Website</div>
              <div class="participant_details-a"><?=$participant_data->website?></div>
            </div>
        </div>

        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Country of Residence </div>
              <div class="participant_details-a"><?=$participant_data->residence_country?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >City of Residence</div>
              <div class="participant_details-a"><?=$participant_data->residence_city?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Country Citizenship</div>
              <div class="participant_details-a"><?=$participant_data->citizenship_country?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Document type</div>
              <div class="participant_details-a"><?=$participant_data->document_type?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Document number</div>
              <div class="participant_details-a"><?=$participant_data->document_number?></div>
            </div>
        </div>
        <?php if($participant_data->category == "Media"){?>
            <div class="participant_details">
                <div class="participant_details-i" >
                  <div class="participant_details-q" >Media card</div>
                  <div class="participant_details-a"><?=$participant_data->media_card?></div>
                </div>
            </div>
            <div class="participant_details">
                <div class="participant_details-i" >
                  <div class="participant_details-q" >Media card expiry</div>
                  <div class="participant_details-a"><?=$participant_data->media_card_expiry?></div>
                </div>
            </div>
            <div class="participant_details">
                <div class="participant_details-i" >
                  <div class="participant_details-q" >Media card authority</div>
                  <div class="participant_details-a"><?=$participant_data->media_card_authority?></div>
                </div>
            </div>
            <div class="participant_details">
                <div class="participant_details-i" >
                  <div class="participant_details-q" >Media equipment</div>
                  <div class="participant_details-a"><?=$participant_data->media_equipment?></div>
                </div>
            </div>
        <?php }?>
        <?php if($participant_data->category == "Delegate"){?>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Payment method</div>
              <div class="participant_details-a"><?=$participant_data->payment_method?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Amount</div>
              <div class="participant_details-a"><?=$participant_data->amount?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Payment rn</div>
              <div class="participant_details-a"><?=$participant_data->payment_rn?></div>
            </div>
        </div>
          <?php }?>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Added date</div>
              <div class="participant_details-a"><?=$participant_data->added_date?></div>
            </div>
        </div>

        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >State</div>
              <div class="participant_details-a"><?=$participant_data->state?></div>
            </div>
        </div>
        <div class="participant_details">
            <div class="participant_details-i" >
              <div class="participant_details-q" >Form</div>
              <div class="participant_details-a"><?=$participant_data->form?></div>
            </div>
        </div>
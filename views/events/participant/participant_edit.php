
  <input type="hidden" name="webToken" value="56">
  <input type="hidden" name="request" value="participant-editCategory">
  <input type="hidden" name="participant-event_id" value="<?=$event_ID?>">
  <input type="hidden" name="participant-company_id" value="<?=$company_data->ID?>">
  <input type="hidden" name="participant-id" value="<?=$participant_data->ID?>">
  <div class="form-group">
    <label for="category">Category</label>
    <select name="participant-category" id="category" class="form-control bordered" required="required">
       
        <option value="" <?php if($participant_data->category == ''){ echo 'selected="selected"';}?>> [--Select--] </option>


            <option value="Exhibition-Visitor" <?php if($participant_data->category == 'Exhibition-Visitor'){ echo 'selected="selected"';}?>>Exhibition-Visitor</option>

            <option value="Individual-Silver" <?php if($participant_data->category == 'Individual-Silver'){ echo 'selected="selected"';}?>>Individual-Silver</option>

            <?php  
                if($session_user_data->groups == 'Admin'){?>
        
            <option value="Individual-Gold" <?php if($participant_data->category == 'Individual-Gold'){ echo 'selected="selected"';}?>>Individual-Gold</option>

            <option value="Individual-Platinum" <?php if($participant_data->category == 'Individual-Platinum'){ echo 'selected="selected"';}?>>Individual-Platinum</option>
        
            <?php } ?>

            <option value="Individual-Silver-Discounted" <?php if($participant_data->category == 'Individual-Silver-Discounted'){ echo 'selected="selected"';}?>>Individual-Silver-Discounted</option>

            <?php  
                if($session_user_data->groups == 'Admin'){?>
        
            <option value="Individual-Gold-Discounted" <?php if($participant_data->category == 'Individual-Gold-Discounted'){ echo 'selected="selected"';}?>>Individual-Gold-Discounted</option>
        
            <option value="Individual-Platinum-Discounted" <?php if($participant_data->category == 'Individual-Platinum-Discounted'){ echo 'selected="selected"';}?>>Individual-Platinum-Discounted</option>
        
            <?php } ?>
        
            <option value="Individual-Silver-Complimentary" <?php if($participant_data->category == 'Individual-Silver-Complimentary'){ echo 'selected="selected"';}?>>Individual-Silver-Complimentary</option>

            <?php  
                if($session_user_data->groups == 'Admin'){?>
        
            <option value="Individual-Gold-Complimentary" <?php if($participant_data->category == 'Individual-Gold-Complimentary'){ echo 'selected="selected"';}?>>Individual-Gold-Complimentary</option>
        
            <option value="Individual-Platinum-Complimentary" <?php if($participant_data->category == 'Individual-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Individual-Platinum-Complimentary</option>
        
            <?php } ?>
        
            <option value="Diplomatic-Mission-Silver-Complimentary" <?php if($participant_data->category == 'Diplomatic-Mission-Silver-Complimentary'){ echo 'selected="selected"';}?>>Diplomatic-Mission-Silver-Complimentary</option>

            <?php  
                if($session_user_data->groups == 'Admin'){?>
        
            <option value="Diplomatic-Mission-Gold-Complimentary" <?php if($participant_data->category == 'Diplomatic-Mission-Gold-Complimentary'){ echo 'selected="selected"';}?>>Diplomatic-Mission-Gold-Complimentary</option>
        
            <option value="Diplomatic-Mission-Platinum-Complimentary" <?php if($participant_data->category == 'Diplomatic-Mission-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Diplomatic-Mission-Platinum-Complimentary</option>
        
            <?php } ?>
        
            <option value="Private-Sector-Federation-Silver-Complimentary" <?php if($participant_data->category == 'Private-Sector-Federation-Silver-Complimentary'){ echo 'selected="selected"';}?>>Private-Sector-Federation-Silver-Complimentary</option>

            <?php  
                if($session_user_data->groups == 'Admin'){?>
        
            <option value="Private-Sector-Federation-Gold-Complimentary" <?php if($participant_data->category == 'Private-Sector-Federation-Gold-Complimentary'){ echo 'selected="selected"';}?>>Private-Sector-Federation-Gold-Complimentary</option>
        
            <option value="Private-Sector-Federation-Platinum-Complimentary" <?php if($participant_data->category == 'Private-Sector-Federation-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Private-Sector-Federation-Platinum-Complimentary</option>
        
            <?php } ?>
        
            <option value="Development-Partners-Silver-Complimentary" <?php if($participant_data->category == 'Development-Partners-Silver-Complimentary'){ echo 'selected="selected"';}?>>Development-Partners-Silver-Complimentary</option>

            <?php  
                if($session_user_data->groups == 'Admin'){?>
        
            <option value="Development-Partners-Gold-Complimentary" <?php if($participant_data->category == 'Development-Partners-Gold-Complimentary'){ echo 'selected="selected"';}?>>Development-Partners-Gold-Complimentary</option>
        
            <option value="Development-Partners-Platinum-Complimentary" <?php if($participant_data->category == 'Development-Partners-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Development-Partners-Platinum-Complimentary</option>
        
            <?php } ?>
        
            <option value="Moderator-Silver-Complimentary" <?php if($participant_data->category == 'Moderator-Silver-Complimentary'){ echo 'selected="selected"';}?>>Moderator-Silver-Complimentary</option>

            <?php  
                if($session_user_data->groups == 'Admin'){?>
        
            <option value="Moderator-Gold-Complimentary" <?php if($participant_data->category == 'Moderator-Gold-Complimentary'){ echo 'selected="selected"';}?>>Moderator-Gold-Complimentary</option>
        
            <option value="Moderator-Platinum-Complimentary" <?php if($participant_data->category == 'Moderator-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Moderator-Platinum-Complimentary</option>
        
            <?php } ?>
        
            <option value="Panelist-Silver-Complimentary" <?php if($participant_data->category == 'Panelist-Silver-Complimentary'){ echo 'selected="selected"';}?>>Panelist-Silver-Complimentary</option>

            <?php  
                if($session_user_data->groups == 'Admin'){?>
        
            <option value="Panelist-Gold-Complimentary" <?php if($participant_data->category == 'Panelist-Gold-Complimentary'){ echo 'selected="selected"';}?>>Panelist-Gold-Complimentary</option>
        
            <option value="Panelist-Platinum-Complimentary" <?php if($participant_data->category == 'Panelist-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Panelist-Platinum-Complimentary</option>
        
            <?php } ?>
        
            <option value="Speaker-Silver-Complimentary" <?php if($participant_data->category == 'Speaker-Silver-Complimentary'){ echo 'selected="selected"';}?>>Speaker-Silver-Complimentary</option>

            <?php  
                if($session_user_data->groups == 'Admin'){?>
        
            <option value="Speaker-Gold-Complimentary" <?php if($participant_data->category == 'Speaker-Gold-Complimentary'){ echo 'selected="selected"';}?>>Speaker-Gold-Complimentary</option>
        
            <option value="Speaker-Platinum-Complimentary" <?php if($participant_data->category == 'Speaker-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Speaker-Platinum-Complimentary</option>
        
            <?php } ?>
        
            <option value="Group-Silver" <?php if($participant_data->category == 'Group-Silver'){ echo 'selected="selected"';}?>>Group-Silver</option>
        
            <option value="Group-Gold" <?php if($participant_data->category == 'Group-Gold'){ echo 'selected="selected"';}?>>Group-Gold</option>
        
            <option value="Group-Platinum" <?php if($participant_data->category == 'Group-Platinum'){ echo 'selected="selected"';}?>>Group-Platinum</option>
        
            <option value="Group-Silver-Discounted" <?php if($participant_data->category == 'Group-Silver-Discounted'){ echo 'selected="selected"';}?>>Group-Silver-Discounted</option>
        
            <option value="Group-Gold-Discounted" <?php if($participant_data->category == 'Group-Gold-Discounted'){ echo 'selected="selected"';}?>>Group-Gold-Discounted</option>
        
            <option value="Group-Platinum-Discounted" <?php if($participant_data->category == 'Group-Platinum-Discounted'){ echo 'selected="selected"';}?>>Group-Platinum-Discounted</option>
        
            <option value="Group-Silver-Complimentary" <?php if($participant_data->category == 'Group-Silver-Complimentary'){ echo 'selected="selected"';}?>>Group-Silver-Complimentary</option>
        
            <option value="Group-Gold-Complimentary" <?php if($participant_data->category == 'Group-Gold-Complimentary'){ echo 'selected="selected"';}?>>Group-Gold-Complimentary</option>
        
            <option value="Group-Platinum-Complimentary" <?php if($participant_data->category == 'Group-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Group-Platinum-Complimentary</option>
        
            <option value="Exhibitor-Silver-Discounted" <?php if($participant_data->category == 'Exhibitor-Silver-Discounted'){ echo 'selected="selected"';}?>>Exhibitor-Silver-Discounted</option>
        
            <option value="Exhibitor-Gold-Discounted" <?php if($participant_data->category == 'Exhibitor-Gold-Discounted'){ echo 'selected="selected"';}?>>Exhibitor-Gold-Discounted</option>
        
            <option value="Exhibitor-Platinum-Discounted" <?php if($participant_data->category == 'Exhibitor-Platinum-Discounted'){ echo 'selected="selected"';}?>>Exhibitor-Platinum-Discounted</option>
        
            <option value="Exhibitor-Silver-Complimentary" <?php if($participant_data->category == 'Exhibitor-Silver-Complimentary'){ echo 'selected="selected"';}?>>Exhibitor-Silver-Complimentary</option>
        
            <option value="Exhibitor-Gold-Complimentary" <?php if($participant_data->category == 'Exhibitor-Gold-Complimentary'){ echo 'selected="selected"';}?>>Exhibitor-Gold-Complimentary</option>
        
            <option value="Sponsor-Silver-Discounted" <?php if($participant_data->category == 'Sponsor-Silver-Discounted'){ echo 'selected="selected"';}?>>Sponsor-Silver-Discounted</option>
        
            <option value="Sponsor-Gold-Discounted" <?php if($participant_data->category == 'Sponsor-Gold-Discounted'){ echo 'selected="selected"';}?>>Sponsor-Gold-Discounted</option>
        
            <option value="Sponsor-Platinum-Discounted" <?php if($participant_data->category == 'Sponsor-Platinum-Discounted'){ echo 'selected="selected"';}?>>Sponsor-Platinum-Discounted</option>
        
            <option value="Sponsor-Silver-Complimentary" <?php if($participant_data->category == 'Sponsor-Silver-Complimentary'){ echo 'selected="selected"';}?>>Sponsor-Silver-Complimentary</option>
        
            <option value="Sponsor-Gold-Complimentary" <?php if($participant_data->category == 'Sponsor-Gold-Complimentary'){ echo 'selected="selected"';}?>>Sponsor-Gold-Complimentary</option>
        
            <option value="Sponsor-Platinum-Complimentary" <?php if($participant_data->category == 'Sponsor-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Sponsor-Platinum-Complimentary</option>
        
            <option value="Smart-Africa-Member-Silver-Discounted" <?php if($participant_data->category == 'Smart-Africa-Member-Silver-Discounted'){ echo 'selected="selected"';}?>>Smart-Africa-Member-Silver-Discounted</option>
        
            <option value="Smart-Africa-Member-Gold-Discounted" <?php if($participant_data->category == 'Smart-Africa-Member-Gold-Discounted'){ echo 'selected="selected"';}?>>Smart-Africa-Member-Gold-Discounted</option>
        
            <option value="Smart-Africa-Member-Platinum-Discounted" <?php if($participant_data->category == 'Smart-Africa-Member-Platinum-Discounted'){ echo 'selected="selected"';}?>>Smart-Africa-Member-Platinum-Discounted</option>
        
            <option value="Face-the-Gorillas-Silver-Discounted" <?php if($participant_data->category == 'Face-the-Gorillas-Silver-Discounted'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Silver-Discounted</option>
        
            <option value="Face-the-Gorillas-Gold-Discounted" <?php if($participant_data->category == 'Face-the-Gorillas-Gold-Discounted'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Gold-Discounted</option>
        
            <option value="Face-the-Gorillas-Platinum-Discounted" <?php if($participant_data->category == 'Face-the-Gorillas-Platinum-Discounted'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Platinum-Discounted</option>
        
            <option value="Face-the-Gorillas-Silver-Complimentary" <?php if($participant_data->category == 'Face-the-Gorillas-Silver-Complimentary'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Silver-Complimentary</option>
        
            <option value="Face-the-Gorillas-Gold-Complimentary" <?php if($participant_data->category == 'Face-the-Gorillas-Gold-Complimentary'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Gold-Complimentary</option>
        
            <option value="Face-the-Gorillas-Platinum-Complimentary" <?php if($participant_data->category == 'Face-the-Gorillas-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Platinum-Complimentary</option>
        
            <option value="Ms-Geek-2017-Silver-Discounted" <?php if($participant_data->category == 'Ms-Geek-2017-Silver-Discounted'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Silver-Discounted</option>
        
            <option value="Ms-Geek-2017-Gold-Discounted" <?php if($participant_data->category == 'Ms-Geek-2017-Gold-Discounted'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Gold-Discounted</option>
        
            <option value="Ms-Geek-2017-Platinum-Discounted" <?php if($participant_data->category == 'Ms-Geek-2017-Platinum-Discounted'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Platinum-Discounted</option>
        
            <option value="Ms-Geek-2017-Silver-Complimentary" <?php if($participant_data->category == 'Ms-Geek-2017-Silver-Complimentary'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Silver-Complimentary</option>
        
            <option value="Ms-Geek-2017-Gold-Complimentary" <?php if($participant_data->category == 'Ms-Geek-2017-Gold-Complimentary'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Gold-Complimentary</option>
        
            <option value="Ms-Geek-2017-Platinum-Complimentary" <?php if($participant_data->category == 'Ms-Geek-2017-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Ms-Geek-2017-Platinum-Complimentary</option>
        
            <option value="Government-Silver-Complimentary" <?php if($participant_data->category == 'Government-Silver-Complimentary'){ echo 'selected="selected"';}?>>Government-Silver-Complimentary</option>
            

            <?php  
                if($session_user_data->groups == 'Admin'){?>

            <option value="Government-Gold-Complimentary" <?php if($participant_data->category == 'Government-Gold-Complimentary'){ echo 'selected="selected"';}?>>Government-Gold-Complimentary</option>
        
            <option value="Government-Platinum-Complimentary" <?php if($participant_data->category == 'Government-Platinum-Complimentary'){ echo 'selected="selected"';}?>>Government-Platinum-Complimentary</option>
            
            <?php }?>

            <option value="Media" <?php if($participant_data->category == 'Media'){ echo 'selected="selected"';}?>>Media</option>
        
            <option value="NOC" <?php if($participant_data->category == 'NOC'){ echo 'selected="selected"';}?>>NOC</option>
        
            <option value="Organiser" <?php if($participant_data->category == 'Organiser'){ echo 'selected="selected"';}?>>Organiser</option>
        
            <option value="Delegate-Liaison" <?php if($participant_data->category == 'Delegate-Liaison'){ echo 'selected="selected"';}?>>Delegate-Liaison</option>
        
            <option value="Armed-Security" <?php if($participant_data->category == 'Armed-Security'){ echo 'selected="selected"';}?>>Armed-Security</option>
        
            <option value="Security" <?php if($participant_data->category == 'Security'){ echo 'selected="selected"';}?>>Security</option>
        
            <option value="Protocal" <?php if($participant_data->category == 'Protocal'){ echo 'selected="selected"';}?>>Protocal</option>
        
            <option value="Medical" <?php if($participant_data->category == 'Medical'){ echo 'selected="selected"';}?>>Medical</option>
        
            <option value="Catering" <?php if($participant_data->category == 'Catering'){ echo 'selected="selected"';}?>>Catering</option>
        
            <option value="Production-Technician" <?php if($participant_data->category == 'Production-Technician'){ echo 'selected="selected"';}?>>Production-Technician</option>
        
            <option value="Contractor" <?php if($participant_data->category == 'Contractor'){ echo 'selected="selected"';}?>>Contractor</option>
        
            <option value="Face-the-Gorillas-Applicant" <?php if($participant_data->category == 'Face-the-Gorillas-Applicant'){ echo 'selected="selected"';}?>>Face-the-Gorillas-Applicant</option>
            
            <option value="Ms-geek-Applicant" <?php if($participant_data->category == 'Ms-geek-Applicant'){ echo 'selected="selected"';}?>>Ms-geek-Applicant</option>

            <option value="Speaker-Applicant" <?php if($participant_data->category == 'Speaker-Applicant'){ echo 'selected="selected"';}?>>Speaker-Applicant</option>

    </select>
  </div>
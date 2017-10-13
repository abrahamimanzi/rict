<?php 
require_once 'core/init.php';
$db = DB::getInstance();

    $dataArr = array();
    $event_ID = Input::get('id','get');
    $agentClass = new Participant();
    // $agentClass->select(" WHERE `event_ID`='{$event_ID}' AND `payment_state`='Confirmed' OR `payment_state`='Free' AND `payment_state`!='Pending' AND `pass_type`!='No pass' AND `state`!='Confirmed'");
    $agentClass->select(" WHERE `state`='Confirmed' AND `pass_type`!='No pass'");
    
    if($agentClass->count()){
            $i = 0;
            foreach($agentClass->data() as $agent_data){
                $i++;
                $photo = @end(explode('/',@$agent_data->photo));
//                $photo = $agent_data->photo;
                $dataArr[] = array(
                    "Pass TYPE"=>$agent_data->pass_type,
                    "FIRST NAME"=>$agent_data->firstname,
                    "LAST NAME"=>$agent_data->lastname,
                    "COUNTRY"=>$agent_data->residence_country,
                    "JOB TITLE"=>$agent_data->jobtitle,
                    "ID"=>$agent_data->ID,
                    "COMPANY NAME"=>$agent_data->company_name,
                    "STATUS"=>$agent_data->status,
                    "ID NUMBER / PASSPORT NUMBER"=>$agent_data->document_number,
                    "REG ID"=>$agent_data->code,
                    "CATEGORY"=>$agent_data->category,
                    "EMAIL ADDRESS"=>$agent_data->email,
                    "PHOTO"=>$photo);
            }



          $data = $dataArr;
          function cleanData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
          }
    //
    //                                  // file name for download
          $filename = "PAS_" . date('Ymd') . ".xls";
    //
          header("Content-Disposition: attachment; filename=\"$filename\"");
          header("Content-Type: application/vnd.ms-excel");
    //
          $flag = false;
          foreach($data as $row) {
            if(!$flag) {
              // display field/column names as first row
              echo implode("\t", array_keys($row)) . "\n";
              $flag = true;
            }
            array_walk($row, __NAMESPACE__ . '\cleanData');
            echo implode("\t", array_values($row)) . "\n";
          }
    }
?>
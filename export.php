<?php 
require_once 'core/init.php';
$db = DB::getInstance();

    $dataArr = array();
    $event_ID = Input::get('id','get');
    $agentClass = new Participant();
    $agentClass->select(" WHERE `pass_type`!='No pass' AND `event_ID`='{$event_ID}'");
    if($agentClass->count()){
            $i = 0;
            foreach($agentClass->data() as $agent_data){
                $i++;
                $photo = @end(explode('/',@$agent_data->photo));
//                $photo = $agent_data->photo;
                $dataArr[] = array(
                    // "Pass TYPE"=>$agent_data->pass_type,
                    "TITLE"=>$agent_data->title,
                    "FIRST NAME"=>$agent_data->firstname,
                    "LAST NAME"=>$agent_data->lastname,
                    "TELPHONE"=>$agent_data->telephone,
                    "EMAIL ADDRESS"=>$agent_data->email,
                    "GENDER"=>$agent_data->gender,
                    // "RESIDENCE COUNTRY"=>$agent_data->residence_country,
                    "COUNTRY"=>$agent_data->company_country,
                    "JOB TITLE"=>$agent_data->jobtitle,
                    "ID"=>$agent_data->ID,
                    "COMPANY NAME"=>$agent_data->company_name,
                    "STATE"=>$agent_data->state,
                    "STATUS PAYMENT"=>$agent_data->status,
                    "ID NUMBER / PASSPORT NUMBER"=>$agent_data->document_number,
                    "REG ID"=>$agent_data->code,
                    "CATEGORY"=>$agent_data->category,
                    "In which range of products are you interested in"=>$agent_data->company_industry,
                    "Which sector do you belong to"=>$agent_data->company_category,
                    "COMPANY ADDRESS"=>$agent_data->company_address,
                    "COMPANY CITY"=>$agent_data->company_city,
                    "How did you hear about us"=>$agent_data->referenceby,
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
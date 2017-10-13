<?php

$dirF = $GLOBALS['DOTS']."public_html/media/files/".$_FILES['file']['name'];
copy($_FILES['file']['tmp_name'], $dirF);
					
$array = array(
	'filelink' => $dirF.$_FILES['file']['name'],
	'filename' => $_FILES['file']['name']
);

echo stripslashes(json_encode($array));
	
?>
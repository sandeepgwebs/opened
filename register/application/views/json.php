<?php
	$print = false;

	if($print){
		var_dump($json);
	}else{
		header('Content-Type: application/json');
    	echo json_encode($json);
    }
?>
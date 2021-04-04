<?php
	ini_set("max_execution_time", 3600);//seconds , works only for command line
	set_time_limit(3600);//0= unlimited	, works only for command line
	
	for($i=0;$i<1000;$i++){
		echo $i."\n";
		sleep(5);
	}
	
	
?>

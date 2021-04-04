<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

require 'system.class.php';


$task = new Tasks();
$init = $task->init();
if(!$init)
    die(json_encode($init));

    
if(isset($_POST['type'])) {
    switch($_POST['type']) {
        case 'runCmd':
            echo json_encode($task->run($_POST['cmd']));
                
            break;
        
        case 'getRunning':
            echo json_encode($task->getRunningTask());

            break;
        
        case 'showTask':
            echo json_encode($task->getTaskData($_POST['pid']));

            break;
        
        case 'killTask':
            echo json_encode($task->killRunningTask($_POST['pid']));

            break;
    }
}

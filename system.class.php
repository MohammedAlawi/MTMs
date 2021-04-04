<?php

class Tasks {

    private $_tmpPath = __DIR__.'/tmp/';
    private $_dataFile = __DIR__.'/tmp/data.json';

    function __construct() {

    }

    public function init() {
        $return = ['status' => true];

        // Create a path of tmp if not exist
        if(!is_dir($this->_tmpPath)) {
            if(!mkdir($this->_tmpPath, 0755))
                $return = ['status' => false, 'msg' => 'Error when create: '.$this->_tmpPath];
        }

        // Create data file if not exist
        if(!is_file($this->_dataFile) and $return['status'] !== false ) {
            $myfile = fopen($this->_dataFile, "w"); 
            if($myfile !== false) {
                fwrite($myfile, json_encode([]));
                fclose($myfile);
            } else {
                $return = ['status' => false, 'msg' => 'Error when create: '.$this->_dataFile];
            }   
        }
        return $return;
    }

    // Get data from ($_dataFile) file
    private function getDataFileOfTask() {
        $file = json_decode(file_get_contents($this->_dataFile), true);

        return is_array($file) ? $file : [];
    }

    // Set new data to ($_dataFile) file
    private function setDataFileOfTask($data = null, $append = true) {
        $return = ['status' => true];

        if($data == null)
            $return = ['status' => false, 'msg' => 'The data to save in (data.json) cannot be empty!'];
        
        if($return['status'] !== false) {
            if($append){
                $newData = $this->getDataFileOfTask();
                $newData[] = $data;
            } else {
                $newData = $data;
            }
            file_put_contents($this->_dataFile, json_encode($newData));
        }
        
        return $return;
    }

    // Kill all running processes
    public function killRunningAllTask() {
        $dataFile = $this->checkTasks();

        foreach($dataFile as $task) {
            $checkIsRunning = explode("\n", shell_exec('ps '.$task['pid'].' 2>&1'));
            if(count($checkIsRunning) > 2) {
                $kill = shell_exec('kill '.$task['pid'].' 2>&1');
                if (!preg_match('/No such process/', $kill)) {
                    // return true;
                }
            }
        }

        $this->checkTasks();
    }
    
    // Kill process by PID
    public function killRunningTask($pid = null) {
        $return = ['status' => true];

        if($pid == null)
            $return = ['status' => false, 'msg' => 'Must Enter PID to get Data!'];
        
        if($return['status'] !== false) {
            $dataFile = $this->getDataFileOfTask();
            $matches = array_search($pid, array_column($dataFile, 'pid'));
            
            if($matches !== false and $dataFile[$matches]['sts'] == 'run') {
                $data = $dataFile[$matches];
                
                $checkIsRunning = explode("\n", shell_exec('ps '.$data['pid'].' 2>&1'));
                if(count($checkIsRunning) > 2) {
                    $kill = shell_exec('kill '.$data['pid'].' 2>&1');
                    if (!preg_match('/No such process/', $kill)) {
                        $return['data'] = ['pid' => $data['pid']];
                    }
                }
            } else {
                $return['data'] = ['pid' => $dataFile[$matches]['pid'], 'end' => $dataFile[$matches]['end']];
            }
        }
        
        return $return;
    }

    

    // Check process if running, update status (sts = 'run') otherwise set status (sts = 'fin') and (end = [dateTime])
    private function checkTasks() {
        $dataFile = $this->getDataFileOfTask();

        $running = [];
        $newData = [];

        foreach($dataFile as $task) {
            $task['lst'] = date('Y-m-d H:i:s');
            if($task['pid'] != null){
                $checkIsRunning = explode("\n", shell_exec('ps '.$task['pid'].' 2>&1'));
                if(count($checkIsRunning) > 2) {
                    $running[] = $task;
                    $task['sts'] = 'run';
                } else {
                    if($task['sts'] != 'fin')
                        $task['end'] = date('Y-m-d H:i:s');
                    $task['sts'] = 'fin';
                }
            } else {
                $task['sts'] = 'fin';
            }

            $newData[] = $task;
        }
        $this->setDataFileOfTask($newData, false);
        return $newData;
    }

    // Get running process by PID or all running
    public function getRunningTask($pid = null) {
        $dataFile = $this->checkTasks();

        if($pid != null)
            $dataFile = $dataFile[array_search($pid, array_column($dataFile, 'pid'))];
        
        return $dataFile;
    }

    // Get task content by PID
    public function getTaskData($pid = null) {
        $return = ['status' => true];

        if($pid == null)
            $return = ['status' => false, 'msg' => 'Must Enter PID to get Data!'];
        
        if($return['status'] !== false) {
            $dataFile = $this->getDataFileOfTask();
            $matches = array_search($pid, array_column($dataFile, 'pid'));

            $data = [];
            if($matches !== false) {
                $data = $dataFile[$matches];
                $return['data'] = ['pid' => $data['pid'], 'cmd' => $data['cmd'], 'sts' => $data['sts'], 'out' => file_get_contents($data['out'])];
            }
        }
        
        return $return;
    }

    // Run task-process 
    public function run($cmd = null) {
        if($cmd == null)
            die('The command cannot be empty!');

        $cmd = trim($cmd);
        $cmd = preg_replace('/\s+/', ' ', $cmd);
        $dataFile = $this->getDataFileOfTask();
        
        $return = ['status' => false, 'msg' => ''];
        
        $foundPreviuce = [];
        for($i=0; $i<count($dataFile);$i++){
            if($dataFile[$i]['cmd'] == $cmd and $dataFile[$i]['sts'] == 'run')
                $foundPreviuce[] = $dataFile[$i];
        }
        if(count($foundPreviuce) == 0) {
            $outputFile = $this->_tmpPath.substr(md5(rand(1111, 999999) * rand(111, 888)), 0, 12).'.htask';
            $pid = (int)shell_exec($cmd.' >> '.$outputFile.' 2>&1 & echo $!');

            $data = [
                'pid'   => $pid,
                'cmd'   => $cmd,
                'out'   => $outputFile,
                'str'   => date('Y-m-d H:i:s'),
                'lst'   => date('Y-m-d H:i:s'),
                'end'   => '',
                'sts'   => 'run'
            ];

            $dataFile = $this->setDataFileOfTask($data);

            if($pid > 0)
                $return = ['status' => true, 'msg' => ''];

        } else {
            $return = ['status' => false, 'msg' => 'The Command ('.$cmd.') already exists and running now with PID: ('.implode('), (', array_column($foundPreviuce, 'pid')).') Files: ('.implode('), (', array_column($foundPreviuce, 'out')).')'];
        }

        return $return;
    }

}
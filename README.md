
<h1 align="center">MTMs</h1>

<p align="center">
<img src="https://img.shields.io/github/forks/MohammedAlawi/MTMs?logo=githu">
<img src="https://img.shields.io/github/issues/MohammedAlawi/MTMs?logo=github">
<img src="https://img.shields.io/github/stars/MohammedAlawi/MTMs?logo=github">
<img src="https://img.shields.io/github/last-commit/MohammedAlawi/MTMs?logo=Github">
</p>

---


## Multi-Task Management system (MTMs)
MTMs is a PHP script for creating and manage processes on the operating system.


## Table of contents
- [General info](#general-info)
- [Technologies](#technologies)
- [Features](#features )
- [Installation](#installation)
- [Upcoming features](upcoming-features)
- [Usage](usage)
- [Running MTMs with browser](running-MTMs-with-browser)
- [License](#license)


## General info
MTMs is a PHP script for easier to create, show the result of that, and finish the process in the operating system (Linux), and the most important feature, you can create more than one task at the same time.
 
## Technologies
- ![](https://img.shields.io/badge/Apache-2.4.46-critical)
- ![](https://img.shields.io/badge/php-7.4.3-blue)
- ![](https://img.shields.io/badge/jQuery-3.6-9cf)
- ![](https://img.shields.io/badge/Bootstrap-5.0-blueviolet)

## Features
- Multiple Task in the same time
- Show all task
- Create new Task
- Show Task output
- Finish Task
- Check for similarity before start


## Upcoming features
- [ ] Windows OS compatibility
- [ ] Save to DB
-  Want more? [Submit a feature request](https://github.com/MohammedAlawi/MTMs/issues/new)!

## Installation
* git clone `https://github.com/MohammedAlawi/MTMs.git`
* Go to broswer open it.  (easy to use 😉)

## Usage
```php
require 'system.class.php';

$task = new Tasks();
$init = $task->init();
```

##### This methods can use it:

| Method             | Description                     | Example              |
|--------------------|---------------------------------|----------------------|
| run                | Start run command               | run('php long.php')  |
| getRunningTask     | Get All Task                    | getRunningTask()     |
| getTaskData        | Get task data by PID user given | getTaskData()        |
| getTaskData        | Get task data by PID user given | getTaskData()        |
| killRunningTask    | Finish task by PID user given   | killRunningTask(654) |
| killRunningAllTask | Finish All running task         | killRunningAllTask() |


## Running MTMs with browser
![](https://raw.githubusercontent.com/MohammedAlawi/MTMs/main/static/1-%20dashboard.JPG)

![](https://raw.githubusercontent.com/MohammedAlawi/MTMs/main/static/2-%20add-task.JPG)

![](https://raw.githubusercontent.com/MohammedAlawi/MTMs/main/static/3-%20dashboard.JPG)

![](https://raw.githubusercontent.com/MohammedAlawi/MTMs/main/static/4-%20show-output-task.JPG)

![](https://raw.githubusercontent.com/MohammedAlawi/MTMs/main/static/5-%20stop-task.JPG)

![](https://raw.githubusercontent.com/MohammedAlawi/MTMs/main/static/6-%20dashboard.JPG)


## License
[MIT](https://choosealicense.com/licenses/mit/)
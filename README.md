
<h1 align="center">MTMs</h1>

<p align="center">
<img src="https://img.shields.io/github/forks/MohammedAlawi/MTMs?logo=githu">
<img src="https://img.shields.io/github/issues/MohammedAlawi/MTMs?logo=github">
<img src="https://img.shields.io/github/stars/MohammedAlawi/MTMs?logo=github">
<img src="https://img.shields.io/github/last-commit/MohammedAlawi/MTMs?logo=Github">
</p>

---


## Multi-Task Management system (MTMs)
MTMs is a PHP interface script, will help you to manage and create tasks and jobs on your Linux operation system and track them.


## Table of contents
- [Summary](#summary)
- [Technologies](#technologies)
- [Features](#features )
- [Todo](#todo)
- [Installation](#installation)
- [Usage](#usage)
- [Running MTMs with browser](#running-mtms-with-browser)
- [License](#license)


## Summary
MTMs is a PHP script and library, to make it easier for you to create jobs and to track them on your Linux operation system, MTMs will provide you with full detailed results and logs, not only detailed but also easy to understand for the normal user.

## Technologies
- ![](https://img.shields.io/badge/Apache-2.4.46-critical)
- ![](https://img.shields.io/badge/php-7.4.3-blue)
- ![](https://img.shields.io/badge/jQuery-3.6-9cf)
- ![](https://img.shields.io/badge/Bootstrap-5.0-blueviolet)

## Features
- Multiple Task in the same time
- Show all tasks
- Create new Tasks
- Show Tasks outputs
- Finish Tasks
- Checking for duplication

## Todo
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
| getRunningTask     | Get All Tasks                   | getRunningTask()     |
| getTaskData        | Get task data by PID user given | getTaskData()        |
| killRunningTask    | Finish task by PID user given   | killRunningTask(654) |
| killRunningAllTask | Finish All running task         | killRunningAllTask() |


## Running MTMs with browser
![](https://raw.githubusercontent.com/MohammedAlawi/MTMs/main/static/try.gif)


## License
[MIT](https://choosealicense.com/licenses/mit/)
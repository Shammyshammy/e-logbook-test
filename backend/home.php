<h3>Welcome to E-logbook</h3>
<hr>
<?php 
if($_SESSION['type'] =="Manager"){
    $where = " department_id = '{$_SESSION['department_id']}' ";
}else{
    $where = " task_id in (SELECT task_id FROM `task_assignees` where employee_id = '{$_SESSION['employee_id']}') ";
}
?>
<div class="col-12">
    <div class="row gx-3 row-cols-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 d-flex align-items-center">
                        <div class="col-auto pe-1">
                            <span class="fa fa-tasks fs-3 text-info"></span>
                        </div>
                        <div class="col-auto flex-grow-1">
                            <div class="fs-5"><b>Total Tasks</b></div>
                            <div class="fs-6 text-end fw-bold">
                                <?php 
                                $task = $conn->query("SELECT count(task_id) as `count` FROM `task_list` where {$where} ")->fetchArray()['count'];
                                echo $task > 0 ? number_format($task) : 0 ;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 d-flex align-items-center">
                        <div class="col-auto pe-1">
                            <span class="fa fa-tasks fs-3 text-dark"></span>
                        </div>
                        <div class="col-auto flex-grow-1">
                            <div class="fs-5"><b>Pending Tasks</b></div>
                            <div class="fs-6 text-end fw-bold">
                                <?php 
                                $task = $conn->query("SELECT count(task_id) as `count` FROM `task_list` where {$where}  and `status` = 0")->fetchArray()['count'];
                                echo $task > 0 ? number_format($task) : 0 ;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 d-flex align-items-center">
                        <div class="col-auto pe-1">
                            <span class="fa fa-tasks fs-3 text-primary"></span>
                        </div>
                        <div class="col-auto flex-grow-1">
                            <div class="fs-5"><b>On-Progress Tasks</b></div>
                            <div class="fs-6 text-end fw-bold">
                                <?php 
                                $task = $conn->query("SELECT count(task_id) as `count` FROM `task_list` where {$where}  and `status` = 1")->fetchArray()['count'];
                                echo $task > 0 ? number_format($task) : 0 ;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 d-flex align-items-center">
                        <div class="col-auto pe-1">
                            <span class="fa fa-tasks fs-3 text-danger"></span>
                        </div>
                        <div class="col-auto flex-grow-1">
                            <div class="fs-5"><b>Closed Tasks</b></div>
                            <div class="fs-6 text-end fw-bold">
                                <?php 
                                $task = $conn->query("SELECT count(task_id) as `count` FROM `task_list` where {$where}  and `status` = 2")->fetchArray()['count'];
                                echo $task > 0 ? number_format($task) : 0 ;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
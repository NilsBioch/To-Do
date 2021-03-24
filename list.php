<?php 
    include 'datalayer.php'; 
    $currentListId = $_GET['id'];
    $conn = connection();
    $list = fetchCurrentList($conn, $currentListId);
    $taskItem = fetchCurrentTasks($conn, $currentListId);
    $statuses = fetchAllStatus($conn);
    
    if(isset($_POST['sortTime'])){
        $taskItem = sortTasksTime($conn, $currentListId, $_POST['sortTimeSetting']);
    }else if(isset($_POST['sortStatus'])){
        $taskItem = sortStatus($conn, $_POST['status']);
    }
    include 'assets/header.php';
?>
<div class='d-lg-flex flex-lg-row flex-sm-column justify-content-between'>
        <h1 class='text-white mx-auto'>Bekijk hier List <?php echo $list['name'] ?></h1>
        <a class='align-self-center' href='index.php'><i class='fas fa-arrow-circle-left fa-3x justify-content-between'></i></a>
</div>
<div id='list' class='card mt-2 w-50 mb-3 mx-auto text-white'>
    <h5 class='card-header'><?php echo $list['name'] ?></h5>
        <form method="post">
            <div class="d-flex">
                <input type="submit" class="btn btn-primary text-white mr-auto p-2" name="sortTime" value='sortTime'/>
                <input type="submit" class="btn btn-primary text-white p-2" name="sortStatus" value="Filter Status">
            </div>
            <div class="d-flex justify-content-center">
                <select class='form-control' id="sortTimeSetting" name="sortTimeSetting">
                    <option value="ASC">Sort tijd van Laag naar Hoog </option>
                    <option value="DESC">Sort tijd van Hoog naar Laag</option>
                </select>
                <select class='form-control' id="status" name="status">
                    <?php
                        foreach($statuses as $status){
                            echo"<option value='".$status["id"]."'>".$status['name']."</option>";
                        }
                    ?>
                </select>
            </div>
        </form>
        <div class='card-body'>
            <ul class='list-group list-group-flush'>
            <?php
            foreach ($taskItem as $task) {
                if ($task['list_id'] == $list['id']) {
                    $status = fetchCurrentStatus($conn, $task);
                    ?>
                    <li id='list-item-list' class='text-white list-group-item'>
                        <h5 class='card-title'><?php echo $task['name'] ?></h5>
                        <h6 class='card-subtitle mb-2 text-muted'><?php echo $status['name'] ?></h6>
                        <a href='deleteTask.php?id=<?php echo $task['id'] ?>' class='fas fa-trash text-light'></a>
                        <a href='editTask.php?id=<?php echo $task['id'] ?>' class='fas fa-edit text-light'></a>
                        <p class='card-text'><?php echo $task['description'] ?></p>
                        <p class='card-text'><small class='text-muted'>Duur: <?php echo $task['duration'] ?> minuten</small></p>
                    </li>
                    <?php
                }
            }
            ?>
            </ul>
                <div class='card-body text-center'>
                    <a href='editList.php?id=<?php echo $data['id'] ?>' class='card-link text-light'>Edit List</a>
                    <a href='deleteList.php?id=<?php echo $data['id'] ?>' class='card-link text-light'>Delete List</a>
                    <a href='createTask.php?id=<?php echo $data['id'] ?>' class='card-link text-light'>Add Task</a>
                </div>
            </div>
        </div>

</div>

<?php 
    include 'assets/header.php';
    include 'datalayer.php'; 
    $conn = connection();
    $list = fetchAllLists($conn);
    $tasks = fetchAllTasks($conn);
    $status = fetchAllStatus($conn);
?>
<div class='mb-5 mt-2'>
    <div class='d-lg-flex flex-lg-row flex-sm-column justify-content-between'>
        <h1 class='text-white'>Bekijk hier alle Lists</h1>
        <a class='align-self-center' href='createList.php'><i class='fas fa-plus-circle fa-3x justify-content-between'></i></a>
    </div>
    <?php
    for ($i=0; $i < count($list); $i++) { 
        $data = $list[$i];
        echo" 
        <div id='list' class='card mt-2 text-white d-inline-flex'>
            <h5 class='card-header'>".$data['name']."</h5> <i class=' card-header far fa-clock'></i><i class='card-header fas fa-info-circle'></i> 
            <div class='card-body'>
                <ul class='list-group list-group-flush'>";
                $taskItem = fetchCurrentTasks($conn, $data['id']);
                foreach ($taskItem as $task) {
                    if ($task['list_id'] == $data['id']) {
                        $status = fetchCurrentStatus($conn, $task);
                        echo"
                        <li id='list-item' class='text-white list-group-item'>
                            <h5 class='card-title'>".$task['name']." </h5>
                            <h6 class='card-subtitle mb-2 text-muted'>".  $status['name'] ."</h6>
                            <a href='deleteTask.php?id=" .$task['id']. "' class='fas fa-trash'></a>
                            <a href='editTask.php?id=" .$task['id']. "' class='fas fa-edit'></a>
                            <p class='card-text'>".$task['description']."</p>
                            <p class='card-text'><small class='text-muted'>Duur: ". $task['duration']." minuten</small></p>
                        </li>";
                        }
                    }
                echo"
                </ul>
                <div class='card-body'>
                    <a href='editList.php?id=" .$data['id']. "' class='card-link'>Edit List</a>
                    <a href='deleteList.php?id=" .$data['id']. "' class='card-link'>Delete List</a>
                    <a href='createTask.php?id=" .$data['id']. "' class='card-link'>Add Task</a>
                </div>
            </div>
        </div>";
        }
    ?>
</div>

<?php include 'assets/footer.php' ?>


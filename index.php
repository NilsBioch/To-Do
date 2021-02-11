<?php 
include 'datalayer.php'; 
$conn = connectie();
$result = fetchAllLists($conn);
$tasks = fetchListTasks($conn);
$status = fetchAllStatus($conn);
include 'assets/header.php';
?>

<div class='mb-5 mt-2'>
    <div class='d-lg-flex flex-lg-row flex-sm-column justify-content-between'>
        <h1 class='text-white'>Bekijk hier alle Lists</h1>
        <a class='btn-lg btn-primary text-white align-self-center' href='createList.php'>Nieuwe List</a>
    </div>
    <?php

    for ($i=0; $i < count($result); $i++) { 
        $data = $result[$i];
        echo" <div id='list' class='card mt-2 text-white d-inline-flex'>";
        echo"    <h5 class='card-header'>".$data['name']."</h5> <i class=' card-header far fa-clock'></i> ";
        echo"  <div class='card-body'>";
        echo"  <ul class='list-group list-group-flush'>";
        $taskItem = fetchCurrentTask($conn, $data['id']);
        foreach ($taskItem as $task) {
            if ($task['list_id'] == $data['id']) {
                $status = fetchCurrentStatus($conn, $task);
                echo"<li id='list-item' class='text-white list-group-item'>";
                echo"<h5 class='card-title'>".$task['name']." </h5>";
                echo "<h6 class='card-subtitle mb-2 text-muted'>".  $status['name'] ."</h6>";
                echo"<a href='deleteTask.php?id=" .$task['id']. "' class='fas fa-trash'></a>";
                echo"<a href='editTask.php?id=" .$task['id']. "' class='fas fa-edit'></a>";
                echo"<p class='card-text'>".$task['description']."</p>";
                echo "<p class='card-text'><small class='text-muted'>Duur: ". $task['duration']." minuten</small></p>";
                echo"</li>";

            }
        }
        echo"  </ul>";
        echo"  <div class='card-body'>";
        echo"    <a href='updateList.php?id=" .$data['id']. "' class='card-link'>Edit List</a>";
        echo"    <a href='deleteList.php?id=" .$data['id']. "' class='card-link'>Delete List</a>";
        echo"    <a href='createTask.php?id=" .$data['id']. "' class='card-link'>Add Task</a>";
        echo"  </div>";
        echo"  </div>";
        echo" </div>";
    }
    ?>
</div>

<?php include 'assets/footer.php' ?>


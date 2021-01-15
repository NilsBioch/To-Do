<?php 
include 'datalayer.php'; 
$conn = connectie();
$result = fetchAllLists($conn);
$tasks = fetchListTasks($conn);
include 'header.php';
?>

<body>
<div class="mb-5 mt-2">
    <div class="d-lg-flex flex-lg-row flex-sm-column justify-content-between">
        <h1>Bekijk hier alle Lists</h1>
        <a class="btn-lg btn-primary text-white align-self-center" href="createlist.php">Nieuwe List</a>
    </div>
    <?php

    for ($i=0; $i < count($result); $i++) { 
        $data = $result[$i];
        echo" <div class='card mt-2 d-inline-flex'>";
        echo"  <div class='card-body'>";
        echo"    <h5 class='card-title'>".$data['name']."</h5>";
        echo"    <p class='card-text'>".$data['description']."</p>";
        echo"  </div>";
        echo"  <ul class='list-group list-group-flush'>";
        foreach ($tasks as $task) {
            if ($task['list_id'] == $data['id']) {
                echo"    <li class='list-group-item'>".$task['name']."</li>";
            }
        }
        echo"  </ul>";
        echo"  <div class='card-body'>";
        echo"    <a href='updateList.php?id=" .$data['id']. "' class='card-link'>Edit List</a>";
        echo"    <a href='deleteList.php?id=" .$data['id']. "' class='card-link'>Delete List</a>";
        echo"    <a href='createTask.php?id=" .$data['id']. "' class='card-link'>Add Task</a>";
        echo"  </div>";
        echo" </div>";
    }
    ?>
</div>

<?php include'header_footer/footer.php' ?>

</body>
</html>
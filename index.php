<?php 
    include 'assets/header.php';
    include 'datalayer.php'; 
    $conn = connection();
    $list = fetchAllLists($conn);

?>
<div class='mb-5 mt-2'>
    <div class='d-lg-flex flex-lg-row flex-sm-column justify-content-between'>
        <h1 class='text-white'>Bekijk hier alle Lists</h1>
        <a class='align-self-center' href='createList.php'><i class='fas fa-plus-circle fa-3x justify-content-between'></i></a>
    </div>
    <?php
    for ($i=0; $i < count($list); $i++) { 
        $data = $list[$i];
        ?>
        <div id='list' class='card mt-2 text-white d-inline-flex '>
            <h5 class='card-header'><?php echo $data['name'] ?><a href='list.php?id=<?php echo $data['id'] ?>' class='fas fa-info-circle text-light'></a></h5>
            <div class='card-body'>
                <ul class='list-group list-group-flush'>
                <?php
                $taskItem = fetchCurrentTasks($conn, $data['id']);
                foreach ($taskItem as $task) {
                    if ($task['list_id'] == $data['id']) {
                        $status = fetchCurrentStatus($conn, $task);
                        ?>
                        <li id='list-item' class='text-white list-group-item'>
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
                <div class='card-body'>
                    <a href='editList.php?id=<?php echo $data['id'] ?>' class='card-link text-light'>Edit List</a>
                    <a href='deleteList.php?id=<?php echo $data['id'] ?>' class='card-link text-light'>Delete List</a>
                    <a href='createTask.php?id=<?php echo $data['id'] ?>' class='card-link text-light'>Add Task</a>
                </div>
            </div>
        </div>
        <?php
        }
    ?>
</div>

<?php include 'assets/footer.php' ?>


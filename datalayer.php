<?php 
function connection(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "To-Do";
    $conn;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $conn;
    }
    catch(PDOException $e)
        {
        echo "Error: " . $e->getMessage();
    }
}

/**
 * Fetches all lists
 *
 * You can find this function in, index.php
 * 
 * @param [type] $conn connects to database, to give acces.
 * @return mixed -Returns all lists
 */
function fetchAllLists($conn){
    $stmt = $conn->prepare("SELECT * FROM list");
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

/**
 * Fetches all statuses
 *
 * You can find this function in index.php, editTask.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @return mixed -Returns all statuses
 */
function fetchAllStatus($conn){
    $stmt = $conn->prepare("SELECT * FROM status");
    $stmt->execute();
    $status = $stmt->fetchAll();
    return $status;
}

/**
 * Fetches all tasks
 *
 * You can find this function in index.php 
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @return mixed -Returns all tasks
 */
function fetchAllTasks($conn){
    $stmt = $conn->prepare("SELECT * FROM task");
    $stmt->execute();
    $status = $stmt->fetchAll();
    return $status;
}

/**
 * Fetches the current tasks
 *
 * You can find this function in index.php 
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 * @return mixed -Returns
 */
function fetchCurrentTasks($conn, $currentListId){
    $stmt = $conn->prepare("SELECT * FROM task WHERE list_id = $currentListId");
    $stmt->execute();
    $status = $stmt->fetchAll();
    return $status;
}

/**
 * Fetches the current list that you want to edit.
 *
 * You can find this function in editList.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 * @return void
 */
function fetchCurrentList($conn, $currentListId){    
    $stmt = $conn->prepare("SELECT * FROM list WHERE id = $currentListId");
    $stmt->execute();
    $status = $stmt->fetch();
    return $status;
}

/**
 * Fetches the current task that you want to edit.
 *
 * You can find this function in editTask.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentTaskId -The id of the current task
 * @return void
 */
function fetchCurrentTask($conn, $currentTaskId){
    $stmt = $conn->prepare("SELECT * FROM task WHERE id = $currentTaskId");
    $stmt->execute();
    $status = $stmt->fetch();
    return $status;
}

/**
 * Sorts the tasks on duration
 *
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 * @return void
 */
function sortTasksTime($conn, $currentListId){
    $stmt = $conn->prepare("SELECT * FROM task WHERE list_id = $currentListId ORDER BY `task`.`duration` ASC");
    $stmt->execute();
    $status = $stmt->fetchAll();
    return $status;
}

/**
 * Fetches the current status for a task
 *
 * You can find this function in index.php 
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [type] $task
 * @return void
 */
function fetchCurrentStatus($conn, $task){
    $status;
    $stmt = $conn->prepare("SELECT * FROM status WHERE id = :status_id");
    $stmt->execute(array(
        ':status_id' => $task['status_id'], 
    ));
    $status = $stmt->fetch();
    return $status;
}

/**
 * Creates a list 
 *
 * @param [type] $conn -connects to database, to give acces.
 * @param [type] $data
 * @return void
 */
function createList($conn, $data){
    $stmt = $conn->prepare("INSERT INTO list (name) VALUES (:name )");
    $stmt->execute(array(
        ':name' => $data['name'],
    ));
    header("Location: index.php");    
}

/**
 * Creates a task in a list
 *
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 * @param [type] $data
 * @return void
 */
function createTask($conn, $currentListId, $data){
    $stmt = $conn->prepare("INSERT INTO task (name, description, status_id, duration, list_id) VALUES (:name , :description, :status_id, :duration, :list_id)");
    $stmt->execute(array(
    ':name' => $data['name'],
    ':description' => $data['description'],
    ':status_id' => $data['status'],
    ':duration' => $data['duration'],
    ':list_id' => $currentListId,
 ));
    header("Location: index.php");    
}

/**
 * Edits the list
 *
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 * @param [type] $data
 * @return void
 */
function editList($conn, $currentListId, $data){
    $stmt = $conn->prepare("UPDATE list  SET name=:name WHERE id=:currentListId");
    $stmt->execute(array(
        ':name' => $data['name'],
        ':currentListId' => $currentListId,   
    ));
    header("Location: index.php"); 
}

/**
 * Edits the task
 *
 * You can find this function in editTask.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentTaskId -The id of the current task
 * @param [type] $data
 * @return void
 */
function editTask($conn, $currentTaskId, $data){
    $stmt = $conn->prepare("UPDATE task  SET name=:name, description=:description, status_id=:status_id, duration=:duration WHERE id=:currentTaskId");
    $stmt->execute(array(
        ':name' => $data['name'],
        ':description' => $data['description'],
        ':duration' => $data['duration'],
        ':status_id' => $data['status'],
        ':currentTaskId' => $currentTaskId,   
    ));
    header("Location: index.php"); 
}

/**
 * Deletes the list and all the tasks in the list
 *
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 * @return void
 */
function deleteList($conn, $currentListId){
    $stmt = $conn->prepare("DELETE FROM list WHERE id='$currentListId'; DELETE FROM task WHERE list_id='$currentListId';");
    $stmt->execute();  
    header("Location: index.php");
}

/**
 * Deletes task
 *
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentTaskId -The id of the current task
 * @return void
 */
function deleteTask($conn, $currentTaskId){
    $stmt = $conn->prepare("DELETE FROM task WHERE id='$currentTaskId'");
    $stmt->execute();  
    header("Location: index.php");
}


?>
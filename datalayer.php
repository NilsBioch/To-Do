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
 * Location: index.php
 * 
 * @param [type] $conn connects to database, to give acces.
 * @return [mixed] -Returns all lists
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
 * Location: index.php, editTask.php, createTask.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @return [mixed] -Returns all statuses
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
 * Location: index.php 
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @return [mixed] -Returns all tasks
 */
function fetchAllTasks($conn){
    $stmt = $conn->prepare("SELECT * FROM task");
    $stmt->execute();
    $status = $stmt->fetchAll();
    return $status;
}

/**
 * Fetches the tasks in the current list
 *
 * Location: index.php 
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 * @return [mixed] -Returns the tasks in the current list 
 */
function fetchCurrentTasks($conn, $currentListId){
    $stmt = $conn->prepare("SELECT * FROM task WHERE list_id =:currentListId");
    $stmt->execute(array( ':currentListId' => $currentListId ));
    $status = $stmt->fetchAll();
    return $status;
}

/**
 * Fetches the current list that you want to edit.
 *
 * Location: editList.php, deleteList.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 * @return [mixed] -Returns the current list
 */
function fetchCurrentList($conn, $currentListId){    
    $stmt = $conn->prepare("SELECT * FROM list WHERE id =:currentListId");
    $stmt->execute(array( ':currentListId' => $currentListId ));
    $status = $stmt->fetch();
    return $status;
}

/**
 * Fetches the current task that you want to edit.
 *
 * Location: index.php, editTask.php, deleteTask
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentTaskId -The id of the current task
 * @return [mixed] -Returns the current task
 */
function fetchCurrentTask($conn, $currentTaskId){
    $stmt = $conn->prepare("SELECT * FROM task WHERE id =:currentTaskId");
    $stmt->execute(array( ':currentTaskId' => $currentTaskId ));
    $status = $stmt->fetch();
    return $status;
}

/**
 * Sorts the tasks on duration
 *
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 * @return [mixed] -Returns the sorted tasks
 */
function sortTasksTime($conn, $currentListId){
    $stmt = $conn->prepare("SELECT * FROM task WHERE list_id =:currentListId ORDER BY `task`.`duration` ASC");
    $stmt->execute(array( ':currentListId' => $currentListId ));
    $status = $stmt->fetchAll();
    return $status;
}
function sortStatus($conn, $currentListId){
    $stmt = $conn->prepare("SELECT * FROM `task` WHERE list_id =:currentListId ORDER BY `task`.`status_id` ASC");
    $stmt->execute(array( ':currentListId' => $currentListId ));
    $status = $stmt->fetchAll();
    return $status;
}
/**
 * Fetches the current status for a task
 *
 * Location: index.php 
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $task -The id of the status in the task table
 * @return [mixed] -Returns the current status
 */
function fetchCurrentStatus($conn, $task){
    $stmt = $conn->prepare("SELECT * FROM status WHERE id =:status_id");
    $stmt->execute(array( ':status_id' => $task['status_id'] ));
    $status = $stmt->fetch();
    return $status;
}

/**
 * Creates a list 
 *
 * Location: createList.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [string] $data -The name of list
 */
function createList($conn, $data){
    $stmt = $conn->prepare("INSERT INTO list (name) VALUES (:name )");
    $stmt->execute(array( ':name' => $data['name'] ));  
}

/**
 * Creates a task in a list
 *
 * Location: createTask.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 * @param [mixed] $data -The input of the user
 */
function createTask($conn, $currentListId, $data){
    $stmt = $conn->prepare("INSERT INTO task (name, description, status_id, duration, list_id) VALUES (:name , :description, :status_id, :duration, :list_id)");
    $stmt->execute(array(
    ':name' => $data['name'], ':description' => $data['description'], ':status_id' => $data['status'], ':duration' => $data['duration'], ':list_id' => $currentListId ));   
}

/**
 * Edits the list
 *
 * Location: editList.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 * @param [string] $data -The name of the list
 */
function editList($conn, $currentListId, $data){
    $stmt = $conn->prepare("UPDATE list  SET name=:name WHERE id=:currentListId");
    $stmt->execute(array( ':name' => $data['name'], ':currentListId' => $currentListId ));
}

/**
 * Edits the task
 *
 * Location: editTask.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentTaskId -The id of the current task
 * @param [mixed] $data -The input of the user.
 */
function editTask($conn, $currentTaskId, $data){
    $stmt = $conn->prepare("UPDATE task  SET name=:name, description=:description, status_id=:status_id, duration=:duration WHERE id=:currentTaskId");
    $stmt->execute(array( ':name' => $data['name'], ':description' => $data['description'], ':duration' => $data['duration'], ':status_id' => $data['status'], ':currentTaskId' => $currentTaskId ));
}

/**
 * Deletes the list and all the tasks in the list
 *
 * Location: deleteList.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentListId -The id of the current list
 */
function deleteList($conn, $currentListId){
    $stmt = $conn->prepare("DELETE FROM list WHERE id=:currentListId; DELETE FROM task WHERE list_id=:currentListId;");
    $stmt->execute(array( ':currentListId' => $currentListId ));  
}

/**
 * Deletes task
 *
 * Location: deleteTask.php
 * 
 * @param [type] $conn -connects to database, to give acces.
 * @param [number] $currentTaskId -The id of the current task
 */
function deleteTask($conn, $currentTaskId){
    $stmt = $conn->prepare("DELETE FROM task WHERE id=:currentTaskId");
    $stmt->execute(array( ':currentTaskId' => $currentTaskId ));  
}



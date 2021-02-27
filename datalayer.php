<?php 
function connectie(){
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

function fetchAllLists($conn){
    $stmt = $conn->prepare("SELECT * FROM list");
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function fetchAllStatus($conn){
    $stmt = $conn->prepare("SELECT * FROM status");
    $stmt->execute();
    $status = $stmt->fetchAll();
    return $status;
}

function fetchListTasks($conn){
    $stmt = $conn->prepare("SELECT * FROM task");
    $stmt->execute();
    $status = $stmt->fetchAll();
    return $status;
}

function fetchCurrentTask($conn, $currentListId){
    $stmt = $conn->prepare("SELECT * FROM task WHERE list_id = $currentListId");
    $stmt->execute();
    $currentTasks = $stmt->fetchAll();
    return $currentTasks;
}

function sortTasksTime($conn, $currentListId){
    $stmt = $conn->prepare("SELECT * FROM task WHERE list_id = $currentListId ORDER BY `task`.`duration` ASC");
    $stmt->execute();
    $currentTasks = $stmt->fetchAll();
    return $currentTasks;
    
}
function fetchCurrentStatus($conn, $task){
    $status;
    $stmt = $conn->prepare("SELECT * FROM status WHERE id = :status_id");
    $stmt->execute(array(
        ':status_id' => $task['status_id'], 
    ));
    $status = $stmt->fetch();
    return $status;
}

function createList($conn, $data){
    $stmt = $conn->prepare("INSERT INTO list (name) VALUES (:name )");
    $stmt->execute(array(
        ':name' => $data['name'],
    ));
    header("Location: index.php");    
}

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

function editList($conn, $currentListId, $data){
    $stmt = $conn->prepare("UPDATE list  SET name=:name WHERE id=:currentListId");
    $stmt->execute(array(
        ':name' => $data['name'],
        ':currentListId' => $currentListId,   
    ));
    header("Location: index.php"); 
}

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

function deleteList($conn, $currentListId){
    $stmt = $conn->prepare("DELETE FROM list WHERE id='$currentListId'");
    $stmt->execute();  
    deleteTaskInList($conn, $currentListId);
}

function deleteTaskInList($conn, $currentListId){
    $stmt = $conn->prepare("DELETE FROM task WHERE list_id='$currentListId'");
    $stmt->execute();  
    header("Location: index.php");
}

function deleteTask($conn, $currentTaskId){
    $stmt = $conn->prepare("DELETE FROM task WHERE id='$currentTaskId'");
    $stmt->execute();  
    header("Location: index.php");
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
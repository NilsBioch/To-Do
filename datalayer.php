<?php 
function connectie(){
    $servername = "localhost";
    $username = "root";
    $password = "99055617";
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
// connectie
// $name, $img, $color, $weight, $price, $description, $typeId

function fetchAllLists($conn){
    $result;
    $stmt = $conn->prepare("SELECT * FROM list");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
}

function fetchAllStatus($conn){
    $status;
    $stmt = $conn->prepare("SELECT * FROM status");
        $stmt->execute();
        $status = $stmt->fetchAll();
        return $status;
}

function createList($conn, $data){
       $stmt = $conn->prepare("INSERT INTO list (name, description) VALUES (:name , :description)");
       $stmt->execute(array(
        ':name' => $data['name'],
        ':description' => $data['description'],
    ));
       header("Location: index.php");    
}
function createTask($cListId){
//     $stmt = $conn->prepare("INSERT INTO task (list_id, name, description, time, status_id) VALUES (:currentListId, :name , :description, :time, :status)");
//     $stmt->execute(array(
//      ':name' => $data['name'],
//      ':description' => $data['description'],
//      ':time' => $data['time'],
//      ':status' => $data['status'],
//      ':currentListId' => $currentListId,
//  ));
//     header("Location: index.php"); 
echo $cListId;
}
function updateList($conn, $currentListId, $data){
    $stmt = $conn->prepare("UPDATE list  SET name=:name, description=:description WHERE id=:currentListId");
    $stmt->execute(array(
        ':name' => $data['name'],
        ':description' => $data['description'],   
        ':currentListId' => $currentListId
    ));
    header("Location: index.php"); 
}

function deleteList($conn, $currentListId){
    $stmt = $conn->prepare("DELETE FROM list WHERE id='$currentListId'");
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
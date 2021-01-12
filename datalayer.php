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

function createList($conn, $data){
       $stmt = $conn->prepare("INSERT INTO list (name, description) VALUES (:name , :description)");
       $stmt->execute(array(
        ':name' => $data['name'],
        ':description' => $data['description'],
    ));
       header("Location: index.php");    
}

function createNewList($data){
    echo "<div class='mt-2 d-inline-flex'>";
    echo "<div class='card'>";
    echo "<div class='card-body'>";
    echo "<h4 class='card-title'>".$data['name']."</h4>";
    echo "<p class='card-text'>".$data['description']."</p>";
    echo "<a href='list.php?id=" .$data['id']. "'class='btn btn-primary'>Meer details</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";    
}

function updateList($conn, $currentListId, $data){
    $stmt = $conn->prepare("UPDATE list  SET name=':name', description=':description', WHERE id=':currentListId'");
    $stmt->execute(array(
        ':name' => $data['name'],
        ':description' => $data['description'],   
        ':currentListId' => $currentListId,   
    ));
    header("Location: index.php"); 
}

// function createPlan($data){
//     try{
//         $conn=openDatabaseConnection();
//         $stmt = $conn->prepare("INSERT INTO personen (date,start,explainer,players,game) VALUES (:date, :start, :explainer, :players, :game)");
//         $stmt->execute(array(
//             ':name' => $data['date'],
//             ':description' => $data['start'],

//         ));
//        }
//        catch(PDOException $e){
//         echo "Connection failed: " . $e->getMessage();
//         }
//         $conn = null; 
//  }


function deleteList($conn, $currentListId){
    $stmt = $conn->prepare("DELETE FROM list WHERE id='$currentListId'");
    $stmt->execute();  
    header("Location: index.php");
}

// function fetchcurrentvehicle($conn){
//     $result;
//     $currentTypeId = $_GET['id'];
//     $stmt = $conn->prepare("SELECT * FROM vehicles WHERE Typeid=$currentTypeId");
//     $stmt->execute();
//     $result = $stmt->fetchAll();
//     return $result;
// }


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
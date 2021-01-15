<?php 
include'datalayer.php'; 
$conn = connectie();
$result = fetchAllStatus($conn);

$currentListId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM list WHERE id = $currentListId");
    $stmt->execute();
    $data = $stmt->fetch();
    
    include 'header.php';
?>

<body>

<div class="mb-5 mt-2">

    <h1>Wijzig de List gegevens</h1>
    <?php 
    $nameErr=''; 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"]) or empty($_POST["description"]) or empty($_POST["duration"]) ) {
          $nameErr = "Veld is verplicht";
        } else {
          test_input($_POST["name"]);
          test_input($_POST["description"]);
          createTask($conn, $currentListId, $_POST);
        }
    } ?>
    <form method='post'>

    Naam:<br><input type="text" name="name" ><span class="error" required></br>
    Description:<br><input type="textaera" name="description"><span class="error" required></br>
    Duration:<br><input type="number" name="duration"><span class="error" required></br>
	<select id="status" name="status">
    <?php
	foreach($result as $data){
		echo"<option value='".$data["id"]."'>".$data['name']."</option>";
    }
    ?>
    </select><br>
  <input class="btn-lg btn-primary text-white " type="submit" value="Update">
    </form>
</div>

<?php include'header_footer/footer.php' ?>

</body>
</html>
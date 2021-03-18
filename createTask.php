<?php 
include 'datalayer.php'; 
$currentListId = $_GET['id'];
$conn = connection();
$statuses = fetchAllStatus($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	createTask($conn, $currentListId, $_POST);
	header("Location: index.php");
	exit();
}

include 'assets/header.php';
?>
<div class="mb-5 mt-2">
	<div class='d-lg-flex flex-lg-row flex-sm-column justify-content-between'>
      	<h1 class='text-white'>Add new Task</h1>
      	<a class='align-self-center' href='index.php'><i class='fas fa-arrow-circle-left fa-3x justify-content-between'></i></a>
    </div>
<div id='input-box' class="text-center fixed-bottom">
  	<div id="list-form">
    	<form method='post'>
      		<div class="form-group list-form">
        		<h3 class='text-white'>Naam:</h3>
				<input class='form-control' type="text" name="name" required>
				<h3 class='text-white'>Description:</h3>
				<input class='form-control' type="textaera" name="description"required></br>
				<h3 class='text-white'>Duration:</h3>
				<input class='form-control' type="number" name="duration" required></br>
				<h3 class='text-white'>Status:</h3>
				<select class='form-control' id="status" name="status">
					<?php
						foreach($statuses as $status){
							echo"<option value='".$status["id"]."'>".$status['name']."</option>";
						}
					?>
      			</select><br>
        		<input class="btn-lg btn-primary text-white m-2" type="submit" value="Maak aan!">
      		</div>
    	</form>
  	</div>
</div>

<?php  include 'assets/footer.php' ?>
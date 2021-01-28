<?php 
include'datalayer.php'; 
$conn = connectie();
$result = fetchAllStatus($conn);

$currentTaskId = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM task WHERE id = $currentTaskId");
$stmt->execute();
$data = $stmt->fetch();
    include 'assets/header.php';
?>
  <div class="mb-5 mt-2">
    <h1>Edit Task</h1>
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
          editTask($conn, $currentTaskId, $_POST);
        }
     ?>
   <div id='input-box' class="text-center fixed-bottom">
  <div id="list-form">
    <form method='post'>
      <div class="form-group list-form">
        <h3 class='text-white'>Naam:</h3>
        <input class='form-control' type='text' name='name' value="<?php echo $data['name'] ?>" required>
        <h3 class='text-white'>Description:</h3>
        <input class='form-control' type="textaera" name='description' value="<?php echo $data['description'] ?>" required></br>
        <h3 class='text-white'>Duration:</h3>
        <input class='form-control' type="number" name="duration" value="<?php echo $data['duration'] ?>" required></br>
        <h3 class='text-white'>Status:</h3>
        <select class='form-control' id="status" name="status">
        <?php
          foreach($result as $data){
            echo"<option value='".$data["id"]."'>".$data['name']."</option>";
          }
        ?>
      </select><br>
        <input class="btn-lg btn-primary text-white m-2" type="submit" value="Maak aan!">
      </div>
    </form>
  </div>
</div>

<?php include 'assets/footer.php' ?>

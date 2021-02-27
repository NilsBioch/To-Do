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
    <div class='d-lg-flex flex-lg-row flex-sm-column justify-content-between'>
      <h1 class='text-white'>Edit Task</h1>
      <a class='align-self-center' href='index.php'><i class='fas fa-arrow-circle-left fa-3x justify-content-between'></i></a>
    </div>
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
        <input class="btn-lg btn-primary text-white m-2" type="submit" value="Edit Task!">
      </div>
    </form>
  </div>
</div>

<?php include 'assets/footer.php' ?>

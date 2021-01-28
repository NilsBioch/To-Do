<?php 
include'datalayer.php'; 
$conn = connectie();

$currentListId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM list WHERE id = $currentListId");
    $stmt->execute();
    $data = $stmt->fetch();
    
    include 'assets/header.php';
?>
<div class="mb-5 mt-2">

    <h1>Edit list</h1>
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      editList($conn, $currentListId, $_POST);
    }
    ?>

</div>
<div id='input-box' class="text-center fixed-bottom">
  <div id="list-form">
    <form method='post'>
      <div class="form-group list-form">
        <h3 class='text-white'>Naam:</h3>
        <input class="form-control" type="text" name="name" value="<?php echo $data['name'] ?>" required>
        <input class="btn-lg btn-primary text-white m-2" type="submit" value="Maak aan!">
      </div>
    </form>
  </div>
</div>

<?php include 'assets/footer.php' ?>

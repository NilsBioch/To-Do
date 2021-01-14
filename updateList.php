<?php 
include'datalayer.php'; 
$conn = connectie();

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
        if (empty($_POST["name"]) or empty($_POST["description"]) ) {
          $nameErr = "Veld is verplicht";
        } else {
          test_input($_POST["name"]);
          test_input($_POST["description"]);
          updateList($conn, $currentListId, $_POST);
        }
    } ?>
    <form method='post'>

    Naam:<br><input type="text" name="name" value="<?php echo $data['name'] ?>"><span class="error">* <?php echo $nameErr;?></span></br>
    Description:<br><input type="text" name="description" value="<?php echo $data['description'] ?>"><span class="error">* <?php echo $nameErr;?></span></br>
  <input class="btn-lg btn-primary text-white " type="submit" value="Update">
    </form>
</div>

<?php include'header_footer/footer.php' ?>

</body>
</html>
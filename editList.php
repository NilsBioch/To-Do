<?php 
include 'datalayer.php'; 
$currentListId = $_GET['id'];
$conn = connection();
$list = fetchCurrentList($conn, $currentListId);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    editList($conn, $currentListId, $_POST);
    header("Location: index.php");
    exit();
}
include 'assets/header.php';
?>
<div class="mb-5 mt-2">
    <div class='d-lg-flex flex-lg-row flex-sm-column justify-content-between'>
        <h1 class='text-white'>Edit List</h1>
        <a class='align-self-center' href='index.php'><i class='fas fa-arrow-circle-left fa-3x justify-content-between'></i></a>
    </div>
    <?php 

    ?>
</div>
<div id='input-box' class="text-center fixed-bottom">
    <div id="list-form">
        <form method='post'>
            <div class="form-group list-form">
                <h3 class='text-white'>Naam:</h3>
                <input class="form-control" type="text" name="name" value="<?php echo $list['name'] ?>" required>
                <input class="btn-lg btn-primary text-white m-2" type="submit" value="Edit Lijst!">
            </div>
        </form>
    </div>
</div>

<?php include 'assets/footer.php' ?>

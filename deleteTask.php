<?php 
include 'datalayer.php'; 
$currentTaskId = $_GET['id'];
$conn = connection();
$task = fetchCurrentTask($conn, $currentTaskId);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    deleteTask($conn, $currentTaskId);
    header("Location: index.php");
    exit();
}
include 'assets/header.php';
?>
<div class='d-lg-flex flex-lg-row flex-sm-column justify-content-between'>
    <h1 class='text-white  mx-auto'>Weet u zeker dat u <?php echo $task['name'] ?> wilt verwijderen</h1>
    <a class='align-self-center' href='./index.php'><i class='fas fa-arrow-circle-left fa-3x justify-content-between'></i></a>
</div>
<div id='input-box' class="text-center fixed-bottom">
    <div class="mb-5 mt-2 d-flex justify-content-center">
        <form method="post">
            <input class="btn-lg btn-primary text-white m-3" type="submit" value="Ja!">
        </form> 
        <form action='index.php'>
            <input class="btn-lg btn-primary text-white m-3" type="submit" value="Nee!">
        </form>
    </div>
</div>
<?php include 'assets/footer.php' ?> 

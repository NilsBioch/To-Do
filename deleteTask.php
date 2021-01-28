<?php 
include'datalayer.php'; 
$conn = connectie();

$currentTaskId = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM task WHERE id = $currentTaskId");
    $stmt->execute();
    $data = $stmt->fetch();

    include 'assets/header.php';
?>
<h1>Weet u zeker dat u <?php echo $data['name'] ?> wilt verwijderen</h1>
    <div class="mb-5 mt-2 d-flex justify-content-center">
        <form method="post">
            <input class="btn-lg btn-primary text-white m-3" type="submit" value="Ja!">
                <?php 
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        deleteTask($conn, $currentTaskId);
                    }
                ?>
        </form> 
        <form action='index.php'>
        <input class="btn-lg btn-primary text-white m-3" type="submit" value="Nee!">
    </form>
</div>
<?php include 'assets/footer.php' ?> 

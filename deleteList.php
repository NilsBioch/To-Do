<?php 
include'datalayer.php'; 
$conn = connectie();
$result = fetchAllLists($conn);

$currentListId = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM list WHERE id = $currentListId");
    $stmt->execute();
    $data = $stmt->fetch();

    include 'header.php';
?>

<body>
<h1>Weet u zeker dat u <?php echo $data['name'] ?> wilt verwijderen</h1>

<div class="mb-5 mt-2 d-flex justify-content-center">
    <form method="post">
    <input class="btn-lg btn-primary text-white m-3" type="submit" value="Ja!">
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            deleteList($conn, $currentListId);
        }
        ?>
    </form> <form action='index.php'>
<input class="btn-lg btn-primary text-white m-3" type="submit" value="Nee!">
    </form>
</div>
<?php include'header_footer/footer.php' ?> 
</body>
</html>
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

<div class="mb-5 mt-2">

    <div class="d-lg-flex flex-lg-row flex-sm-column justify-content-between">
        <h1>Bekijk hier <?php echo $data["name"] ?></h1>
        <div class="align-self-center">
            <a class="btn-lg btn-info text-white" href="updateList.php?id=<?php echo $data['id']?>">Edit List</a>
            <a class="btn-lg btn-danger text-white" href="deleteList.php?id=<?php echo $data['id']?>">Delete List</a>
        </div>
    </div>

    <div class="content mt-2">
        <div>
            <div>
                <div class="text-center border">
                    <div class="border-bottom">
                        <strong><?php echo $name = $data["name"]; ?></strong>
                    </div>
                </div>
            </div>
            <p class="card-text">
            <?php echo $data["description"] ?>
            </p>
        </div>
    </div>
    <hr>
</div>

<?php include'header_footer/footer.php' ?>

</body>
</html>
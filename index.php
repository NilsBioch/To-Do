<?php 
include 'datalayer.php'; 
$conn = connectie();
$result = fetchAllLists($conn);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<div class="mb-5 mt-2">
    <div class="d-lg-flex flex-lg-row flex-sm-column justify-content-between">
        <h1>Bekijk hier alle Lists</h1>
        <a class="btn-lg btn-primary text-white align-self-center" href="createlist.php">Nieuwe List</a>
    </div>
    <?php

    for ($i=0; $i < count($result); $i++) { 
        $data = $result[$i];
        createNewList($data);
    }
    ?>
</div>

<?php include'header_footer/footer.php' ?>

</body>
</html>
<?php 
include 'datalayer.php'; 
include 'validation.php';
$currentTaskId = $_GET['id'];
$conn = connection();
$statuses = fetchAllStatus($conn);
$task = fetchCurrentTask($conn, $currentTaskId);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data['name']           = test_input($_POST['name']);
    $data['description']    = test_input($_POST['description']);
	$data['status']         = test_input($_POST['status']);
    $data['duration']       = test_input($_POST['duration']);
    editTask($conn, $currentTaskId, $data);
    header("Location: index.php");
    exit();
}
include 'assets/header.php';
?>
<div class="mb-5 mt-2">
    <div class='d-lg-flex flex-lg-row flex-sm-column justify-content-between'>
        <h1 class='text-white'>Edit Task</h1>
        <a class='align-self-center' href='index.php'><i class='fas fa-arrow-circle-left fa-3x justify-content-between'></i></a>
    </div>
    <div id='input-box' class="text-center fixed-bottom">
        <div id="list-form">
            <form method='post'>
                <div class="form-group list-form">
                    <h3 class='text-white'>Naam:</h3>
                    <input class='form-control' type='text' name='name' value="<?php echo $task['name'] ?>" required>
                    <h3 class='text-white'>Description:</h3>
                    <input class='form-control' type="textaera" name='description' value="<?php echo $task['description'] ?>" required></br>
                    <h3 class='text-white'>Duration:</h3>
                    <input class='form-control' type="number" name="duration" value="<?php echo $task['duration'] ?>" required></br>
                    <h3 class='text-white'>Status:</h3>
                    <select class='form-control' id="status" name="status">
                        <?php
                            foreach($statuses as $status){
                                ?>
                                <option value="<?php echo $status['id'] ?>" <?php if ($task['status_id'] == $status['id']) echo 'selected="selected" '; ?> ><?php echo $status['name'] ?></option>
                            <?php
                            }
                        ?>
                    </select>
                    </br>
                    <input class="btn-lg btn-primary text-white m-2" type="submit" value="Edit Task!">
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'assets/footer.php' ?>
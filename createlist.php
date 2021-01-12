<?php 
include 'datalayer.php'; 
$conn = connectie();

$stmt = $conn->prepare("SELECT * FROM list");
$stmt->execute();
$result = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create List</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<div class="mb-5 mt-2 ">
		<h1>Add new list</h1>
		<?php 
    		$nameErr ='';
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["name"]) or empty($_POST["description"])) {
				$nameErr = "Veld is verplicht";
				} else {
				createList($conn, $_POST);
				}
			}
    	?>
		<form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
			Naam:<br><input type="text" name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}; ?>">
			<span class="error">* <?php echo $nameErr;?></span></br>
			Description:<br><input type="textarea" name="description"
				value="<?php if(isset($_POST['description'])){echo $_POST['description'];}; ?>">
			<span class="error">* <?php echo $nameErr;?></span></br>
			<br>
			<input class="btn-lg btn-primary text-white " type="submit" value="Maak aan!">
		</form>
	</div>
	<?php include 'header_footer/footer.php' ?>
</body>
</html>
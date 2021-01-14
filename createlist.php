<?php 
include 'datalayer.php'; 
$conn = connectie();

fetchAllLists($conn);
include 'header.php';
?>

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
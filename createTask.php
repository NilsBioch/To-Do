<?php include 'datalayer.php';
$conn=connectie();
$result=fetchAllLists($conn);
$status=fetchAllStatus($conn);

$ListId = $_GET['id'];
$ListId = $cListId;

include 'header.php';
?>
<body>
	<div class="mb-5 mt-2 ">
		<h1>Add new Task</h1>
		<?php 
			$nameErr='';
			if ($_SERVER["REQUEST_METHOD"]=="POST") {
				if (empty($_POST["name"]) or empty($_POST["description"]) or empty($_POST["time"])) {
					$nameErr="Veld is verplicht";
				}
				else {
					createTask($cListId);
				}
			}
		?>
		<form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>Naam:
		<br>
		<input type="text" name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}; ?>" required >
		</br>
		Description:
		<br>
		<input type="textarea" name="description" value="<?php if(isset($_POST['description'])){echo $_POST['description'];}; ?>" required>
		</br>
		Tijd in Minuten:<br>
		<input type="text" name="time" value="<?php if(isset($_POST['time'])){echo $_POST['time'];}; ?>" required>
		<br>
		 Status:</br>
		<select name="status"><?php foreach($status as $statusOptions) {
			echo "<option value='".$statusOptions['id']."'>". $statusOptions['name'] ."</option>";
		}
		?>
		</select>
<br>
<input class="btn-lg btn-primary text-white " type="submit" value="Maak aan!"></form>
	</div><?php include 'header_footer/footer.php'?>
</body>

</html>
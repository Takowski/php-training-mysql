<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
<?php
include 'read.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$difficulty = $_POST['difficulty'];
	$distance = $_POST['distance'];
	$duration = $_POST['duration'];
	$height_difference = $_POST['height_difference'];

	// SQL to update a record
	$sql = "UPDATE hiking SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference WHERE id = :id";

	// Prepare statement
	$stmt = $bdd->prepare($sql);

	// Bind parameters
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':difficulty', $difficulty);
	$stmt->bindParam(':distance', $distance);
	$stmt->bindParam(':duration', $duration);
	$stmt->bindParam(':height_difference', $height_difference);
	$stmt->bindParam(':id', $id);

	// Execute the statement
	$stmt->execute();

	echo "Record updated successfully";
} else {
	$id = $_GET['id'];

	// SQL to get a record
	$sql = "SELECT * FROM hiking WHERE id = :id";

	// Prepare statement
	$stmt = $bdd->prepare($sql);

	// Bind parameters
	$stmt->bindParam(':id', $id);

	// Execute the statement
	$stmt->execute();

	// Fetch the record
	$hiking = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!-- Rest of your HTML form code -->
<html>
<head>
	<meta charset="utf-8">
	<title>Modifier une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<h1>Modifier</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo htmlspecialchars($hiking['name']); ?>">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile" <?php echo $hiking['difficulty'] == 'très facile' ? 'selected' : ''; ?>>Très facile</option>
				<option value="facile" <?php echo $hiking['difficulty'] == 'facile' ? 'selected' : ''; ?>>Facile</option>
				<option value="moyen" <?php echo $hiking['difficulty'] == 'moyen' ? 'selected' : ''; ?>>Moyen</option>
				<option value="difficile" <?php echo $hiking['difficulty'] == 'difficile' ? 'selected' : ''; ?>>Difficile</option>
				<option value="très difficile" <?php echo $hiking['difficulty'] == 'très difficile' ? 'selected' : ''; ?>>Très difficile</option>
			</select>
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo htmlspecialchars($hiking['distance']); ?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo htmlspecialchars($hiking['duration']); ?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo htmlspecialchars($hiking['height_difference']); ?>">
		</div>
		<!-- Add a hidden input field to hold the id of the hiking -->
		<input type="hidden" name="id" value="<?php echo htmlspecialchars($hiking['id']); ?>">
		<button type="submit">Submit</button>
	</form>
</body>
</html>
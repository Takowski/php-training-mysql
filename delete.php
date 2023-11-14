<?php
include 'read.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // SQL to delete a record
    $sql = "DELETE FROM hiking WHERE id = :id";

    // Prepare statement
    $stmt = $bdd->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':id', $id);

    // Execute the statement
    $stmt->execute();

    echo "Record deleted successfully";
} else {
?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        ID of hiking to delete: <input type="text" name="id"><br>
        <input type="submit">
    </form>
<?php
}
?>
/**** Supprimer une randonnée ****/

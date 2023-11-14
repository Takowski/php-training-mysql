<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <?php
    // Connexion à la base de données
    try
    {
    $bdd= new PDO('mysql:host=localhost;dbname=becode;charset=utf8', 'root', 'root');
    $sql = "SELECT * FROM hiking";
    $response = $bdd->query($sql);
    $hikings = $response->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e)
    {
    die('Erreur : '.$e->getMessage());
    }
    ?>
    <table>
      <!-- Afficher la liste des randonnées -->
      <?php foreach ($hikings as $hiking): ?>
        <tr>
          <td><?php echo htmlspecialchars($hiking['id']); ?></td>
          <td><?php echo htmlspecialchars($hiking['name']); ?></td>
          <td><?php echo htmlspecialchars($hiking['difficulty']); ?></td>
          <td><?php echo htmlspecialchars($hiking['distance']); ?></td>
          <td><?php echo htmlspecialchars($hiking['duration']); ?></td>
          <td><?php echo htmlspecialchars($hiking['height_difference']); ?></td>
          <td><a href="update.php?id=<?php echo $hiking['id']; ?>">Update</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>

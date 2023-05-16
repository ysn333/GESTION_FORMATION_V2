<?php
session_start();

include "db/dbconfig.php";

if (isset($_POST["date_debut"]) && isset($_POST["date_fin"])) {
  $dateDebut = $_POST["date_debut"];
  $dateFin = $_POST["date_fin"];

  // Get the available teachers based on the selected start and end dates
  $sql = "SELECT * FROM formateur WHERE id_formateur NOT IN (SELECT id_formateur FROM session WHERE (date_debut BETWEEN :date_debut AND :date_fin) OR (date_fin BETWEEN :date_debut AND :date_fin))";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(":date_debut", $dateDebut);
  $stmt->bindParam(":date_fin", $dateFin);
  $stmt->execute();
  $availableTeachers = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Return the available teachers as a JSON-encoded string
  echo json_encode($availableTeachers);
}
?>
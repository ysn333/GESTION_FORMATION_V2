<?php
// Establish a database connection
include "../db/dbconfig.php";

// Retrieve form data
$date_debut = $_POST['date_debut'];
$date_fin = $_POST['date_fin'];
$nombre_places_max = $_POST['nombre_places_max'];
$etat = $_POST['etat'];
$id_formation = $_POST['id_formation'];
$id_formateur = $_POST['id_formateur'];

// Validate form data
if (empty($date_debut) || empty($date_fin) || empty($nombre_places_max) || empty($etat) || empty($id_formation) || empty($id_formateur)) {
  // Required field(s) missing
  header("Location: ../add_session_form.php?message=Missing required field(s).");
  exit();
}

// Insert new session data into database
$sql = "INSERT INTO session (date_debut, date_fin, nombre_places_max, etat, id_formation, id_formateur) VALUES (:date_debut, :date_fin, :nombre_places_max, :etat, :id_formation, :id_formateur)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':date_debut', $date_debut);
$stmt->bindParam(':date_fin', $date_fin);
$stmt->bindParam(':nombre_places_max', $nombre_places_max);
$stmt->bindParam(':etat', $etat);
$stmt->bindParam(':id_formation', $id_formation);
$stmt->bindParam(':id_formateur', $id_formateur);

try {
  $stmt->execute();
  // Redirect to confirmation page or display success message
  header("Location: ../add_session_form.php?message=Session added successfully.");
  exit();
} catch (PDOException $e) {
  // Display error message
  header("Location: ../add_session_form.php?message=Error adding session: " . $e->getMessage());
  exit();
}
?>
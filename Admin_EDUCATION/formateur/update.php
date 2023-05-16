<?php

include "../db/dbconfig.php";
session_start();
    if(isset($_POST['submit'])) {
        $id = $_GET['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $role = $_POST['role'];




            // Update apprenant's information in the database without changing the image file
            $sql = "UPDATE formateur SET firstname = :firstname, lastname = :lastname, email = :email,role = :role WHERE id_formateur = :id";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role', $role);
  
            $stmt->bindParam(':id', $id);

            $stmt->execute();
            header("Location: ../index.php");
            exit();
        }

?>
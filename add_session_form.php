
<?php
session_start();

include "db/dbconfig.php";



?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Admin_EDUCATION\assets\style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
          crossorigin="anonymous">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>House Miner</title>
</head>
<body>
<nav>
    <div id="logo">
      
        <span>EDU MEETING</span>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous">
<?php


$stmt = $conn->prepare("SELECT * FROM apprenant WHERE email=:email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);



if ($result) { 
    if ($result['password'] == $password) {
        $_SESSION['id_formateur'] = $result['id_formateur'];
        $_SESSION['id_apprenant'] = $result['id_apprenant'];
        $_SESSION['firstname'] = $result['firstname'];
        $_SESSION['lastname'] = $result['lastname'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['img'] = $result['img'];
        $_SESSION['role'] = $result['role'];


    }
  }

  if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
    // User is an apprenant
    echo '';
  } else if (isset($_SESSION['role']) && $_SESSION['role'] == 'formateur') {
    // User is a formateur
    echo '';
  } else if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    // User is a admin
    echo '';
  } else {
    // User is not logged in
    echo 'Vous n\'êtes pas connecté.';
  }
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$email =  $_SESSION['email'];
$img = $_SESSION['img'];
$role = $_SESSION['role'];


?>

<div class="position-relative">
    <button id="dropdownUserAvatarButton"
            class="flex mx-3 text-sm rounded-full md:mr-0 focus:ring-4 profile">
        <img src='files/profiles/<?php echo $img ?>' alt="">
        <span><?= $firstname . ' ' . $lastname ?> </span>
    </button>
    <div id="dropdownAvatar"
         class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
            <p class="text-center"><?= $firstname . ' ' . $lastname ?></p>
            <div class="font-medium truncate"><?= $email ?></div>
        </div>
        <a href=""
           class=" px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Paramètres</a>
        <div class="py-2">
            <a href="includ/logout.php"
               class="logout px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                <span>Se déconnecter </span>
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        </div>
    </div>
</div>

</nav>
<main>
    <aside>
        <form action="" method="get">
        <div class="input-group">
                <h6>Dashbord Admin</h6>
                <label for="country_aside" class="hide"></label>
                <a href="Admin_EDUCATION\index.php">Dashbord</a>
                <a href="add_formation_form.php">Add Formation</a>
                <a href="">Add Session</a>


            </div>
           
        </form>
    </aside>
    <section>
    <div class="container mt-5">
    <?php
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $alert_type = "success"; // Set the default alert type to "success"
    if (strpos($message, "Erreur") !== false) {
        $alert_type = "danger"; // If the message contains the word "Erreur", set the alert type to "danger"
    }
}
?>
    <div class="container mt-5">
  <div class="row mt-5">
    <div class="col-lg-12 mt-5">
    <h2 class="mb-4">Ajouter un session</h2>
    <?php if (isset($message)) { ?>
                <div class="alert alert-<?php echo $alert_type; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
      <form method="POST" action = "includ/add_session.php">
        <div class="form-group mt-5">
          <label for="date_debut">Date de début:</label>
          <input type="date" class="form-control" id="date_debut" name="date_debut" >
        </div>
        <div class="form-group mt-5">
          <label for="date_fin">Date de fin:</label>
          <input type="date" class="form-control" id="date_fin" name="date_fin" >
        </div>
        <div class="form-group">
          <label for="nombre_places_max">Nombre de places max:</label>
          <input type="number" class="form-control" id="nombre_places_max" name="nombre_places_max" >
        </div>
        <div class="form-group">
          <label for="etat">Etat:</label>
          <select  class="form-control" id="etat" name="etat" >
            <option value="in process of registration">in process of registration</option>
          </select>
        </div>
        <div class="form-group">
          <label for="id_formation">ID Formation:</label>
          <select class="form-control" id="id_formation" name="id_formation" >
            <?php
              include "db/dbconfig.php";
              $sql = "SELECT * FROM formation";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach($formations as $formation){
                echo "<option value='". $formation['id_formation'] ."'>". $formation['id_formation'] ." ". $formation['sujet'] ."</option>";
              }
            ?>
          </select>
        </div>
        <div class="form-group mt-5">
          <label for="id_formateur">ID Formateur:</label>
          <select class="form-control" id="id_formateur" name="id_formateur" >
            <option value="">Sélectionnez une date de début et une date de fin</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary mt-5" id="addBtn" >Ajouter</button>
      </form>
     
    </div>
  </div>
</div>
</div>

<!-- JavaScript and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Initialize the ID Formateur select element
  var idFormateurSelect = $("#id_formateur");

  // Disable the ID Formateur select element and the Ajouter button
  idFormateurSelect.prop("disabled", true);
  $("#addBtn").prop("disabled", true);

  // Add event listeners to the date_debut and date_fin inputs
  $("#date_debut, #date_fin").on("change", function() {
    // Get the selected start and end dates
    var dateDebut = $("#date_debut").val();
    var dateFin = $("#date_fin").val();

    // Send an AJAX request to get the available teachers
    $.ajax({
      url: "get_available_teachers.php",
      type: "POST",
      data: {
        date_debut: dateDebut,
        date_fin: dateFin
      },
      dataType: "json",
      success: function(data) {
        // Clear the ID Formateur select element
        idFormateurSelect.empty();

        // Add the available teachers to the ID Formateur select element
        $.each(data, function(index, formateur) {
            idFormateurSelect.append("<option value='" + formateur.id_formateur + "'>" + formateur.id_formateur + ' ' + formateur.firstname + ' ' + formateur.lastname + "</option>");        });

        // Enable the ID Formateur select element if there are available teachers
        idFormateurSelect.prop("disabled", data.length === 0);

        // Enable the Ajouter button if both start and end dates and ID Formateur are selected
        $("#addBtn").prop("disabled", dateDebut === "" || dateFin === "" || idFormateurSelect.val() === "");
      }
    });
  });

  // Add event listener to the ID Formateur select element
  idFormateurSelect.on("change", function() {
    // Enable the Ajouter button if both start and end dates and ID Formateur are selected
    $("#addBtn").prop("disabled", $("#date_debut").val() === "" || $("#date_fin").val() === "" || $(this).val() === "");
  });
});
</script>
	
    </section>

    </div>
</main>


<script src="Admin_EDUCATION\javascript\script.js"></script>
<script src="Admin_EDUCATION\javascript\dropdrown.js"></script>
</body>
</html>


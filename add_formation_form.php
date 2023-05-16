<?php
include "db/dbconfig.php";
session_start();
?>
<?php


if(isset($_POST["submit"])){
  $sujet = $_POST['sujet'];
  $categorie = $_POST['categorie'];
  $masse_horaire = $_POST['masse_horaire'];
  $description = $_POST['description'];

  if(isset($_FILES['image']) && $_FILES['image']['error'] === 0){
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed_exts = array("jpg", "jpeg", "png", "gif");

    // Check if the uploaded file is an image
    if(in_array($image_ext, $allowed_exts)){
      $image_path = "files/profiles/" . uniqid() . "." . $image_ext;
      move_uploaded_file($image_tmp, $image_path);
    } else {
      echo "Error: The uploaded file is not an image.";
      exit;
    }
  } else {
    echo "Error: No image was uploaded.";
    exit;
  }

  $sql = "INSERT INTO formation (sujet, categorie, masse_horaire, description, image) VALUES (:sujet, :categorie, :masse_horaire, :description, :image)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':sujet', $sujet);
  $stmt->bindParam(':categorie', $categorie);
  $stmt->bindParam(':masse_horaire', $masse_horaire);
  $stmt->bindParam(':description', $description);
  $stmt->bindParam(':image', $image_path);

  if ($stmt->execute()) {
      echo "New formation record created successfully";
  } else {
      echo "Error: " . $stmt->errorInfo()[2];
  }
}
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
                <a href="">Add Formation</a>
                <a href="add_session_form.php">Add Session</a>


            </div>
            
        </form>
    </aside>
    <section>
    <div class="container mt-5">
      <div class="row mt-5">

        <div class="col-lg-12 mt-5">  
        <h2 class="mb-4">Ajouter un formation</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group mt-5">
                <label for="sujet">Sujet:</label>
                <input type="text" class="form-control" id="sujet" name="sujet" required>
                </div>
                <div class="form-group">
                <label for="categorie">Catégorie:</label>
                <input type="text" class="form-control" id="categorie" name="categorie" required>
                </div>
                <div class="form-group">
                <label for="masse_horaire">Masse horaire:</label>
                <input type="text" class="form-control" id="masse_horaire" name="masse_horaire" required>
                </div>
                <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
            </form>
        </div>
    </div>
</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </section>

    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a5fdcae6a3.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

<script src="Admin_EDUCATION\javascript\script.js"></script>
<script src="Admin_EDUCATION\javascript\dropdrown.js"></script>
</body>
</html>
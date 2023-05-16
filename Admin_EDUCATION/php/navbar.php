
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
        <img src='../files/profiles/<?php echo $img ?>' alt="">
        <span><?= $firstname . ' ' . $lastname ?> </span>
    </button>
    <div id="dropdownAvatar"
         class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
            <p class="text-center"><?= $firstname . ' ' . $lastname ?></p>
            <div class="font-medium truncate"><?= $email ?></div>
        </div>
        <a href="../index.php"
           class=" px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Home Page</a>
        <div class="py-2">
            <a href="logout.php"
               class="logout px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                <span>Se déconnecter </span>
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        </div>
    </div>
</div>

<?php
include "../db/dbconfig.php";
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/style.css">
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
    <?php
    include "../php/navbar.php";
    ?>
    <?php
        if(isset($_POST['submit'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // Upload image file to server
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
    
            // Insert new apprenant into the database
            $sql = "INSERT INTO formateur (firstname, lastname, email, password, img) VALUES (:firstname, :lastname, :email, :password, :img)";
            $stmt = $conn->prepare($sql);
    
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':img', $target_file);
    
            $stmt->execute();
    
            header("Location: ../index.php");
            exit();
        }
    ?>
</nav>
<main>
<aside>
        <form action="" method="get">
            <div class="input-group">
                <h6>Dashbord Admin</h6>
                <label for="country_aside" class="hide"></label>
                <a href="../index.php">Dashbord</a>
                <a href="../link_formation.php">Add Formation</a>
                <a href="../link_session.php">Add Session</a>


            </div>
            
        </form>
    </aside>
<section>
<div class="container mt-5">
		<div class="row">
			<div class="col-md-12">
				<h2 class="mb-4">Modifier un formateur</h2>
				<?php
					// Connect to MySQL using PDO
					
					// Get the formateur's information from the database
					$id = $_GET['id'];
					$sql = "SELECT * FROM formateur WHERE id_formateur = :id";
					$stmt = $conn->prepare($sql);
					$stmt->bindParam(':id', $id);
					$stmt->execute();

					$result = $stmt->fetch(PDO::FETCH_ASSOC);


					if (!$result) {
						echo "<p>Cet apprenant n'existe pas.</p>";
					} else {
				?>
				<form action="update.php?id=<?php echo $result['id_formateur']; ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="firstname">Prénom :</label>
						<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo $result['firstname']; ?>" required>
					</div>
					<div class="form-group">
						<label for="lastname">Nom :</label>
						<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo $result['lastname']; ?>" required>
					</div>
					<div class="form-group">
						<label for="email">Email :</label>
						<input type="email" name="email" id="email" class="form-control" value="<?php echo $result['email']; ?>" required>
					</div>
                    <div class="form-group">
						<label for="email">role :</label>
                        <select name="role" id="" >
                            <option value="" >role</option>
                            <option value="user">user</option>
                            <option value="formateur">formateur</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
			

					<div class="form-group">
						<label for="img">Image :</label>
						<input type="file" name="img" id="img" class="form-control-file">
					</div>
                   <br>
					<button type="submit" name="submit" class="btn btn-primary">Modifier</button>
				</form>
				<?php
					}

                    
                      
                    
				?>
			</div>
		</div>
	</div>


</section>
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

<script src="../javascript/script.js"></script>
<script src="../javascript/dropdrown.js"></script>
</body>
</html>
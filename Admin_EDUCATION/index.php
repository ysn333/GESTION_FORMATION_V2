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
    <link rel="stylesheet" href="assets\style.css">
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
    include "php/navbar.php"
    ?>

</nav>
<main>
    <aside>
        <form action="" method="get">
            <div class="input-group">
                <h6>Dashbord Admin</h6>
                <label for="country_aside" class="hide"></label>
                <a href="#">Dashbord</a>
                <a href="../add_formation_form.php">Add Formation</a>
                <a href="../add_session_form.php">Add Session</a>


            </div>
            
        </form>
    </aside>
    <section>
        <?php include 'includ/num.php'; ?>
      <div class="container mt-5">
        <div class="row mt-5">
        <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><i class="fas fa-users"></i> Users</h5>
                <p class="card-text"><?php echo  $new_student_count ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><i class="fas fa-graduation-cap"></i>Successful Students</h5>
                <p class="card-text"><?php echo  $success_count ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><i class="fas fa-award"></i> Awards</h5>
                <p class="card-text"><?php echo  $award_count ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><i class="fas fa-chalkboard-teacher"></i>Teachers</h5>
                <p class="card-text"><?php echo  $teacher_count ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col-md-12">
			<h2 class="mb-4">Liste des apprenants</h2>
			<form action="index.php" method="GET" class="search-form">
				<div class="form-group">
					<label for="search">Rechercher par prénom :</label>
					<input type="text" name="search" id="search" class="form-control" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
				</div>
				<button type="submit" class="btn btn-primary BTNN">Rechercher</button>
			</form>
			<a href="includ/add_apprenant.php" class="btn btn-success mb-5">Ajouter un apprenant</a>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Prénom</th>
						<th>Nom</th>
						<th>Email</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$rows_per_page = 4;

						$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

						$limit = $rows_per_page;
						$offset = ($current_page - 1) * $rows_per_page;

						

						$search = isset($_GET['search']) ? $_GET['search'] : '';
						if (!empty($search)) {
							$sql = "SELECT COUNT(*) AS count FROM apprenant WHERE firstname LIKE :search";
							$stmt = $conn->prepare($sql);
							$stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
						} else {
							$sql = "SELECT COUNT(*) AS count FROM apprenant";
							$stmt = $conn->prepare($sql);
						}
						$stmt->execute();
						$result = $stmt->fetch(PDO::FETCH_ASSOC);
						$total_rows = $result['count'];

						$total_pages = ceil($total_rows / $rows_per_page);

						if (!empty($search)) {
							$sql = "SELECT * FROM apprenant WHERE firstname LIKE :search LIMIT :limit OFFSET :offset";
							$stmt = $conn->prepare($sql);
							$stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
							$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
							$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
						} else {
							$sql = "SELECT * FROM apprenant LIMIT :limit OFFSET :offset";
							$stmt = $conn->prepare($sql);
							$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
							$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
						}
						$stmt->execute();

						$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

						if (count($result) > 0) {
						  // Output data of each row
						  foreach($result as $row) {
						    echo "<tr>";
						    echo "<td>" . $row["id_apprenant"] . "</td>";
						    echo "<td>" . $row["firstname"] . "</td>";
						    echo "<td>" . $row["lastname"] . "</td>";
						    echo "<td>" . $row["email"] . "</td>";
						    echo "<td>" . $row["role"] . "</td>";
						    echo "<td><a href='includ\update_apprenant.php?id=" . $row["id_apprenant"] . "' class='btn btn-primary btn-sm mr-2'>Modifier</a><a href='includ\delete_apprenant.php?id=" . $row["id_apprenant"] . "' class='btn btn-danger btn-sm'>Supprimer</a></td>";
						    echo "</tr>";
						  }
						} else {
						  echo "<tr><td colspan='6'>Aucun apprenant trouvé.</td></tr>";
						}

					?>
				</tbody>
			</table>

            <nav aria-label="Page navigation example">
	<ul class="pagination justify-content-center">
		<?php if ($current_page > 1): ?>
			<li class="page-item"><a class="page-link" href="?page=<?php echo $current_page - 1; ?><?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">Précédent</a></li>
		<?php endif; ?>

		<?php
			// Limit the number of visible links to 7
			$visible_links = 7;
			$start = max(1, $current_page - floor($visible_links / 2));
			$end = min($total_pages, $start + $visible_links - 1);
			$start = max(1, $end - $visible_links + 1);

			for ($i = $start; $i <= $end; $i++):
		?>
			<li class="page-item <?php echo $current_page == $i ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?><?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>"><?php echo $i; ?></a></li>
		<?php endfor; ?>

		<?php if ($current_page < $total_pages): ?>
			<li class="page-item"><a class="page-link" href="?page=<?php echo $current_page + 1; ?><?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">Suivant</a></li>
		<?php endif; ?>
	</ul>
</nav>
		</div>
	</div>
</div>


<div class="container mt-5 mt-5 ">
	<div class="row mt-5">
		<div class="col-md-12  ">
			<h2 class="mb-4 formateur">Liste des formateur</h2>
			<form action="index.php" method="GET" class="search-form">
				<div class="form-group">
					<label for="search">Rechercher par prénom :</label>
					<input type="text" name="search" id="search" class="form-control" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
				</div>
				<button type="submit" class="btn btn-primary BTNN">Rechercher</button>
			</form>
			<a href="formateur\add_formateur.php" class="btn btn-success mb-5">Ajouter un formateur</a>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Prénom</th>
						<th>Nom</th>
						<th>Email</th>
						<th>Role</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$rows_per_page = 4;

						$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

						$limit = $rows_per_page;
						$offset = ($current_page - 1) * $rows_per_page;

						

						$search = isset($_GET['search']) ? $_GET['search'] : '';
						if (!empty($search)) {
							$sql = "SELECT COUNT(*) AS count FROM formateur WHERE firstname LIKE :search";
							$stmt = $conn->prepare($sql);
							$stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
						} else {
							$sql = "SELECT COUNT(*) AS count FROM formateur";
							$stmt = $conn->prepare($sql);
						}
						$stmt->execute();
						$result = $stmt->fetch(PDO::FETCH_ASSOC);
						$total_rows = $result['count'];

						$total_pages = ceil($total_rows / $rows_per_page);

						if (!empty($search)) {
							$sql = "SELECT * FROM formateur WHERE firstname LIKE :search LIMIT :limit OFFSET :offset";
							$stmt = $conn->prepare($sql);
							$stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
							$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
							$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
						} else {
							$sql = "SELECT * FROM formateur LIMIT :limit OFFSET :offset";
							$stmt = $conn->prepare($sql);
							$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
							$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
						}
						$stmt->execute();

						$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

						if (count($result) > 0) {
						  // Output data of each row
						  foreach($result as $row) {
						    echo "<tr>";
						    echo "<td>" . $row["id_formateur"] . "</td>";
						    echo "<td>" . $row["firstname"] . "</td>";
						    echo "<td>" . $row["lastname"] . "</td>";
						    echo "<td>" . $row["email"] . "</td>";
						    echo "<td>" . $row["role"] . "</td>";
						    echo "<td><a href='formateur\update_formateur.php?id=" . $row["id_formateur"] . "' class='btn btn-primary btn-sm mr-2'>Modifier</a><a href='formateur\delete_formateur.php?id=" . $row["id_formateur"] . "' class='btn btn-danger btn-sm'>Supprimer</a></td>";
						    echo "</tr>";
						  }
						} else {
						  echo "<tr><td colspan='6'>Aucun formateur trouvé.</td></tr>";
						}

						$conn = null;
					?>
				</tbody>
			</table>

            <nav aria-label="Page navigation example">
	<ul class="pagination justify-content-center">
		<?php if ($current_page > 1): ?>
			<li class="page-item"><a class="page-link" href="?page=<?php echo $current_page - 1; ?><?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">Précédent</a></li>
		<?php endif; ?>

		<?php
			// Limit the number of visible links to 7
			$visible_links = 7;
			$start = max(1, $current_page - floor($visible_links / 2));
			$end = min($total_pages, $start + $visible_links - 1);
			$start = max(1, $end - $visible_links + 1);

			for ($i = $start; $i <= $end; $i++):
		?>
			<li class="page-item <?php echo $current_page == $i ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?><?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>"><?php echo $i; ?></a></li>
		<?php endfor; ?>

		<?php if ($current_page < $total_pages): ?>
			<li class="page-item"><a class="page-link" href="?page=<?php echo $current_page + 1; ?><?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">Suivant</a></li>
		<?php endif; ?>
	</ul>
</nav>
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

<script src="javascript/script.js"></script>
<script src="javascript/dropdrown.js"></script>
</body>
</html>
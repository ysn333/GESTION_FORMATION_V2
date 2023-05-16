<?php
    // Retrieve data from the database
    $success_count = $conn->query("SELECT COUNT(*) FROM inscription WHERE resultat = 'valid'")->fetchColumn();
    $total_count = $conn->query("SELECT COUNT(*) FROM inscription")->fetchColumn();
    if ($total_count > 0) 
        $success_rate = round(($success_count / $total_count) * 100, 2);
    else ;

    $teacher_count = $conn->query("SELECT COUNT(*) FROM formateur")->fetchColumn();
    $new_student_count = $conn->query("SELECT COUNT(*) FROM apprenant")->fetchColumn();
    $award_count = $conn->query("SELECT COUNT(*) FROM awards")->fetchColumn();

?>
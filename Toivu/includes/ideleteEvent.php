<?php
    session_start();
    include("../config/cconfig.php");

    if(isset($_POST["id"])) {
        $query = "DELETE from wsk21_toivu_calendar WHERE calID=:id, userID=:suser";
        $stmt = $DBH -> prepare($query);
        $stmt -> execute(
            array(
                ':id' => $_POST['id'],
                ':suser' => $_SESSION['suserID']
            )
        );
    }
?>
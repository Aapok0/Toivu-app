<?php
    if(isset($_POST["id"])) {
        $query = "DELETE from wsk21_toivu_calendar WHERE calID=:id, userID=:user";
        $stmt = $DBH -> prepare($query);
        $stmt -> execute(
            array(
                ':id' => $_POST['id'],
                ':user' => $_SESSION['suserID']
            )
        );
    }
?>
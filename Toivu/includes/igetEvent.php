<?php
    $data = array();
    $query = "SELECT * FROM wsk21_toivu_calendar WHERE userID = :suser ORDER BY calID";
    $stmt = $DBH -> prepare($query);
    $stmt -> bindParam(':suser', $session_user);
    $stmt -> execute();
    $result = $stmt -> fetchAll(PDO::FETCH_ASSOC));

    foreach ($result as $row) {
        $data[] = array(
            'id' => $row["calID"],
            'title' => $row["calEvent"],
            'mood' => $row["calMood"],
            'start' => $row["calStart"],
            'end' => $row["calEnd"]
        );
    }
    echo json_encode($data);
?>
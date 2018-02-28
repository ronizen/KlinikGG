<?php

$db_exists = file_exists("daypilot.sqlite");

$db = new PDO('sqlite:daypilot.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// other init
date_default_timezone_set("UTC");


if (!$db_exists) {
    //create the database
    $db->exec("CREATE TABLE doctor (
    doctor_id   INTEGER       PRIMARY KEY AUTOINCREMENT NOT NULL,
    doctor_name VARCHAR (100) NOT NULL
    );");
    
    $db->exec("CREATE TABLE appointment (
    appointment_id              INTEGER       PRIMARY KEY AUTOINCREMENT NOT NULL,
    appointment_start           DATETIME      NOT NULL,
    appointment_end             DATETIME      NOT NULL,
    appointment_patient_name    VARCHAR (100),
    appointment_patient_phone   VARCHAR (100),
    appointment_patient_email   VARCHAR (100),
    appointment_patient_keluhan VARCHAR (100),
    appointment_status          VARCHAR (100) DEFAULT ('free') NOT NULL,
    appointment_patient_session VARCHAR (100),
    doctor_id                   INTEGER       NOT NULL
    );");

    $items = array(
        array('name' => 'dr.Nurul'),
        array('name' => 'dr.Arif'),        
    );
    $insert = "INSERT INTO [doctor] (doctor_name) VALUES (:name)";
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':name', $name);
    foreach ($items as $m) {
      $name = $m['name'];
      $stmt->execute();
    }

}

?>

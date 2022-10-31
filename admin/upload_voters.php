<?php

## Add DatabaseConnection File
require_once('includes/session.php');

    
if(!empty($_FILES["file"]["name"]))
{
     // Allowed mime types
    $allowedFileTypes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );

    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $allowedFileTypes))
    {
 
        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

        // Skip the first line
        fgetcsv($csvFile);

        // Parse data from CSV file line by line
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
        {
            // validate csv data
            $firstname = mysqli_real_escape_string($conn,$getData[0]);
            $lastname = mysqli_real_escape_string($conn,$getData[1]);
            $username = mysqli_real_escape_string($conn, $getData[1]);
            $phone = mysqli_real_escape_string($conn,$getData[3]);
        
            //generate voters id & password
            $set = '12345';
            $voter = substr(str_shuffle($set), 0, 8);
            $password = md5($set);

         
            /** check if voter record already exist in table */ 
            // $check_if_voter_exist = $conn->query("SELECT * FROM `voters` WHERE `firstname` = '{$firstname}' AND `lastname` = '{$lastname}'");
            // if($check_if_voter_exist->num_rows > 0){
            //     echo "voter_exists"; return;
            // } 
        
            // add query 
            $sql = "INSERT INTO `voters` (`voters_id`, `password`, `firstname`, `lastname`) VALUES (?,?,?,?)";

            // prepare sql query statement
            $statement = $conn->prepare($sql);
            $statement->bind_param("ssss", $username, $password, $firstname, $lastname);

            // execute query
            $statement->execute();
                
        }

        fclose($csvFile);
        echo "successful";
        
    } else {
        echo "invalid_file";
    }

} else { echo "empty_file"; }

?>
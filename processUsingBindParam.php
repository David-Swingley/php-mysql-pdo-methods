<?php
session_start();
include('dbcon.php');


//Add Save Contact 
if(isset($_POST['save_contact']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $zip = $_POST['zip'];

    try {

        $query = "INSERT INTO contacts (fullname, email, phone, zip) VALUES (?, ?, ?, ?)";
        $statement = $conn->prepare($query);
        $statement->bindParam(1, $fullname);
        $statement->bindParam(2, $email);
        $statement->bindParam(3, $phone);
        $statement->bindParam(4, $zip);
        $query_execute = $statement->execute();

        if($query_execute)
        {
            $_SESSION['message'] = "Added Successfully";
            header('Location: fetch-data.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Added";
            header('Location: fetch-data.php');
            exit(0);
        }

    } catch (PDOException $e) {

        echo "My Error Type:". $e->getMessage();
    }
}




//Update Contact Info
if(isset($_POST['update_contact']))
{
    $contact_id = $_POST['contact_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $zip = $_POST['zip'];

    try {

        $query = "UPDATE contacts SET fullname=:fullname, email=:emailid, phone=:phoneno, zip=:zip WHERE id=:stud_id LIMIT 1";
        $statement = $conn->prepare($query);
        $statement->bindParam(':fullname', $fullname);
        $statement->bindParam(':emailid', $email);
        $statement->bindParam(':phoneno', $phone);
        $statement->bindParam(':zip', $zip);
        $statement->bindParam(':stud_id', $contact_id, PDO::PARAM_INT);
        $query_execute = $statement->execute();

        if($query_execute)
        {
            $_SESSION['message'] = "Updated Successfully";
            header('Location: fetch-data.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Updated";
            header('Location: fetch-data.php');
            exit(0);
        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

//Delete Contact
if(isset($_POST['delete_contact']))
{
    $contact_id = $_POST['delete_contact'];

    try {

        $query = "DELETE FROM contacts WHERE id=? LIMIT 1";
        $statement = $conn->prepare($query);
        $statement->bindParam(1, $contact_id, PDO::PARAM_INT);
        $query_execute = $statement->execute();

        if($query_execute)
        {
            $_SESSION['message'] = "Deleted Successfully";
            header('Location: fetch-data.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Deleted";
            header('Location: fetch-data.php');
            exit(0);
        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}








?>
<?php
session_start();
include('dbcon.php');


//Add / Save Contact
if(isset($_POST['save_contact_btn']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $zip = $_POST['zip'];

    $query = "INSERT INTO contacts (fullname, email, phone, zip) VALUES (:fullname, :email, :phone, :zip)";
    $query_run = $conn->prepare($query);

    $data = [
        ':fullname' => $fullname,
        ':email' => $email,
        ':phone' => $phone,
        ':zip' => $zip,
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        $_SESSION['message'] = "Inserted Successfully";
        header('Location: add-data.php');
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Not Inserted";
        header('Location: add-data.php');
        exit(0);
    }
}

//Update Contact
if(isset($_POST['update_contact']))
{
    $contactId = $_POST['contactId'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $zip = $_POST['zip'];

    try {

        $query = "UPDATE contacts SET fullname=:fullname, email=:email, phone=:phone, zip=:zip WHERE id=:id LIMIT 1";
        $statement = $conn->prepare($query);

        $data = [
            ':fullname' => $fullname,
            ':email' => $email,
            ':phone' => $phone,
            ':zip' => $zip,
            ':id' => $contactId
            // ':id' => 1
        ];
        $query_execute = $statement->execute($data);

        if($query_execute)
        {
            $_SESSION['message'] = "Updated Successfully";
            //echo"<br />contactId  = $contactId <br /><p>Updated Successfully</p><br />";
            //print_r($data);
            header('Location: fetch-data.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Updated";
              //echo"<br /><p>Not Updated</p><br />";
            header('Location: fetch-data.php');
            exit(0);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

//Delete Contact 
if(isset($_POST['delete_contact']))
{
    $contactId = $_POST['delete_contact'];

    try {

        $query = "DELETE FROM contacts WHERE id=:stud_id";
        $statement = $conn->prepare($query);
        $data = [
            ':stud_id' => $contactId
        ];
        $query_execute = $statement->execute($data);

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

    } catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>
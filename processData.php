<?php
session_start();
include('dbcon.php');

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
            //':id' => $contactId
             ':id' => 1
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

?>
<?php
    include('dbcon.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <title>PHP MySQL Edit & Update Data Using bindParam() Function CRUD</title>
</head>
<body>
    
    <div class="container">
        <div class="row">
  
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4>PHP MySQL Edit & Update Data  Using bindParam() Function 
                            <a href="index.php" class="btn btn-primary float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_GET['id']))
                        {
                            $contact_id = $_GET['id'];

                            $query = "SELECT * FROM contacts WHERE id=? LIMIT 1";
                            $statement = $conn->prepare($query);
                            $statement->bindParam(1, $contact_id, PDO::PARAM_INT);
                            $statement->execute();

                            $data = $statement->fetch(PDO::FETCH_ASSOC);
                            ?>
                            
                            <form action="processUsingBindParam.php" method="POST">

                                <input type="hidden" name="contact_id" value="<?=$data['id'];?>">

                                <div class="mb-3">
                                    <label>Full Name</label>
                                    <input type="text" name="fullname" value="<?=$data['fullname'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Email Id</label>
                                    <input type="email" name="email" value="<?=$data['email'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" value="<?=$data['phone'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Zipcode</label>
                                    <input type="text" name="zip" value="<?=$data['zip'];?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_contact" class="btn btn-primary">Update Contact</button>
                                </div>
                            </form>
                            
                            <?php
                        }
                        else
                        {
                            echo "<h5>No ID Found</h5>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
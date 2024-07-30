<?php  session_start();  include('dbcon.php');  ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >


    <title>PHP MySQL PDO Edit & Update DB</title>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>PHP MySQL PDO Edit & Update DB
                            <a href="fetch-data.php" class="btn btn-danger float-end">Fetch Data</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_GET['id']))
                        {                           
                            $contactId = $_GET['id'];
                            $query = "SELECT * FROM contacts WHERE id=:id LIMIT 1";
                            $statement = $conn->prepare($query);
                            $data = [':id' => $contactId];
                            $statement->execute($data);
                            $result = $statement->fetch(PDO::FETCH_OBJ);
                        }
                        ?>
                        <form action="code.php" method="POST">

                            <input type="hidden" name="contactId" value="<?php  $result->id ?>" />

                            <div class="mb-3">
                                <label>Full Name</label>
                                <input type="text" name="fullname" value="<?= $result->fullname; ?>" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="text" name="email" value="<?= $result->email; ?>" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" value="<?= $result->phone; ?>" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label>Course</label>
                                <input type="text" name="zip" value="<?= $result->zip; ?>" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_contact" class="btn btn-primary">Update Contact</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php 
include('dbcon.php');

/*
CREATE TABLE `contacts` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `fullname` VARCHAR(100) NOT NULL,
   `email` VARCHAR(40) NOT NULL,
  `phone` int(5) NOT NULL,  
  `zip` int(5) NOT NULL, 
  `comment` text DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   `IPV4Address` INT UNSIGNED,
    PRIMARY KEY (id)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

MySQL Insert Statement (07/2024)
INSERT INTO contacts (fullname, email, phone, zip, comment, updated_date, IPV4Address)VALUES('Jame Bond', 'jb007@bond.com', '9497014444', '90270', 'my comments.', '2024-07-24', '127.0.0.1');

 $row->id; 
 $row->fullname;
$row->email; 
 $row->phone; 
$row->zip;

*/
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Fetch data from  database using pdo in php</title>
  </head>
  <body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>PHP MySQL PDO Fetch Data</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Edit</th>
                                    <th>ID</th>                                    
                                    <th>FullName</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Zipcode</th>
                                     <th><a class="btn btn-primary btn-sm" href="add-data.php" role="button">Add Contact</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM contacts";
                                    $statement = $conn->prepare($query);
                                    $statement->execute();

                                    $statement->setFetchMode(PDO::FETCH_OBJ); //PDO::FETCH_ASSOC
                                    $result = $statement->fetchAll();
                                    if($result)
                                    {
                                        foreach($result as $row)
                                        {
                                            ?>
                                            <tr>
                                             <td><a href="edit-data.php?id=<?= $row->id; ?>" title="Edit <?= $row->fullname; ?>">Edit</a></td>
                                                <td><?= $row->id; ?></td>
                                                <td><?= $row->fullname; ?></td>
                                                <td><?= $row->email; ?></td>
                                                <td><?= $row->phone; ?></td>
                                                <td><?= $row->zip; ?></td>
                                                <td><form action="processData.php" method="POST"><button type="submit" name="delete_contact" value="<?=$row->id;?>" class="btn btn-danger">Delete</button></form></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="5">No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
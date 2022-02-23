<?php
// php variable to store data of database connection
$server ="localhost";
$user ="root";
$password ="";
$database ="phpsinglepage";

// connection string
$conn = mysqli_connect($server, $user, $password, $database);


// add new info ( create )
if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($conn, strip_tags($_POST['name']));
    $email=mysqli_real_escape_string($conn, strip_tags($_POST['email']));
    $contact=mysqli_real_escape_string($conn, strip_tags($_POST['contact']));
    $house_number=mysqli_real_escape_string($conn, strip_tags($_POST['house_number']));
    $place_of_birth=mysqli_real_escape_string($conn, strip_tags($_POST['place_of_birth']));
    
    $insert="INSERT INTO crud (name, email, contact, house_number, place_of_birth) VALUES('$name', '$email', '$contact', '$house_number', '$place_of_birth' )";
   $result=mysqli_query($conn, $insert);
   if($result=mysqli_query($conn, $insert)){ ?>
         <script>window.location="index.php"</script> 
        <?php
    }
}

// Delete user (Delete)
if(isset($_GET['deleteid'])){
    $delete_sql="DELETE FROM crud WHERE id='$_GET[deleteid]'";
   if( $result=mysqli_query($conn, $delete_sql)){   ?>
         <script>window.location="index.php"</script>
        <?php
   }
}

//edit alread exist user (Update)
if(isset($_POST['doneedit'])){
    $edit_name=mysqli_real_escape_string($conn, strip_tags($_POST['edit_name']));
    $edit_email=mysqli_real_escape_string($conn, strip_tags($_POST['edit_email']));
    $edit_contact=mysqli_real_escape_string($conn, strip_tags($_POST['edit_contact']));
    $edit_house_number=mysqli_real_escape_string($conn, strip_tags($_POST['edit_house_number']));
    $edit_place_of_birth=mysqli_real_escape_string($conn, strip_tags($_POST['edit_place_of_birth']));
    $editidf=mysqli_real_escape_string($conn, strip_tags($_POST['edit_id_edit']));
    $edit_sql="UPDATE crud SET name= '$edit_name', email='$edit_email', contact='$edit_contact', house_number='$edit_house_number', place_of_birth='$edit_place_of_birth' WHERE id=$editidf";
    if( $result=mysqli_query($conn, $edit_sql)){   ?>
        <script>window.location="index.php"</script>
       <?php
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <h2>PHP single CRUD</h2>
        <?php

        // retrive data from database (Read)
        if(isset($_GET['editid'])){ 
            $edit_sql="SELECT * FROM crud WHERE id='$_GET[editid]'";
            $result=mysqli_query($conn, $edit_sql);
            while($rows=mysqli_fetch_assoc($result)){
                $name= $rows['name'];
                $email= $rows['email'];
                $contact= $rows['contact'];
                $house_number= $rows['house_number'];
                $place_of_birth= $rows['place_of_birth'];
            }
            ?>
            <form action="index.php" method="post" class="col-md-6 ">
                <div class="form-group my-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="edit_name" value="<?php echo $name ?>"required="true">
                </div>
                <div class="form-group my-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="edit_email" value="<?php echo $email ?>"required="true">
                </div>
                <div class="form-group my-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="number" class="form-control" name="edit_contact" value="<?php echo $contact ?>"required="true">
                </div>
                <div class="form-group my-3">
                    <label for="house_number" class="form-label">House Number</label>
                    <input type="text" class="form-control" name="edit_house_number" value="<?php echo $house_number ?>" required="true">
                </div>
                <div class="form-group my-3">
                    <label for="place_of_birth" class="form-label">Place of Birth</label>
                    <input type="text" class="form-control" name="edit_place_of_birth" value="<?php echo $place_of_birth ?>" required="true">
                </div>
                <div class="form-group">
                    <input type="hidden" value="<?php echo $_GET['editid'] ?>" name="edit_id_edit"class="btn btn-primary">
                    <input type="submit" value="Done Edit" name="doneedit"class="btn btn-primary">
                </div>
            </form>
            <?php
        } else{ ?>
            <form action="index.php" method="post" class="col-md-6 ">
                <div class="form-group my-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required="true">
                </div>
                <div class="form-group my-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required="true">
                </div>
                <div class="form-group my-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="number" class="form-control" name="contact" required="true">
                </div>
                <div class="form-group my-3">
                    <label for="house_number" class="form-label">House Number</label>
                    <input type="text" class="form-control" name="house_number" required="true">
                </div>
                <div class="form-group my-3">
                    <label for="place_of_birth" class="form-label">Place of Birth</label>
                    <input type="text" class="form-control" name="place_of_birth" required="true">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit"class="btn btn-primary">
                </div>
            </form>
            <?php
        }

        $select_sql="SELECT * FROM crud";
        $result=mysqli_query($conn, $select_sql);
        echo "
        <table class='table table-striped-color table-hover-color'>
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>House Number</th>
                    <th>Place Of Birth</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody> 
        ";
        $c=1;
        while($rows=mysqli_fetch_assoc($result)){
            echo "
                <tr>
                    <td>$c</td>
                    <td>$rows[name]</td>
                    <td>$rows[email]</td>
                    <td>$rows[contact]</td>
                    <td>$rows[house_number]</td>
                    <td>$rows[place_of_birth]</td>
                    <td><a href='index.php?editid=$rows[id]' class='btn btn-success'>Edit</a></td>
                    <td><a href='index.php?deleteid=$rows[id]' class='btn btn-danger'>Delete</a></td>
                    <br>
                </tr>
        ";
        $c++;
        }
        echo "
            </tbody>
        </table>
        ";
        ?> 
</body>
</html>
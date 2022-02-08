<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">     
  </head>
  <body>
    <div class="container my-4">
      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">Sno.</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Gender</th>
            <th scope="col">Courses</th>
            <th scope="col">States</th>
            <th scope="col">Address</th>
            <th scope="col">Profile Picture</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php

              include("conn.php");

              $sql = "SELECT * FROM `list`";
              $result = mysqli_query($conn, $sql); 
            
              $sno=0;
              while($row = mysqli_fetch_assoc($result)){ 
                $id=$row['sno'];
                $name=$row['name'];
                $email=$row['email'];
                $phone=$row['phone'];
                $gender=$row['gender'];
                $courses=$row['courses'];
                $states=$row['states'];
                $address=$row['address'];
                
                $sno = $sno + 1;
                
                echo "<tr>
                  <td scope='row'>". $sno . "</td>
                  <td>". $name . "</td>
                  <td>". $email . "</td>
                  <td>". $phone . "</td>
                  <td>". $gender . "</td>
                  <td>". $courses . "</td>
                  <td>". $states . "</td>
                  <td>". $address . "</td>
                  <td><img src='$row[image]' width='150px' height='100px'></td>
                  <td> <div class='btn-group'>
                    <a class='btn btn-secondary' href='form1.php?updateid=". $id . "'>Update</a>
                    <a class='btn btn-danger' href='delete.php?deleteid=". $id . "'>Delete</a></td>
                </tr>";
              }
            ?>
        </tbody>
      </table>
    </div>
    <hr> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>$(document).ready( function () {
          $('#myTable').DataTable();
          } );
    </script>
  </body>
</html>
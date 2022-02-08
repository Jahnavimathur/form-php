<?php  
  include("conn.php");
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
   // echo "<pre>";print_r($_POST);die;
    $my_id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    if(isset($_POST['courses'])){
      $courses = $_POST["courses"];
      $check = implode(",", $courses);
    }else{
      $check = '';
    }   

    if(isset($_POST['gender'])){
      $gender = $_POST["gender"];
    }else{
      $gender = '';
    }
    
    /* echo $gender.'<br>';
    echo $check;die; */
    //echo $check;die;

    $states = $_POST["states"];
    $address = $_POST["address"];
    if(isset($_FILES['image'])){$image = $_FILES['image'];
      print_r($_FILES['image']);

      $img_name = $_FILES['image']['name'];
      $extension = pathinfo($img_name, PATHINFO_EXTENSION);

      $randomno = rand(0, 100000);
      $rename = 'Upload'.date('Ymd').$randomno;
      echo $newname = $rename.'.'.$extension;
      $img_loc = $_FILES['image']['tmp_name'];
      $img_des = "uploadImage/".$img_name;
      $img = move_uploaded_file($img_loc, 'uploadImage/'. $img_name); 
    }
    //echo "<pre>";print_r($img);die;

    if($my_id == ""){
      $sql = "INSERT INTO `list` (`name`, `email`, `phone`, `gender`, `courses`, `states`, `address`, `image`) VALUES ('$name', '$email', '$phone', '$gender', '$check', '$states', '$address', '$img_des')";   
      $result = mysqli_query($conn, $sql);
      if($result){
        echo "The record was inserted successfully";
        header("Location: list.php");
      }else{
        echo "The record was not inserted successfully because of " . mysqli_error($conn);
      }
    }else{
      $updatequery = "UPDATE `list` SET `name`='$name',`email`='$email',`phone`='$phone', `gender`='$gender', `courses`='$check', `states`='$states', `address`='$address', `image`='$img_des' WHERE sno = $my_id ";
      //echo $updatequery;die;
      $result= mysqli_query($conn, $updatequery);
      if($result){
        echo "record inserted";
        header("Location: list.php");
        
      }else{
        echo "The record was not inserted successfully because of " . mysqli_error($conn);
      }
    }  
  }

  if(isset($_GET['updateid'])){
    $id = $_GET['updateid'];
    $result_new = mysqli_query($conn, "SELECT * FROM list WHERE sno=$id");    
   /*  print_r($row);die; */
   
    while($row = mysqli_fetch_assoc($result_new)){
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];         
        $gender = $row['gender'];
        $courses = $row['courses'];       
        $states = $row['states'];
        $address = $row['address'];  
        if(isset($_FILES['image'])){$image = $_FILES['image'];
          print_r($_FILES['image']);
          $img_loc = $_FILES['image']['tmp_name'];
          $img_name = $_FILES['image']['name'];
          $img_des = "uploadImage/".$img_name;
          $img = move_uploaded_file($img_loc, 'uploadImage/'. $img_name); 
        }    
    }
    $courses = explode(",",$courses);
    //echo "<pre>";print_r($img);die;
   /*  echo $name;die; */
  }  
?>



<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
  </head>
  <body>
    <h3>Form</h3>
    <div>
      <form action="form1.php" id="your-form" name="myForm" onSubmit= "return validateForm()"  method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php if(isset($id)){ echo $id; } ?>">
        <label for="name">Name</label>
        <input type="text" class="msg" id="form" name="name" value="<?php if(isset($name)){ echo $name; } ?>" placeholder="Your name.."><br>

        <label for="email">Email</label>
        <input type="text" id="form" name="email" value="<?php if(isset($email)){ echo $email; } ?>" placeholder="Your email.."><br>

        <label for="phone">Phone Number</label>
        <input type="tel" id="form" name="phone" value="<?php if(isset($phone)){ echo $phone; } ?>" placeholder="Your Phone Number.."><br>

        <label for="password">Password</label>
        <input type="password" id="form" class="password" name="password" placeholder="Your Password.." ><br>

        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="form" class="confirm-password" name="confirm-password" placeholder="Confirm Your Password.."><br>

        <p>Please select your gender:</p>
          <input type="radio" id="male" name="gender" value="male" <?php  if(isset($gender)){if($gender == 'male'){echo "checked";}} ?>>
          <label for="male">Male</label><br>
          <input type="radio" id="female" name="gender" value="female" <?php  if(isset($gender)){if($gender == 'female'){echo "checked";}} ?>>
          <label for="female">Female</label><br>
          <input type="radio" id="others" name="gender" value="others" <?php  if(isset($gender)){if($gender == 'others'){echo "checked";}} ?>>
          <label for="others">Others</label>

        <p>Please select your courses:</p>
          <input type="checkbox" id="php" name="courses[]" value="php"<?php if(isset ($courses)) {if(in_array("php", $courses)){echo "checked";}} ?>>
          <label for="php">PHP</label><br>
          <input type="checkbox" id="android" name="courses[]" value="android"<?php if(isset ($courses)) {if(in_array("android", $courses)){echo "checked";}} ?>>
          <label for="android">Android</label><br>
          <input type="checkbox" id="python" name="courses[]" value="python"<?php if(isset ($courses)) {if(in_array("python", $courses)){echo "checked";}} ?>>
          <label for="python">Python</label><br>
          <input type="checkbox" id="java" name="courses[]" value="java"<?php if(isset ($courses)) {if(in_array("java", $courses)){echo "checked";}} ?>>
          <label for="java">JAVA</label><br><br>
        
        <p>Select state:</p>
          <select name="states" id="states">
          <option value="">Select Your State</option>
          <option value="Bihar" <?php if(isset ($states)) {if($states =='Bihar'){echo "selected";}} ?>>Bihar</option>
          <option value="Rajasthan" <?php if(isset ($states)) {if($states =='Rajasthan'){echo "selected";}} ?>>Rajasthan</option>
          <option value="UP" <?php if(isset ($states)) {if($states =='UP'){echo "selected";}} ?>>UP</option>
          <option value="Maharashtra" <?php if(isset ($states)) {if($states =='Maharashtra'){echo "selected";}} ?>>Maharashtra</option>
          </select><br><br>

        <p>Permanent Address:</p>
          <textarea id="form" name="address" placeholder="Your address here.."><?php if(isset($address)){ echo $address; } ?>
          </textarea><br>

        <label for="">Profile Picture</label>
        <input type="file" id="" name="image" value="image"><img src="<?php if(isset($image)){ echo $image; } ?>" alt="">

        <input type="submit" value="Submit">
      </form>
    </div>
      
    
  

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
<script>

function validateForm(msg) {
  document.getElementByClass("msg").innerHTML = "Message";
  return false;
}
</script>

    
      
        
    
  </body>
</html>
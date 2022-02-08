<?php


  include("conn.php");

   $name = $email = $password = $gender = $courses = "";

  if( $_SERVER["REQUEST_METHOD"] == "POST"){

   // echo "<pre>";print_r($_POST);die;

   /* $name = clean_input($_POST['name']);
    $email = clean_input($_POST['email']);
    $password = clean_input($_POST['password']);
    $gender = clean_input($_POST['gender']);
    $courses = clean_input($_POST['courses']);
   
    

    
    if(isset($name) && $name != "" ){

      }else{
        echo "You must fill the name";
    }   */
   
    if(isset($_POST['courses']) && $_POST['courses']!="")
    {
    echo 'checkbox is checked'; 
    }else{
      echo 'you need to check atleast one course';
    }
  } 
  



  $nameErr = $emailErr = $phoneErr = $passwordErr = $genderErr = "";
  $name = $email = $phone = $password = $gender = "";

  $valid = true;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $valid=false;
      $nameErr = "*Name is required";
    } /* else {  
      $name = input_data($_POST["name"]);  
          // check if name only contains letters and whitespace  
          if (!preg_match("/^[a-zA-Z ]*$/",$name)) {  
          $nameErr = "Only alphabets and white space are allowed";  
          }
    } */
    // echo $name;die;
    
    if (empty($_POST["email"])) {
      $valid=false;
      $emailErr = "*Email is required";
    } 
    if (empty($_POST["phone"])) {
      $valid=false;
      $phoneErr = "*Phone is required";
    } 
    if (empty($_POST["password"])) {
      $valid=false;
      $passwordErr = "*Password is required";
    } 
    if (empty($_POST["gender"])) {
      $valid=false;
      $genderErr = "*Gender is required";
    } 
    /*if(isset($_POST["courses"])){
      $checkedcourses = 0;
      $values = $_POST["courses"];
  
      $checkedcourses = count($values);
  
      if ($checkedcourses < 1){
        $courseserror = "*You need to check atleast one course";
      }
    } */
    
    
    if($valid){
      header('location:form.php');
      exit();
    }
  }

  function clean_input($field){
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    return $field;
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
  </head>
  <body>
    <h3>Form</h3>

    <div>
      <form action="form.php" method="post">
        <label for="name">Name</label>
        <input type="text" id="form" name="name" placeholder="Your name.."><span  class="error"> <?php echo $nameErr;?></span>
          <br><br>

        <label for="email">Email</label>
        <input type="email" id="form" name="email" placeholder="Your email.."><span class="error"> <?php echo $emailErr;?></span>
         <br><br>

        <label for="phone">Phone Number</label>
        <input type="tel" id="form" name="phone" placeholder="Your Phone Number.."><span class="error"> <?php echo $phoneErr;?></span>
         <br><br>

        <label for="password">Password</label>
        <input type="password" id="form" name="password" placeholder="Your password.."><span class="error"> <?php echo $passwordErr;?></span>
         <br><br>
        
        <p>Please select your gender:</p>
        <input type="radio" id="male" name="gender" value="Male">
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="Female">
        <label for="female">Female</label><br>
        <input type="radio" id="others" name="gender" value="others">
        <label for="others">Others</label><br>
        <span class="error"> <?php echo $genderErr;?></span>
         <br><br>

        <p>Please select your courses:</p>
        <input type="checkbox" id="php" name="courses[]" value="php">
            <label for="php">PHP</label><br>
            <input type="checkbox" id="android" name="courses[]" value="android">
            <label for="android">Android</label><br>
            <input type="checkbox" id="python" name="courses[]" value="python">
            <label for="python">Python</label><br>
            <input type="checkbox" id="java" name="courses[]" value="java">
            <label for="java">JAVA</label><br><br>
            <!-- <span class="error"> <?php if(isset($courseserror)){ echo $courseserror;} ?> </span>  
            <br><br> -->
        
        <input type="submit" name="submit" value="Submit">
      </form>
    </div>
  </body>
</html>
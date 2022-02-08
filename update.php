<?php  
   include("conn.php");
    
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $email =$_POST['email'];
        $phone =$_POST['phone'];
        $gender = $_POST['gender'];
        $courses=$_POST['courses'];
        $states=$_POST['states'];
        $address=$_POST['address'];
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
        $sql = 	"UPDATE list SET name='$name',email='$email',phone='$phone', gender='$gender', courses='$courses', states='$states', address='$address', image='$img_des' WHERE sno=$id";
        $result = mysqli_query($conn, $sql);
        
        if($result)
        {
            header("location:list.php");
        }
        else
        {
            echo ' Please Check Your Query ';
        }
    }
    else{
        header("location:list.php");
    }   
?>
<?php 

include 'db.php';
$email = $title = $ingredients = "";
$errors = array('email'=>'' , 'title'=>'', 'ingredients'=>'');




if(isset($_POST['submit'])) {
  
    $email = htmlentities($_POST['email']);
    $title = htmlspecialchars($_POST['title']);
    $ingredients = htmlentities($_POST['ingredients']);

    //check email
    if(empty($_POST['email'])) {
        $errors['email'] = 'Email field is required';
    }else {
     
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           $errors['email'] = 'Email must be valid !';
        }
    }

        //check title
    if(empty($_POST['title'])) {
        $errors['title'] = 'Title field is required';
    }else {
       
        if(!preg_match('/^[a-zA-Z\s]+$/',$title)) {
            $errors['title'] = 'Title must contain letter and spaces only !';
        }
    }

        //check ingredients
    if(empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'Ingredients field is required';
    }else {
      
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)) {
            $errors['ingredients'] = 'Ingredients must be a comma separated list !';
        }
    }

        if(array_filter($errors)) {
            //echo 'Error 404';
        }else {
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $title = mysqli_real_escape_string($conn,$_POST['title']);
            $ingredients = mysqli_real_escape_string($conn,$_POST['ingredients']);

            //write query
            $queryadd = "INSERT INTO pizzas (title,ingredients,email) VALUES ('$title','$ingredients','$email')";

            //save to db and check
            if(mysqli_query($conn, $queryadd)) {
               // success 
               $_SESSION['message'] = "Pizza added Successfully! ";
               $_SESSION['msg_type'] = "blue-text";
               header("location:index.php");
               
            }else {
                //failed 

                echo 'query error:' . mysqli_error($conn);
            }

          
        }

}


?>

<?php include 'templates/header.php'; ?>
    
 <section class="container grey-text">
<h4 class="center">Add a Pizza</h4>
<form action="add.php" class="white" method="POST">
    <label for="email">Your Email:</label>
    <input type="text" name="email" value="<?php echo $email?>">
    <div class="red-text"><?php echo $errors['email'] ?></div>
   

    <label for="title">Pizza Title:</label>
    <input type="text" name="title" value="<?php echo $title?>">
    <div class="red-text"><?php echo $errors['title'] ?></div>


    <label for="ingredients">Ingredients (comma separated):</label>
    <input type="text" name="ingredients" value="<?php echo $ingredients?>">
    <div class="red-text"><?php echo $errors['ingredients'] ?></div>


    <div class="center">
    <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
    </div>
  
</form>
 </section>

<?php include 'templates/footer.php'; ?>
    

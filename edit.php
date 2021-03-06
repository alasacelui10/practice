<?php

include 'db.php';

$utitle = $uemail = $uingredients = '';
$errors = array('uemail'=>'' , 'utitle'=>'', 'uingredients'=>'');

if(isset($_GET['id'])) {

    $id = mysqli_real_escape_string($conn,$_GET['id']);

    //write query

    $querypdetails = "SELECT * FROM pizzas WHERE id = $id";

    // make a query to show the result  in the webpage

    $result = mysqli_query($conn, $querypdetails);

    // fetch result/row in an array format

    $pizza = mysqli_fetch_assoc($result);

    // free result

    mysqli_free_result($result);

    //close connection
    mysqli_close($conn);
}

if(isset($_GET['id'])){
    

        if (isset($_POST['update']))  {
        //$updateID = mysqli_real_escape_string($conn, $_GET['id']);
        //$id = htmlentities($_POST['id']);

    
                // if there is no error then its time to save to database
            

                    $fetched_id = $_GET['id'];
                    // $id = mysqli_real_escape_string($conn,$_POST['uid']);
                    // $utitle = mysqli_real_escape_string($conn,$_POST['utitle']);
                    // $uemail = mysqli_real_escape_string($conn,$_POST['uemail']);
                    // $uingredients = mysqli_real_escape_string($conn,$_POST['uingredients']);
                    
                    $utitle = $_POST['utitle'];
                    $uemail = $_POST['uemail'];
                    $uingredients = $_POST['uingredients'];
                    
                    //write query 
            
                    $queryupdate = "UPDATE pizzas SET title='$utitle', email = '$uemail', ingredients ='$uingredients' WHERE id = '$fetched_id'"; 
                    //session
                    $_SESSION['message'] = "Pizza Updated Successfully !";
                    $_SESSION['msg_type'] = 'green-text';
                        
                    // make update query 
        
                    if(mysqli_query($conn, $queryupdate)){
                        header("location:index.php");
                    
                    }else {
                        echo 'error update' . mysqli_error($conn);
                    }
                }
            

            }



?>



<?php include 'templates/header.php'; ?>

<section class="container grey-text">
<h4 class="center">Update a Pizza</h4>

<?php if(isset($_GET['id'])): ?>
    
<p class="center">ID Number - <?php echo $pizza['id'] ?></p>
<?php endif ?>
<form action="" class="white" method="POST">
    <label for="email">Your Email:</label>
    <input type="text" name="uemail" value="<?php ?>"">
    <div class="red-text"> <?php echo $errors['uemail'] ?></div>
   

    <label for="title">Pizza Title:</label>
    <input type="text" name="utitle" value="<?php ?>"> <div class="red-text"> <?php echo $errors['utitle'] ?></div>
   
    


    <label for="ingredients">Ingredients (comma separated):</label>
    <input type="text" name="uingredients" value="<?php ?>"> <div class="red-text"> <?php echo $errors['uingredients'] ?></div>
   
  


    <div class="center">
    <!-- <input type="hidden" name="uid" value="<?php echo $pizza['id'] ?>"> -->
    <input type="submit" name="update" value="Update" class="btn brand z-depth-0"> <!-- update button -->
    </div>
  
</form>
 </section>



<?php include 'templates/footer.php'; ?>
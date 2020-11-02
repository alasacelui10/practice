<?php 

include 'db.php';


if(isset($_POST['delete'])) {

    $deleteID = mysqli_real_escape_string($conn, $_POST['deleteID']);

    //write delete query

    $querydelete = "DELETE FROM pizzas WHERE id = $deleteID";

    // make a query

    if(mysqli_query($conn, $querydelete)) {
        //success
        $_SESSION['message'] = 'Pizza deleted successfully! ';
        $_SESSION['msg_type'] = 'red-text';
        header("location:index.php");
    }else {
        //failure
        echo 'Error connection !' .mysqli_error($conn);
    }

  

}





//check GET REQUEST id Params 
if(isset($_GET['id'])) {

    $id = mysqli_real_escape_string($conn,$_GET['id']);

    //write a sql query per pizza

    $querypdetails = "SELECT * FROM pizzas WHERE id = $id";

    // make a query and get result

    $result = mysqli_query($conn, $querypdetails);

    // fetch one row/ result in an array 

   $pizza = mysqli_fetch_assoc($result);

    //free result 

    mysqli_free_result($result);

    //close connection

    mysqli_close($conn);

}


?>



<?php include 'templates/header.php'; ?>
<div class="container center">
    <?php if($pizza): ?>

    <h4><?php echo htmlentities($pizza['title']); ?></h4>
    <p>Created by: <?php echo htmlentities($pizza['email']);?></p>
    <p><?php echo date($pizza['created_at']);?></p>
    <p><?php echo htmlentities($pizza['ingredients'])?></p>
    <!-- Delete Form -->
    <form action="details.php" method="POST">
        <input type="hidden" name="deleteID" value="<?php echo $pizza['id'] ?>">
        <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
       <a href="edit.php?id=<?php echo $pizza['id'] ?>" class="btn brand z-depth-0">Edit Pizza</a>
    </form>

    <?php else: ?>

     <h4 class="red-text">ERROR 404 PAGE DOES NOT EXIST !!!!!!!!!!!!!!!!!</h4>

    <?php endif ?>
</div>

<?php include 'templates/footer.php'; ?>
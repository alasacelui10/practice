<?php 

include 'db.php';
 // write query for all pizzas

 $queryselect = 'SELECT title , ingredients , id FROM pizzas ORDER BY created_at';

 // make query and get result

 $result = mysqli_query($conn, $queryselect);

 // fetch the resulting rows as an array

 $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

 // free the result from the memory
mysqli_free_result($result);

// close the connection
mysqli_close($conn);

//  print_r($pizzas);


?>


<?php include 'templates/header.php'; ?>
<?php if(isset($_SESSION['message'])) : ?>
<div class="center card-panel <?php echo $_SESSION['msg_type']?>">

    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>

</div>
 <?php endif ?>
  <h4 class="center grey-text">Pizzas!</h4>
  <div class="container">
    <div class="row">
    
    <?php foreach($pizzas as $pizza) : ?>

      <div class="col s6 md3">
      <div class="card z-depth-0">
        <img src="img/pizza.svg" alt="" class="pizza">
      <div class="card-content center">
        <h6><?php echo htmlentities($pizza['title']) ?></h6>
        <ul>
        <?php foreach(explode(',',$pizza['ingredients']) as $ingredients ) : ?>
            <li><?php echo htmlentities($ingredients); ?></li>
        <?php endforeach ?>
        </ul>
      </div>

      <div class="card-action right-align">
      <a href="details.php?id=<?php echo $pizza['id']?>" class="brand-text">more info</a>
      </div>

      </div>
      </div>

    <?php endforeach ?>
    </div>
  </div>  


<?php include 'templates/footer.php'; ?>
    

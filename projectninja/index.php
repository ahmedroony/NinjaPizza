<?php
    include('config/db_connect.php');
    $sql = 'SELECT id,title,ingredients FROM pizza';
    //make query & get result
    $result = mysqli_query($conn,$sql);
    //fetch the resulting rows as an array
    $pizzas = mysqli_fetch_all($result,MYSQLI_ASSOC);
    //free result from memory
    mysqli_free_result($result);
    //close connection
    mysqli_close($conn);
    // print_r(explode(',', $pizzas[0]['ingredients']));
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php')?> 
    <h4 class="center"></h4>
    <div class="container">
        <div class="row">
            <?php
                foreach($pizzas as $pizza):?>
                    <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizza['title']);?></h6>
                            <ul>
                                <?php foreach(explode(',', $pizza['ingredients']) as $ing):?>
                                      <li><?php echo htmlspecialchars($ing)?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action right-align"></div>
                        <a href="#" class="brand-text">more info</a>
                    </div>
                </div>
        </div>
        <?php endforeach;?>
        <?php if(count($pizzas) >=1 ){;?>
          <p>you have more then 1 </p>
        <?php }else { ?>
        <?php }?>  
    </div>
    <?php include('templates/footer.php')?> 
</html>

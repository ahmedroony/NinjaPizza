<?php
// if(isset($_GET['submit'])){
//     echo $_GET['email'];
//     echo $_GET['title'];
//     echo $_GET['ingredients'];
// }
include('config/db_connect.php');

$title=$email=$ingredients='';

$errors = array('email'=>'','title'=>'','ingredients'=>''); //dynamic error
if(isset( $_POST['submit'])){
    if(empty($_POST['email'])){
        $errors['email'] = 'email is required <br/> ';
    } else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'the email is not vailed adders';
        }
    }
    if(empty($_POST['title'])){
        $errors['title'] = 'title is required <br /> ';
    }else{
        $title = $_POST['title'];
        //int preg_match( $pattern, $input, $matches, $flags, $offset )
        if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
            $errors['title'] = 'title is required <br />';
        }
    }
    if(empty($_POST['ingredients']) ){
        $errors['ingredients'] = 'ingredients is required <br /> ';
    }else{
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients'] = 'ingredients must be letters nad spaces only';
        }
    }


    if(array_filter($errors)){//filter the error
         echo 'its not vaild';
    }else{
        //create new record in database / sql
        $sql = "INSERT INTO pizza (email,title,ingredients)
        VALUES ('$title','$email','$ingredients')";
    }
    if(mysqli_query($conn,$sql)){
        //success
        header('location:index.php');
    }else{
        //error
        echo 'my sql error' . mysqli_error($conn,$sql);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php')?> 
    <section class="container grey-text">
        <h4 class="center">add a pizza</h4>
        <form action="" class="white" method="POST">
            <label for="">your email</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
            <div class="red-text"><?php echo $errors['email'];?></div>

            <label for="">pizza title:</label>
            <input type="text" name="title"value="<?php echo htmlspecialchars($title)?>">
            <div class="red-text"><?php echo $errors['title'];?></div>

            <label for="">ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
            <div class="red-text"><?php echo $errors['ingredients']?></div>


            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include('templates/footer.php')?> 
</html>
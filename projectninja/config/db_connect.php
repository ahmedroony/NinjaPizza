    <?php
        $conn = mysqli_connect('localhost','ahmed','test','pizzas');
        //check the connection
        if(!$conn){
            echo 'connection error' . mysqli_connect_error();
        }
    ?>

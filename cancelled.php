<?php
    include('functions.php');
    $order_ID = $_GET['order_ID'];
    $query = "select * from `orders` where `order_ID` = '$order_ID'; ";
    if(count(fetchAll($query)) > 0){
        foreach(fetchAll($query) as $row){
           
           
            $F_ID = $row['F_ID'];
            $foodname = $row['foodname'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $order_date = $row['order_date'];
            $username = $row['username'];
            $R_ID = $row['R_ID'];
            $status = $row['status'];



            $query = "INSERT INTO `past_orders` (`order_ID`, `F_ID`, `foodname`, `price`, `quantity`, `order_date`, `username`, `R_ID`, `status`)  VALUES ('$order_ID', '$F_ID', '$foodname', '$price', '$quantity', '$order_date', '$username', '$R_ID'
            ,'cancelled');";
        }


        $query .= "DELETE FROM `orders` WHERE `orders`.`order_ID` = '$order_ID';";
        if(performQuery($query)){
            
            echo '<script>alert("Order is cancelled.")</script>';
          echo "<script> window.location.href = 'merchant_view_order.php';</script>";
        }else{
            echo "Unknown error occured. Please try again.";
        }
    }else{
        echo "Error occured.";
    }
    
?>

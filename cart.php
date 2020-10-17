<?php include 'config.php'; ?>
<?php include 'header.php'; ?>

<?php // echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';
$total;
$carttotal;
$errors=array();
if (isset($_GET['check'])) {
  $userid=2;
  foreach ($_SESSION as $key=>$val) {
      if ($key=='userdata' or $key=='productpop') {
          continue;
      }




      $products_array=json_encode($val);
      foreach ($val as $k=>$v) {
        if ($k=='gtotal') {
          global $carttotal;
            //$_SESSION[$key][$k]=$total;
            $carttotal=$_SESSION[$key][$k];
        }
    }

      //var_dump($serialized_array); // gives back a string, perfectly for db saving!
          //var_dump($unserialized_array);
          // gives back the array again

  }
  $date = date('Y-m-d H:i:s');
  $status='Success';

  if (sizeof($errors)==0) {
      global $total,$carttotal;

      $sql = "INSERT INTO orders(`userid`, `cartdata`, `datetime`, `carttotal`,`status`) VALUES('".$userid."', '".$products_array."', '".$date."', '".$carttotal."', '".$status."'  )" ;

      if ($conn->query($sql) === true) {
          echo "<h2>Cart data saved successfully Thank You!!!!</h2>";
      } else {
          $errors[] = array('input'=>'form','msg'=>$conn->error);
      }
      $conn->close();
  }

}


foreach ($_SESSION as $key1=>$val1) {
    if ($key1=='userdata' or $key1=='productpop') {
        continue;
    }
    if (isset($_GET['delete'])) {
        $k=$_GET['delete'];
        unset($_SESSION[$k]);
    }
}

?>
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="cart.php" method="post">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($_SESSION as $key1=>$val1) {

                          if ($key1=='productpop' or $key1=='userdata') {
                                continue;
                          }
                      echo '<tr>';
                      echo "<td><a class='remove'  href='cart.php?delete=$key1'><fa class='fa fa-close'></fa></a></td>" ;
                        foreach ($val1 as $key2=>$val2) {
                            if ($key2=='pimage') {
                                echo '<td><a href="#"><img src="'.$val2.'" alt="img"></a></td>' ;
                            }
                            if ($key2=='pname') {
                                echo '<td><a class="aa-cart-title" href="#">'.$val2.'</a></td>' ;
                            }
                            if ($key2=='pprice') {
                                echo '<td>$'.$val2.'</td>';
                            }
                        }
                          echo "<td><input class='aa-cart-quantity'  type='number' value='1'></td>" ;

                        foreach ($val1 as $key2=>$val2) {
                            if ($key2=='pprice') {
                                global $total;
                                $total+=$val2;
                                echo '<td>$'.$val2.'</td>';
                            }
                        }
                        echo '</tr>';
                    }
                    foreach ($val1 as $k=>$v) {
                      if ($k=='gtotal') {
                          $_SESSION[$key1][$k]=$total;
                          //echo $_SESSION[$key1][$k];
                      }
                  }
                     ?>

                     <!--- <tr>
                        <td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="#"><img src="img/man/polo-shirt-2.png" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#">Polo T-Shirt</a></td>
                        <td>$150</td>
                        <td><input class="aa-cart-quantity" type="number" value="1"></td>
                        <td>$150</td>
                      </tr>
                      <tr>
                        <td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="#"><img src="img/man/polo-shirt-3.png" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#">Polo T-Shirt</a></td>
                        <td>$50</td>
                        <td><input class="aa-cart-quantity" type="number" value="1"></td>
                        <td>$50</td>
                      </tr>-->
                      <tr>
                        <td colspan="6" class="aa-cart-view-bottom">
                         <!-- <div class="aa-cart-coupon">
                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                          </div>-->

                          <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                        </td>
                      </tr>
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td><?php echo $total; ?></td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td><?php echo $total; ?></td>
                   </tr>
                 </tbody>
               </table>
               <a href="cart.php?check=1" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
<?php include 'footer.php'; ?>
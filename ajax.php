
<?php
//header('Location:product.php');
include 'config.php';
session_start();
//session_destroy();

$productid=$_POST['productid'];
$action=$_POST['action'];

//$_SESSION=array();

    if (isset($_POST['productid'])) {
        $sql = "SELECT * FROM products where `pid`=$productid";
        $res = $conn->query($sql);

        if ($res->num_rows > 0) {

            while ($row = $res->fetch_assoc()) {
                if (isset($_SESSION['productpop'])) {
                    // session_unset();

                   /* foreach ($_SESSION as $k=>$v) {
                        if ($k=='productpop') {
                            unset($_SESSION[$k]);
                            //header('Location:product.php');

                        }
                    }*/
                }

                   $_SESSION['productpop'] = array('pname' => $row['pname'],'pid' => $row['pid'], 'pimage'=> $row['pimage'], 'pprice'=>$row['pprice'], 'pcategory'=>$row['category'], 'ptag'=>$row['tag'] , 'pdescription'=>$row['description'], 'pcolor'=>$row['color'] );

            }
        } else {
            echo "0 results";
        }
        $conn->close();
    }



?>
<?php

//echo 'welcome'.$_POST['productid'];
include 'config.php';
session_start();
$productid=$_POST['productid'];
$action=$_POST['action'];


    if (isset($_POST['productid'])) {

        if (!($_SESSION['userdata']['user_name']) || !($_SESSION['userdata']['password'])) {
            //echo "<script>alert('Please login first')</script>";
          header("Location:signin.php"); /* Redirect browser */
        }


        $sql = "SELECT * FROM products where `pid`=$productid";
        $res = $conn->query($sql);

        if ($res->num_rows > 0) {

            while ($row = $res->fetch_assoc()) {
                $grandtotal=0;
                $_SESSION['cartdata'.$productid] = array('pname' => $row['pname'],'pid' => $row['pid'], 'pimage'=> $row['pimage'], 'pprice'=>$row['pprice'], 'category'=>$row['category'], 'tag'=>$row['tag'] , 'pdescription'=>$row['description'], 'pcolor'=>$row['color'], 'gtotal'=>$grandtotal);
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    }



$product=$_SESSION['cartdata'.$productid];
echo json_encode(array('product'=>$product));
?>
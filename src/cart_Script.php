<?php
include './product_Data.php';

// To add product in the cart 
$action =$_POST['action'];
if ($action == "add_to_cart"){
$prod_Id = $_POST['ind'];
$flag = 0;
$length = count($_SESSION['cart_Array']);
if (empty($_SESSION['cart_Array'])) {

        foreach ($products as $key1 => $value1) {
            if ($value1['id'] == $prod_Id) {
                $cartObj = array(
                    "id" => $value1['id'],
                    "name" => $value1['name'], "image" => $value1['image'],
                    "price" => $value1['price'], "quantity" => 1
                );
                array_push($_SESSION['cart_Array'], $cartObj);
            };
        }
} else {
        foreach ($_SESSION['cart_Array'] as $key1 => $value1) {
            if ($value1['id'] == $prod_Id) {
                $flag = 1;
            }
    }
    if ($flag == 1) {
        $i=0;
            foreach ($_SESSION['cart_Array'] as $key1 => $value1) {
                if ($value1['id'] == $prod_Id) {
                    $_SESSION['cart_Array'][$i]['quantity'] = $_SESSION['cart_Array'][$i]['quantity'] + 1;
                }$i=$i+1;
            }
    }
    if ($flag == 0) {
            foreach ($products as $key1 => $value1) {
                if ($value1['id'] == $prod_Id) {
                    $cartObj = array(
                        "id" => $value1['id'],
                        "name" => $value1['name'], "image" => $value1['image'],
                        "price" => $value1['price'], "quantity" => 1
                    );
                    array_push($_SESSION['cart_Array'], $cartObj);
                }
            }
        }
    }
echo json_encode($_SESSION['cart_Array']);
}

// To increase Quantity in the cart and send the updated data through ajax
if ($action == "add_Quant"){
    $j= $_POST['j'];
    $i=0;
    foreach ($_SESSION['cart_Array'] as $key1 => $value1) {
        if ($value1['id'] == $j) {
            $_SESSION['cart_Array'][$i]['quantity'] = $_SESSION['cart_Array'][$i]['quantity'] + 1;
        }$i=$i+1;
    }
    echo json_encode($_SESSION['cart_Array']);
}

//To decrease Quantity in the cart and send the updated data through ajax
if ($action == "reduce_Quant"){
    $ind = 0;
    $m= $_POST['m'];
    for ($i = 0; $i < count($_SESSION['cart_Array']); $i++) {
      if ($_SESSION['cart_Array'][$i].['id'] == $m) {
        $ind = $i;
      }
    }$z=0;
    foreach ($_SESSION['cart_Array'] as $key1 => $value1) {
        if ($value1['id'] == $m) {
            if ($_SESSION['cart_Array'][$z]['quantity'] > 1) {
                $_SESSION['cart_Array'][$z]['quantity'] = $_SESSION['cart_Array'][$z]['quantity'] - 1;
            } 
            else {
                array_splice($_SESSION['cart_Array'],$ind, 1);
            }$z++;
          }
    }
    echo json_encode($_SESSION['cart_Array']);
} 
//To calculate the bill of products in the cart and send the updated data through ajax
if ($action == "bill_Amount"){
    $bill_data = $_POST['billData'];
    $bill = 0;
    $z=0;
    foreach ($_SESSION['cart_Array'] as $key1 => $value1) {
        $bill = $bill + $_SESSION['cart_Array'][$z]['price'] * $_SESSION['cart_Array'][$z]['quantity'];
        $z++;
    }
    echo $bill;
}
//To delete the entire row
if ($action == "del_Row")
{$t=0 ;
    $r = $_POST['delId'];
    foreach ($_SESSION['cart_Array'] as $key1 => $value1) {
        if ($value1['id'] == $r)
        {
         array_splice($_SESSION['cart_Array'],$t,1);
        }$t++ ;
    }
    echo json_encode($_SESSION['cart_Array']);
}
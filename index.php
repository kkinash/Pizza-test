<?php
//index.php

spl_autoload_register();
require_once("vendor/autoload.php");
use Business\PizzaService;
use Entities\OrderItem;
use Entities\CartItem;

$pizzaSvc = new PizzaService();

$error = "";


$l = 0;
include_once("Presentation/header.php");
include_once("Presentation/menu.php");


$pizzaService = new PizzaService();
$pizzaList = $pizzaService->getAllPizzasOverview();
include_once("Presentation/pizzaoverview.php");

if (isset($_GET['action']) && $_GET['action'] === 'deleteorder') {
    unset($_SESSION['orderid']);
    if (!isset($_GET['reload'])) {
        echo '<meta http-equiv=Refresh content="0;url=?reload=1">';
    }
}
/*   ADD PRODUCT TO CART */

if (isset($_POST['action']) && $_POST['action'] === 'order') {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    echo "<meta http-equiv='refresh' content='0'>";
    if (isset($_POST['product'])) {
        $l = count($_SESSION['cart']);
        //check if this ID is allready in cart
        if ($l > 0) {
            $controlingCounter = 0;
            foreach ($_SESSION['cart'] as $thisPizza) {

                $id = $thisPizza->getProductid();

                if ($id == $_POST['product']) {
                    print('OOPS!');
                    $thisPizza->setNumber($thisPizza->getNumber() + 1);
                    $controlingCounter = 1;
                    break;
                }
            }
            if ($controlingCounter == 0) {
                array_push($_SESSION['cart'], new CartItem($_POST['product'], 1));
            }

        } else {
            array_push($_SESSION['cart'], new CartItem($_POST['product'], 1));
        }
    }


}

include_once("Presentation/footer.php");


// unset($_SESSION['cart']);
?>
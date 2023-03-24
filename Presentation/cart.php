<div class="hello flex ">


    <?php if (isset($_SESSION['userid'])) {

    } else { ?>
        <p class=" user-info"><a href="./checkpage.php">Log in</a> to
            get discount prices!</p><br><br>
    <?php }
    ; ?>
</div>
<div class="Header">
    <h3 class="Heading">New Order</h3>
    <h5 class="Action"><a href="./clearcart.php">Remove all</a></h5>
</div>
<?php
$totalcost = 0;
foreach ($_SESSION['cart'] as $cartItem) {

    $id = $cartItem->getProductid();
    $thispizza = $pizzaSvc->getPizzaByIdOverview($id);


    ?>
    <div class="Cart-Items">
        <div class="image-box">
            <img src="Design/img/<?php print $thispizza->getId() ?>.png" />
        </div>
        <div class="about">
            <h1 class="title">
                <?php print $thispizza->getName() ?>
            </h1>
            <h3 class="subtitle">
                <?php print $thispizza->getDescription() ?>
            </h3>

        </div>
        <div class="counter">
            <div class="count">
                <?php print $cartItem->getNumber() ?>
            </div>

        </div>
        <div class="prices">
            <div class="amount">
                <?php if (isset($_SESSION['user']) && $_SESSION["discount"] > 0) {
                    $price = $thispizza->getPromotionprice() * $cartItem->getNumber();
                    print $price;
                    $totalcost = $totalcost + $price;
                } else {
                    $price = $thispizza->getPrice() * $cartItem->getNumber();
                    print $price;
                    $totalcost = $totalcost + $price;
                } ?> €
            </div>


        </div>

    </div>
<?php }
?>

<hr>
<div class="checkout">
    <div class="total">
        <div>
            <div class="Subtotal">Sub-Total</div>

        </div>
        <div class="total-amount">
            <?php
            $_SESSION['totalcost'] = $totalcost;
            print $totalcost;
            ?>€
        </div>
    </div>
</div>
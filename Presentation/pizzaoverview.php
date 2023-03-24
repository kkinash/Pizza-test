<body>
    <!-- <div id="main">
        <center>
            <div id="main-text">PIZZA! MET LEVERING!</div>
            <div id="main-br"></div>
            <div id="main-img"><img src=""></div>
            <div id="main-img2"><img src=""></div>
        </center>

    </div> -->


    <div id="content" class="content">
        <div id="pizzaoverview">

            <div id="list" class="centered whitebox" name="list">
                <?php
                foreach ($pizzaList as $pizza) {

                    ?>
                    <div id="child">
                        <div id="img-nr">

                            <div id="photo"><img src="Design/img/<?php print($pizza->getId()); ?>.png"></div>
                        </div>
                        <div id="title">
                            <?php print($pizza->getName()); ?>
                        </div>
                        <div id="decsription">
                            <?php print($pizza->getDescription()); ?>
                        </div>

                        <div id="price-order">
                            <div id="price">
                                <?php
                                if (isset($_SESSION["discount"]) && $_SESSION["discount"] !== 0) {
                                    ?><span style="text-decoration: line-through; color: grey;">
                                        <?php print($pizza->getPrice()); ?>
                                    </span> &nbsp
                                    <?php
                                    print($pizza->getPromotionprice());
                                } else {
                                    print($pizza->getPrice());
                                } ?>€
                            </div>
                            <div id="order">
                                <form method="POST" class="order" role="form">
                                    <input type="hidden" name="action" value="order" />
                                    <input type="hidden" name="product" value="<?php print($pizza->getId()); ?>" />
                                    <button type="submit" value="submit">ORDER</button>
                                </form>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>


        </div>
        <div>
            <?php
            if (isset($_SESSION['orderid']) && isset($_SESSION['userid'])) { ?>
                <div class="flex flex-column align-content-center ">
                    <div class="CartContainer whitebox">
                        <p class=" user-info">You have existing order: <a href="./checkpage.php">
                                <?php print $_SESSION['orderid'] ?>
                            </a>
                        </p>
                    </div>
                </div>
            <?php }


            if (isset($_SESSION['cart'])) {
                if (count($_SESSION['cart']) > 0) {
                    ?>
                    <div class="flex flex-column align-content-center ">
                        <div class="CartContainer whitebox">
                            <?php
                } else { ?>

                            <div style="display: none">
                                <div class="CartContainer whitebox">
                                    <?php
                }
                include_once("Presentation/cart.php"); ?>
                            </div>
                            <div class="checkout_button">
                                <?php if (isset($_SESSION['orderid'])) {
                                    ?>
                                    <form method="get" style="width:250px">
                                        <button type="submit" name="order" formaction="./checkout.php" value="neworder"
                                            class="button justify-content-center">Create new order</button>
                                    </form>
                                <?php } else { ?>
                                    <form style="width:250px" action="./checkpage.php"><button
                                            class="button justify-content-center">Checkout</button></form>
                                <?php } ?>
                            </div>




                            <?php
            } ?>
                    </div>
                    <div>
</body>
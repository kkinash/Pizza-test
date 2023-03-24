<script>

    function openForm() {
        document.getElementById("popupForm").style.display = "block";
    }
    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }
    function openForm2() {
        document.getElementById("popupForm2").style.display = "block";
    }
    function closeForm2() {
        document.getElementById("popupForm2").style.display = "none";
    }
    function openForm3() {
        document.getElementById("popupForm3").style.display = "block";
    }
    function closeForm3() {
        document.getElementById("popupForm3").style.display = "none";
    }

</script>

<body>
    <div id="content" class="content">

        <?php if (isset($_SESSION["orderid"])) { ?>

            <div class="checkout-itemlist  flex flex-column">
                <div>
                    <center><br><br><br>
                        <h3 class="Heading">Your Order is created!</h3><br>
                        <h5>Order number is
                            <?php
                            print $_SESSION["orderid"]; ?>
                    </center>
                </div>
                <div class="checkout-user whitebox">
                    <h3 class="Heading">Your Details&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a onclick='openForm()'>EDIT</a>
                    </h3>
                    <div class="user-item">
                        Name:
                        <?php print $user->getName() ?>&nbsp;
                        <?php print $user->getFamilyName() ?>
                    </div>

                    <div class="user-item">
                        Discount:
                        <?php
                        $disc = $user->getDiscount();
                        if ($disc == 1) {
                            echo "50%";
                        } else {
                            echo "no discount";
                        }
                        ?>
                    </div>

                </div>
                <div class="checkout-location whitebox">
                    <h3 class="Heading">

                    </h3>

                    <h3 class="Heading">Order Adress:&nbsp;&nbsp;&nbsp;
                        <?php
                        if (in_array($place->getPostcode(), $_SESSION['deliverible'])) {
                            ?><span style="color:var(--ins-color);">
                                <?php print "We can deliver here"; ?></span <?php
                        } else { ?><span style="color:var(--del-color);">
                            <?php print "We can NOT deliver here"; ?></span <?php
                        }
                        ?> </h3>
                        <div class="user-item">City:
                            <?php print($place->getPostcode()); ?>
                            ,&nbsp;
                            <?php print($place->getName()); ?>
                            ,&nbsp; <a onclick='openForm3()'>EDIT</a><br>
                            <?php print($user->getStreet()); ?>
                            ,&nbsp;
                            <?php print($user->getHousenr()); ?> <a onclick='openForm2()'>EDIT</a><br><br>
                        </div>



                </div>

                <div class="Cart-Items flex flex-column whitebox">
                    <h3 class="Heading">Pizzas &nbsp;&nbsp;&nbsp; <a href="./index.php?">EDIT</a><br><br>
                    </h3>
                    <?php foreach ($orderitems as $item) {
                        $id = $item->getProductid();
                        $thispizza = $pizzaSvc->getPizzaByIdOverview($id);
                        ?>

                        <div class="Item flex margin15" style="width:100%;margin-top:25px;">
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
                                    <?php print $item->getNumber() ?>
                                </div>
                            </div>
                            <div class="prices">
                                <div class="amount">
                                    <?php if (isset($_SESSION['user']) && $_SESSION["discount"] > 0) {
                                        $price = $thispizza->getPromotionprice() * $item->getNumber();
                                        print $price;
                                        $totalcost = $totalcost + $price;
                                    } else {
                                        $price = $thispizza->getPrice() * $item->getNumber();
                                        print $price;
                                        $totalcost = $totalcost + $price;
                                    } ?> €
                                </div>
                            </div>

                        </div>
                    <?php } ?>

                </div>
                <div class="checkout-location whitebox" style="width:96%">
                    <div class=" total">
                        <div>
                            <div class="Subtotal">Total</div>

                        </div>
                        <div class="total-amount">
                            <?php
                            print($order->getTotalprice());
                            ?>€
                        </div>
                    </div>
                </div>





                <?php if (in_array($place->getPostcode(), $_SESSION['deliverible'])) { ?>
                    <div class="checkout_button">
                        <?php if (isset($_SESSION['orderid'])) {
                            ?>

                            <a href="./confirmed.php?action=deleteorder" class="button btn justify-content-center"
                                style="height:80px;width:100%;color:white;font-size:30px;">CONFIRM ORDER</a>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div id="popupForm" class="formPopup">
                    <div class="formContainer" id="popupForm">
                        <form class="formContainer" method="get">
                            <h6>Edit details</h6>
                            <label for=" name"> Name</label>
                            <input name="name" id="name" value="<?php print $user->getName() ?>">
                            <label for="familyname">Familyname</label>
                            <input name="familyname" id="familyname" value="<?php print $user->getFamilyName() ?>">
                            <button type="submit" class="btn" name="action" value="editname">Save</button>
                            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                        </form>
                    </div>
                </div>

                <div id="popupForm2" class="formPopup">
                    <div class="formContainer" id="popupForm">
                        <form class="formContainer" method="get">
                            <h6>Edit Adress</h6>
                            <label for="street">Street</label>
                            <input name="street" id="street" value="<?php print($user->getStreet()); ?>">
                            <label for="housenr">House №</label>
                            <input name="housenr" id="housenr" value=" <?php print($user->getHousenr()); ?>">
                            <button type="submit" class="btn" name="action" value="editadress">Save</button>
                            <button type="button" class="btn cancel" onclick="closeForm2()">Close</button>
                        </form>
                    </div>
                </div>

                <div id="popupForm3" class="formPopup">
                    <div class="formContainer" id="popupForm">
                        <form class="formContainer" method="get">
                            <h6>Edit CITY</h6>
                            <label for="postcode">Postcode</label>
                            <input name="postcode" type="number" id="postcode"
                                value="<?php print($place->getPostcode()); ?>">
                            <label for="city">City</label>
                            <input name="city" id="city" value="<?php print($place->getName()); ?>">
                            <button type="submit" class="btn" name="action" value="editcity">Save</button>
                            <button type="button" class="btn cancel" onclick="closeForm3()">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        } ?>
<?php
declare(strict_types=1);

?>


<!DOCTYPE HTML>
<html>

<head>
    <meta charset=utf-8>

    <script src="./Design/js/checked.js" defer></script>
    <!-- <script>

        function openForm() {
            document.getElementById("popupForm").style.display = "block";
        }
        function closeForm() {
            document.getElementById("popupForm").style.display = "none";
        }

    </script>
                 <div id="popupForm" class="formPopup">
                <div class="formContainer" id="popupForm">
                    <form class="formContainer" method="post" action="checkpage.php">
                        <h6>Add new City</h6>
                        <label for="postcode">Postcode</label>
                        <input name="postcode" id="postcode">
                        <label for="cityname">Name</label>
                        <input name="cityname" id="cityname">
                        <button type="submit" class="btn" name="action" value="addplace">Add City</button>
                        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                    </form>
                </div>
            </div> -->
</head>
</head>

<body>
    <div id="content" class="content">
        <div id="login" class="whitebox">

            <h4>I have an account</h4>
            <div class="form-register flex justify-content-center">

                <?php if (!isset($_SESSION["user"])) { ?>

                    <div class="form">
                        <form action="./checkpage.php?action=process" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Login (email): </label>
                                <input type="text" class="form-control" name="username" id="username" <?php if (isset($_COOKIE['email'])) { ?> value="<?php print $_COOKIE['email']; ?>"><?php } else { ?> > <?php } ?>
                            </div>
                            <div class="mb-5">
                                <label for="password" class="form-label">Passwoord: </label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <span style="color:red;">
                                <?php print $error_login ?>
                            </span> <button type="submit" class="btn btn-primary"
                                formaction="./checkpage.php?action=process">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div style="width:100px"></div>

        <div id="register whitebox" class="whitebox">

            <h4>I don't have an account</h4>
            <span style="color:red;">
                <?php print $error_register ?>
            </span>
            <br><br>
            <div class="form-register flex justify-content-center">

                <div class="form">
                    <form action="./checkpage.php?action=signup" method="POST">
                        <label for="name">First Name:</label>
                        <input type="text" id="name" name="name" value="John" required>

                        <label for="familyname">Family Name:</label>
                        <input type="text" id="fname" name="fname" value="Doe" required>
                        <label for="postcode">Postcode</label>
                        <input type="number" id="xpostcode" name="postcode" onkeyup="trackChange(this.value)" required>
                        <label id="delivering-yes" class="success" style="display: none;">Yes, we can deliver
                            there!</label>
                        <label id="delivering-no" class="error" style="display: none;">Sory, we can't deliver
                            there</label>
                        <label id="need4" class="error" style="display: none;">Postcode must be 4 lessters</label>
                        <br>
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" required>

                        <label for="street">Street</label>
                        <input type="text" id="street" name="street" required>

                        <label for="housenr">House Number</label>
                        <input type="number" id="housenr" name="housenr" min="0">

                        <label for="additionalinfo">Additional info</label>
                        <input type="text" id="additionalinfo" name="additionalinfo">

                        <label for="agree">I want to create an account</label>
                        <input type="checkbox" id="agree" name="agree" onclick="boxChecked()"><br><br>

                        <input type="submit" class="btn btn-primary" id="order-btn" name="btnGoahead" value="Order"
                            style="display:block" formaction="./checkout.php?action=goahead">
                        <div id="emailandpass" style="display:none">
                            <label for="email">Email:</label>
                            <input type="email" id="reg-email" name="email">

                            <label for="password">Password:</label>
                            <input type="password" id="reg-password" name="password">

                            <label for="rpassword">Repeat password:</label>
                            <input type="password" id="reg-rpassword" name="rpassword">

                            <br>
                            <input type="submit" class="btn btn-primary" name=" btnSingUp" value="Sign Up">
                        </div>
                    </form>

                </div>
            </div>



        </div>

</body>
<script>


    /* PHP POSTCODES ARRAY TO JS */
    <?php
    $js_deliverible = json_encode($deliverible);
    echo "var deliverible_js_array = " . $js_deliverible . ";\n";
    ?>
    function isInArray(array, search) {
        return array.indexOf(search) >= 0;
    }



    function trackChange(value) {
        let a = 'a';
        let code = parseInt(value);;
        if (value.toString().length == 4) {
            document.getElementById("need4").style.display = "none";
            let a = isInArray(deliverible_js_array, code);
            console.log(a);
            if (a == true) {
                document.getElementById("delivering-yes").style.display = "block";
                document.getElementById("delivering-no").style.display = "none";

            } else {
                document.getElementById("delivering-yes").style.display = "none";
                document.getElementById("delivering-no").style.display = "block";
            }
        } else {
            document.getElementById("need4").style.display = "block";
            document.getElementById("delivering-yes").style.display = "none";
            document.getElementById("delivering-no").style.display = "none";


        }

    }
</script>
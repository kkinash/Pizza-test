<?php


//index.php

spl_autoload_register();
require_once("vendor/autoload.php");

use Business\PlaceService;
use Business\UserService;
use Exceptions\PasswordsDoNotMatchException;
use Exceptions\UserNotFoundException;
use Exceptions\EmailExistsException;
use Exceptions\PlaceExistsException;
use Exceptions\InvalidPasswordException;

$error_register = "";
$error_login = "";
$_SESSION['createorder'] = '1';

include_once("Presentation/header.php");
include_once("Presentation/menu.php");

if (isset($_SESSION["userid"])) {
    header("Location: ./checkout.php");

}

$userService = new UserService();
$placeService = new PlaceService();
$placeList = $placeService->getAllplacesOverview();
$deliverible = $placeService->getDeliveriblePostcodesOverview();
$_SESSION['deliverible'] = $deliverible;

// REGISTER ↓
if (isset($_GET['action']) && $_GET['action'] === 'signup') {
    $userService = new UserService();
    $registerresult = '0';
    $name = $_POST['name'];
    $familyname = $_POST['fname'];
    $password1 = $_POST['password'];
    $password2 = $_POST['rpassword'];
    $email = $_POST['email'];
    $street = $_POST['street'];
    $housenr = (int) $_POST['housenr'];
    $postcode = (int) $_POST['postcode'];
    $cityname = $_POST['city'];
    $addinfo = $_POST['additionalinfo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    try {
        $userService->checkPassword($password1, $password2);
        $registerresult = $userService->registerUserOvewview($name, $familyname, $email, $password, $street, $housenr, $postcode, $cityname, $addinfo);

        $error_register = "You have successfully signed up. Let`s Login!";
        //echo '<script>alert("You have successfully signed up. Let`s Login!")</script>';
    } catch (PasswordsDoNotMatchException $e) {

        $error_register = "Pasword and password repeat doesnt match!";
    } catch (EmailExistsException $e) {
        $error_register = "This email is allready taken!";
    } catch (\Exception $e) {
        $error_register = "Onbekende fout: kan niet register.";
    }
    // if registration is successful -> login
    if ($registerresult > 0) {
        try {
            $userAccount = $userService->loginUser($email, $password1);
            $_SESSION["userAccount"] = serialize($userAccount);
            $_SESSION["user"] = $userAccount->getEmail();
            $_SESSION["userid"] = $userAccount->getId();
            $_SESSION["name"] = $userAccount->getName();
            $_SESSION["familyname"] = $userAccount->getFamilyName();
            $_SESSION["email"] = $userAccount->getEmail();
            $_SESSION["street"] = $userAccount->getStreet();
            $_SESSION["housenr"] = $userAccount->getHousenr();
            $_SESSION["placeid"] = $userAccount->getCityid();
            $_SESSION["addinfo"] = $userAccount->getUserAddInfo();
            $_SESSION["discount"] = $userAccount->getDiscount();
            unset($_COOKIE['email']);
            setcookie('email', $_SESSION["email"], time() + 86400);
            echo "<meta http-equiv='refresh' content='0'>";
        } catch (UserNotFoundException $e) {
            $error_login = "User with this email doesn't exist";

        } catch (InvalidPasswordException $e) {
            $error_login = "Wrong password";

        } catch (\Exception $e) {
            $error_login = "Unknown error: kan niet inloggen.";
        }
    }
}

// LOGIN

if (isset($_GET["action"]) && ($_GET["action"]) === "process") {
    $username = $_POST["username"];
    $password = $_POST['password'];

    $userService = new UserService();

    try {
        $userAccount = $userService->loginUser($username, $password);

        $_SESSION["userAccount"] = serialize($userAccount);
        $_SESSION["user"] = $username;
        $_SESSION["userid"] = $userAccount->getId();
        $_SESSION["name"] = $userAccount->getName();
        $_SESSION["familyname"] = $userAccount->getFamilyName();
        $_SESSION["email"] = $userAccount->getEmail();
        $_SESSION["street"] = $userAccount->getStreet();
        $_SESSION["housenr"] = $userAccount->getHousenr();
        $_SESSION["placeid"] = $userAccount->getCityid();
        $_SESSION["addinfo"] = $userAccount->getUserAddInfo();
        $_SESSION["discount"] = $userAccount->getDiscount();
        unset($_COOKIE['email']);
        setcookie('email', $_SESSION["email"], time() + 86400);
        echo "<meta http-equiv='refresh' content='0'>";
    } catch (UserNotFoundException $e) {
        $error_login = "User with this email doesn't exist";
    } catch (InvalidPasswordException $e) {
        $error_login = "Wrong password";
    } catch (\Exception $e) {
        $error_login = "Unknown error: kan niet inloggen.";
    }
    //  header("location: index.php");
    // echo 'Hello, ' . $_SESSION["user"];

}

// ADD NEW CITY ↓
if (isset($_POST['action']) && $_POST['action'] === 'addplace') {

    $postcode = (int) $_POST['postcode'];
    $name = $_POST['cityname'];
    if ($postcode > 8999 && $postcode < 9030) {
        $isaccessible = 1;
    } else {
        $isaccessible = 0;
    }
    try {
        $placeService->addPlaceOverview($postcode, $name, $isaccessible);
    } catch (PlaceExistsException $e) {
        $error = "This City is allready exists!";
    }
    unset($_POST['action']);
    echo "<meta http-equiv='refresh' content='0'>";
}
include_once 'Presentation/checkpage.php';

?>
</div>
</div>
</div>
<table>
    <?php


    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }


    ?>
</table>
<?php $title = "Validate function" ?>
<?php require_once("../header.php"); ?>

<form action="" method="post">
    <div class="form-group">
        <input class="tel" type="tel" name="tel" placeholder="+380991234567" required />
        <input class="" type="submit" name="check" value="Check" />
    </div>
</form>
<?php
/**
 * 380975670100
 * +380975555555
 * 0975555555
 * 097 555-55-55
 * 8097 555 55 55
 **/
function validNumberUa() {
    if (isset($_POST['check'])) {

        if ($_POST['tel'] === "") {
            echo "<br>Заполните поле";
            return false;
        }

        $tel = $_POST['tel'];
        $clean = array(" ", "-");
        $tel = str_replace($clean, "", $tel);
        $pattern = "/^(\+380|380|80|0){1}\d{9}$/";
        echo (preg_match($pattern, $tel))? "Valid" : "Invalid";
    }
}

validNumberUa();

?>

</body>
</html>

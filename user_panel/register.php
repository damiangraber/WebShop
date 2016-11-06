<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['user_id'])) {
        header('Location: index.php');
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['fname']) && strlen(trim($_POST['fname'])) > 0
        && isset($_POST['lname']) && strlen(trim($_POST['lname'])) > 0
        && isset($_POST['email']) && strlen(trim($_POST['email'])) >= 5
        && isset($_POST['password']) && strlen(trim($_POST['password'])) >= 6
        && isset($_POST['retyped_password'])
        && trim($_POST['password']) == trim($_POST['retyped_password'])
    ) {

        require_once __DIR__.'../connection.php';
        require_once __DIR__.'../src/User.php';

        $user = new User();
        $user->setFname(trim($_POST['fname']));
        $user->setLname(trim($_POST['lname']));
        $user->setEmail(trim($_POST['email']));
        $user->setPassword(trim($_POST['password']));


        if ($user->saveToDB($conn)) {
            echo 'Gratulacje, zarejestrowałeś się! Przejdź na stronę logowania ';
            echo '<a href="login.php">Login</a>';

        } else {
            echo 'Błąd przy rejestracji, spróbuj ponownie';
        }
    } else {
        echo 'Błędne dane w formularzu';
    }
}


?>


<html>
<head>
    <!--<script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/app.js"></script>-->
</head>
<body>
<form method="POST">
    <label>
        Imię:<br>
        <input type="text" name="fname">
    </label>
    <br>
    <label>
        Nazwisko:<br>
        <input type="text" name="lname">
    </label>
    <br>
    <label>
        Email:<br>
        <input type="text" name="email">
    </label>
    <br>
    <label>
        Hasło:<br>
        <input type="password" name="password">
    </label>
    <br>
    <label>
        Powtórz hasło:<br>
        <input type="password" name="retyped_password"
    </label>
    <br><br>
    <input type="submit" value="Utwórz konto">

</form>


</body>


</html>

<?php namespace lab8;
include_once 'classes/Baza.php';
include_once 'classes/User.php';
include_once 'classes/LoggedUserManager.php';
$db = Baza::getInstance("mysql:host=localhost;dbname=klienci", "root", "");
$um = new LoggedUserManager();
$showError = false;

if (filter_input(INPUT_GET, "akcja")=="wyloguj") {
    $um->logout($db);
}

if (filter_input(INPUT_POST, "zaloguj")) {
    $userId=$um->login($db);
    if ($userId > 0) {
        header("Location: testLogin.php");
    } else {
        $showError = "Błędna nazwa użytkownika lub hasło";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
<section class="vh-100 gradient-custom">
    <?php
    if($showError) {
        echo "<div class='alert alert-danger' role='alert'>$showError</div>";
    }
    ?>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4">
                            <h2 class="fw-bold mb-2 text-uppercase">Logowanie</h2>
                            <form action="index.php" method="post">
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="login" id="loginInput" class="form-control form-control-lg"
                                           minlength="3"
                                           maxlength="25"
                                           required/>
<!--                                           pattern="/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/" -->
                                    <label class="form-label" for="loginInput">Login</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="passwd" id="passwdInput" class="form-control form-control-lg"
                                           required
                                           pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{5,32}$"
                                    />
                                    <label class="form-label" for="passwdInput">Password</label>
                                </div>
                                <input type="submit" class="btn btn-outline-light btn-lg px-5" value="Zaloguj" name="zaloguj" />
                                <p><a href="rejestracja.php">Register</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>

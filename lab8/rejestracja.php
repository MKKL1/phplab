<?php  namespace lab8;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>Rejestracja</title>
</head>
<body>
<?php

include_once "classes/Baza.php";
include_once "classes/UserManager.php";
include_once "classes/User.php";
include_once "classes/RegistrationForm.php";

$bd = Baza::getInstance("mysql:host=localhost;dbname=klienci", "root", "");

$regFrom = new RegistrationForm();
$userManager = new UserManager($bd);


$showError = false;
$showSuccess = false;
if(filter_input(INPUT_POST, 'submit')) {
    $user = $regFrom->checkUser();
    if($user===NULL) {
        $showError = "Niepoprawne dane rejestracji";
    } else {
        if(!$userManager->add($user)) {
            $showError = "Błąd dodawania użytkownika";
        } else {
            $showSuccess = "Poprawnie zarejestracji";
            header("Location: index.php");
        }
    }
}
?>

<section class="vh-100 gradient-custom">
    <?php
    if($showError) {
        echo "<div class='alert alert-danger' role='alert'>$showError</div>";
    }
    if($showSuccess) {
        echo "<div class='alert alert-success' role='alert'>$showSuccess</div>";
    }
    ?>


    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4">
                            <h2 class="fw-bold mb-2 text-uppercase">Rejestracja</h2>



                            <form action="rejestracja.php" method="post">
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="userName" id="loginInput" class="form-control form-control-lg"
                                           minlength="3"
                                           maxlength="25"
                                           required/>
                                    <!--   pattern="/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/"-->
                                    <label class="form-label" for="loginInput">Login</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="fullName" id="fullNameInput" class="form-control form-control-lg"
                                           required/>
<!--                                           pattern="^[0-9A-Za-z]{3,25} [0-9A-Za-z]{3,25}$"-->
                                    <label class="form-label" for="fullNameInput">Imie i nazwisko</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="email" id="emailInput" class="form-control form-control-lg" required/>
                                    <label class="form-label" for="emailInput">E-mail</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="passwd" id="passwordInput" class="form-control form-control-lg"
                                           required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{5,32}$"/>
                                    <label class="form-label" for="passwordInput">Hasło</label>
                                </div>

                                <input type="submit" class="btn btn-outline-light btn-lg px-5" name="submit" value="Rejestracja"/>
                                <input type="reset" class="btn btn-outline-light btn-lg px-5" value="Anuluj"/>
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

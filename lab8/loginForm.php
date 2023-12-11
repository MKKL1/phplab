<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4">
                            <h2 class="fw-bold mb-2 text-uppercase">Logowanie</h2>
                            <form action="classes/processLogin.php" method="post">
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="login" id="loginInput" class="form-control form-control-lg" />
                                    <label class="form-label" for="loginInput">Login</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="passwd" id="passwdInput" class="form-control form-control-lg" />
                                    <label class="form-label" for="passwdInput">Password</label>
                                </div>
                                <input type="submit" class="btn btn-outline-light btn-lg px-5" value="Zaloguj" name="zaloguj" />
                                <p>Not a member? <a href="rejestracja.php">Register</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

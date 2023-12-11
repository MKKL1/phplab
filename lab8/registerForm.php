<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4">
                            <h2 class="fw-bold mb-2 text-uppercase">Rejestracja</h2>

                            <form action="classes/processRegister.php" method="post">
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="userName" id="loginInput" class="form-control form-control-lg" />
                                    <label class="form-label" for="loginInput">Login</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="fullName" id="fullNameInput" class="form-control form-control-lg" />
                                    <label class="form-label" for="fullNameInput">Imie i nazwisko</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="email" id="emailInput" class="form-control form-control-lg" />
                                    <label class="form-label" for="emailInput">E-mail</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="passwd" id="passwordInput" class="form-control form-control-lg" />
                                    <label class="form-label" for="passwordInput">Hasło</label>
                                </div>

                                <input type="submit" class="btn btn-outline-light btn-lg px-5" value="Rejestracja" name="zaloguj" />
                                <input type="reset" class="btn btn-outline-light btn-lg px-5" value="Anuluj"/>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

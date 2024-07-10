
    <div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
            <form method="post" action="assets/php/actions.php?login">
                <div class="d-flex justify-content-center">

                    <img class="mb-4" src="assets/images/pictogram.png" alt="" height="45">
                </div>
                <h1 class="h5 mb-3 fw-normal">Please sign in</h1>

                <div class="form-floating">
                    <input type="text" name="username_email" class="form-control rounded-0" placeholder="username/email">
                    <label for="floatingInput">username/email</label>
                </div>

                <?php if(isset($_SESSION['username_email_error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['username_email_error']; ?>
                    </div>
                    <?php unset($_SESSION['username_email_error']); // Don't forget to unset the session variable ?>
                <?php endif; ?>
                

                <div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">password</label>
                </div>
                <!-- Using the session variable created in the actions.php to show the error in password if that session variable is triggered -->
                <?php if(isset($_SESSION['password_error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['password_error']; ?>
                    </div>
                    <?php unset($_SESSION['password_error']); // Don't forget to unset the session variable ?>
                <?php endif; ?>

                <?php if(isset($_SESSION['unfilled_error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['unfilled_error']; ?>
                    </div>
                    <?php unset($_SESSION['unfilled_error']); // Don't forget to unset the session variable ?>
                <?php endif; ?>

                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <input type="hidden" name="form_type" value="login">
                    <button class="btn btn-primary" type="submit">Sign in</button>
                    <a href="#" class="text-decoration-none">Create New Account</a>
                    


                </div>
                <a href="#" class="text-decoration-none">Forgot password ?</a>
            </form>
        </div>
    </div>

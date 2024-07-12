
    <div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
            <form  method="post" action="assets/php/actions.php">
                <div class="d-flex justify-content-center">


                </div>
                <h1 class="h5 mb-3 fw-normal">Verify Your Email Id</h1>


                <p>Enter 6 Digit Code Sended to You</p>
                <div class="form-floating mt-1">

                    <input type="password" name="code" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">######</label>
                </div>
                
                <?php if(isset( $_SESSION['code_error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo  $_SESSION['code_error']; ?>
                    </div>
                    <?php unset( $_SESSION['code_error']); // Don't forget to unset the session variable ?>
                <?php endif; ?>

                <?php if(isset( $_SESSION['wrong_code_error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo  $_SESSION['wrong_code_error']; ?>
                    </div>
                    <?php unset( $_SESSION['wrong_code_error']); // Don't forget to unset the session variable ?>
                <?php endif; ?>
                
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <input type="hidden" name="form_type" value="verify_email">
                    <button class="btn btn-primary" type="submit">Resend Code</button>
                    <button class="btn btn-primary" type="submit">Verify Email</button>





                </div>
                <br>
                <a href="?login" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i>
                    Logout</a>
            </form>
        </div>
    </div>


   
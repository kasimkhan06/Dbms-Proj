<?php $title = "login";
include('../includes/header.php');
?>

<div class="page-container">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center ">
                <?php
                if (isset($_SESSION['status'])) {
                ?>
                    <div class="alert transparent-alert border-0">
                        <h5 class="text-white">
                            <?= $_SESSION['status']; ?>
                        </h5>
                    </div>
                <?php
                    unset($_SESSION['status']);
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row my-3 justify-content-center">
            <div class="col-md-6 text-white my-form">
                <div class="row m-3">
                    <div class="col-md-12 text-center pt-4 cust-font">
                        <h1>LOG IN</h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 ">
                        <form action="verify_login.php" method="post" class="m-2 p-3">
                            <div class="text-white d-flex pb-3">
                                <div>
                                    <i class="fa-solid fa-envelope fa-xl cust-icon" style="color: #f5f5f5;"></i>
                                </div>
                                <div>
                                    <label for="">Email</label>
                                    <input type="email" name="email" id="" class="form-control">
                                </div>
                            </div>
                            <div class="text-white d-flex pb-3">
                                <div>
                                    <i class="fa-solid fa-key fa-xl cust-icon" style="color: #fafafa;"></i>
                                </div>
                                <div>
                                    <label for="">Password</label>
                                    <input type="password" name="password" id="" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 justify-content-center custom-link">
                                <a href="forgot_pass.php">Forgot Password?</a>
                            </div>
                            <div class="mb-3 justify-content-center">
                                <button type="submit" class="btn cust-btn" name="log_btn">
                                    <i class="fa-solid fa-right-to-bracket fa-lg" style="color: #ebebeb;"></i>
                                    <h6>LOG IN</h6>
                                </button>
                            </div>
                            <div class="mb-3 justify-content-center custom-link">
                                <h6 class="no-email">didn't receive an email? </h6> <a href="send_email.php">click here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include('../includes/footer.php') ?>
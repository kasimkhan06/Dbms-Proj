<?php $title = "Reset Pass";
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
                        <h4>Enter New Password</h4>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form action="forgot_pass_code.php" method="post" class="m-2 p-3">
                            <div class="text-white d-flex pb-3">
                                <div>
                                    <input type="hidden" name="email" value="<?php if (isset($_GET['email'])) {
                                                                                    echo $_GET['email'];
                                                                                }   ?>" class="form-control">
                                </div>
                            </div>
                            <div class="text-white d-flex pb-3">
                                <div>
                                    <input type="hidden" name="token" value="<?php if (isset($_GET['token'])) {
                                                                                    echo $_GET['token'];
                                                                                }   ?>" class="form-control">
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
                            <div class="text-white d-flex pb-3">
                                <div>
                                    <i class="fa-solid fa-key fa-xl cust-icon" style="color: #fafafa;"></i>
                                </div>
                                <div>
                                    <label for="">confirm Password</label>
                                    <input type="password" name="conf-password" id="" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 justify-content-center">
                                <button type="submit" class="btn cust-btn" name="reset-btn">
                                    <h6>Change</h6>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include('../includes/footer.php'); ?>
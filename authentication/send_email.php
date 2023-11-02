<?php include('../includes/header.php'); ?>

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
                        <h4>Enter Email To Verify</h4>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form action="send_email_verify.php" method="post" class="m-2 p-3">
                            <div class="text-white d-flex pb-3">
                                <div>
                                    <i class="fa-solid fa-envelope fa-xl cust-icon" style="color: #f5f5f5;"></i>
                                </div>
                                <div>
                                    <label for="">Enter Email</label>
                                    <input type="email" name="email" id="" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3 justify-content-center">
                                <button type="submit" class="btn cust-btn" name="send-btn">
                                    <i class="fa-solid fa-right-to-bracket fa-lg" style="color: #ebebeb;"></i>
                                    <h6>SEND</h6>
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
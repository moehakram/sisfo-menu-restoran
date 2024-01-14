<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-6 col-lg-12 col-md-9">
   
    <?php if(isset($data['error'])): ?>
                <div class="text-center my-3 alert alert-danger" role="alert">
                    <div class="text-gray-900"> <?= $data['error'] ?></div>
                </div><?php endif ?>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="p-5">
                <!-- awal form -->  
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>

                <form class="user" action="/user/login" method="post">

                    
                    <div class="form-group">
                        <input name="id" type="text" class="form-control form-control-user"
                            id="exampleInputUser" placeholder="Enter Username" value="<?= $_POST['id']??'' ?>">
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="Enter Password">
                    </div>
                    <button type="submit" name="login_user" class="btn btn-primary btn-user btn-block">
                    Sign On
                    </button>
                </form>
                <hr>
                <div class="text-center">
                    <!-- <a class="small" href="forgot-password.html">Lupa Password?</a> -->
                </div>
                <div class="text-center">
                    <p class="smal">Belum punya akun ?
                        <a class="small" href="/user/register">
                            registerasi</a>
                    </p>
                </div>

                <!-- akhir form -->
            </div>
        </div>

    </div>

</div>

</div>
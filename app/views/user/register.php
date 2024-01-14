<div class="container">

<div class="row justify-content-center">

    <div class="col-xl-5 col-lg-10 col-md-9 card o-hidden border-0 shadow-lg my-5">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Registerasi</h1>
            </div>

            <form class="user justify-content-center" action="/user/register" method="post">

                <div class="form-group row">
                    <div class="col-lg-12 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user <?= isset($_SESSION['error']['username'])?'is-invalid':''?>" name="id" id="id"
                            value="<?=$_POST['id']??'' ?>" placeholder="username">
                        <div class="invalid-feedback text-left">
                            <?= $_SESSION['error']['username'] ?>
                        </div>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <input type="text" class="form-control form-control-user <?= isset($_SESSION['error']['name'])?'is-invalid':'' ?>" name="name" id="name"
                            value="<?=$_POST['name']??'' ?>" placeholder="name" placeholder="nama">
                        <div class="invalid-feedback text-left">
                            <?= $_SESSION['error']['name']; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user <?= isset($_SESSION['error']['password'])?'is-invalid':'' ?>" name="password"
                            id="password" placeholder="password">
                        <div class="invalid-feedback text-left">
                            <?= $_SESSION['error']['password']??'' ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user" name="password"
                            id="password2" placeholder="konfirmasi password">
                        <div class="invalid-feedback text-left" id="password-error">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12  mb-3 mb-sm-0">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register
                        </button>
                    </div>

                </div>

            </form>
            <hr>
            <div class="text-center">
                <p class="smal">Sudah punya akun ?
                    <a class="small" href="/user/login">Login</a>
                </p>
            </div>

        </div>
    </div>

</div>

</div>
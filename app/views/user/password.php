<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">Update Password</h1>
                                <?php if(isset($data['error'])): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $data['error'] ?>
                                    </div>                                       
                                <?php endif ?>
                            </div>
                            <form class="user" method="post" action="/user/password">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="id"
                                        placeholder="id" value="<?= $data['user']['id']??''?>" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        name="oldPassword" id="oldPassword" placeholder="old password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        name="newPassword" id="newPassword" placeholder="password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Change Password
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/">cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>

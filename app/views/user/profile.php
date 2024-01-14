<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-6 mt-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">Update Profile</h1>
                                <?php if(isset($data['error'])): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $data['error'] ?>
                                </div>
                                <?php endif ?>
                            </div>
                            <form class="user" method="post" action="/user/profile">
                                <div class="form-group">
                                    <label for="id">username</label>
                                    <input type="text" class="form-control form-control-user" id="id"
                                        placeholder="id" value="<?= $data['user']['id']??'' ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control form-control-user" name="name"
                                        id="name" value="<?= $data['user']['name']??'' ?>" placeholder="name">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Update Profile
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
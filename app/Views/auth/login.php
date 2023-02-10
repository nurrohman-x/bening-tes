<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="card shadow">
            <h5 class="card-header">Login</h5>
            <div class="card-body">
                <form action="<?= base_url('login') ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    <a href="<?= base_url('register') ?>" class="link link-primary">register</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
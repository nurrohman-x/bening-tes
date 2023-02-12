<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow">
                <h5 class="card-header">edit user</h5>
                <div class="card-body">
                    <form action="<?= base_url('user-update/' . $data->id); ?>" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" value="<?= $data->email; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= $data->username; ?>" id="exampleInputUsername1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsernamew1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputUsernamew1">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div>
                    <div class="d-flex mb-3 p-3 bg-light justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=<?= session('user')->username; ?>" alt="" class="rounded-circle" style="width: 40px;">
                            <h3 class="m-2" style="font-size: 1rem;"><?= session('user')->username; ?></h3>
                        </div>
                        <a onclick=" event.preventDefault(); document.getElementById('formLogout').submit();" class="btn btn-dark btn-sm">Logout</a>
                    </div>
                </div>
                <div class="card-header">
                    <h4 class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">create</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">username</th>
                                <th scope="col">email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data)) {
                                foreach ($data as $data) : ?>
                                    <tr class="<?= $data['opened'] == 0 ? 'table-primary' : ''; ?>">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <img src="https://ui-avatars.com/api/?name=<?= $data["username"]; ?>" alt="" class="rounded-circle" style="width: 25px;">
                                                    <h3 class="m-2" style="font-size: 1rem;"><?= $data["username"]; ?></h3>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $data["email"]; ?></td>
                                        <td>
                                            <a href="/user-chat/<?= $data["id"]; ?>" class="btn btn-success btn-sm">chat</a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            } else { ?>
                                <tr>
                                    <td colspan="3">
                                        <div class="alert alert-info" role="alert">
                                            tidak ada percakapan
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user-store') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputUsername1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername11">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputUsername11">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {

    })
</script>
<?= $this->endSection(); ?>
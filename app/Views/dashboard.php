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
                    <h4 class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">mulai percakapan</h4>
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
                <h5 class="modal-title" id="exampleModalLabel">semua user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($user as $us) : ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="/user-chat/<?= $us->id; ?>" class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=<?= $us->username; ?>" alt="" class="rounded-circle" style="width: 25px;">
                                            <h3 class="m-2" style="font-size: 1rem;"><?= $us->username; ?></h3>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
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
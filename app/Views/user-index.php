<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <a href="<?= base_url('user-create'); ?>" class="btn btn-primary btn-sm">create user</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">username</th>
                                <th scope="col">email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($data as $dt) : ?>
                                <tr>
                                    <th><?= $i++; ?></th>
                                    <td><?= $dt->username; ?></td>
                                    <td><?= $dt->email; ?></td>
                                    <td>
                                        <a href="user-edit/<?= $dt->id ?>" class="btn btn-warning btn-sm">edit</a>
                                        <form action="<?= base_url('user-delete/' . $dt->id) ?>" method="post" style="display: inline;">
                                            <input type="submit" class="btn btn-danger btn-sm">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
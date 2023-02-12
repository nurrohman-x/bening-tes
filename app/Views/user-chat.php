<?= $this->extend('layouts/index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center align-items-center">
                <div class="shadow pl-4 pr-4 pb-4 pt-2 rounded" style="width: 400px; height:80vh">
                    <a href="<?= base_url('dashboard') ?>" class="link-dark" style="font-size: 2rem;">&#8592</a>
                    <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name=<?= $user->username; ?>" alt="" class="rounded-circle" style="width: 15%;">
                        <h4 class="display-4 m-2" style="font-size: 1.4rem;"><?= $user->username; ?></h4>
                    </div>
                    <hr>
                    <div class="p-4 rounded d-flex flex-column mt-2 chat-box" id="box-chat">
                        <?php foreach ($data as $dt) : ?>
                            <p class="<?= $dt->from_id != session('user')->id ? 'ltext' : 'rtext align-self-end'; ?>  border rounded p-2 mb-1">
                                <?= $dt->message ?>
                                <small class="d-block">24:59</small>
                            </p>
                        <?php endforeach; ?>
                    </div>
                    <div class="input-group b-3">
                        <textarea id="message" cols="3" class="form-control"></textarea>
                        <button id="sendBtn" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    var scrollDown = function() {
        let chatBox = document.getElementById('box-chat')
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    scrollDown()

    $(document).ready(function() {
        $('#sendBtn').on('click', function() {
            message = $('#message').val()
            if (message == '') return

            $.post('<?= base_url('user-chat'); ?>', {
                message: message,
                to_id: <?= $user->id; ?>,
                conv_id: <?= $id_conv; ?>
            }, function(response) {
                let decode = JSON.parse(response)
                $("#message").val('')
                $('#box-chat').append(
                    `<p class="rtext align-self-end border rounded p-2 mb-1">${decode.message}
                        <small class="d-block">12:00</small>
                    </p>`
                )
                scrollDown()
            });
        })
    })
</script>
<?= $this->endSection(); ?>
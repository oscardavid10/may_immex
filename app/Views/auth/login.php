<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <?php if (session()->getFlashdata('error')) : ?>
    <p><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <button type="submit">Login</button>
    </form>
</body>

</html>
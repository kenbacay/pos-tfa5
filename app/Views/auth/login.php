<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

    <h1>POS Login</h1>

    <?php if (isset($validation)): ?>
        <div style="color: red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div style="color: red;">
            <?= esc($error) ?>
        </div>
    <?php endif; ?>

<form action="<?= site_url('login') ?>" method="post">
    <?= csrf_field() ?>

    <label for="username">Username:</label><br>
    <input
        type="text"
        name="username"
        id="username"
        value="<?= old('username') ?>"
    >

    <br><br>

    <label for="password">Password:</label><br>
    <input
        type="password"
        name="password"
        id="password"
    >

    <br><br>

    <button type="submit">Login</button>

</form>
</body>
</html>
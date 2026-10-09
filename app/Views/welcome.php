<!DOCTYPE html>
<html>
<head>
    <title>Tasks for Today</title>
</head>
<body>

    <?php if (session()->get('logged_in')): ?>
        <a href="<?= site_url('logout') ?>">Logout</a>
    <?php else: ?>
        <a href="<?= site_url('login') ?>">Login</a>
    <?php endif; ?>

    <h1>Tasks for Today</h1>

    <nav>
        <a href="<?= site_url('/') ?>">Welcome</a> |
        <a href="<?= site_url('tasks') ?>">Task List</a> |
        <a href="<?= site_url('profile') ?>">Profile</a> |
        <a href="<?= site_url('about') ?>">About</a>
    </nav>

    <br>

    <table border="1" cellpadding="8">
        <tr>
            <th>Task</th>
            <th>Status</th>
            <th>Date</th>
        </tr>

        <?php if (empty($tasks)): ?>
            <tr>
                <td colspan="3">No tasks for today.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= esc($task['title']) ?></td>
                    <td><?= esc($task['status'] ?? '') ?></td>
                    <td><?= esc($task['task_date']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

</body>
</html>
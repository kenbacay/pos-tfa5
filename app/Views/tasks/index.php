<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
</head>
<body>

    <?php if (session()->get('logged_in')): ?>
        <a href="<?= site_url('logout') ?>">Logout</a>
    <?php else: ?>
        <a href="<?= site_url('login') ?>">Login</a>
    <?php endif; ?>

    <h1>Task List</h1>

    <?php if (session()->get('logged_in')): ?>
        <a href="<?= site_url('tasks/new') ?>">Add New Task</a>
    <?php endif; ?>

    <br><br>

    <?php if (empty($tasks)): ?>
        <p>No active tasks found.</p>
    <?php else: ?>

        <?php foreach ($tasks as $task): ?>
            <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">

                <h3><?= esc($task['title']) ?></h3>

                <p>
                    Status: <?= esc($task['status'] ?? '') ?>
                </p>

                <p>
                    Task date: <?= esc($task['task_date']) ?>
                </p>

                <?php if (session()->get('logged_in')): ?>
                    <a href="<?= site_url('tasks/edit/' . $task['id']) ?>">
                        Edit
                    </a>

                    <form
                        action="<?= site_url('tasks/delete/' . $task['id']) ?>"
                        method="post"
                        style="display: inline;"
                    >
                        <?= csrf_field() ?>

                        <button type="submit">
                            Delete
                        </button>
                    </form>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>

    <?php endif; ?>

    <br>

    <a href="<?= site_url('/') ?>">Back to Welcome</a>

</body>
</html>
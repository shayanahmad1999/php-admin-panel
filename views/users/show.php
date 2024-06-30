
<h1>User Details</h1>
<p>ID: <?= htmlspecialchars($user->id) ?></p>
<p>Name: <?= htmlspecialchars($user->name) ?></p>
<p>Email: <?= htmlspecialchars($user->email) ?></p>
<a href="<?= url('user') ?>">Back to list</a>

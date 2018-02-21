<?php require_once 'app/views/_global/header.php'; ?>

<h2>Prijava administratora</h2>

<?php if (isset($DATA['message'])): ?>
	<p class="message bg-danger"><?php echo $DATA['message']; ?></p>
<?php endif; ?>

<form method="POST" id="form">
	<div class="form-group">
		<label for="email">Email adresa:</label>
		<input type="email" class="form-control" id="email" name="email" required>
	</div>
	<div class="form-group">
		<label for="password">Lozinka:</label>
		<input type="password" class="form-control" id="password" name="password" required>
	</div>
	<button type="submit" class="btn btn-primary">Prijava</button>
</form>

<?php

require_once 'app/views/_global/footer.php';

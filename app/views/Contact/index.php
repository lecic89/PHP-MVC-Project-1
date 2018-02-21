<?php require_once 'app/views/_global/header.php'; ?>

<h2>Kontakt</h2>

<?php if (isset($DATA['message'])): ?>
	<p class="message <?php

	if (isset($DATA['status']))
	{
		echo ' bg-success';
	}
	else
	{
		echo ' bg-danger';
	}

	?>"><?php echo $DATA['message']; ?></p>
   <?php endif; ?>

<form method="POST" id="form">
	<?php if (!Session::exists(Config::USER_SESSION)): ?>
		<div class="form-group">
			<label for="email">Email adresa:</label>
			<input type="email" class="form-control" id="email" name="email" required>
		</div>
	<?php endif; ?>
	<div class="form-group">
		<label for="content">Sadržaj:</label>
		<textarea id="content" name="content" class="form-control" required></textarea>
	</div>
	<button type="submit" class="btn btn-primary">Slanje</button>
</form>

<?php

require_once 'app/views/_global/footer.php';

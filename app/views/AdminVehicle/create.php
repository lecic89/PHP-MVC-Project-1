<?php require_once 'app/views/_global/header.php'; ?>

<h2>Dodavanje vozila</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>mvc-admin/users">Home</a></li>
		<li><a href="<?php echo Config::BASE; ?>mvc-admin/vehicles">Rad sa vozilima</a></li>
		<li class="active">Dodavanje vozila</li>
	</ol>
</nav>

<?php if (isset($DATA['message'])): ?>
	<p class="message bg-danger"><?php echo $DATA['message']; ?></p>
<?php endif; ?>

<form method="POST" id="form">
	<div class="form-group">
		<label for="name">Naziv:</label>
		<input type="text" class="form-control" id="name" name="name" pattern="<?php echo RegExHelper::patternForVehicleNameInSerbian(); ?>" required>
	</div>
	<button type="submit" class="btn btn-primary">Dodavanje</button>
</form>

<?php

require_once 'app/views/_global/footer.php';

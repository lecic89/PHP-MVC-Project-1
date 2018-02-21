<?php require_once 'app/views/_global/header.php'; ?>

<h2>Izmena grada</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>mvc-admin/users">Home</a></li>
		<li><a href="<?php echo Config::BASE; ?>mvc-admin/cities">Rad sa gradovima</a></li>
		<li class="active">Izmena grada</li>
	</ol>
</nav>

<?php if (isset($DATA['message'])): ?>
	<p class="message bg-danger"><?php echo $DATA['message']; ?></p>
<?php endif; ?>

<?php if ($DATA['city']): ?>
	<form method="POST" id="form">
		<div class="form-group">
			<label for="name">Naziv:</label>
			<input type="text" class="form-control" id="name" name="name" pattern="<?php echo RegExHelper::patternForCityNameInSerbian(); ?>" value="<?php echo Sanitize::escape($DATA['city']->name); ?>" required>
		</div>
		<button type="submit" class="btn btn-primary">Izmena</button>
	</form>
<?php else: ?>
	<p class="alert alert-warning">Ne postoji grad sa zadatim ID parametrom!</p>
<?php endif; ?>

<?php

require_once 'app/views/_global/footer.php';

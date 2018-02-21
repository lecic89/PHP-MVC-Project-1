<?php require_once 'app/views/_global/header.php'; ?>

<h2>Izmena korisnika</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>mvc-admin/users">Home</a></li>
		<li class="active">Izmena korisnika</li>
	</ol>
</nav>

<?php if (isset($DATA['message'])): ?>
	<p class="message bg-danger"><?php echo $DATA['message']; ?></p>
<?php endif; ?>

<?php if ($DATA['user']): ?>
	<form id="form" method="POST">
		<div class="form-group">
			<label for="fn">Ime:</label>
			<input type="text" class="form-control" id="fn" name="first_name" value="<?php echo Sanitize::escape($DATA['user']->first_name); ?>" pattern="<?php echo RegExHelper::patternForFirstOrLastNameInSerbian(); ?>" required>
		</div>
		<div class="form-group">
			<label for="ln">Prezime:</label>
			<input type="text" class="form-control" id="ln" name="last_name" value="<?php echo Sanitize::escape($DATA['user']->last_name); ?>" pattern="<?php echo RegExHelper::patternForFirstOrLastNameInSerbian(); ?>" required>
		</div>
		<div class="form-group">
			<label for="email">Email adresa:</label>
			<input type="email" class="form-control" id="email" name="email" value="<?php echo Sanitize::escape($DATA['user']->email); ?>" required>
		</div>
		<button type="submit" class="btn btn-primary">Izmena</button>
	</form>
<?php else: ?>
	<p class="alert alert-warning">Ne postoji korisnik sa zadatim ID parametrom!</p>
<?php endif; ?>

<?php

require_once 'app/views/_global/footer.php';

<?php

require_once 'app/views/_global/header.php';

?>

<h2>Dodavanje korisnika</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>mvc-admin/users">Home</a></li>
		<li class="active">Dodavanje korisnika</li>
	</ol>
</nav>

<?php if (isset($DATA['message'])): ?>
	<p class="message bg-danger"><?php echo $DATA['message']; ?></p>
<?php endif; ?>

<form method="POST" id="form">
	<div class="form-group">
		<label for="fn">Ime:</label>
		<input type="text" class="form-control" id="fn" name="first_name" pattern="<?php echo RegExHelper::patternForFirstOrLastNameInSerbian(); ?>" required>
	</div>
	<div class="form-group">
		<label for="ln">Prezime:</label>
		<input type="text" class="form-control" id="ln" name="last_name" pattern="<?php echo RegExHelper::patternForFirstOrLastNameInSerbian(); ?>" required>
	</div>
	<div class="form-group">
		<label for="email">Email adresa:</label>
		<input type="email" class="form-control" id="email" name="email" required>
	</div>
	<div class="form-group">
		<label for="password">Lozinka:</label>
		<input type="password" class="form-control" id="password" name="password" required>
	</div>
	<button type="submit" class="btn btn-primary">Dodavanje</button>
</form>

<?php

require_once 'app/views/_global/footer.php';

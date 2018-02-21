<?php

require_once 'app/views/_global/header.php';

?>

<h2>Dodavanje ponude</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>usluge-transporta">Usluge transporta</a></li>
		<li><a href="<?php echo Config::BASE; ?>usluge-transporta/<?php echo $DATA['service']->id; ?>">Usluga #<?php echo $DATA['service']->id; ?></a></li>
		<li class="active">Dodavanje ponude</li>
	</ol>
</nav>

<?php if (isset($DATA['message'])): ?>
	<p class="message bg-danger"><?php echo $DATA['message']; ?></p>
<?php endif; ?>

<form method="POST">
	<div class="form-group">
		<label for="price">Cena:</label>
		<input type="number" class="form-control" id="price" name="price" min="50" step="1" value="50" required>
	</div>
	<div class="form-group">
		<label for="description">Opis:</label>
		<textarea id="description" name="description" class="form-control" required></textarea>
	</div>
	<button type="submit" class="btn btn-primary">Dodavanje</button>
</form>

<?php

require_once 'app/views/_global/footer.php';

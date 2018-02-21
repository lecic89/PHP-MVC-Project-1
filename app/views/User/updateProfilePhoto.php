<?php require_once 'app/views/_global/header.php'; ?>

<h2>Izmena profilne slike</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>moj-profil">Moj profil</a></li>
		<li class="active">Izmena profilne slike</li>
	</ol>
</nav>

<?php if (isset($DATA['message'])): ?>
	<p class="message bg-danger"><?php echo $DATA['message']; ?></p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
	<div class="input-group">
		<label for="profile_photo">Odaberite sliku koju želite da postavite kao profilnu:</label>
		<input type="file" name="profile_photo" id="profile_photo" class="form-control" required>
	</div>
	<br>
    <button type="submit" class="btn btn-primary">Izmena profilne slike</button>
</form>

<?php

require_once 'app/views/_global/footer.php';

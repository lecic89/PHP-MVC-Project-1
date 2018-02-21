<?php require_once 'app/views/_global/header.php'; ?>

<h2>Profil</h2>

<?php if ($DATA['user']): ?>
	<div class="col-lg-6 col-sm-12 text-center">
		<img src="<?php echo Config::BASE.Config::IMAGE_PATH.$DATA['user']->profile_photo; ?>" alt="<?php echo Sanitize::escape($DATA['user']->first_name.' '.$DATA['user']->last_name); ?>" class="img-responsive img-thumbnail">
	</div>
	<div class="col-lg-6 col-sm-12">
		<dl class="dl-horizontal">
			<dt>Ime:</dt>
			<dd><?php echo Sanitize::escape($DATA['user']->first_name); ?></dd>
			<dt>Prezime:</dt>
			<dd><?php echo Sanitize::escape($DATA['user']->last_name); ?></dd>
			<dt>Email:</dt>
			<dd><?php echo Sanitize::escape($DATA['user']->email); ?></dd>
		</dl>
		<hr>
		<p class="pull-right">Član od <?php echo date('d.m.Y', strtotime($DATA['user']->created_at)); ?>.</p>
	</div>
<?php else: ?>
	<p class="alert alert-warning">Ne postoji osoba sa zadatim ID parametrom!</p>
<?php endif; ?>

<?php

require_once 'app/views/_global/footer.php';

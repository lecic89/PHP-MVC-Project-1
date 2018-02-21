<?php require_once 'app/views/_global/header.php'; ?>

<h2>Inbox</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>mvc-admin/users">Home</a></li>
		<li><a href="<?php echo Config::BASE; ?>mvc-admin/inbox">Inbox</a></li>
		<li class="active">Poruka</li>
	</ol>
</nav>

<?php if ($DATA['message']): ?>
	<article>
		<h3 class="alert alert-info"><?php echo Sanitize::escape($DATA['message']->email); ?></h3>
		<p><?php echo Sanitize::escape($DATA['message']->content); ?></p>
	</article>
	<hr>
	<p class="pull-right"><?php echo date('H:i:s d.m.Y', strtotime($DATA['message']->created_at)); ?></p>
	<p>
		<a href="mailto:<?php echo Sanitize::escape($DATA['message']->email); ?>" class="btn btn-info">
			<span class="glyphicon glyphicon-envelope"></span> Odgovori na poruku
		</a>

		<a href="<?php echo Config::BASE; ?>mvc-admin/inbox/delete/<?php echo $DATA['message']->id; ?>" onclick="return confirm('Da li ste sigurni?');" class="btn btn-danger">
			<span class="glyphicon glyphicon-remove"></span> Obriši poruku
		</a>
	</p>
<?php else: ?>
	<div class="alert alert-warning">Ne postoji poruka sa zadatim ID parametrom!</div>
<?php endif; ?>

<?php

require_once 'app/views/_global/footer.php';

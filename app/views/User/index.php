<?php require_once 'app/views/_global/header.php'; ?>

<h2>Moj profil</h2>

<nav>
	<ol class="breadcrumb">
		<li class="active">Moj profil</li>
	</ol>
</nav>

<div class="col-lg-6 col-sm-12 text-center">
	<img src="<?php echo Config::BASE.Config::IMAGE_PATH.$DATA['user']->profile_photo; ?>" alt="<?php echo Sanitize::escape($DATA['user']->first_name.' '.$DATA['user']->last_name); ?>" class="img-responsive img-thumbnail">
	<br><br>
	<a href="<?php echo Config::BASE; ?>moj-profil/slika" class="btn btn-primary"><span class="glyphicon glyphicon-camera"></span> Promeni profilnu sliku</a>
	<br><br>
	<a href="<?php echo Config::BASE; ?>moj-profil/izmena" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Izmena profila</a>
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

<?php

require_once 'app/views/_global/footer.php';

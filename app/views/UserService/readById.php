<?php require_once 'app/views/_global/header.php'; ?>

<h2>Detalji</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>usluge-transporta">Usluge transporta</a></li>
		<li class="active">Detalji</li>
	</ol>
</nav>

<?php if ($DATA['service']): ?>
	<div>
		<dl class="dl-horizontal">
			<dt>Prevoznik:</dt>
			<dd>
				<a href="<?php echo Config::BASE; ?>profil/<?php echo $DATA['service']->user_id; ?>">
					<?php echo Sanitize::escape($DATA['service']->user); ?>
				</a>
			</dd>
			<dt>Metod transporta:</dt>
			<dd><?php echo Sanitize::escape($DATA['service']->vehicle); ?></dd>
			<dt>Od:</dt>
			<dd><?php echo Sanitize::escape($DATA['service']->from_city); ?></dd>
			<dt>Do:</dt>
			<dd><?php echo Sanitize::escape($DATA['service']->to_city); ?></dd>
			<dt>Opis:</dt>
			<dd><?php echo Sanitize::escape($DATA['service']->description); ?></dd>
			<dt>Vreme i datum:</dt>
			<dd><?php echo date('H:i, d.m', strtotime($DATA['service']->at)); ?></dd>
			<dt>Status:</dt>
			<dd><?php

				if ($DATA['service']->active)
				{
					echo 'Aktivna';
				}
				else
				{
					echo 'Neaktivna';
				}

				?></dd>
		</dl>
		<hr>
		<?php if ($DATA['service']->user_id === Session::get(Config::USER_SESSION)): ?>
			<div id="offers" data-service-id="<?php echo $DATA['service']->id; ?>" data-url="<?php echo Config::BASE; ?>ponude"></div>
			<button type="button" id="refresh" class="btn btn-success btn-xs">Osveži podatke</button>
		<?php endif; ?>
		<hr>
		<?php if ($DATA['service']->user_id === Session::get(Config::USER_SESSION)): ?>
			<a class="btn btn-warning" href="<?php echo Config::BASE; ?>usluge-transporta/uklanjanje-ponude" onclick="return confirm('Da li ste sigurni?');">Ukloni ponudu</a>
		<?php else: ?>
			<a class="btn btn-warning" href="<?php echo Config::BASE; ?>dodavanje-ponude/<?php echo $DATA['service']->id; ?>/">Ostavi ponudu</a>
		<?php endif; ?>
	</div>
<?php else: ?>
	<p class="alert alert-warning">Ne postoji transportna usluga sa zadatim ID parametrom!</p>
<?php endif; ?>

<?php

require_once 'app/views/_global/footer.php';

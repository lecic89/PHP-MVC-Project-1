<?php require_once 'app/views/_global/header.php'; ?>

<h2>Aktuelne pošiljke</h2>

<nav>
	<ol class="breadcrumb">
		<li class="active">Pošiljke</li>
	</ol>
</nav>

<div class="row">
	<article class="col-lg-6 col-sm-12">
		<h4>Kao vozač:</h4>
		<?php if ($DATA['asDriver']): ?>
			<ul class="list-group">
				<?php foreach ($DATA['asDriver'] as $shipment): ?>
					<li class="list-group-item">
						<h5><?php echo Sanitize::escape($shipment->delivery_code); ?></h5>
						<a href="<?php echo Config::BASE; ?>isporuka/<?php echo $shipment->id; ?>">Detalji</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<div class="alert alert-warning text-center">/</div>
		<?php endif; ?>
	</article>
	<article class="col-lg-6 col-sm-12">
		<h4>Kao korisnik:</h4>
		<?php if ($DATA['asUser']): ?>
			<ul class="list-group">
				<?php foreach ($DATA['asUser'] as $shipment): ?>
					<li class="list-group-item">
						<h5><?php echo Sanitize::escape($shipment->delivery_code); ?></h5>
						<a href="<?php echo Config::BASE; ?>isporuka/<?php echo $shipment->id; ?>">Detalji</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<div class="alert alert-warning text-center">/</div>
		<?php endif; ?>
	</article>
</div>

<?php

require_once 'app/views/_global/footer.php';

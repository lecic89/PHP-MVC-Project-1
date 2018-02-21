<?php require_once 'app/views/_global/header.php'; ?>

<h2>Pošiljka - detalji</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>isporuka">Pošiljke</a></li>
		<li class="active">Detalji</li>
	</ol>
</nav>

<?php if ($DATA['shipment']): ?>
	<h3><?php echo Sanitize::escape($DATA['shipment']->delivery_code); ?></h3>
	<br>
	<dl class="dl-horizontal">
		<dt>Korisnik:</dt>
		<dd>
			<a href="<?php echo Config::BASE; ?>profil/<?php echo $DATA['shipment']->user_id; ?>">
				<?php echo Sanitize::escape($DATA['shipment']->user); ?>
			</a>
		</dd>
		<dt>Prevoznik:</dt>
		<dd>
			<a href="<?php echo Config::BASE; ?>profil/<?php echo $DATA['shipment']->driver_id; ?>">
				<?php echo Sanitize::escape($DATA['shipment']->driver); ?>
			</a>
		</dd>
		<dt>Metod transporta:</dt>
		<dd><?php echo Sanitize::escape($DATA['shipment']->vehicle); ?></dd>
		<dt>Od:</dt>
		<dd><?php echo Sanitize::escape($DATA['shipment']->from_city); ?></dd>
		<dt>Do:</dt>
		<dd><?php echo Sanitize::escape($DATA['shipment']->to_city); ?></dd>
		<dt>Opis:</dt>
		<dd><?php echo Sanitize::escape($DATA['shipment']->description); ?></dd>
		<dt>Vreme i datum:</dt>
		<dd><?php echo date('H:i, d.m', strtotime($DATA['shipment']->start_time)); ?></dd>
	</dl>
	<hr>
	<?php if ($DATA['shipment']->user_id === Session::get(Config::USER_SESSION)): ?>
		<dl>
			<dt>Trenutni status pošiljke:</dt>
			<dd><?php echo Sanitize::escape($DATA['shipment']->delivery_code); ?></dd>
			<?php if (isset($DATA['updates']) and ( isset($DATA['updates'][0]->message))): ?>
				<dt>Poslednja poruka:</dt>
				<dd><?php echo Sanitize::escape($DATA['updates'][0]->message); ?></dd>
			<?php endif; ?>
		</dl>
		<?php if ($DATA['shipment']->delivery_code === $DATA['codes'][2]->status or $DATA['shipment']->delivery_code === $DATA['codes'][3]->status): ?>
			<a href="<?php echo Config::BASE; ?>isporuka/uklanjanje/<?php echo $DATA['shipment']->id; ?>" onclick="return confirm('Da li ste sigurni?');" class="btn btn-danger btn-xs">Uklanjanje</a>
		<?php endif; ?>
	<?php elseif ($DATA['shipment']->driver_id === Session::get(Config::USER_SESSION)) : ?>
		<h4>Izvestite klijenta o vašem trenutnom položaju i situaciji:</h4>
		<form class="form-inline" method="POST" id="form" data-shipment-id="<?php echo $DATA['shipment']->id; ?>" data-url="<?php echo Config::BASE; ?>isporuka/checkpoint">
			<div class="form-group">
				<label for="dc">Status isporuke:</label>
				<select name="dc" id="dc" class="form-control">
					<?php foreach ($DATA['codes'] as $dc) : ?>
						<?php if ($DATA['shipment']->delivery_code === $dc->status): ?>
							<option value="<?php echo $dc->id; ?>" selected><?php echo Sanitize::escape($dc->status); ?></option>
						<?php else: ?>
							<option value="<?php echo $dc->id; ?>"><?php echo Sanitize::escape($dc->status); ?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="input-group">
				<input type="text" class="form-control" id="message" name="message" placeholder="Ostavite vašu poruku ovde" pattern="<?php echo RegExHelper::patternForUserContentInSerbian(); ?>" required>
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">
						<i class="glyphicon glyphicon-paperclip"></i> Pošalji
					</button>
				</span>
			</div>
		</form>
	<?php endif; ?>
<?php else: ?>
	<p class="alert alert-warning">Ne postoji pošiljka sa zadatim ID parametrom!</p>
<?php endif; ?>

<?php

require_once 'app/views/_global/footer.php';

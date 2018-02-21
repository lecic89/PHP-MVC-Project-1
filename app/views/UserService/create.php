<?php require_once 'app/views/_global/header.php'; ?>

<h2>Dodavanje usluge transporta</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>usluge-transporta">Usluge transporta</a></li>
		<li class="active">Dodavanje usluge transporta</li>
	</ol>
</nav>

<?php if (isset($DATA['message'])): ?>
	<p class="message bg-danger"><?php echo $DATA['message']; ?></p>
<?php endif; ?>

<form method="POST" id="form">
	<div class="form-group">
		<label for="to">Metod transporta:</label>
		<select name="vehicle" id="vehicle" class="form-control">
			<?php foreach ($DATA['vehicles'] as $vehicle) : ?>
				<option value="<?php echo $vehicle->id; ?>"><?php echo Sanitize::escape($vehicle->name); ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="from">Od:</label>
		<select name="from" id="from" class="form-control">
			<?php foreach ($DATA['cities'] as $city) : ?>
				<option value="<?php echo $city->id; ?>"><?php echo Sanitize::escape($city->name); ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label for="to">Do:</label>
		<select name="to" id="to" class="form-control">
			<?php foreach ($DATA['cities'] as $city) : ?>
				<?php if ($city->id > 1 and $city->id < 3): ?>
					<option value="<?php echo $city->id; ?>" selected><?php echo Sanitize::escape($city->name); ?></option>
				<?php else: ?>
					<option value="<?php echo $city->id; ?>"><?php echo Sanitize::escape($city->name); ?></option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group row">
		<div class="col-xs-3">
			<div class="input-group">
				<label for="hours">Sat:</label>
				<input type="number" class="form-control" id="hours" name="hours" min="0" max="23" step="1" value="12" required>
			</div>
		</div>
		<div class="col-xs-3">
			<div class="input-group">
				<label for="minutes">minut:</label>
				<input type="number" class="form-control" id="minutes" name="minutes" min="0" max="59" step="1" value="0" required>
			</div>
		</div>
		<div class="col-xs-3">
			<div class="input-group">
				<label for="day">Dan:</label>
				<input type="number" class="form-control" id="day" name="day" min="1" max="31" step="1" value="<?php echo (date('d') + 1); ?>" required>
			</div>
		</div>
		<div class="col-xs-3">
			<div class="input-group">
				<label for="month">Mesec:</label>
				<input type="number" class="form-control" id="month" name="month" min="1" max="12" step="1" value="<?php echo date('m'); ?>" required>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="description">Opis:</label>
		<textarea id="description" name="description" class="form-control" required></textarea>
	</div>
	<button type="submit" class="btn btn-primary">Dodavanje</button>
</form>

<?php

require_once 'app/views/_global/footer.php';

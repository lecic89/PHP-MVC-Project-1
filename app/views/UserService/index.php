<?php require_once 'app/views/_global/header.php'; ?>

<h2>Usluge transporta</h2>

<nav>
	<ol class="breadcrumb">
		<li class="active">Usluge transporta</li>
	</ol>
</nav>

<?php if ($DATA['services']): ?>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr class="bg-primary">
					<th>Od</th>
					<th>Do</th>
					<th>Metod transporta</th>
					<th>Vreme i datum</th>
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($DATA['services'] as $service): ?>
					<tr<?php

					if ($service->user_id === Session::get(Config::USER_SESSION))
					{
						/**
						 * Ovde možemo dodati posebnu klasu za ponudu aktivnog
						 *  korisniak u slučaju da želimo da je dodatno istaknemo
						 * @example echo 'class="bg-warning"';
						 */
					}

					?>>
						<td><?php echo Sanitize::escape($service->from_city); ?></td>
						<td><?php echo Sanitize::escape($service->to_city); ?></td>
						<td><?php echo Sanitize::escape($service->vehicle); ?></td>
						<td><?php echo date('H:i, d.m', strtotime($service->at)); ?></td>
						<td class="text-center">
							<a class="btn btn-info" href="<?php echo Config::BASE; ?>usluge-transporta/<?php echo $service->id; ?>">Detalji</a>
						</td>
						<td class="text-center">
							<?php if ($service->user_id !== Session::get(Config::USER_SESSION)): ?>
								<a class="btn btn-warning" href="<?php echo Config::BASE; ?>dodavanje-ponude/<?php echo $service->id; ?>/">Ostavi ponudu</a>
							<?php else: ?>
								<a class="btn btn-warning" href="<?php echo Config::BASE; ?>usluge-transporta/uklanjanje-ponude" onclick="return confirm('Da li ste sigurni?');">Ukloni ponudu</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-danger">Nema ponuda trenutno.</div>
<?php endif; ?>

<?php if (!$DATA['status']): ?>
	<a href="<?php echo Config::BASE; ?>usluge-transporta/dodavanje" class="btn btn-primary">Ponudi uslugu transporta</a>
<?php else: ?>
	<a class="btn btn-warning" href="<?php echo Config::BASE; ?>usluge-transporta/uklanjanje-ponude" onclick="return confirm('Da li ste sigurni?');">Ukloni moju ponudu</a>
<?php endif; ?>

<?php

require_once 'app/views/_global/footer.php';

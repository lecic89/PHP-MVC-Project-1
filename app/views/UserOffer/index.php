<h4>Spisak zahteva za uslugom:</h4>
<?php if ($DATA['offers'] and count($DATA['offers'])): ?>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr class="bg-primary">
					<th>Korisnik</th>
					<th>Cena</th>
					<th>Opis</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($DATA['offers'] as $offer): ?>
					<tr>
						<td>
							<a href="<?php echo Config::BASE; ?>profil/<?php echo $offer->user_id; ?>">
								<?php echo Sanitize::escape($offer->user); ?>
							</a>
						</td>
						<td><?php echo Sanitize::escape($offer->price); ?></td>
						<td><?php echo Sanitize::escape($offer->description); ?></td>
						<td class="text-center">
							<a href="<?php echo Config::BASE; ?>isporuka/dodavanje/<?php echo $offer->id; ?>/" class="btn btn-primary">Prihvati</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-warning">Nema zahteva za uslugom trenutno!</div>
<?php endif;

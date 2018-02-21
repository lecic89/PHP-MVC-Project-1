<?php require_once 'app/views/_global/header.php'; ?>

<h2>Pregled aktivnosti logova korisnika</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>mvc-admin/users">Home</a></li>
		<li class="active">Pregled aktivnosti logova korisnika</li>
	</ol>
</nav>

<?php if ($DATA['logins']): ?>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr class="bg-primary">
					<th>Korisnik</th>
					<th>IP adresa</th>
					<th>Veb klijent</th>
					<th>Vreme i datum</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($DATA['logins'] as $row): ?>
					<tr>
						<td><?php echo Sanitize::escape($row->user->email); ?></td>
						<td><?php echo Sanitize::escape($row->remote_addr); ?></td>
						<td><?php echo Sanitize::escape($row->user_agent); ?></td>
						<td><?php echo date('H:i:s d.m.Y', strtotime($row->created_at)); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-danger">Nema logova u bazi trenutno.</div>
<?php endif; ?>

<?php

require_once 'app/views/_global/footer.php';

<?php require_once 'app/views/_global/header.php'; ?>

<h2>Pregled korisnika</h2>

<nav>
	<ol class="breadcrumb">
		<li class="active">Home</li>
	</ol>
</nav>

<?php if ($DATA['users']): ?>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr class="bg-primary">
					<th>Ime</th>
					<th>Prezime</th>
					<th>Email</th>
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($DATA['users'] as $row): ?>
					<tr>
						<td><?php echo Sanitize::escape($row->first_name); ?></td>
						<td><?php echo Sanitize::escape($row->last_name); ?></td>
						<td><?php echo Sanitize::escape($row->email); ?></td>
						<td class="text-center">
							<a class="btn btn-info" href="<?php echo Config::BASE; ?>mvc-admin/users/update/<?php echo $row->id; ?>">Izmena</a>
						</td>
						<td class="text-center">
							<a class="btn btn-danger" href="<?php echo Config::BASE; ?>mvc-admin/users/delete/<?php echo $row->id; ?>" onclick="return confirm('Da li ste sigurni?');">Uklanjanje</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-danger">Nema korisnika u bazi trenutno.</div>
<?php endif; ?>

<ul>
	<li><a href="<?php echo Config::BASE; ?>mvc-admin/users/add">Dodavanje novog korisnika</a></li>
	<li><a href="<?php echo Config::BASE; ?>mvc-admin/users/activity-log">Aktivnost logova korisnika</a></li>
	<li><a href="<?php echo Config::BASE; ?>mvc-admin/inbox">Inbox <span class="badge"><?php echo $DATA['unread']; ?></span></a></li>
	<li><a href="<?php echo Config::BASE; ?>mvc-admin/cities">Rad sa gradovima</a></li>
	<li><a href="<?php echo Config::BASE; ?>mvc-admin/vehicles">Rad sa vozilima</a></li>
</ul>

<?php

require_once 'app/views/_global/footer.php';

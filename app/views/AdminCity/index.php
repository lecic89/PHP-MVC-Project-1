<?php require_once 'app/views/_global/header.php'; ?>

<h2>Rad sa gradovima</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>mvc-admin/users">Home</a></li>
		<li class="active">Rad sa gradovima</li>
	</ol>
</nav>

<?php if ($DATA['cities']): ?>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr class="bg-primary">
					<th>Naziv</th>
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($DATA['cities'] as $row): ?>
					<tr>
						<td><?php echo Sanitize::escape($row->name); ?></td>
						<td class="text-center">
							<a class="btn btn-info" href="<?php echo Config::BASE; ?>mvc-admin/cities/update/<?php echo $row->id; ?>">Izmena</a>
						</td>
						<td class="text-center">
							<a class="btn btn-danger" href="<?php echo Config::BASE; ?>mvc-admin/cities/delete/<?php echo $row->id; ?>" onclick="return confirm('Da li ste sigurni?');">Uklanjanje</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-danger">Nema gradova u bazi trenutno.</div>
<?php endif; ?>

<p>
	<a href="<?php echo Config::BASE; ?>mvc-admin/cities/add">Dodavanje grada</a>
</p>

<?php

require_once 'app/views/_global/footer.php';

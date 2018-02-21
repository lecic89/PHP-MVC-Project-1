<?php require_once 'app/views/_global/header.php'; ?>

<h2>Inbox</h2>

<nav>
	<ol class="breadcrumb">
		<li><a href="<?php echo Config::BASE; ?>mvc-admin/users">Home</a></li>
		<li class="active">Inbox</li>
	</ol>
</nav>

<?php if ($DATA['messages']): ?>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr class="bg-primary">
					<th>Email</th>
					<th>Sadržaj</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($DATA['messages'] as $row): ?>
					<tr>
						<td>
							<a href="mailto:<?php echo Sanitize::escape($row->email); ?>"><?php echo Sanitize::escape($row->email); ?></a>
						</td>
						<td><?php echo substr(Sanitize::escape($row->content), 0, 50).'...'; ?></td>
						<td class="text-center">
							<?php if ($row->status): ?>
								<span class="glyphicon glyphicon-ok" title="Pročitana"></span>
							<?php else: ?>
								<span class="glyphicon glyphicon-unchecked" title="Nije pročitana!"></span>
							<?php endif; ?>
						</td>
						<td class="text-center">
							<a href="<?php echo Config::BASE; ?>mvc-admin/inbox/<?php echo $row->id; ?>">Detaljnije</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-danger">Nema poruka u sandučetu trenutno.</div>
<?php endif; ?>

<?php

require_once 'app/views/_global/footer.php';

<!DOCTYPE html>
<html>
	<head>
		<title><?php

			if (isset($DATA['title']))
			{
				echo $DATA['title'].' | ';
			}

			?>Post4Less</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo Config::BASE; ?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo Config::BASE; ?>assets/css/main.css">
	</head>
	<body>
		<?php if (Session::exists(Config::ADMIN_SESSION)): ?>
			<div class="container-fluid">
				<header>
					<h4>Admin Panel</h4>
				</header>
				<nav>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="<?php echo Config::BASE; ?>mvc-admin/users"><i class="glyphicon glyphicon-home"></i> Home</a>
						</li>
						<li>
							<a href="<?php echo Config::BASE; ?>mvc-admin/odjava" onclick="return confirm('Da li ste sigurni?');"><i class="glyphicon glyphicon-log-out"></i> Odjava</a>
						</li>
					</ul>
				</nav>
			</div>
		<?php endif; ?>
		<div class="container">
			<header>
				<h1>
					<a href="<?php echo Config::BASE; ?>">Post4Less</a>
				</h1>
			</header>
			<nav>
				<ul id="primary-nav" class="nav nav-tabs">
					<!-- Početna -->
					<li<?php

					if ($foundRoute['Controller'] === 'Home')
					{
						echo ' class="active"';
					}

					?>>
						<a href="<?php echo Config::BASE; ?>">Početna</a>
					</li>
					<!-- /Početna -->
					<?php if (Session::exists(Config::USER_SESSION)): ?>
						<!-- Profil -->
						<li<?php

						if ($foundRoute['Controller'] === 'User')
						{
							echo ' class="active"';
						}

						?>>
							<a href="<?php echo Config::BASE; ?>moj-profil">Profil</a>
						</li>
						<!-- /Profil -->
						<!-- Usluge -->
						<li<?php

						if ($foundRoute['Controller'] === 'UserService' or $foundRoute['Controller'] === 'UserOffer')
						{
							echo ' class="active"';
						}

						?>>
							<a href="<?php echo Config::BASE; ?>usluge-transporta">Usluge transporta</a>
						</li>
						<!-- /Usluge -->
						<!-- Isporuke -->
						<li<?php

						if ($foundRoute['Controller'] === 'UserShipment')
						{
							echo ' class="active"';
						}

						?>>
							<a href="<?php echo Config::BASE; ?>isporuka">Pošiljke</a>
						</li>
						<!-- /Isporuke -->
					<?php endif; ?>
					<!-- Kontakt -->
					<li<?php

					if ($foundRoute['Controller'] === 'Contact')
					{
						echo ' class="active"';
					}

					?>>
						<a href="<?php echo Config::BASE; ?>kontakt">Kontakt</a>
					</li>
					<!-- /Kontakt -->
				</ul>
				<?php if (!Session::exists(Config::ADMIN_SESSION)): ?>
					<?php if (Session::exists(Config::USER_SESSION)): ?>
						<a href="<?php echo Config::BASE; ?>odjava" onclick="return confirm('Da li ste sigurni?');" class="pull-right">Odjava</a>
					<?php else: ?>
						<a href="<?php echo Config::BASE; ?>prijava" class="pull-right">Prijava</a>
					<?php endif; ?>
				<?php endif; ?>
			</nav>
			<section class="row">
				<main class="col-lg-9 col-sm-12 clearfix">
<?php require_once 'app/views/_global/header.php'; ?>

<h2>Početna</h2>

<div class="row text-center">
	<div class="col-lg-3 col-lg-offset-1 col-sm-12 box">
		<a href="<?php echo Config::BASE; ?>usluge-transporta/dodavanje">
			<img src="<?php echo Config::BASE; ?>assets/img/transport.jpg" alt="Post4Less prevoznici" class="img-responsive img-circle">
		</a>
		<br>
		<p>Post4Less aplikacija namenjena je svima koji svakodnevno prelaze desetine ili stotine kilometara na putu do posla ili za potrebe izvršavanja određenih obaveza.</p>
	</div>
	<div class="col-lg-3 col-lg-offset-1 col-sm-12 box">
		<a href="<?php echo Config::BASE; ?>usluge-transporta">
			<img src="<?php echo Config::BASE; ?>assets/img/shipment.jpg" alt="Post4Less pošiljaoci" class="img-responsive img-circle">
		</a>
		<br>
		<p>Takođe, aplikacija je namenjena i korisnicima usluge transporta koji imaju potrebu da svakodnevno ili vrlo često šalju manje ili veće pošiljke na uručenje.</p>
	</div>
	<div class="col-lg-3 col-lg-offset-1 col-sm-12 box">
		<a href="<?php echo Config::BASE; ?>kontakt">
			<img src="<?php echo Config::BASE; ?>assets/img/contact-us.jpg" alt="Post4Less kontakt" class="img-responsive img-circle">
		</a>
		<br>
		<p>Ako imate pitanja pišite nam - naši operateri su tu samo zbog vas 24 časa dnevno 7 dana u nedelji.</p>
	</div>
</div>

<div class="row text-center">
	<p class="col-lg-3 col-lg-offset-1 col-sm-12 box">
		<a href="<?php echo Config::BASE; ?>usluge-transporta/dodavanje" class="btn btn-success btn-block">Ponudi uslugu transporta</a>
	</p>
	<p class="col-lg-3 col-lg-offset-1 col-sm-12 box">
		<a href="<?php echo Config::BASE; ?>usluge-transporta" class="btn btn-primary btn-block">Potraži uslugu transporta</a>
	</p>
	<p class="col-lg-3 col-lg-offset-1 col-sm-12 box">
		<a href="<?php echo Config::BASE; ?>kontakt" class="btn btn-danger btn-block">Kontaktirajte nas</a>
	</p>
</div>

<?php

require_once 'app/views/_global/footer.php';

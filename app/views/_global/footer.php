</main>
<aside class="col-lg-3 col-sm-12">
	<div class="widget text-center">
		<a href="https://www.facebook.com/" target="_blank">
			<img src="<?php echo Config::BASE; ?>assets/img/social/facebook.png" alt="Facebook">
		</a>
		<a href="https://www.instagram.com/" target="_blank">
			<img src="<?php echo Config::BASE; ?>assets/img/social/instagram.png" alt="Instagram">
		</a>
		<a href="https://twitter.com/" target="_blank">
			<img src="<?php echo Config::BASE; ?>assets/img/social/twitter.png" alt="Twitter">
		</a>
		<a href="#" target="_blank">
			<img src="<?php echo Config::BASE; ?>assets/img/social/rss.png" alt="RSS">
		</a>
	</div>
</aside>
</section>
<footer>
	<?php if (!Session::exists(Config::ADMIN_SESSION) and ! Session::exists(Config::USER_SESSION)): ?>
		<p>
			<a href="<?php echo Config::BASE; ?>mvc-admin/" title="Dodato kao link za potrebe drugog preseka iz predmeta PIVT">Prijava administratora</a>
		</p>
	<?php endif; ?>
	<p>&copy; Mlecic89, <?php echo date('Y'); ?>.</p>
</footer>
</div>
<script src="<?php echo Config::BASE; ?>assets/js/main.js"></script>
<?php

$script = 'assets/js/'.$foundRoute['Controller'].'/'.$foundRoute['Method'].'.js';
if (file_exists($script))
{
	echo '<script src="'.Config::BASE.$script.'"></script>'.PHP_EOL;
}

?>
</body>
</html>
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
</main>
<footer class="bg-dark text-white">
	<div class="container">
		<div class="row py-5">
			<div class="col-md-4">
				<div align="center">
					<img src="<?= base_url()?>assets/img/GRUPO_MAIS.png" style="width: 70%;">
				</div>
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-6 my-2">
						<h4>Controles de sistemas online</h4>

						<?php if ($this->session->userdata("usuario_logado")) : ?>
							<p> </p>
							<?php endif; ?>
					</div>
					<div class="col-md-6 my-2">
						<h4>Email para suporte:</h4>
						<p>tiagofranca@marizafoods.com.br</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

</body>
</main>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/popper.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/admin_mariza.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.mask.min.js') ?>"></script>


</html>
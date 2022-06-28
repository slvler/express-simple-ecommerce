<?php $this->load->view('home/layout/header'); ?>
<?php
$this->load->helper('contact/contact');
$extra = json_decode(contact_page()["extra"]);
?>
	<div id="main" class="mb-3 mt-3 page-payment">

		<div class="shape shape5"></div>

		<div class="shape shape2"></div>

		<div class="container">			

			<div class="payment text-center py-5 mt-5">

				<h1 class="text-success text-center mb-3">Siparişiniz onaylandı!</h1>

				<p>Siparişiniz, <strong><?php echo $orderkey; ?></strong> sipariş kodu ile sistemimize başarı ile kayıt edilmiş, e-posta adresinize de iletilmiştir.</p>

				<p>Siparişiniz ile ilgili sorularınız için yetkililerimize, <br />

				<a href="mailto:<?php echo $extra[3]->value; ?>"><strong><?php echo $extra[3]->value; ?></strong></a> e-posta adresinden ve <a href="tel:<?php echo $extra[4]->value; ?>"><strong><?php echo $extra[4]->value; ?></strong></a> numaralı çağrı merkezimizden ulaşabilirsiniz.</p>

				<p><strong>Özsüt'ü tercih ettiğiniz için teşekkürler.</strong></p>

			</div>

		</div>

	</div>

	

<?php $this->load->view('home/layout/footer'); ?>
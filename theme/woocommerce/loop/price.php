<?php

global $product;
?>

<?php if ($price_html = $product->get_price_html()) : ?>

	<span class="price">
		<span class="price--on_sale"><?= number_format($product->get_price(), 0, '', ' ') ?> BYN</span>
		<?php if ($product->is_on_sale()) { ?>
			<span class="price--regular"><?= number_format($product->get_regular_price(), 0, '', ' ') ?> BYN</span>
		<?php } ?>
	</span>
<?php else: ?>
	<span class="price">
		Цена по запросу
	</span>
<?php endif; ?>
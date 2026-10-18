export default () => {
	jQuery(document).ready(function ($) {
		const debouncedClick = debounce(() => $('.update_cart_btn').click(), 600);

		$('main.cart-page').on('click', '.quantity button', function () {
			const btn = $(this);

			const inputQty = btn.parent().find('.qty');
			const prevVal = +inputQty.val();
			let newVal = 1;

			if (btn.hasClass('btn-plus')) {
				newVal = prevVal + 1;
			} else {
				if (prevVal > 1) {
					newVal = prevVal - 1;
				}
			}

			inputQty.val(newVal);

			$('.update_cart_btn').prop('disabled', false);

			debouncedClick();
		});
	});

	function debounce(func, wait) {
		let timeout;
		return function (...args) {
			const context = this;
			clearTimeout(timeout);
			timeout = setTimeout(() => func.apply(context, args), wait);
		};
	}
};

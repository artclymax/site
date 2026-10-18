export default () => {
	const checkbox = document.querySelector('input[name="on_sale"]');
	const form = document.getElementById('sale-filter-form');

	if (form) {
		checkbox.addEventListener('change', function () {
			form.submit();
		});
	}
};

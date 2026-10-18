export default () => {
	const phoneInput = document.querySelectorAll('input[type="tel"]');

	phoneInput.forEach((el) => {
		IMask(el, {
			mask: '+375 (00) 000-00-00',
		});
	});
};

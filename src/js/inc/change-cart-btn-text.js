export default () => {
	const btnsContainers = document.querySelectorAll(
		'.product__card--footer-btns',
	);

	const observer = new MutationObserver((mutations) => {
		mutations.forEach((mutation) => {
			if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
				if (
					mutation.previousSibling &&
					mutation.previousSibling.classList.contains('added')
				) {
					mutation.previousSibling.textContent = 'В корзине';
				}
			}
		});
	});

	const config = { childList: true, subtree: true };

	btnsContainers.forEach((btnsContainer) => {
		observer.observe(btnsContainer, config);
	});
};

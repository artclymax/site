export default () => {
	const categoryMenu = document.querySelector('.category__menu--container');

	if (!categoryMenu) return;

	categoryMenu.addEventListener('mouseover', () => {
		document.body.style.overflow = 'hidden';
	});

	categoryMenu.addEventListener('mouseout', () => {
		document.body.style.overflow = 'auto';
	});
};

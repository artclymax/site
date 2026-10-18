export default () => {
	const searchForms = ['searchform', 'searchform-mobile'];

	searchForms.forEach((form) => {
		const searchForm = document.getElementById(form);

		if (searchForm) {
			const searchIcons = document.querySelectorAll('.search-icon');

			searchIcons.forEach((icon) => {
				icon.addEventListener('click', function () {
					searchForm.submit();
				});
			});
		}
	});
};

export default () => {
	const breakpoints = {
		mobile: 1280,
	};

	jQuery(document).ready(function ($) {
		$('header .burger').on('click', function (event) {
			if (window.innerWidth <= breakpoints.mobile) {
				$('body').removeClass('body-contacts-show');

				$('body').toggleClass('body-nav-show');

				// $('.menu-item a').on('click', function () {
				// 	$('body').removeClass('body-nav-show');
				// });
			}
		});

		$('header #phone-icon').on('click', function (event) {
			if (window.innerWidth <= breakpoints.mobile) {
				$('body').removeClass('body-nav-show');

				$('body').toggleClass('body-contacts-show');
			}
		});
	});

	const itemsHasChildren = document.querySelectorAll('.menu-item-has-children');

	itemsHasChildren.forEach((item) => {
		item.addEventListener('click', () => {
			item.classList.toggle('open');
		});
	});
};

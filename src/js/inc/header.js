export default () => {
	let header = document.getElementsByTagName('header')[0],
		init = false,
		scroll_pos = 0,
		scroll_pos_2 = window.pageYOffset,
		header_height = 80;

	window.onload = function () {
		if (window.pageYOffset > 80) {
			header.classList.add('block__header--bg');
		} else {
			header.classList.remove('block__header--bg');
		}
	};

	scroll_pos_2 =
		scroll_pos_2 > header_height ? scroll_pos_2 + header_height : header_height;

	window.addEventListener('scroll', function () {
		if (window.pageYOffset > 80) {
			header.classList.add('block__header--bg');
		} else {
			header.classList.remove('block__header--bg');
		}

		if (
			document.body.classList.contains('body-nav-show') &&
			window.innerWidth < 1025
		) {
			return;
		}
		let scroll_num = window.pageYOffset;
		if (scroll_num > scroll_pos && init) {
			if (scroll_num > scroll_pos_2) {
				header.classList.add('block__header--hide');
			}
		} else {
			header.classList.remove('block__header--hide');
			scroll_pos_2 = scroll_num + header_height;
			init = true;
		}
		scroll_pos = scroll_num;
	});
};

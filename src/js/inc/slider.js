export default () => {
	new Swiper('.brands__swiper', {
		slidesPerView: 2,
		spaceBetween: 8,
		loop: true,

		breakpoints: {
			400: { slidesPerView: 3, spaceBetween: 8 },
			768: { slidesPerView: 6, spaceBetween: 8 },
			1025: { slidesPerView: 6, spaceBetween: 24 },
		},

		navigation: {
			prevEl: '.brands__button-prev',
			nextEl: '.brands__button-next',
		},
	});

	new Swiper('.reviews__swiper', {
		slidesPerView: 'auto',
		centeredSlides: true,
		spaceBetween: 20,
		loop: true,

		breakpoints: {
			358: { slidesPerView: 1, spaceBetween: 8 },
			450: { slidesPerView: 2, spaceBetween: 8 },
			768: { slidesPerView: 3, spaceBetween: 8 },
			1025: { slidesPerView: 3, spaceBetween: 8 },
		},

		navigation: {
			prevEl: '.reviews__button-prev',
			nextEl: '.reviews__button-next',
		},
	});

	new Swiper('.o-kompanii__swiper', {
		slidesPerView: 3,
		loop: false,

		fadeEffect: {
			crossFade: true,
		},

		breakpoints: {
			358: {
				slidesPerView: 1,
				spaceBetween: 10,
			},

			768: {
				slidesPerView: 2,
				spaceBetween: 20,
			},

			1024: {
				slidesPerView: 4,
				spaceBetween: 24,
			},
		},

		navigation: {
			prevEl: '.button-prev',
			nextEl: '.button-next',
		},

		// pagination: {
		// 	el: '.o-kompanii__swiper-pagination',
		// 	clickable: true,
		// },
	});

	const swiper = new Swiper('.product-swiper-thumbnail', {
		loop: true,
		spaceBetween: 10,
		slidesPerView: 4,
		freeMode: true,
		watchSlidesProgress: true,
	});
	new Swiper('.product-swiper-main', {
		loop: true,
		spaceBetween: 10,
		slidesPerView: 1,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		thumbs: {
			swiper: swiper,
		},
	});
};

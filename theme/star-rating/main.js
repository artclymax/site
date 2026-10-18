const stars = new StarRating('.star-rating', {
	tooltip: '',
});

const reviewsSwiper = new Swiper('.mx-reviews-swiper', {
	slidesPerView: 1,
	spaceBetween: 0,
	loop: true,
	centeredSlides: true,
	initialSlide: 1,
	autoplay: true,
	navigation: {
		nextEl: '.mx-reviews-swiper__btn-next',
		prevEl: '.mx-reviews-swiper__btn-prev',
	},
	pagination: {
		el: '.mx-reviews-swiper__pagination',
		clickable: true,
	},
	breakpoints: {
		768: {
			slidesPerView: 2.9,
			spaceBetween: 0,
		},
	},
})

Fancybox.bind("[data-fancybox]", {
	placeFocusBack: false,
});
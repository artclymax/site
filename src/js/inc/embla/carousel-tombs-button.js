export const addThumbBtnsClickHandlers = (emblaApiMain, emblaApiThumb) => {
	const slidesThumbs = emblaApiThumb.slideNodes();

	const scrollToIndex = slidesThumbs.map((_, index) => () =>
		emblaApiMain.scrollTo(index)
	);

	slidesThumbs.forEach((slideNode, index) => {
		slideNode.addEventListener('click', scrollToIndex[index], false);
	});

	return () => {
		slidesThumbs.forEach((slideNode, index) => {
			slideNode.removeEventListener('click', scrollToIndex[index], false);
		});
	};
};

export const addToggleThumbBtnsActive = (emblaApiMain, emblaApiThumb) => {
	const slidesThumbs = emblaApiThumb.slideNodes();

	const toggleThumbBtnsState = () => {
		const previous = emblaApiMain.previousScrollSnap();
		const selected = emblaApiMain.selectedScrollSnap();
		slidesThumbs[previous].classList.remove('embla-thumbs__slide--selected');
		slidesThumbs[selected].classList.add('embla-thumbs__slide--selected');
	};

	emblaApiMain.on('select', toggleThumbBtnsState);
	emblaApiThumb.on('init', () => {
		slidesThumbs.forEach((slide) => {
			slide.classList.remove('embla-thumbs__slide--selected');
		});

		if (slidesThumbs.length) {
			slidesThumbs[0].classList.add('embla-thumbs__slide--selected');
		}
	});

	return () => {
		const selected = emblaApiMain.selectedScrollSnap();
		slidesThumbs[selected].classList.remove('embla-thumbs__slide--selected');
	};
};

export const addTogglePrevNextBtnsActive = (emblaApi, prevBtn, nextBtn) => {
	const togglePrevNextBtnsState = () => {
		if (emblaApi.canScrollPrev()) prevBtn.removeAttribute('disabled');
		else prevBtn.setAttribute('disabled', 'disabled');

		if (emblaApi.canScrollNext()) nextBtn.removeAttribute('disabled');
		else nextBtn.setAttribute('disabled', 'disabled');
	};

	emblaApi
		.on('select', togglePrevNextBtnsState)
		.on('init', togglePrevNextBtnsState)
		.on('reInit', togglePrevNextBtnsState);

	return () => {
		prevBtn.removeAttribute('disabled');
		nextBtn.removeAttribute('disabled');
	};
};
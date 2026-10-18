import { addThumbBtnsClickHandlers } from './carousel-tombs-button';
import { addToggleThumbBtnsActive } from './carousel-tombs-button';

export default () => {
	const OPTIONS = {};
	const OPTIONS_THUMBS = {
		containScroll: 'keepSnaps',
		dragFree: true,
	};

	const arr = ['.embla', '.embla-2'];

	arr.forEach((item) => {
		const embla = document.querySelector(item);

		if (!embla) return;

		const viewportNodeMainCarousel = embla.querySelector('.embla__viewport');
		const viewportNodeThumbCarousel = embla.querySelector(
			'.embla-thumbs__viewport',
		);

		const emblaApiMain = EmblaCarousel(viewportNodeMainCarousel, OPTIONS);

		const emblaApiThumb = EmblaCarousel(
			viewportNodeThumbCarousel,
			OPTIONS_THUMBS,
		);

		const removeThumbBtnsClickHandlers = addThumbBtnsClickHandlers(
			emblaApiMain,
			emblaApiThumb,
		);
		const removeToggleThumbBtnsActive = addToggleThumbBtnsActive(
			emblaApiMain,
			emblaApiThumb,
		);

		emblaApiMain
			.on('destroy', removeThumbBtnsClickHandlers)
			.on('destroy', removeToggleThumbBtnsActive);

		emblaApiThumb
			.on('destroy', removeThumbBtnsClickHandlers)
			.on('destroy', removeToggleThumbBtnsActive);
	});
};

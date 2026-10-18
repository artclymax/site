export default () => {
	MicroModal.init({
		onShow: (modal) => {}, // [1]
		onClose: (modal) => {}, // [2]
		openTrigger: 'data-micromodal-open', // [3]
		closeTrigger: 'data-micromodal-close', // [4]
		openClass: 'is-open', // [5]
		disableScroll: true, // [6]
		disableFocus: false, // [7]
		awaitOpenAnimation: false, // [8]
		awaitCloseAnimation: false, // [9]
		debugMode: false, // [10]
	});

	MicroModal.init({
		onShow: (modal) => {}, // [1]
		onClose: (modal) => {}, // [2]
		openTrigger: 'data-portfolio-open', // [3]
		closeTrigger: 'data-portfolio-close', // [4]
		openClass: 'is-open', // [5]
		disableScroll: true, // [6]
		disableFocus: false, // [7]
		awaitOpenAnimation: false, // [8]
		awaitCloseAnimation: false, // [9]
		debugMode: false, // [10]
	});

	MicroModal.init({
		onShow: (modal) => {}, // [1]
		onClose: (modal) => {}, // [2]
		openTrigger: 'data-embla-open', // [3]
		closeTrigger: 'data-embla-close', // [4]
		openClass: 'is-open', // [5]
		disableScroll: true, // [6]
		disableFocus: false, // [7]
		awaitOpenAnimation: false, // [8]
		awaitCloseAnimation: false, // [9]
		debugMode: false, // [10]
	});
};

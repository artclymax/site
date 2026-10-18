import { sendAction } from './sendMailAction';

export default () => {
	const form = document.getElementById('form');

	if (!form) return;

	form.addEventListener('submit', (event) => {
		event.preventDefault();

		const submitBtn = form.querySelector('button[type="submit"]');

		try {
			submitBtn.disabled = true;

			const formData = new FormData(form);

			sendAction(formData, () => {
				event.target.reset();
			});
		} catch (error) {
			console.error(error);
		} finally {
			event.target.reset();
			submitBtn.disabled = false;
		}
	});
};

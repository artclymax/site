export default () => {
	toastr.options = {
		timeOut: 10000,
		positionClass: 'toast-top-right',
	};

	const arr = ['feedback-form-1', 'cheaper-form', 'onrequest-form'];

	arr.forEach((form) => {
		const formEl = document.getElementById(form);

		if (!formEl) return;

		formEl.insertAdjacentHTML(
			'beforeend',
			'<input type="number" name="lol" class="lol-field">',
		);

		const submitBtn = formEl.querySelector('.btn');

		const inputs = formEl.querySelectorAll(
			'input[type="text"], input[type="tel"], input[type="email"]',
		);
		const inputsPolicy = formEl.querySelectorAll('input[type="checkbox"]');
		const warningPolicy = formEl.querySelectorAll('.warning--policy');

		formEl.addEventListener('submit', (e) => {
			e.preventDefault();
			let isValid = true;

			// Проверка полей
			inputs.forEach((input) => {
				if (input.name === 'phone' || input.name === 'link') {
					if (input.value === '') {
						input.nextElementSibling.classList.add('warning--show');
						isValid = false;
					}
				} else {
					input.nextElementSibling.classList.remove('warning--show');
				}
			});

			// Проверка чекбоксов
			inputsPolicy.forEach((input) => {
				if (!input.checked) {
					warningPolicy.forEach((el) => {
						el.classList.add('warning--show');
					});
					isValid = false;
				} else {
					warningPolicy.forEach((el) => {
						el.classList.remove('warning--show');
					});
				}
			});

			// Если форма валидна, отправляем данные
			if (isValid) {
				submitBtn.setAttribute('disabled', 'disabled'); // Отключаем кнопку
				submitBtn.classList.add('loading'); // Добавляем класс загрузки

				const formData = new FormData(formEl);
				fetch(ajaxurl, {
					method: 'POST',
					body: formData,
				})
					.then((response) => response.json())
					.then(({ data: { message, success } }) => {
						if (success) {
							toastr.success(message);
							formEl.reset();
						} else {
							toastr.error(message);
						}
					})
					.catch((error) => {
						toastr.error('Произошла ошибка при отправке запроса.');
						console.error('Error:', error);
					})
					.finally(() => {
						submitBtn.removeAttribute('disabled'); // Включаем кнопку
						submitBtn.classList.remove('loading'); // Убираем класс загрузки
						MicroModal.close('cheaper-modal');
						MicroModal.close('onrequest-modal');
					});
			}
		});
	});
};

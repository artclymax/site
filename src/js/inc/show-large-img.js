export  function setupModal(modalId, thumbnailClass) {
	const modal = document.getElementById(modalId);
	const modalImg = modal.querySelector('.modal-content');
	const closeBtn = modal.querySelector('.close');

	// Обработчик клика для миниатюр
	const thumbnails = document.getElementsByClassName(thumbnailClass);
	for (let i = 0; i < thumbnails.length; i++) {
			thumbnails[i].onclick = function () {
					modal.style.display = 'block';
					modalImg.src = this.getAttribute('data-large');
					document.body.classList.add('no-scroll');
			};
	}

	closeBtn.onclick = function () {
			modal.style.display = 'none';
			document.body.classList.remove('no-scroll');
	};

	modal.onclick = function (event) {
			if (event.target === modal) {
					modal.style.display = 'none';
					document.body.classList.remove('no-scroll');
			}
	};
}

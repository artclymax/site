export default () => {
	const isCookiePolicyAccepted = checkCookie('c_accepted');
	const footer = document.querySelector('footer');

	if (!isCookiePolicyAccepted) {
		footer.insertAdjacentHTML('afterend', createCookiePolicyHTML());

		const acceptCookieBtn = document.getElementById('accept-cookie');
		const removeCookieBtn = document.getElementById('remove-cookie');

		acceptCookieBtn.addEventListener('click', () => {
			setCookie('c_accepted', 'true', 180);
			hideCookiePolicy();
		});

		removeCookieBtn.addEventListener('click', () => {
			deleteAllCookies();
			setCookie('c_accepted', 'true', 180);

			hideCookiePolicy();
		});
	}
};

function createCookiePolicyHTML() {
	return `
		<div id="cookie-policy" class="cookie__policy">
			<div class="cookie__policy--container">
				<div class="cookie__policy--content">
					<div class="cookie__policy--text">
						Для удобства пользователей сайта используются файлы cookie. Продолжая просмотр этого сайта, вы соглашаетесь на обработку файлов cookie в соответствии с
						<a href="/cookie-policy"> Политикой обработки файлов cookie.</a>
					</div>
					<div class="cookie__policy--btns">
						<button id="accept-cookie" class="cmn-btn cmn-btn--main cmn-btn--full">Принять</button>
						<button id="remove-cookie" class="cmn-btn cmn-btn--second cmn-btn--full">Отклонить</button>
					</div>
				</div>
			</div>
		</div>
	`;
}

function hideCookiePolicy() {
	const cookiePolicy = document.getElementById('cookie-policy');
	if (cookiePolicy) {
		cookiePolicy.remove(); // Удаляем элемент cookie policy из DOM
	}
}

function checkCookie(cookieName) {
	return document.cookie
		.split('; ')
		.some((cookie) => cookie.startsWith(`${cookieName}=`));
}

function setCookie(name, value, days) {
	let expires = '';
	if (days) {
		const date = new Date();
		date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
		expires = `; expires=${date.toUTCString()}`;
	}
	document.cookie = `${name}=${value || ''}${expires}; path=/`;
}

function deleteAllCookies() {
	document.cookie.split(';').forEach((cookie) => {
		const cookieName = cookie.split('=')[0].trim();
		document.cookie = `${cookieName}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;

		location.reload();
	});
}
<form id="feedback-form-2" class="feedback_form-2" method="post">
	<div>
		<input type="text" name="name" placeholder="Ваше имя" require>
		<div class="warning warning--name">Поле имя обязательно для заполнения</div>
	</div>

	<div>
		<input type="tel" name="phone" placeholder="+375 (_ _) _ _ _-_ _-_ _" require>
		<div class="warning warning--phone">Поле телефон обязательно для заполнения</div>
	</div>

	<input type="hidden" name="action" value="mail_to">

	<div>
		<label for="policy">
			<input type="checkbox" name="policy" id="policy" checked>
			<div>
				Соглашаюсь с <a href="/policy">Политикой обработки персональных данных</a>
			</div>
		</label>
		<div class="warning warning--policy">Вы не согласились с условиями</div>
	</div>

	<button class="btn cmn-btn cmn-btn--main" type="submit">
		Заказать звонок
		<span class="loader"></span>
	</button>

</form>

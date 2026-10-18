<?php

function mail_to()
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (!empty($_POST['lol'])) {
			exit('Spam detected');
		}

		$name = sanitize_text_field($_POST['name']);
		$phone = sanitize_text_field($_POST['phone']);
		$email = sanitize_text_field($_POST['email']);
		$link = sanitize_text_field($_POST['link']);
		$comment = sanitize_text_field($_POST['comment']);

		$to = get_option('email');

		if($link) {
			$subject = 'Заявка с сайта ' . get_bloginfo('name') . ' на товар дешевле';
			$body = "Имя: $name\nТелефон: $phone\nEmail: $email\nСсылка: $link\nКомментарий: $comment";
		} else {
			$subject = 'Заявка с сайта ' . get_bloginfo('name') . ' на обратный звонок';
			$body = "Имя: $name\nТелефон: $phone\n";
		}

		$headers = 'From: webmaster@example.com';

		if (wp_mail($to, $subject, $body, $headers)) {
			wp_send_json_success(['message' => 'Письмо успешно отправлено!', 'success' => true]);
		} else {
			wp_send_json_error(['message' => 'Ошибка при отправке письма.', 'success' => false]);
		}

		wp_die();
	}
}

<?php

namespace Controllers\Api;

use Modules\Main\Application;
use Modules\Main\BaseController;
use Modules\Validator\EmailValidator;
use Modules\Validator\StringValidator;

class FeedbackController extends BaseController
{
    public function send(): void
    {
        $post = Application::getInstance()->post;

        $name    = trim($post->get('name', ''));
        $email   = trim($post->get('email', ''));
        $message = trim($post->get('message', ''));

        $errors = [];

        // Валидация имени
        $nameValidator = new StringValidator(
            minLength: 2,
            maxLength: 100
        );
        if (!$nameValidator->validate($name)) {
            $errors[] = $nameValidator->getError() ?? 'Некорректное имя';
        }

        // Валидация email
        $emailValidator = new EmailValidator();
        if (!$emailValidator->validate($email)) {
            $errors[] = $emailValidator->getError() ?? 'Некорректный email';
        }

        // Валидация сообщения (опционально, но лучше ограничить)
        if ($message === '') {
            $errors[] = 'Сообщение не может быть пустым';
        }

        header('Content-Type: application/json; charset=utf-8');

        if (count($errors) > 0) {
            echo json_encode(['status' => 'failure', 'errors' => $errors], JSON_UNESCAPED_UNICODE);
            return;
        }

        // Отправка письма
        $to      = 'lancelot.ozernuy@gmail.com';
        $subject = 'Сообщение с сайта lancy-dev.ru';
        $body    =
            "Имя: {$name}\n" .
            "Email: {$email}\n\n" .
            "Сообщение:\n{$message}\n";

        $headers = "From: {$name} <{$email}>\r\n" .
            "Reply-To: {$email}\r\n" .
            "Content-Type: text/plain; charset=UTF-8\r\n";

        $sent = mail($to, $subject, $body, $headers);

        if (!$sent) {
            echo json_encode([
                'status' => 'failure',
                'errors' => ['Не удалось отправить письмо. Попробуйте позже.']
            ], JSON_UNESCAPED_UNICODE);
            return;
        }

        echo json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE);
    }
}

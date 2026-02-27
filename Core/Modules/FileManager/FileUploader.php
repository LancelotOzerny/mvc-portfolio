<?php

namespace Modules\FileManager;

use Modules\Validator\FileValidator;
use SplFileInfo;

class FileUploader
{
    /**
     * Сохраняет загруженное изображение
     *
     * @param array $uploadedFile Массив из $_FILES для конкретного файла
     * @param string $destinationPath Полный путь для сохранения файла (включая имя файла)
     * @param FileValidator $validator Валидатор для проверки файла
     * @return array ['success' => bool, 'errors' => array]
     */
    public function saveImage(array $uploadedFile, string $destinationPath, FileValidator $validator): array
    {
        $errors = [];

        if ($uploadedFile['error'] !== UPLOAD_ERR_OK) 
        {
            $errors[] = 'Ошибка загрузки файла: код ' . $uploadedFile['error'];
            return ['success' => false, 'errors' => $errors];
        }

        try
        {
            $splFile = new SplFileInfo($uploadedFile['tmp_name']);

            if (!$validator->validate($splFile)) {
                $errors[] = $validator->getError();
                return ['success' => false, 'errors' => $errors];
            }

            // Перемещаем файл в целевую директорию
            if (move_uploaded_file($uploadedFile['tmp_name'], $destinationPath)) {
                return ['success' => true, 'errors' => []];
            } else {
                $errors[] = 'Не удалось сохранить файл по указанному пути';
                return ['success' => false, 'errors' => $errors];
            }
        } catch (\Exception $e) {
            $errors[] = 'Внутренняя ошибка при сохранении файла: ' . $e->getMessage();
            return ['success' => false, 'errors' => $errors];
        }
    }

    /**
     * Генерирует уникальное имя файла на основе оригинального имени
     *
     * @param string $originalName Оригинальное имя файла
     * @return string Уникальное имя файла с сохранением расширения
     */
    public function generateUniqueFilename(string $originalName): string
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $filename = pathinfo($originalName, PATHINFO_FILENAME);

        return uniqid($filename . '_') . '.' . strtolower($extension);
    }
}
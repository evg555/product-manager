<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$response = [
    'status' => 'success',
    'message' => '',
    'content' => ''
];

$iblockID = intval($request->getPost('iblock_id'));

switch ($request->getPost('action')) {
    case 'add':
        $name = \MyTest\StringHelper::safeString($request->getPost('name'));
        $color = \MyTest\StringHelper::safeString($request->getPost('color'));
        $size = \MyTest\StringHelper::safeString($request->getPost('size'));

        if (!$name) {
            $response['status'] = 'failed';
            $response['message'] = 'Введите название товара!';

            echo json_encode($response);
            exit;
        }

        $productManager = new \MyTest\ProductManager($iblockID);
        $result = $productManager->Add([
            'NAME' => $name,
            'COLOR' => $color,
            'SIZE' => $size
        ]);

        if ($result) {
            $response['message'] = 'Товар успешно добавлен!';
            $response['content'] = trim("ID: {$result['ID']} Название: {$result['NAME']} Цвет: {$result['PROPERTIES']['COLOR']} Размер: {$result['PROPERTIES']['SIZE']}");
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Ошибка добавления товара!';
        }

        break;
    case 'update':
        $id = intval($request->getPost('id'));
        $name = \MyTest\StringHelper::safeString($request->getPost('name'));
        $color = \MyTest\StringHelper::safeString($request->getPost('color'));
        $size = \MyTest\StringHelper::safeString($request->getPost('size'));

        if ($id < 1) {
            $response['status'] = 'failed';
            $response['message'] = 'Введите корректный ID товара!';

            echo json_encode($response);
            exit;
        }

        $productManager = new \MyTest\ProductManager($iblockID);
        $result = $productManager->Update($id, [
            'NAME' => $name,
            'COLOR' => $color,
            'SIZE' => $size
        ]);

        if ($result) {
            $response['message'] = 'Товар успешно обновлен!';
            $response['content'] = trim("ID: {$result['ID']} Название: {$result['NAME']} Цвет: {$result['PROPERTIES']['COLOR']} Размер: {$result['PROPERTIES']['SIZE']}");
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Ошибка обновления товара!';
        }

        break;
    case 'delete':
        $id = intval($request->getPost('id'));

        if ($id < 1) {
            $response['status'] = 'failed';
            $response['message'] = 'Введите корректный ID товара!';

            echo json_encode($response);
            exit;
        }

        $productManager = new \MyTest\ProductManager($iblockID);
        $result = $productManager->Delete($id);

        if ($result) {
            $response['message'] = "Товар с ID $id успешно удален!";
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Ошибка удаления товара!';
        }

        break;
    case 'get':
        $id = intval($request->getPost('id'));

        if ($id < 1) {
            $response['status'] = 'failed';
            $response['message'] = 'Введите корректный ID товара!';

            echo json_encode($response);
            exit;
        }

        $productManager = new \MyTest\ProductManager($iblockID);
        $result = $productManager->GetInfo($id);

        if ($result) {
            $response['content'] = trim("ID: {$result['ID']} Название: {$result['NAME']} Цвет: {$result['PROPERTIES']['COLOR']} Размер: {$result['PROPERTIES']['SIZE']}");
        } else {
            $response['status'] = 'failed';
            $response['message'] = "Товар с ID $id не найден!";
        }

        break;
}

echo json_encode($response);
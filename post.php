<?php
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n"; 
$headers .= "From: Заказ с сайта <foto@artavenue.kz>"."\r\n";

date_default_timezone_set('Asia/Dacca');

$message_po = "
<html>
<head>
<title>Новый заказ звонка</title>
</head>
<body>
<p>Дата: ".date("d M Y H:i:s")."</p><br>
<p>Новый заказ звонка: ".$_POST['phone']."</p>
<p>Имя: ".$_POST['name']."</p>
</body>
</html>";

$mess  = "Дата: ".date("d M Y H:i:s")."\n";
$mess .= "Новый заказ звонка\n";
$mess .= "Имя: {$_POST['name']}\n";
$mess .= "Телефон: {$_POST['phone']}\n";
if (!empty($_POST['title'])) {
    $mess .= "Услуга: {$_POST['title']}\n";
}
$mess .= "----------------------------------\n----------------------------------";

$token = '5143081427:AAEkhRMQW4800Bj5gq4gGXhz5m5IM4KbfL8'; // токен бота
$chat_id = -1003100180935; // ID группы

$query = [
    'chat_id' => $chat_id,
    'parse_mode' => 'HTML',
    'text' => $mess
];

// === Отправляем сообщение в Telegram (через cURL) ===
$ch = curl_init('https://api.telegram.org/bot'.$token.'/sendMessage');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
curl_setopt($ch, CURLOPT_TIMEOUT, 3); // максимум 3 секунды ожидания
$response = curl_exec($ch);
curl_close($ch);

// === Отправляем письмо ===
if (mail('mail@artavenue.kz', 'Заказ звонка', $message_po, $headers)) {
?>
    <img class="send" src="assets/images/send.png">
    <h2 class="bron_h3">Спасибо</h2>    
    <p class="raxmet">Ваш заказ звонка принят в обработку, в ближайшее время с Вами свяжутся наши менеджеры.</p>    
    <p><a class='btn close-modal' data-modal="#modal1" href="#">Закрыть</a></p>
<?php
} else {
?>
    <img class="send" src="assets/images/err.png">
    <h2 class="bron_h3">Ошибка</h2>    
    <p class="raxmet">Сообщение не отправлено, попробуйте еще раз.</p>    
    <p><a class='btn close-modal' data-modal="#modal1" href="#">Закрыть</a></p>
<?php
}
exit;
?>

<?php
$id='AE3ab3vVKQtglAtqfNOrqq';
$uri='https://frozen-woodland-30531.herokuapp.com/auth.php';
$state='asdfghj';
$url='https://notify-bot.line.me/oauth/authorize?'.
	'response_type=code'.'&'.
	'client_id='.$id.'&'.
	'redirect_uri='.$uri.'&'.
	'scope=notify'.'&'.
	'state='.$state.'&'.
	'response_mode=form_post';
header("Location: ".$url);
exit;
?>
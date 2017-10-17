<?php
define('LINE_GET_TOKEN',"https://notify-bot.line.me/oauth/token");
define('LINE_API_NOTIFY',"https://notify-api.line.me/api/notify");
$id='AE3ab3vVKQtglAtqfNOrqq';
$uri='https://frozen-woodland-30531.herokuapp.com/auth.php';
$secret="Y82tINHu6dGdmejvZdtBfEkP2COzwbMSOI4BIHUCvaL";
	function get_token($code){
        $url="https://notify-bot.line.me/oauth/token";
		$id='AE3ab3vVKQtglAtqfNOrqq';
		$uri='https://frozen-woodland-30531.herokuapp.com/auth.php';
		$secret="Y82tINHu6dGdmejvZdtBfEkP2COzwbMSOI4BIHUCvaL";
        $data = array(
            "grant_type" => "authorization_code",
            "code" => $code,
            "redirect_uri" => $uri,
            "client_id" => $id,
            "client_secret" => $secret
		);
        $data = http_build_query($data, "", "&");
        $options = array('http'=>array(
                'method'=>'POST',
                'header'=>"Content-Type: application/x-www-form-urlencoded\r\n"
                      . "Content-Length: ".strlen($data)  . "\r\n" ,
                'content' => $data
        ));
        $context = stream_context_create($options);
        $resultJson = file_get_contents($url,FALSE,$context );
        $resultArray = json_decode($resultJson,TRUE);
		echo $resultArray["access_token"];
		echo $resultArray["status"];
        if( $resultArray["status"] != 200)  {
            return false;
        }
		$_SESSION['access_token']=$resultArray['access_token'];
        return true;
    }
	function send_message($message){
        $data = array("message" => $message);
        $data = http_build_query($data, "", "&");
        $options = array('http'=>array(
                'method'=>'POST',
                'header'=>"Authorization: Bearer " . $_POST["access_token"] . "\r\n"
                      . "Content-Type: application/x-www-form-urlencoded\r\n"
                      . "Content-Length: ".strlen($data)  . "\r\n" ,
                'content' => $data
        ));
        $context = stream_context_create($options);
        $resultJson = file_get_contents(LINE_API_NOTIFY,FALSE,$context );
        $resutlArray = json_decode($resultJson,TRUE);
        if( $resutlArray['access_token'] == NULL)  {
            return false;
        }
		var_dump($resultJson);
        return true;
    }
	session_start();
	if(isset($_POST["state"])){
		if(isset($_POST["code"])){
			$code=$_POST["code"];
			get_token($code);
		}
	}
	if(isset($_POST["message"])){
		send_message($_POST["message"],$_SESSION["access_token"]);
	}
?>
<!DOCTYPE html>
<html lang="ja" xmlns:og="http://ogp.me/ns#" xmlns:mixi="http://mixi-platform.com/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <meta charset="UTF-8">
    <title>line通知登録画面</title>
</head>
<body>	
<?php if(isset($_SESSION["access_token"])) : ?>
<form action ="https://frozen-woodland-30531.herokuapp.com/auth.php"; method = "post" >
    <input type="text" name="access_token" value="<?php echo htmlspecialchars($_SESSION["access_token"], ENT_QUOTES, "UTF-8"); ?>">
    <input type="text" name="message">
    <input type="submit" name="通知送信" value="通知送信">
</form>    
<?php endif; ?>    
</body>
</html>
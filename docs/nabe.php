<html>
<head>
    <meta charset="utf-8">
	<title>通知を飛ばします</title>
</head>
<body>
	<?php
    define('LINE_API_URL'  ,"https://notify-api.line.me/api/notify");
   $token="UTxJuYOttYoBHoNDIRK4Hz5RHq1w4Wi6wyEi5wUqIdL";
    function post_message($message,$token){
		define('LINE_API_TOKEN',$token);
        $data = array("message" => $message//,
//					  "imageFile" => "https://frozen-woodland-30531.herokuapp.com/recommend-main4.png"
					 );
        $data = http_build_query($data, "", "&");
        $options = array('http'=>array(
                'method'=>'POST',
                'header'=>"Authorization: Bearer " . $token . "\r\n"
                      . "Content-Type: application/x-www-form-urlencoded\r\n"
                      . "Content-Length: ".strlen($data)  . "\r\n" ,
                'content' => $data
        ));
        $context = stream_context_create($options);
        $resultJson = file_get_contents(LINE_API_URL,FALSE,$context );
        $resutlArray = json_decode($resultJson,TRUE);
        if( $resutlArray['status'] != 200)  {
            return false;
        }
        return true;
    }
	$message = "鍋が作れます";
	post_message($message,$token);
?>
	<h1>通知しました</h1>
</body>
</html>
<?
if((isset($_POST['phone'])&&$_POST['phone']!="")){ 
        $to = 'sergejbocarov1@gmail.com'; 
        $subject = 'Вызов врача на дом'; 
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Телефон: '.$_POST['phone'].'</p>                        
                    </body>
                </html>'; 
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
        $headers .= "From: Отправитель <from@example.com>\r\n";
        mail($to, $subject, $message, $headers);
}
?>

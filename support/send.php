<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");
if(isset($_POST['email'], $_POST['name'], $_POST['title'], $_POST['content'])){
    $mail = $_POST['email'];
    $name = $_POST['name'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $domain = $_SERVER['SERVER_NAME'];
    $contents = <<< EOM
    メールアドレス
    $mail
    名前
    $name
    タイトル
    $title
    お問い合わせ内容
    $content
    -----
    $domain から送信されました。
    EOM;
    $headers = [
        'MIME-Version' => '1.0',
        'Content-Type' => 'text/plain; charset=ISO-2022-JP-ms',
        'X-Priority' => '3',
    ];
    array_walk( $headers, function( $_val, $_key ) use ( &$header_str ) {
        $header_str .= sprintf( "%s: %s \r\n", trim( $_key ), trim( $_val ) );
    } );
    $send = mb_send_mail('support@ichiru-web.com', $title, $contents, $header_str);
    if($send){
        $title = 'お問い合わせ完了';
        $contents = <<< EOM
        お問い合わせ完了しました。
        回答までしばらくお待ちください。
        ---------------
        お問い合わせ内容
        $content
        EOM;
        $headers = [
            'MIME-Version' => '1.0',
            'Content-Type' => 'text/plain; charset=ISO-2022-JP-ms',
            'X-Priority' => '3',
            'From' => 'support@ichiru-web.com',
        ];
        array_walk( $headers, function( $_val, $_key ) use ( &$header_str ) {
            $header_str .= sprintf( "%s: %s \r\n", trim( $_key ), trim( $_val ) );
        } );
        mb_send_mail($mail, $title, $contents, $header_str);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送信完了</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <p>送信できました。</p>
    <p>メールボックスに「お問い合わせ完了」が届いていると思います。</p>
    <p>回答までしばらくお待ちください</p>
</body>
</html>
<?php
}else{
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>送信失敗</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <p>送信に失敗しました。</p>
    <p>一からやり直してください。</p>
</body>
</html>
<?php
}
}else{
    include_once('../error/400.php');
}
?>

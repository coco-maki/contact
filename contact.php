<?php
session_start();
// ワンタイムトークンの一致を確認
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    // トークンが一致しなかった場合
    die('お問い合わせの送信に失敗しました');
}

mb_language("Japanese");
//↑マルチバイトの言語設定を日本語にします
mb_internal_encoding("UTF-8");
//↑マルチバイトの文字エンコーディングをUTF-8にします

// 簡単なバリデーションとデータの取得
if ($_POST) {
    $to = 'hatsu.ngo2023@gmail.com'; // 宛先のメールアドレス
    $subject = 'お問い合わせフォームからの送信'; // メールの件名

    //↓以下は、送信するメールの本文です。1行ずつ$messageに追記する形です。
    // \nは、改行の意味。
    $message = "お問い合わせがありました。\n";
    $message .= "\n";
    $message .= "入力された内容は以下の通りです。\n";
    $message .= "---\n";
    $message .= "\n";
    $message .= "ニックネーム：\n";
    $message .= $_POST["name"]; // name属性がnameの内容が入ります
    $message .= "\n";
    $message .= "メールアドレス:\n";
    $message .= $_POST["email"]; // name属性がemailの内容が入ります
    $message .= "\n";
    $message .= "年齢:\n";
    $message .= $_POST["age"]; // name属性がageの内容が入ります
    $message .= "\n";
    $message .= "ご依頼理由:\n";
    $message .= $_POST["reason"]; // name属性がreasonの内容が入ります
    $message .= "\n";
    $message .= "ご要望事項や相談内容:\n";
    $message .= $_POST["details"]; // name属性がdetailsの内容が入ります

    // ここでメール送信の処理やデータベースへの保存処理を行う
    // 例: mail($to, $subject, $message);
    if(mb_send_mail($to,$subject,$message)) {
    echo "お問い合わせありがとうございます。以下の内容で受け付けました。<br>";
    echo "名前: $name<br>";
    echo "メールアドレス: $email<br>";
    echo "年齢: $age<br>";
    echo "ご依頼理由: $reason<br>";
    echo "ご要望事項や相談内容: $details<br>";
    } else {
        echo "メールの送信に失敗しました";
    }
    } else {
    echo "HTMLからのPOST送信受信に失敗しました";
}
?>
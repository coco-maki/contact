<?php
// セッションの利用を開始
session_start();

// ワンタイムトークン生成
$token_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($token_byte);

// トークンをセッションに保存
$_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>お問い合わせ</title>
    <meta name="description" content="お問い合わせフォームです。">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main class="wrapper">
        <h1 class="page-title">お申込み・お問合せ</h1>
        <form action="contact.php" method="post">
            <div class="form-group">
                <label for="name">ニックネーム（必須）</label>
                <input type="text" id="name" name="name" required>
            </div>
        
            <div class="form-group">
                <label for="email">メールアドレス（必須）</label>
                <input type="email" id="email" name="email" required>
            </div>
        
            <div class="form-group">
                <label for="age">年齢（必須）</label>
                <select id="age" name="age" required>
                    <option value="">選択してください</option>
                    <option value="18-19">18~19歳</option>
                    <option value="20-24">20~24歳</option>
                    <option value="25-29">25~29歳</option>
                    <option value="30-34">30~34歳</option>
                    <option value="35-39">35~39歳</option>
                    <option value="40-44">40~44歳</option>
                    <option value="45-49">45~49歳</option>
                    <option value="50-">50歳以上</option>
                </select>
            </div>
        
            <div class="form-group">
                <label for="reason">ご依頼理由</label>
                <textarea id="reason" name="reason" rows="4"></textarea>
            </div>
        
            <div class="form-group">
                <label for="details">ご要望事項や相談内容</label>
                <textarea id="details" name="details" rows="4"></textarea>
            </div>
        
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>" />

            <button type="submit">送信</button>
        </form>
    </main>
    <footer>
        <p class="copyright">&copy; contact</p>
    </footer>
</body>

</html>
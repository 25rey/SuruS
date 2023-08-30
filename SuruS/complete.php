<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
>
<link rel="stylesheet"type="text/css" href="css/stylee.css">
<link rel="stylesheet"type="text/css" href="css/header.css">
<link rel="stylesheet"type="text/css" href="css/contact.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://kit.fontawesome.com/02ea003b00.js" crossorigin="anonymous"></script>
<script src="js/surus-main.js"></script>

<!-- ロジック
================================================================================================ -->
<?php
session_start();

/* 以下、メール送信の処理
------------------------------------------------------------------------------------------------- */
// 送信ボタンが押されたら
if (!empty($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {
    // //フォームのボタンが押されたら、POSTされたデータを各変数に格納
    $name = $_POST["name"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $message = $_POST["message"];
    

    // メールの言語設定
    mb_language("japanese");
    mb_internal_encoding("UTF-8");

    // 件名を変数subjectに格納
    $subject = "［自動送信］メッセージ内容の確認";

    // メール本文を変数bodyに格納
    $body = <<< EOM
  {$name}　様

  メッセージありがとうございます。
  以下の内容でメッセージを承りました。

  ===================================================
  < お名前 >
  {$name}

  < メールアドレス >
  {$email}

  < 電話番号 >
  {$tel}

  < メッセージ >
  {$message}
  ===================================================

  ※当メールは送信専用となっております。
  　ご返信いただいても、お答えいたしかねますのでご了承ください。
  EOM;

    // 送信元のメールアドレスを変数fromEmailに格納(本番環境へのデプロイ時に正規のアドレスに変更すること！)
    $fromEmail = "reon2597@gmail.com";

    // 送信元の名前を変数fromNameに格納
    $fromName = "SuruS 運営";

    // ヘッダ情報を変数headerに格納する
    $header = "From: $fromEmail";

    // 受信用のメールアドレスを変数myEmailに格納(本番環境へのデプロイ時に正規のアドレスに変更すること！)
    $myEmail = "reon2597@gmail.com";

    // フォーム入力者へメールを送信する
    mb_send_mail($email, $subject, $body, $header);

    // サイト管理者へメールを送信する
    mb_send_mail($myEmail, $subject, $body, $header);
} else {
    // トークンが一致しない場合、不正アクセス画面へ移動する
    header(("location: alert.php"));
    exit;
}
?>

<!-- ビュー
================================================================================================ -->
<body>
    <header class="wid100" style="height: 50px;">
        <div class="head-logo" style="height: 50px; width: 50px;">
            <a href="index.html">
                <img class="chgimg" src="picture/logo.jpg" style="width: auto; height: 100%;">
            </a>
        </div>
        <nav class="drawer-nav" style="padding-top: 10px; color:rgb(207,65,138)">
            <div class="nav-inner">
            <ul class="nav fx hc wf-a">
                <li class="title sp">OFFICIAL</li>
                <li class="home">
                    <a href="index.html">HOME</a>>
                </li>
                <li style="font-size: 2.0rem;"><a href="about.html">about</a></li>
                <li style="font-size: 2.0rem;"><a href="information.html">information</a></li>
                <li style="font-size: 2.0rem;"><a href="member.html">member</a></li>
                <!--<li style="font-size: 2.0rem;"><a href="goods.html">goods</a></li>-->
                <li style="font-size: 2.0rem;"><a href="contact.html">contact</a></li>
                <!--<li style="font-size: 2.0rem;"><a href="link.html">link</a></li>-->
                <li>
                    <a href="https://twitter.com/surus_official">
                        <img src="picture/X.png" style="height: 20px; width: auto;">
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/surus.official/">
                        <img src="picture/insta.png" style="height: 20px; width: auto;">
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/surus_official">
                        <img src="picture/youtube.png" style="height: 20px; width: auto;">
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/surus_official">
                        <img src="picture/tiktok.png" style="height: 20px; width: auto;">
                    </a>
                </li>
            </ul>
        </nav>
        <div id="menu_wrap">
            <div id="sidemenu">
                <ul>
                    <li><a id="menuhome" class="menuelem" href="index.html"><span>Home</span></a></li>
                    <li><a id="menuabout" class="menuelem" href="about.html"><span>About</span></a></li>
                    <li><a id="menuinfo" class="menuelem" href="information.html"><span>Infometion</span></a></li>
                    <li><a id="menumember" class="menuelem" href="member.html"><span>Member</span></a></li>
                    <!--<li><a id="menugoods" class="menuelem" href="goods.html"><span>Goods</span></a></li>-->
                    <li><a id="menucontact" class="menuelem" href="contact.html"><span>Contact</span></a></li>
                    <!--<li><a id="menulink" class="menuelem" href="link.html"><span>Link</span></a></li>-->
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div id="sidemenu_key">
            <div>
                <!--開いてるとき-->
                <div class="semicircle"></div>
                <div class="semicircle"></div>
                <div class="semicircle"></div>
                <div class="menu">Menu</div>
            </div>
        </div>
    </header>
    <main>
        <h2 class="text">送信完了</h2>
        <p class="text">メッセージありがとうございました。入力したメールアドレス宛に確認メールを送信しましたので、ご確認ください。</p>
        <p class="text">尚、数十分経過してもメールが届かない場合はメッセージが送信できていない可能性がございます。</p>
        <p class="text">お手数ですが、トップページよりもう一度メッセージの送信をお願いいたします。</p>
        <a href="index.html">
            <button class="btn" type="button">トップページに戻る</button>
        </a>

        <!-- bodyタグ直前に挿入 -->
        <script src="js/forbid_back.js"></script>
    </main>
</body>
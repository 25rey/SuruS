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
// セッション開始
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //フォームのボタンが押されたら、POSTされたデータを各変数に格納
    $name = $_POST["name"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $message = $_POST["message"];

    // トークンの生成（CSRF対策）
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;

    // HTML出力前のエスケープ処理
    function escape($str)
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
} else {
    //フォームボタン以外からこのページにアクセスした場合（URL直接入力など）、トップページに戻る
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
        <p class="text">下記の内容でメッセージを送信します。よろしければ「送信」ボタンを押してください。</p>
        <div class="contact">
            <form action="complete.php" method="post">
                <input type="hidden" name="token" value="<?php echo escape($token); ?>">
                <table class="contact_table" width="960">
                    <tr>
                        <th class="confirm_item" width="288px">名前</th>
                        <td class="confirm_body" width="672px">
                            <input type="hidden" id="name" name="name" value="<?php echo escape($name); ?>" />
                            <p class="inputcontent"><?php echo escape($name); ?></p>
                        </td>
                    </tr>
                   <tr>
                        <th class="confirm_item">メールアドレス</th>
                        <td class="confirm_body">
                            <input type="hidden" id="email" name="email" value="<?php echo escape($email); ?>" />
                           <p class="inputcontent"><?php echo escape($email); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="confirm_item">電話番号</th>
                        <td class="confirm_body">
                            <input type="hidden" id="tel" name="tel" value="<?php echo escape($tel); ?>" />
                            <p class="inputcontent"><?php echo escape($tel); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th class="confirm_item">お問い合わせ内容(50字以上)</th>
                        <td class="confirm_body">
                            <input type="hidden" id="message" name="message" value="<?php echo escape($message); ?>" />
                            <p class="inputcontent"><?php echo nl2br(escape($message)); ?></p>
                        </td>
                    </tr>
                </table>
                <input class="btn" type="button" value="修正" onclick="history.back(-1)">
                <input class="btn" type="submit" value="送信" name="submit"></input>
            </form>
        </div>
    </main>
</body>
<?php
// 表示制御用変数
$display_control_no = 0;

// ディレクトリのパス格納変数確認用
print "print __FILE__ .<br>→" . __FILE__ . "<br>";
print "print dirname(__FILE__) .<br>→" . dirname(__FILE__) . "<br>";

// サーバのベースURL
$url_base = "http://tojikaji.xsrv.jp/";

// ディレクトリのパスからURLを取得する処理（取得したい文字が検索文字より後にある場合）
$directory_path = dirname(__FILE__);
$search_string = "public_html/";
$posision = strpos($directory_path, $search_string) + strlen($search_string);
$path_this = substr($directory_path, $posision);
// ディレクトリのパスから一つ上階層を取得する処理（取得したい文字が検索文字より前にある場合）
$search_string_parent_path = "/";
$posision = strpos($path_this, $search_string_parent_path) + strlen($search_string_parent_path) - 1;
$path_up_directory = substr($path_this, 0, $posision);
// ディレクトリのパスからファイル名を取得する処理
$posision = strpos(__FILE__, $path_this) + strlen($path_this);
$file_name = substr(__FILE__, $posision);

// 問題ないか確認
print "print \$ual_this = " . $path_this . "<br>";
print "print \$ual_home = " . $path_up_directory . "<br>";
print "print \$file_name = " . $file_name . "<br>";

// Loginボタン押下時に動く処理
if (isset($_POST['login_button']) == true) {
    $display_control_no = 1;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--  タブ名称  -->
    <title>KS_Login</title>
    <meta name="description" content="An interactive getting started guide for Brackets.">
    <link rel="stylesheet" href="main.css">
</head>

<body>

    <h2>ログイン画面</h2>

    <form method="post">
        <table>
            <tbody>
                <tr>
                    <td>メールアドレス</td>
                    <td><input type="text" name="login_mail" maxlength="50" size="60"></td>
                </tr>
                <tr>
                    <td>パスワード</td>
                    <td><input type="text" name="login_pass" maxlength="50" size="60"></td>
                </tr>
            </tbody>
        </table>
        <br>
        <button type="submit" name="login_button">Login</button>
    </form>

    <?php
    if ($display_control_no == 1) {
        print "<br>";
        print "<h1>ごめんね！　～ボタン押下時のロジック開発中～　ごめんね！</h1>";
        print "<button type=\"button\" name=\"back\" onclick=\"location.href='" . $url_base . $path_this . "'\">リセット</button>";
        print "<button type=\"button\" name=\"back\" onclick=\"location.href='" . $url_base . $path_up_directory . "'\">戻る</button>";
    }
    ?>
</body>

</html>
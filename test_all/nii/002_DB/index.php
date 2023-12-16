<?php
// サーバのベースURL
$url_base = "http://tojikaji.xsrv.jp/";
// ディレクトリのパスからURLを取得する処理（取得したい文字が検索文字より後にある場合）
$directory_path = dirname(__FILE__);
$search_string = "public_html/";
$posision = strpos($directory_path, $search_string) + strlen($search_string);
$path_this = substr($directory_path, $posision) . "/";
// ディレクトリのパスから一つ上階層を取得する処理
$directory_list = explode("/", $path_this);
$directory_list_quantity = count($directory_list);
$minimum_quantity = 2;
if ($directory_list_quantity > $minimum_quantity) {
    // $path_this を "/" で分割した配列の数が $minimum_quantity より大きいとき
    for ($i = 0; $i < count($directory_list) - $minimum_quantity; $i++) {
        if ($i === 0) {
            $path_up_directory = $directory_list[$i] . "/";
        } else {
            $path_up_directory .= $directory_list[$i] . "/";
        }
    }
} else {
    // $path_this 内で、始めに現れる "/" の前の文字列を取得する
    $search_string_parent_path = "/";
    $posision = strpos($path_this, $search_string_parent_path) + strlen($search_string_parent_path) - 1;
    $path_up_directory = substr($path_this, 0, $posision);
}
// ディレクトリのパスからファイル名を取得する処理
$posision = strpos(__FILE__, $path_this) + strlen($path_this);
$file_name = substr(__FILE__, $posision);

// URL
$url_this = $url_base . $path_this;
$url_up_directory = $url_base . $path_up_directory;
// 下階層のpath
$url_php = $url_this . "db_php.php" . "/";
$url_python = $url_this . "db_python.php" . "/";

// URLリスト表示用二次元配列
$url_list_no_url = 0;
$url_list_no_name = 1;
$url_list = [
    [$url_up_directory, "戻る"],
    [$url_php, "PHPのDB接続"],
    [$url_python, "PythonのDB接続"]
];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--  タブ名称  -->
    <title><?php print $path_this; ?></title>
    <meta name="description" content="An interactive getting started guide for Brackets.">
    <link rel="stylesheet" href="main.css">
</head>

<body>

    <p>Go to:</p>

    <ul>
        <?php
        print "<li>path:" . $path_this . "</li>";
        for ($i = 0; $i < count($url_list); $i++) {
            print "<li>";
            print "<a href='" . $url_list[$i][$url_list_no_url] . "'>" . $url_list[$i][$url_list_no_name] . "</a>";
            print "</li>";
        }
        ?>
    </ul>

</body>

</html>
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
// $url_php = $url_this . "db_php.php" . "/";
// $url_python = $url_this . "db_python.php" . "/";

// URLリスト表示用二次元配列
$url_list_no_url = 0;
$url_list_no_name = 1;
$url_list = [
    [$url_this, "戻る"]
];

// ======================================
//          DB接続するための処理
// ======================================
// データベース情報
$db['dbname'] = "tojikaji_kizuna001"; // データベース名
$db['user'] = "tojikaji_kizuna";   // ユーザ名
$db['path'] = "kizuna7980";   // ユーザのパスワード
// $db['host'] = "127.0.0.1";   // DBサーバのIPアドレス
$db['host'] = "localhost";   // DBサーバのURL

//エラーメッセージの初期化
$errorMessage = "";
//フラグの初期化
$o = false;

//検索ボタンが押された時の処理
if (isset($_POST["search"])) {
    //入力チェック
    if (empty($_POST["username"])) {
        $errorMessage = '名前が未入力です。';
    }

    if (!empty($_POST["username"])) {
        $o = true;
        //入力したユーザ名を変数に格納
        $username = $_POST["username"];

        //dsnを作成
        $dsn = sprintf('mysql:host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        try {
            //PDOを使ってMySQLに接続
            $pdo = new PDO($dsn, $db['user'], $db['path'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            // $pdo = new PDO($dsn, $db['user'], $db['path'], [
            //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            //     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // ]);

            //SQLを作成
            $sql = "SELECT * FROM 0001_01_user WHERE user_name LIKE '" . $username . "%'";

            //$pdoにあるqueryメソッドを呼び出してSQLを実行
            $stmt = $pdo->query($sql);

            //出力結果を$rowに代入
            $row = $stmt->fetchAll();

            //出力結果をそれぞれの配列に格納
            $user_id = array_column($row, 'userid');
            $user_name = array_column($row, 'user_name');
            $user_pass = array_column($row, 'password');
            $user_mail = array_column($row, 'mailaddress');
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー' . $e->getMessage();
        }
    }
}
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
    <h1>出力画面</h1>
    <form id="outputForm" name="outputForm" action="" method="POST">
        <p>検索フォーム</p>
        <div>
            <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
        </div>
        <label for="username">名前</label>
        <input type="text" id="username" name="username" placeholder="名前を入力" value="<?php if (!empty($_POST["username"])) {
                                                                                        echo htmlspecialchars($_POST["username"], ENT_QUOTES);
                                                                                    } ?>">
        <input type="submit" id="search" name="search" value="検索">
        <label>（前方一致検索）</label>
        <br>
        <label>※SQLインジェクション攻撃可能「' OR 1=1 or 1='」</label>
    </form>
    <div>
        <?php
        if (!empty($user_id)) {
            if (count($user_id) > 0) {
                echo '<p>検索結果<br>';
                echo '- - - - - - - - - - - - - - - - - - - - - - - - </p>';
                for ($i = 0; $i < count($user_id); $i++) {
                    echo '<div>ユーザーID：' . $user_id[$i] . '</div>';
                    echo '<div>名前：' . $user_name[$i] . '</div>';
                    echo '<div>パスワード：' . $user_pass[$i] . '</div>';
                    echo '<div>メールアドレス：' . $user_mail[$i] . '</div>';
                    echo '<p>- - - - - - - - - - - - - - - - - - - - - - - - </p>';
                }
            } else {
                if ($o == true) {
                    echo '<p>検索結果</p>';
                    echo '<div>該当するデータはありません</div>';
                } else {
                }
            }
        }
        ?>
    </div>

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
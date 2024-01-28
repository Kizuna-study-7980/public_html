<?php
// メソッド（関数？）実装したい機能


// １．サーバのベースURLするメソッド
$url_base = "http://tojikaji.xsrv.jp/";


// ２．現在の階層のURLを取得するメソッド 及び 1つ上の階層のURLを取得するメソッド
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
// URL
$url_this = $url_base . $path_this; // 現在の階層のURL
$url_up_directory = $url_base . $path_up_directory; // 1つ上の階層のURL


// ======================================
//          ３．DB接続するための処理
// 
//  たくさん機能があるので分割する必要アリ
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

            //SQLを作成
            // ここのSQLを任意のものに書き換えられるようにすれば、データ取得の幅が広がる
            $sql = "SELECT * FROM 0001_01_user WHERE user_name LIKE '" . $username . "%'";

            //$pdoにあるqueryメソッドを呼び出してSQLを実行
            $stmt = $pdo->query($sql);

            //出力結果を$rowに代入
            $row = $stmt->fetchAll();

            //出力結果をそれぞれの配列に格納
            // 取得したいカラム名を配列にして、SQLから取得したデータも配列に格納すればデータの取得が容易になる
            // 指定データを取得したいときは、取得カラム配列の何番目に取得したいカラムがあるかのNoを取得
            // 取得NoをSQLから取得したデータ配列のNoに置き換えると良い（indexOfメソッドとかあるのかな）
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
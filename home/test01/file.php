<?php
//＝＝＝＝　制御部　ここから　＝＝＝＝
    $sex[0]="男性";
    $sex[1]="女性";
    $season[0]="春";
    $season[1]="夏";
    $season[2]="秋";
    $season[3]="冬";
    $datafname="questionnaire.txt";
    $pageToDisplay=0; //表示すべきページ
    $nickname="";
    $seibetsu=-1; //どこも指していない状態
    $kisetsu=-1;  //どこも指していない状態
    $checkmessage="";
    if (isset($_POST['okuru']) == true) {
        $pageToDisplay=1;
        $kisetsu=$_POST['kisetsu'];
        if (isset($_POST['seibetsu'])) {
            $seibetsu=$_POST['seibetsu'];
        } else {
            $pageToDisplay=0;
            $checkmessage.="性別が選択されていません。<br>";
        }
        if ($_POST['nickname']!="") {
            $nickname=htmlspecialchars($_POST['nickname'], ENT_QUOTES);
        } else {
            $pageToDisplay=0;
            $checkmessage.="ニックネームが記入されていません。<br>";
        }
        if ($checkmessage!="") {
            $checkmessage="<font color=\"red\"><b>".$checkmessage;
            $checkmessage.="正しく記入してもう一度送信してください。</b></font><br>& lt;br>";
        }
    }
    if (isset($_POST['teisei']) == true) {
        $kisetsu=$_POST['kisetsu'];
        $seibetsu=$_POST['seibetsu'];
        $nickname=$_POST['nickname'];
    }
    if (isset($_POST['hozon']) == true) {
        $kisetsu=$_POST['kisetsu'];
        $seibetsu=$_POST['seibetsu'];
        $nickname=$_POST['nickname'];
        $pageToDisplay=2;
        $fp=fopen($datafname,"a");
        fprintf($fp,"%s,%s,%s\r\n",$nickname,$sex[$seibetsu],$season[$kisetsu]);
        fclose($fp);
    }
//＝＝＝＝　制御部　ここまで　＝＝＝＝
?>

<html>

<body>

    <?php
//＝＝＝＝　表示部　ここから　＝＝＝＝
    if ($pageToDisplay == 0) {
        print "<h2>アンケートです</h2>\n";
        if ($checkmessage!="") print $checkmessage."\n";
        print "<form method=\"post\">\n";
        print "<b>１．あなたのニックネームは？</b>\n";
        print "<ul>";
        print "<input type=\"text\" size=\"30\" name=\"nickname\" value=\"".$nickname."\" required><br>\n";
        print "</ul>";
       
        print "<b>２．あなたの性別は？</b>\n";
        print "<ul>\n";
        for ($i=0; $i<2; $i++) {
            print "<input type=\"radio\" name=\"seibetsu\" value=".$i;
            if ($i==$seibetsu) print " checked";
            print " required>".$sex[$i]."<br>\n";
        }
        print "</ul>\n";
       
        print "<b>３．あなたの一番好きな季節は？</b>\n";
        print "<ul>\n";
        print "<select name=\"kisetsu\">\n";
        for ($i=0; $i<4; $i++) {
            print "<option value=".$i;
            if ($i==$kisetsu) print " selected";
            print ">".$season[$i]."</option>";
        }
        print "\n";
        print "</select>";
        print "</ul>\n";

        print "回答がおわったら送信ボタンを押してください。<br>\n";
        print "<ul>\n";
        print "<input type=\"submit\" name=\"okuru\" value=\"送信\">\n";
        print "</ul>\n";
        print "</form>\n";

    } else if ($pageToDisplay == 1) {
        print $nickname . "　さんの回答です。<br><br>";
        print "性別　　　　：　".$sex[$seibetsu]."<br>\n";
        print "好きな季節　：　".$season[$kisetsu]."<br>\n";
        print "<br>\n";
        print "<ul>\n";
        print "<form method=\"post\">\n";
        print "<input type=\"submit\" name=\"hozon\" value=\"確定送信\"><br>\n";
        print "<input type=\"hidden\" name=\"nickname\" value=\"".$nickname."\">\n";
        print "<input type=\"hidden\" name=\"seibetsu\" value=\"".$seibetsu."\">\n";
        print "<input type=\"hidden\" name=\"kisetsu\" value=\"".$kisetsu."\">\n";
        print "</form>\n";
        print "<form method=\"post\">\n";
        print "<input type=\"submit\" name=\"kyanseru\" value=\"キャンセル\"><br>\n";
        print "</form>\n";
        print "<form method=\"post\">\n";
        print "<input type=\"submit\" name=\"teisei\" value=\"やりなおし訂正\"><br>\n";
        print "<input type=\"hidden\" name=\"nickname\" value=\"".$nickname."\">\n";
        print "<input type=\"hidden\" name=\"seibetsu\" value=\"".$seibetsu."\">\n";
        print "<input type=\"hidden\" name=\"kisetsu\" value=\"".$kisetsu."\">\n";
        print "</form>\n";
        print "</ul>\n";
    } else if ($pageToDisplay == 2) {
        print "ファイル ".$datafname." に保存しました。<br><br>\n";
        print "<form method=\"post\">\n";
        print "<input type=\"submit\" name=\"ryokai\" value=\"了解\"><br>\n";
        print "</form>\n";
    }
//＝＝＝＝　表示部　ここまで　＝＝＝＝
?>

</body>

</html>

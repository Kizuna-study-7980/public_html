# -*- coding: utf-8 -*-
import sys
import Util

argvs = sys.argv
program_name = argvs[0]
graduation_year = Util.getGraduationYear(1)

type_button = "button"
type_submit = "submit"
type_reset = "reset"
type_text = "text"
type_password = "password"


path = sys.path[0]
search = "public_html/"
search_index = path.find(search)
url_this = path[search_index + len(search) :] + "/"
print(path[search_index + len(search)])
print(path[search_index + len(search) :])

url_base = "http://tojikaji.xsrv.jp/"

url_home = url_base + url_this
url_test01 = url_home + "test01/"
url_test01_file = url_home + "test01/file.php"
url_test01_name = url_home + "test01/testname1.php"
url_test02 = url_home + "test02/"
url_test03 = url_home + "test03/"
url_login = url_home + "login/"
url_html_boxmove = url_home + "test99_html/test01_boxmove/"
url_html_photoDisp = url_home + "test99_html/test02_photoDisp/"
button1 = Util.getButtonHTML(type_button, "test1", None, "テスト01", url_test01)
button2 = Util.getButtonHTML(type_button, "test2", None, "テスト02", url_test02)
button3 = Util.getButtonHTML(type_button, "test3", None, "テスト03", url_test03)

test_list = ["りんご", "ごりら", "らま"]

memo_list = [
    "PHPにべた書きだと動くけど、pythonからbuttonタブを取得してprintするのができない。Why？<br>＞pythonのコード1行目に　# -*- coding: utf-8 -*-　を入力すると解決",
    "pythonで出力するためにはprintを行う必要があるが、phpから呼び出したファイル以外でprintを行うとエラーになる",
    "phpで出力する際、ダブルクオーテーションなどのエスケープ処理は（表示しない場合は）必要なし",
    "<a href='https://qiita.com/_Kohei_/items/069aa1e7b872f5ca96bf'>アンダースコアの使い方について</a>",
    "<s>次すること：入力フォームを作る→このページに戻ってきて入力した内容が特定の場所に表示出来ていること</s> ＞ 取り敢えず出来た",
    "次すること：DB接続（その前に新しい環境になったので、DBのテーブルを作る必要あり）",
    "次すること：pythonのimport方法を明確に（別階層にあるUtilやSubを参照する方法を知る）",
    "その内する：CSSの作成",
    "課題：buttonをたくさん作ると煩雑になるため、ボタンやインプット用のクラスを作った方がよさそう",
    "ここのメモもtextから読みだす方法にした方がいいかも（更新が面倒）",
]

# if len(argvs) != 2:  # デバッグ用
if len(argvs) >= 2:
    # input = argvs[1]　# phpからのinput値を使うときに必要
    print("argvs[0]:" + program_name + "<br>")
    print("sys.path:", sys.path)

    print(Util.getListHTML(memo_list, False, None))

    print("テスト用の画面遷移ボタン<br>")
    print(Util.getButtonHTML(type_button, "test1", None, "テスト01", url_test01))
    print(Util.getButtonHTML(type_button, "test2", None, "テスト02", url_test02))
    print(Util.getButtonHTML(type_button, "test3", None, "テスト03", url_test03))

    print(Util.getButtonHTML(type_button, "test1_file", None, "テスト01file", url_test01_file))
    print(Util.getButtonHTML(type_button, "test1_name", None, "テスト01name", url_test01_name))

    print(Util.getButtonHTML(type_button, "login", None, "Login", url_login))

    print(Util.getButtonHTML(type_button, "html01", None, "BoxMove", url_html_boxmove))
    print(Util.getButtonHTML(type_button, "html02", None, "PhotoDisp", url_html_photoDisp))

    print("<br>")
    print("text01" + Util.getTextBoxHTML(type_text, "text01", "初期値", "20", 25))
    print("<br>")
    print("password01" + Util.getTextBoxHTML(type_password, "password01", "12345", "12", 15))
    print("<br>")

    print("<br>")
    # ボタン押下時に画面リロードされない
    print("特に何も起こらない" + Util.getButtonHTML(type_submit, "submit_button", None, "button_submit", None))
    # ボタン押下時に画面リロードされる
    print(
        Util.addPostForm(
            "リロードされる"
            + Util.getTextBoxHTML(type_password, "post_text", "kizuna", "20", "30")
            + Util.getButtonHTML(type_submit, "post_submit_button", None, "button_submit_post", None)
            + "<br>↑のtextboxに入力した値が、ボタンを押下した後、画面上部に表示される。"
        )
    )

    # リスト出力用テスト
    # ul,olのtype選択、True,Falseじゃなくて、ul,olの文字列を入力する方が可読性高くなるので、変更したい
    print(Util.getListHTML(test_list, False, None))
    print(Util.getListHTML(test_list, True, None))
    print(Util.getListHTML(test_list, True, "a"))
else:
    print("Hello")

# できない
# print("<button type=\"button\" name=\"test1\" onclick=\"location.href='http://study7980.cloudfree.jp/test01/'\">テスト01</button>")
# そもそもタブの送り方がおかしい？

# 何がダメなのかの検証をする必要がある

# 検証方法
# pythonでprintして表示されるかどうか
# print(buttonタブ)
# print(pタブ)
# print(brタブ)

# 【解決】
# Utilの文字コードを明示する必要があった
# 「# -*- coding: utf-8 -*-」

# 【Memo】
# 別のクラスでprintするのはNG
# PHPで呼び出したクラス内でprintしないといけない

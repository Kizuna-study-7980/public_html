# -*- coding: utf-8 -*-

term_year = 3


def getGraduationYear(enrollment_year):
    graduation_year = enrollment_year + term_year
    return graduation_year


def getButtonHTML(type, name, value, display_value, link_url):
    """HTMLのボタンを取得する
    """

    html_type = "<button type=\"button\""
    if type != None:
        # 引数のtypeがタブで使えるものでなければ規定値にするような考慮が必要
        html_type = "<button type=\"" + type + "\""
    else:
        html_type = "<button type=\"button\""

    html_name = ""
    if name is not None:
        html_name = " name=\"" + name + "\""

    html_value = ""
    if value is not None:
        html_value = " value =\"" + value + "\""

    html_onclick = ""
    if link_url is not None:
        html_onclick = " onclick=\"location.href='" + link_url + "'\""

    html_display_value = ""
    if html_display_value is not None:
        html_display_value = display_value

    button_html = html_type + html_name + html_value + html_onclick + ">"\
        + html_display_value + "</button>"

    return button_html


def addPostForm(String):
    return_string = "<form method=\"post\">"
    return_string += String
    return_string += "</form>"
    return return_string


def getListHTML(string_list, oi_flag, no_type):
    """箇条書きのHTMLを取得する
    """
    return_string = ""

    list_ul = "ul"
    list_ol = "ol"
    list_type = list_ul

    tab_start = "<" + list_ul + ">"

    if oi_flag is True:

        tab_start = tab_start.replace(list_ul, list_ol)
        list_type = list_ol

        if no_type is not None:
            # 引数のtypeがタブで使えるものでなければ規定値にするような考慮が必要
            tab_start = tab_start.replace(">", " type=" + no_type + ">")

    return_string += tab_start
    for string in string_list:
        return_string += "<li>" + string + "</li>"
    return_string += "</" + list_type + ">"

    return return_string


def getTextBoxHTML(type, name, value, maxlength, size):
    """HTMLのテキストボックスを取得する
    """

    html_type = "<input type=\"text\""
    html_name = ""
    html_value = ""
    html_maxlength = ""
    html_size = ""

    if type != None:
        # 引数のtypeがタブで使えるものでなければ規定値にするような考慮が必要
        html_type = html_type.replace("text", type)
    if name is not None:
        html_name = " name=\"" + name + "\""
    if value is not None:
        html_value = " value =\"" + value + "\""
    if maxlength is not None:
        html_maxlength = " maxlength =\"" + maxlength + "\""
    if size is not None:
        html_size = " size =\"" + str(size) + "\""

    button_html = html_type + html_name + \
        html_value + html_maxlength + html_size + ">"

    return button_html


def getLinkHome():
    return "<a href='http://study7980.cloudfree.jp/home/'>Home</a>"


def printMessage(String):
    print("<p>" + String + "</p>")

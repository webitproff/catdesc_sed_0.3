# catdesc_sed_0.3
Add custom description text to categories
 This simple plugin allows you to add complete descriptions to categories, which are not limited to 255 chars and may contain bbcodes, so that categories turn into pages too.
 
1. Parser modes:

This plugin supports editing pages with CKEditor as well as markItUp. You should install the CKEditor plugin to enable it.

You can select a preferred editor in plugin settings. If CKEditor is chosen, category descriptions will use HTML parser. Otherwise markItUp! and BBcode parsing will be used.
Данная версия плагина позволяет использовать наряду с маркитап'ом для редактирования страниц,
CKEditor. Для использование данной возможности плагин CKEditor должен быть установлен на Вашем сайте.

В настройках плагина выбирается тот или другой редактор.
При отображении описания категории используется парсинг HTML, если включена опция "Использовать CKEditor", и парсинг BB-кодов если эта опция отключена.

2. Installation:

    Put "catdesc" into your plugin folder.
    Go to Admin => Plugins => Category descriptions and install the plugin.
    Add {LIST_TEXT} and {LIST_TEXTEDIT} tags to your "list.tpl" and "list.group.tpl".


3. Tutorial:

Step 1. Enter a category you wish to edit and press "Edit Description" link

Step 2. Edit the article, press "Send" and then click "Category" link above to return to the category

Step 3. Enjoy the result

4. What's new

0.3: Alex300 added CKEditor and HTML parsing support.

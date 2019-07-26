<?php
include('params-local.php');
<<<<<<< HEAD
=======

/*$title = $_POST['title'];
$description = $_POST['description'];
$content = $_POST['content'];
$update_date = $_POST['update_date'];
$update_date = date('Y-m-d H:i:s');
$edit_date = $_POST['edit_date'];
$edit_date = date('Y-m-d H:i:s');
$views = $_POST['views'];
$author_id = $_POST['author_id'];*/
>>>>>>> 39935a7711b2f782077a8e40b7c7a354f5962cd7

try {
    $pdo = new PDO("$driver:host=$host; dbname=$dbname; charset=$charset", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}

function showTable($pdo)
{
    $result = $pdo->query('SELECT betjournal_news.ID, betjournal_news.Title,
    betjournal_news.Short_description, betjournal_news.Content, betjournal_news.Add_date,
    betjournal_news.Edit_date,betjournal_news.Views, betjournal_author.Author_name
    FROM `betjournal_news` INNER JOIN betjournal_author ON betjournal_news.Author_ID = betjournal_author.ID ');
    for ($data = []; $row = $result->fetch(PDO::FETCH_ASSOC); $data[] = $row);

    $newsinfo = "<div class=\"card-header\">
    <h4 class=\"card-title\">Новости</h4>
  </div>
    <table class=\"tdpad fsize mrnlefttable\">
            <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Краткое описание</th>
            <th>Содержимое</th>
            <th>Дата добавления</th>
            <th>Дата редактирования</th>
            <th>Кол-во просмотров</th>
            <th>Автор</th>
            <th>Редактировать</th>
            <th>Удалить</th>
            </tr>";
    foreach ($data as $news) {
        $newsinfo .= "<tr>
            <td>{$news['ID']}</td>
            <td>{$news['Title']}</td>
            <td>{$news['Short_description']}</td>
            <td>{$news['Content']}</td>
            <td>{$news['Add_date']}</td>
            <td>{$news['Edit_date']}</td>
            <td>{$news['Views']}</td>
            <td>{$news['Author_name']}</td>
            <td><a href=\"edit-news.php?edit={$news['ID']}\"><button type=\"button\" class=\"btn btn2 mr-1 mb-1 btn-success btn-sm\">Редактировать</button></a></td>
            <td><a href=\"?delete={$news['ID']}\"><button name=\"del\" type=\"button\" class=\"btn btn2 mr-1 mb-1 btn-danger btn-sm\">Удалить</button></a></td>
            </tr>";
    }

    $newsinfo .= '</table>
    <a href="add-news.php"><button type="button" class="btn btn-success btn-min-width mr-1 mb-1 btntop" name="addNewsBtn">Добавить новость</button></a>
    ';


    include('list-news.php');
}

function deleteTable($pdo)
{
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = "DELETE From betjournal_news where id = $id";
        $result = $pdo->query($query);
    }
}

deleteTable($pdo);
showTable($pdo);
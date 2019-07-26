<?php
include('params-local.php');

try {
    $pdo = new PDO("$driver:host=$host; dbname=$dbname; charset=$charset", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}

function showTable($pdo)
{
    $result = $pdo->query('select * from betjournal_author');
    for ($data = []; $row = $result->fetch(PDO::FETCH_ASSOC); $data[] = $row);

    $newsinfo = "<div class=\"card-header\">
    <h4 class=\"card-title\">Авторы</h4>
  </div>
    <table class=\"tdpad fsize mrnlefttable\">
            <tr>
            <th>ID</th>
            <th>Автор</th>
            </tr>";
    foreach ($data as $news) {
        $newsinfo .= "<tr>
            <td>{$news['ID']}</td>
            <td>{$news['Author_name']}</td>
            <td><a href=\"edit-author.php?edit={$news['ID']}\"><button type=\"button\" class=\"btn btn2 mr-1 mb-1 btn-success btn-sm\">Редактировать</button></a></td>
            <td><a href=\"?delete={$news['ID']}\"><button name=\"del\" type=\"button\" class=\"btn btn2 mr-1 mb-1 btn-danger btn-sm\">Удалить</button></a></td>
            </tr>";
    }

    $newsinfo .= '</table>
    <a href="add-author.php"><button type="button" class="btn btn-success btn-min-width mr-1 mb-1 btntop" name="addNewsBtn">Добавить автора</button></a>
    ';

    include('list-news.php');
}

function deleteTable($pdo)
{
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = "DELETE From betjournal_author where id = $id";
        $result = $pdo->query($query);
    }
}

deleteTable($pdo);
showTable($pdo);

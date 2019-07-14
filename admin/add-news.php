<?php
$driver = 'mysql';
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'betjournal';
$charset = 'utf8';

$addbtn = $_POST['addNewsBtn'];

$title = $_POST['title'];
$description = $_POST['description'];
$content = $_POST['content'];
$update_date = $_POST['update_date'];
$update_date = date('Y-m-d H:i:s');
$edit_date = $_POST['edit_date'];
$edit_date = date('Y-m-d H:i:s');
$views = $_POST['views'];
$author_id = $_POST['author_id'];

if (
    isset($addbtn) && isset($title) && isset($description) && isset($content) && isset($update_date)
    && isset($edit_date) && isset($views) && isset($author_id)
) {
    try {
        $pdo = new PDO("$driver:host=$host; dbname=$dbname; charset=$charset", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result = $pdo->prepare("INSERT INTO `betjournal_news`(`Title`, `Short_description`, `Content`, `Update_date`, `Edit_date`, `Views`, `Author_ID`)
        VALUES ('$title','$description','$content','$update_date', '$edit_date','$views','$author_id')");
        $result->execute();
    } catch (PDOException $e) {
        echo 'Ошибка: ' . $e->getMessage();
    }
    header("Location: list-news-bd.php");
}
include('includes/head.php');
include('includes/navbar.php');
?>

<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="active"><a href="list-news-bd.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Новости</span></a>
        </li>
    </ul>
</div>
</div>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <form method="POST">
                <table border="0">
                    <tr>
                        <td>
                            <h6>Заголовок</h6>
                        </td>
                        <td><input type="text" class="form-control" id="basicInput" name="title"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Краткое описание</h6>
                        </td>
                        <td><input type="text" class="form-control" id="basicInput" name="description"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Содержимое</h6>
                        </td>
                        <td><input type="text" class="form-control" id="basicInput" name="content"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Дата добавления</h6>
                        </td>
                        <td><input type="text" class="form-control" id="basicInput" name="update_date"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Дата редактирования</h6>
                        </td>
                        <td><input type="text" class="form-control" id="basicInput" name="edit_date"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Количество просмотров</h6>
                        </td>
                        <td><input type="text" class="form-control" id="basicInput" name="views"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Автор ID</h6>
                        </td>
                        <td><input type="text" class="form-control" id="basicInput" name="author_id"></td>
                    </tr>
                </table>
                <input type="submit" class="btn btn-success btn-min-width mr-1 mb-1" name="addNewsBtn" value="Сохранить">
            </form>

            <?php
            include('includes/scripts.php');
            ?>
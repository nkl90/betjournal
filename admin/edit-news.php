<?php
$driver = 'mysql';
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'betjournal';
$charset = 'utf8';

$id = $_GET['edit'];

$editbtn = $_POST['saveNewsBtn'];

$title = $_POST['title'];
$description = $_POST['description'];
$content = $_POST['content'];
$edit_date = date('Y-m-d H:i:s');
$author_id = $_POST['author_id'];

$pdo = new PDO("$driver:host=$host; dbname=$dbname; charset=$charset", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $result = $pdo->prepare("SELECT * FROM `betjournal_news`WHERE ID=$id");
    $result->execute([
        'Title' => $title, 'Short_description' => $description, 'Content' => $content,
        'Author_ID' => $author_id
    ]);
    $edit = $result->fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}

if (
    isset($editbtn)
) {
    $result = $pdo->query("UPDATE `betjournal_news` SET Title='$title', Short_description='$description', Content='$content',
    Edit_date='$edit_date', Author_ID='$author_id' WHERE ID=$id");
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
                        <td><input value="<?= $edit->Title; ?>" type="text" class="form-control" id="basicInput" name="title"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Краткое описание</h6>
                        </td>
                        <td><input value="<?= $edit->Short_description; ?> " type="text" class="form-control" id="basicInput" name="description"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Содержимое</h6>
                        </td>
                        <td><textarea class="form-control" id="descTextarea" rows="3" name="content" value="<?= $edit->Content; ?>"></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Автор</h6>
                        </td>
                        <td>
                        <select class="custom-select" id="customSelect" name="author">
                                <option>Выберите автора</option>
                                <?php
                                $author_result = $pdo->prepare("SELECT Author_name FROM `betjournal_author`");
                                $author_result->execute();
                                $author_results=$author_result->fetchAll();
                                foreach ($author_results as $id => $author_name) :
                                    echo "<option value=" . $id["ID"] . ">" . $author_name["Author_name"] . "</option>";
                                endforeach;

                                ?>
                            </select>
                        </tr>
                </table>
                <input type="submit" class="btn btn-success btn-min-width mr-1 mb-1" name="saveNewsBtn" value="Сохранить изменения">
            </form>

            <?php
            include('includes/scripts.php');
            ?>
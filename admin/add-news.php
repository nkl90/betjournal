<?php
include('params-local.php');

$addbtn = $_POST['addNewsBtn'];

$title = $_POST['title'];
$description = $_POST['description'];
$content = $_POST['content'];
$add_date = date('Y-m-d H:i:s');
$author = $_POST['author'];

$pdo = new PDO("$driver:host=$host; dbname=$dbname; charset=$charset", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (
    isset($addbtn) && isset($title) && isset($description) && isset($content) && isset($author)
) {
    try {
        $result = $pdo->prepare("INSERT INTO `betjournal_news`(`Title`, `Short_description`, `Content`, `Add_date`, `Author_ID`)
        VALUES ('$title','$description','$content','$add_date', '$author')");
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
                        <td><textarea class="form-control" id="descTextarea" rows="3" name="content"></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Автор</h6>
                        </td>
                        <td><select class="custom-select" id="customSelect" name="author">
                                <option>Выберите автора</option>
                                <?php
                                $author_result = $pdo->prepare("SELECT Author_name FROM `betjournal_author`");
                                $author_result->execute();
                                $author_results = $author_result->fetchAll();
                                foreach ($author_results as $id => $author_name) :
                                    echo "<option value=".$id["ID"].">" . $author_name["Author_name"] . "</option>";
                                endforeach;
                                ?>
                            </select></td>
                    </tr>
                </table>
                <input type="submit" class="btn btn-success btn-min-width mr-1 mb-1" name="addNewsBtn" value="Сохранить">
            </form>

            <?php
            include('includes/scripts.php');
            ?>
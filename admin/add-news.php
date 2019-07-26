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
        <li class="active"><a href="list-news-author.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Авторы</span></a>
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
                <table>
                    <tr>
                        <td>
                            <h6>Заголовок:</h6>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control title_author_width" id="basicInput" name="title"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Краткое описание:</h6>
                        </td>
                        <td>
                            <h6>Содержимое:</h6>
                        </td>
                    </tr>
                    <tr>
                        <td><textarea class="form-control desc_cont_width" id="descTextarea" rows="3" name="description"></textarea></td>
                        <td><textarea class="form-control desc_cont_width" id="descTextarea" rows="3" name="content"></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Автор:</h6>
                        </td>
                    </tr>
                    <tr>
                        <td><select class="custom-select title_author_width" id="customSelect" name="author">
                                <option>Выберите автора</option>
                                <?php
                                $author_result = $pdo->prepare("SELECT * FROM `betjournal_author`");
                                $author_result->execute();
                                $author_results = $author_result->fetchAll();
                                foreach ($author_results as $key => $row) :
                                    ?>
                                    <option value="<?= $row['ID'] ?>"><?= $row["Author_name"] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" class="btn btn-success btn-min-width mr-1 mb-1 btntop" name="addNewsBtn" value="Сохранить"></td>
                        <td></td>
                    </tr>
                </table>

            </form>
            <?php
            include('includes/scripts.php');
            ?>
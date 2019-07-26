<?php
include('params-local.php');

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
    //сразу видно, по PDO ничего не читала, либо ничего не поняла
    $sth = $pdo->prepare("UPDATE `betjournal_news` SET Title=:title, Short_description=:description, Content=:content,
    Edit_date=:edit_date, Author_ID=:author_id WHERE `ID`=:id");

    $sth->bindParam(':title', $title);
    $sth->bindParam(':description', $description);
    $sth->bindParam(':content', $content);
    $sth->bindParam(':edit_date', $edit_date);
    $sth->bindParam(':author_id', $author_id);
    $sth->bindParam(':id', $id);
    $sth->execute();

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
                        <td><input value="<?= $edit->Title; ?>" type="text" class="form-control title_author_width" id="basicInput" name="title"></td>
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
                        <td><textarea class="form-control desc_cont_width" id="descTextarea" rows="3" name="description"><?= $edit->Short_description; ?></textarea></td>
                        <td><textarea class="form-control desc_cont_width" id="descTextarea" rows="3" name="content"><?= $edit->Content; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Автор:</h6>
                        </td>
                    </tr>
                    <tr>
                        <td><select class="custom-select title_author_width" id="customSelect" name="author_id">
                                <option>Выберите автора</option>
                                <?php
                                $author_result = $pdo->prepare("SELECT * FROM `betjournal_author`");
                                $author_result->execute();
                                $author_results = $author_result->fetchAll();
                                foreach ($author_results as $key => $row) :
                                    ?>
                                    <option <?= ($edit->Author_ID == $row['ID']) ? 'selected' : '' ?> value="<?= $row['ID'] ?>">
                                        <?= $row["Author_name"] ?>
                                    </option>
                                <?php
                                endforeach;
                                ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" class="btn btn-success btn-min-width mr-1 mb-1 btntop" name="saveNewsBtn" value="Сохранить изменения"></td>
                        <td></td>
                    </tr>
                </table>

            </form>
            <?php
            include('includes/scripts.php');
            ?>
<?php
include('params-local.php');

$id = $_GET['edit'];

$editbtn = $_POST['saveAuthorBtn'];

$fio = $_POST['fio'];
$username = $_POST['username'];
$passw = $_POST['passw'];

$pdo = new PDO("$driver:host=$host; dbname=$dbname; charset=$charset", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $result = $pdo->prepare("SELECT * FROM `betjournal_author`WHERE ID=$id");
    $result->execute([
        'Author_name' => $fio, 'username' => $username, 'user_password' => $passw
    ]);
    $edit = $result->fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}

if (
    isset($editbtn)
) {

    $sth = $pdo->prepare("UPDATE `betjournal_author` SET Author_name=:fio, username=:username, user_password=:passw WHERE `ID`=:id");

    $sth->bindParam(':fio', $fio);
    $sth->bindParam(':username', $username);
    $sth->bindParam(':passw', $passw);
    $sth->bindParam(':id', $id);
    $sth->execute();

    header("Location: list-news-author.php");
}

include('includes/head.php');
include('includes/navbar.php');
?>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <form method="POST">
                <table border="0">
                    <tr>
                        <td>
                            <h6>ФИО Автора:</h6>
                        </td>
                    </tr>
                    <tr>
                        <td><input value="<?= $edit->Author_name; ?>" type="text" class="form-control title_author_width authornamewidth" id="basicInput" name="fio"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Логин:</h6>
                        </td>
                    </tr>
                    <tr>
                        <td><input value="<?= $edit->username; ?>" type="text" class="form-control title_author_width" id="basicInput" name="username"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Пароль:</h6>
                        </td>
                    </tr>
                    <tr>
                        <td><input value="<?= $edit->user_password; ?>" type="password" class="form-control title_author_width" id="passwordField" name="passw"></td>
                    </tr>
                </table>
                <input type="submit" class="btn btn-success btn-min-width mr-1 mb-1 btntop" name="saveAuthorBtn" value="Сохранить изменения">
            </form>

            <?php
            include('includes/scripts.php');
            ?>
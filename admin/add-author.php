<?php
include('params-local.php');

$addbtn = $_POST['addAuthorBtn'];

$fio = $_POST['fio'];
$username = $_POST['username'];
$passw = $_POST['passw'];

$pdo = new PDO("$driver:host=$host; dbname=$dbname; charset=$charset", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (
    isset($addbtn) && isset($fio) && isset($username) && isset($passw)
) {
    try {
        $result = $pdo->prepare("INSERT INTO `betjournal_author`(`Author_name`, `username`, `user_password`)
        VALUES ('$fio','$username','$passw')");

        $result->execute();
    } catch (PDOException $e) {
        echo 'Ошибка: ' . $e->getMessage();
    }
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
                        <td><input type="text" class="form-control title_author_width authornamewidth" id="basicInput" name="fio"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Логин:</h6>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" class="form-control title_author_width" id="basicInput" name="username"></td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Пароль:</h6>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="password" class="form-control title_author_width" id="passwordField" name="passw"></td>
                    </tr>
                </table>
                <input type="submit" class="btn btn-success btn-min-width mr-1 mb-1 btntop" name="addAuthorBtn" value="Добавить">
            </form>
            <?php
            include('includes/scripts.php');
            ?>
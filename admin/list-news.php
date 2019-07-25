<?php
include('includes/head.php');
include('includes/navbar.php');
$driver = 'mysql';
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'betjournal';
$charset = 'utf8';
try {
  $pdo = new PDO("$driver:host=$host; dbname=$dbname; charset=$charset", $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $author_result = $pdo->prepare("SELECT Author_name FROM `betjournal_author`");
  $author_result->execute();
  $author_results = $author_result->fetchAll();
} catch (PDOException $e) {
  echo 'Ошибка: ' . $e->getMessage();
}
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

      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Новости</h4>
        </div>
        <div class="card-content collapse show">
          <div class="table-striped tbpad">
            <?= $newsinfo ?>
          </div>
        </div>
      </div>
      <a href="add-news.php"><button type="button" class="btn btn-success btn-min-width mr-1 mb-1" name="addNewsBtn">Добавить новость</button></a>
      <?php
      include('includes/scripts.php');
      ?>
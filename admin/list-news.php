<?php
include('includes/head.php');
include('includes/navbar.php');
include('params-local.php');
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

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">

      <div class="card">
        <div class="card-content collapse show">
          <div class="table-striped tbpad">
            <?= $newsinfo ?>
          </div>
        </div>
      </div>

      <?php
      include('includes/scripts.php');
      ?>
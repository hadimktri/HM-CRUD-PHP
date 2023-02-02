<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once 'src/ArticleRepository.php';

$newArticle = new ArticleRepository("json_files/articles.json");
$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

  $title = trim($_POST['title']);
  $url = filter_var(trim($_POST['url']), FILTER_SANITIZE_URL);

  if (empty($title)) {
    $errorMsg .= '<p>Please enter the title.</p>';
  }

  if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
    $errorMsg .= '<p>Please enter a valid url.</p>';
  }

  if (isset($_POST['submit']) && !empty($title) && filter_var($url, FILTER_VALIDATE_URL)) {

    $updatedArticle = (new Article())->fill(["id" => time(), "title" => $_POST['title'], "url" => $_POST['url']]);
    $newArticle->saveArticle($updatedArticle);
    header("Location:articles.php");
  }
}
?>
<!doctype html>
<html lang="en">
<?php require_once 'layout/header.php' ?>

<body class="wrapper">
  <?php require_once 'layout/navigation.php' ?>
  <div class="container" id="main">
    <!-- Display status message -->
    <div class="container mx-auto mt-10">
      <h3 class="font-bold mt-2">Add Your Article</h3>
      <?php if ($errorMsg) { ?>
        <div class="col-xs-12">
          <div class="alert alert-danger"> <?php echo $errorMsg ?> </div>
        </div>
      <?php } ?>
    </div>

    <form action="#" method="POST">
      <fieldset>
        <legend>Fill required fields below</legend>

        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" id="title" class="form-control" name="title" placeholder="Enter the new title">
        </div>

        <div class="mb-3">
          <label for="url" class="form-label">URL</label>
          <input type="text" id="url" class="form-control" name="url" placeholder="Enter the new url">
        </div>

        <button type="submit" class="btn btn-dark " name="submit">Submit</button>
      </fieldset>
    </form>
  </div>
  <?php require_once 'layout/footer.php' ?>
</body>

</html>
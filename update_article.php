<?php
session_start();
if (!empty($_GET['id'])) {
  require_once 'src/ArticleRepository.php';
 
  $newArticle = new ArticleRepository("json_files/articles.json");
  $id = $_GET['id'];
  $article = $newArticle->getArticleById($id);
  $redirectURL = 'edit_article.php';
  $errorMsg = '';
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

  $title = trim($_POST['title']);
  $url = trim($_POST['url']);
  $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);

  if (empty($title)) {
    $errorMsg .= '<p>Please enter the title.</p>';
  }

  if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
    $errorMsg .= '<p>Please enter a valid url.</p>';
  }

  if (isset($_POST['submit']) && !empty($title) && filter_var($url, FILTER_VALIDATE_URL)) {

    $updatedArticle = (new Article())->fill(["id" => $id, "title" => $title, "url" => $url]);
    $newArticle->updateArticle($id, $updatedArticle);
    header("Location:" . $redirectURL);
  }
}
?>
<!doctype html>
<html lang="en">
<?php require_once 'layout/header.php' ?>

<body>
  <?php require_once 'layout/navigation.php' ?>
  <!-- Display status message -->
  <div class="container mx-auto mt-10">
    <h3 class="font-bold mt-2">Edit Your Article</h3>
    <?php if ($errorMsg) { ?>
      <div class="col-xs-12">
        <div class="alert alert-danger"> <?php echo $errorMsg ?> </div>
      </div>
    <?php } ?>
  </div>
  <!-- form  -->
  <div class="container">
    <form action="#" method="POST">
      <fieldset>
        <legend>Fill required fields below</legend>
        <div class="mb-3">
          <label for="title" class="form-label">TITLE</label>
          <input type="text" id="title" class="form-control" name="title" value="<?php echo htmlspecialchars($article->getTitle()) ?>">
        </div>

        <div class="mb-3">
          <label for="url" class="form-label">URL</label>
          <input type="text" id="url" class="form-control" name="url" value="<?php echo htmlspecialchars($article->getUrl()) ?>">
        </div>
       
        <button type="submit" class="btn btn-dark " name="submit">Submit</button>
      </fieldset>
    </form>
  </div>

</body>

</html>
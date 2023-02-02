<?php
session_start();
require_once 'src/UserRepository.php';
require_once 'src/ArticleRepository.php';

$user = new UserRepository("json_files/users.json");
$users = $user->getAllUsers();

$article = new ArticleRepository("json_files/articles.json");
$articles = $article->getAllArticles();
?>
<!doctype html>
<html lang="en">
<?php require_once 'layout/header.php' ?>

<body class="wrapper">
    <?php require_once 'layout/navigation.php' ?>
    <div class="container-float m-2">
        <h3 class="font-bold">ARTICLES</h3>
    </div>
    <div class="container-float px-3" id="main">
        <table class="table table-bordered border-promary table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="col-sm-6">Title</th>
                    <th scope="col" class="col-sm-6">URL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($articles)) {
                    foreach ($articles as $k => $article) { ?>
                        <tr>
                            <th scope="row"><?php echo $k + 1; ?></th>
                            <td> <?php echo htmlspecialchars($article->getTitle()); ?></td>
                            <td><a href=<?php echo htmlspecialchars($article->getURL()) ?> target="_blank" class="link-info">
                                    <?php echo htmlspecialchars($article->getURL()) ?></a></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="6" class='text-center text-danger'><b>No Article found...</b></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php require_once 'layout/footer.php' ?>
</body>

</html>
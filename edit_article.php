<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once 'src/ArticleRepository.php';
require_once 'src/Models/Article.php';

$article = new ArticleRepository("json_files/articles.json");
$articles = $article->getAllArticles();
?>
<!doctype html>
<html lang="en">
<?php require_once 'layout/header.php' ?>

<body class="wrapper">
    <?php require_once 'layout/navigation.php' ?>
    <h3 class="font-bold m-4">Edit Article</h3>
    <div class="container-float px-3" id="main">
        <table class="table table-bordered border-promary table-hover table-striped ">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="col-sm-7">Title</th>
                    <th scope="col" class="col-sm-5">URL</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($articles)) {
                    foreach ($articles as $k => $article) { ?>
                        <tr>
                            <th scope="row"><?php echo $k + 1; ?></th>
                            <td> <?php echo $article->getTitle(); ?></td>
                            <td><a href=<?php echo $article->getURL() ?> target="_blank" class="link-info"><?php echo $article->getURL() ?></a></td>
                            <td class="text-center"> <a href="update_article.php?id=<?php echo $article->getID(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pen text-success  " viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4
                                         1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5
                                          0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0
                                          0 0-.708l-1.585-1.585z" />
                                    </svg></a></td>
                            <td class="text-center"><a href="delete_article.php?id=<?php echo $article->getID(); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill text-danger " viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 
                                        3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0
                                         0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 
                                         0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                    </svg></a></td>
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
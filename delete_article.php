<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once 'src/ArticleRepository.php';
$article = new ArticleRepository("json_files/articles.json");
$articles = $article->getAllArticles();
$article->deleteArticleById($_GET['id']);
header('Location: edit_article.php');
exit;

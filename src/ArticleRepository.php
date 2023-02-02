<?php
require_once 'src/Models/Article.php';

class ArticleRepository
{
	private string $filename;

	public function __construct(string $filename)
	{
		$this->filename = $filename;
	}

	/**
	 * @return Article[]
	 */
	public function getAllArticles(): array
	{
		if (!file_exists($this->filename)) {
			return [];
		}

		$fileContents = file_get_contents($this->filename);
		if (!$fileContents) {
			return [];
		}

		$decodedArticle = json_decode($fileContents, true);
		if (json_last_error() !== JSON_ERROR_NONE) {
			return [];
		}
		$articles = [];
		foreach ($decodedArticle as $articleData) {
			$articles[] = (new Article())->fill($articleData);
		}

		return $articles;
	}

	/**
	 * @param int $id
	 * @return Article|null
	 */
	public function getArticleById(int $id): Article|null
	{
		$articles = $this->getAllArticles();
		foreach ($articles as $article) {
			if ($article->getID() === $id) {
				return $article;
			}

		}
		return null;
	}

	/**
	 * @param int $id
	 */
	public function deleteArticleById(int $id): void
	{
		$articles = $this->getAllArticles();

		foreach ($articles as $key => $article) {
			if ($article->getID() === $id)
				unset($articles[$key]);
		}
		$encodedArticles = json_encode($articles, JSON_PRETTY_PRINT);
		file_put_contents($this->filename, $encodedArticles);
	}

	/**
	 * @param Article $article
	 */
	public function saveArticle(Article $article): void
	{
		$articles = $this->getAllArticles();
		$articles[] = $article;
		$encodedArticles = json_encode($articles, JSON_PRETTY_PRINT);
		file_put_contents($this->filename, $encodedArticles);
	}

	/**
	 * @param int $id
	 * @param Article $updatedArticle
	 */
	public function updateArticle(int $id, Article $updateArticle): void
	{
		$articles = $this->getAllArticles();
		foreach ($articles as $key => $article) {
			if ($article->getID() === $id) {
				unset($articles[$key]);
				$articles[] = $updateArticle;
			}
		}
		$encodedArticles = json_encode($articles, JSON_PRETTY_PRINT);
		file_put_contents($this->filename, $encodedArticles);
	}
}
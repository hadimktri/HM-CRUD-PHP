<?php
class Article implements jsonSerializable
{
	private int $id;
	private string $title;
	private string $url;
	public function __construct(int $id = 0, string $theTitle = '', string $theUrl = '')
	{
		$this->setID($id);
		$this->setTitle($theTitle);
		$this->setUrl($theUrl);
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle(string $title): void
	{
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}

	/**
	 * @param string $url
	 */
	public function setUrl(string $url): void
	{
		$this->url = $url;
	}

	/**
	 * @return int
	 */
	public function getID(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setID(int $id): void
	{
		$this->id = $id;
	}

	/**
	 * @param $articleData
	 */
	public function fill(array $articleData): Article
	{
		foreach ($articleData as $key => $value) {
			$this->{$key} = $value;
		}
		return $this;
	}

	/**
	 * @return mixed 
	 */
	public function jsonSerialize(): mixed
	{
		return [
			"id" => $this->id,
			"title" => $this->title,
			"url" => $this->url,
		];
	}
}
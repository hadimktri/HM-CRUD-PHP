<?php
class User implements jsonSerializable
{
	private int $id;
	private string $name;
	private string $email;
	private string $password;
	private string $phone;
	private string $image;

	public function __construct(int $theId = 0, string $theName = '', string $theEmail = '', string $thePassword = '', string $thePhone = '', string $theImage = '')
	{
		$this->setID($theId);
		$this->setName($theName);
		$this->setEmail($theEmail);
		$this->setPassword($thePassword);
		$this->setPhone($thePhone);
		$this->setPhone($theImage);
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
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
	/**
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}
	/**
	 * @param string $email
	 */
	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	/**
	 * @param string $password
	 */
	public function setPassword(string $password): void
	{
		$this->password = $password;
	}
	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * @return string
	 */
	public function getPhone(): string
	{
		return $this->phone;
	}
	/**
	 * @param string $phone
	 */
	public function setPhone(string $phone): void
	{
		$this->phone = $phone;
	}

	/**
	 * @return string
	 */
	public function getImage(): string
	{
		return $this->image;
	}
	/**
	 * @param string $image
	 */
	public function setImage(string $image): void
	{
		$this->image = $image;
	}

	/**
	 * @param $userData
	 */
	public function fill(array $userData): User
	{
		foreach ($userData as $key => $value) {
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
			"name" => $this->name,
			"email" => $this->email,
			"password" => $this->password,
			"phone" => $this->phone,
			"image" => $this->image
		];
	}
}

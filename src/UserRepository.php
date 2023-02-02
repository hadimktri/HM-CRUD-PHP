<?php
require_once 'src/Models/User.php';
class UserRepository
{
    private $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return User[]
     */
    public function getAllUsers(): array
    {
        if (!file_exists($this->filename)) {
            return [];
        }

        $fileContents = file_get_contents($this->filename);
        if (!$fileContents) {
            return [];
        }

        $decodedUser = json_decode($fileContents, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [];
        }
        $users = [];
        foreach ($decodedUser as $userData) {
            $users[] = (new User())->fill($userData);
        }
        return $users;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): User|null
    {
        $users = $this->getAllUsers();
        foreach ($users as $user) {
            if ($user->getID() === $id) {
                return $user;
            }
        }
        return null;
    }
    /**
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail(string $email): User|null
    {
        $users = $this->getAllUsers();
        foreach ($users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }
        return null;
    }

    /**
     * @param int $id
     */
    public function deleteUserById(int $id): void
    {
        $users = $this->getAllUsers();

        foreach ($users as $key => $user) {
            if ($user->getID() === $id)
                unset($users[$key]);
        }
        $encodedUsers = json_encode($users, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $encodedUsers);
    }

    /**
     * @param User $user
     */
    public function saveUser(User $user): void
    {
        $users = $this->getAllUsers();
        $users[] = $user;
        $encodedUsers = json_encode($users, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $encodedUsers);
    }

    /**
     * @param int $id
     * @param User $updateUser
     */
    public function updateUser(int $id, User $updateUser): void
    {
        $users = $this->getAllUsers();
        foreach ($users as $key => $user) {
            if ($user->getID() === $id) {
                unset($users[$key]);
                $users[] = $updateUser;
            }
        }
        $encodedUsers = json_encode($users, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $encodedUsers);
    }
}

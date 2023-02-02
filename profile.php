<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once 'src/UserRepository.php';
require_once 'helpers/helpers.php';

if (!($_SESSION['id'])) {
    header("location:articles.php");
} else {
    $newUser = new UserRepository("json_files/users.json");
    $user = $newUser->getUserById($_SESSION['id']);
}

?>
<!doctype html>
<html lang="en">
<?php require_once 'layout/header.php' ?>

<body class="wrapper">
    <?php require_once 'layout/navigation.php' ?>
    </div>
    <div class="container my-4" id="main">
        <form>
            <img class=" profile-pic my-2" src="<?php echo  "images/" . $user->getImage() ?>" alt="Uploaded image">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo htmlspecialchars($user->getName()) ?>" required="">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($user->getEmail()) ?>" required="">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" value="<?php echo htmlspecialchars($user->getPassword()) ?>" required="">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" id="phone" value="<?php echo htmlspecialchars($user->getPhone()) ?>" required="">
            </div>

        </form>
    </div>
    </div>
    <?php require_once 'layout/footer.php' ?>
</body>

</html>
<?php

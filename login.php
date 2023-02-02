<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once 'src/UserRepository.php';
require_once 'helpers/helpers.php';

$errorMsg = '';
if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    if (isset($_REQUEST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $email = trim($_REQUEST['email']);
        $password = trim($_REQUEST['password']);

        $newUser = new UserRepository("json_files/users.json");

        $user = $newUser->getUserByEmail($email);
        $userPass = $user->getPassword();
        if ($userPass === $password) {
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $user->getID();
            $_SESSION['login'] = true;
            header("Location:articles.php");
            exit();
        }
    }

    if (empty($email) || !validEmail($email)) {
        $errorMsg .= '<p>Please enter a valid email.</p>';
    }

    if (empty($password) || !validPassword($password)) {
        $errorMsg .= '<p>Please enter a valid password.</p>';
    }
}

?>
<!doctype html>
<html lang="en">
<?php require_once 'layout/header.php' ?>

<body class="wrapper">
    <?php require_once 'layout/navigation.php' ?>


    <!-- Display Error messages -->
    <div class="container" id="main">
        <div class="container mx-auto mt-10">
            <?php if ($errorMsg) { ?>
                <div class="col-xs-12">
                    <div class="alert alert-danger"> <?php echo $errorMsg ?> </div>
                </div>
            <?php } ?>

        </div>
        <div class="container mt-4">
            <form action="#" method="POST">

                <h3 class="font-bold mt-2">Insert Your Info</h3>
                <div class="mb-3">
                    <p class="mt-2 text-center text-sm text-gray-600">Don't have an account?
                        <a href="new_user.php" class="font-medium text-indigo-600 hover:text-indigo-500">Sign Up</a>
                    </p>
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>

                <div class="mb-3 form-check">
                    <a href="#" class="">Forgot your password?</a>
                </div>
                <button type="submit" class="btn btn-dark " name="login">Submit</button>
            </form>
        </div>
    </div>
    <?php require_once 'layout/footer.php' ?>
</body>

</html>
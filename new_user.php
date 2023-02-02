<?php
session_start();
require_once 'src/UserRepository.php';
require_once 'helpers/helpers.php';

$newUser = new UserRepository("json_files/users.json");
$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);

    if (isset($_FILES["photo"])) {

        $file = $_FILES['photo'];
        $temporaryPath = $file['tmp_name'];
        $originalFileName = $file['name'];
        move_uploaded_file($temporaryPath, __DIR__ . "images/$originalFileName");
    }


    if (empty($email) || !validEmail($email)) {
        $errorMsg .= '<p>Please enter the email.</p>';
    }

    if (empty($password) || !validPassword($password)) {
        $errorMsg .= '<p>Please enter a valid Password.</p>';
    }

    if (isset($_POST['submit']) && !empty($name) && !empty($phone) && !empty($password) &&  !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $updatedUser = (new User())->fill(["id" => $id, "name" => $name, "email" => $email, "password" => $password, "phone" => $phone, "image" => $originalFileName]);
        $newUser->saveUser($updatedUser);
        header("Location:profile.php");
    }
    // header("Location: welcome.php?from=login");
    // exit();
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

        <div class="container my-4">
            <form action="#" method="POST" enctype="multipart/form-data ">

                <h3 class="font-bold mt-2">Insert Your Info</h3>
                <p class="mt-2 text-center text-sm text-gray-600">Already Have an account?
                    <a href="login.php" class="font-medium text-indigo-600 hover:text-indigo-500">Log In</a>
                </p>
                <img class=" profile-pic mt-10" src="<?php echo  "images/ . #" ?>" alt="Uploaded image">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" id="phone">
                </div>

                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Choose Profile picture</label>
                    <input type="file" name="photo" class="form-control form-control-sm " id="formFileSm">
                </div>

                <button type="submit" class="btn btn-dark " name="submit">Submit</button>
            </form>
        </div>
    </div>
    <?php require_once 'layout/footer.php' ?>
</body>

</html>
<?php

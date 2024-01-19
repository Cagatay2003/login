<?php 

include 'db.php';

try {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $db = new Database();
        $user = $db->login($email);

    if($user) {
        $password = $_POST['password'];
        $verify = password_verify($password, $user['password']);
        if($user && $password == $verify) {
            session_start();
            $_SESSION['accountid'] = $user['account_id'];
            header('Location:home.php?ingelogd');
        } else {
            echo "incorrect username or email";
        }
    } else {
        echo "incorrect username or email";
    }
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <div class="mb-3">
           <label for="username" class="form-label">Username</label><br>
           <input type="text" class="form-control" name="username" placeholder="Username"><br><br>
        </div>

        <div class="mb-3">
           <label for="email" class="form-label">Email</label><br>
           <input type="email" class="form-control" name="email" placeholder="Email"><br><br>
        </div>

        <div class="mb-3">
           <label for="password">Password</label><br>
           <input type="password" class="form-control" name="password" placeholder="Password"><br><br>
        </div>

        <a href="aanmelden.php">Als je geen account heb, creeer hier een account</a><br>

        <input type="submit" class="btn btn-primary" value="Inloggen">
    </form>
</body>
</html>
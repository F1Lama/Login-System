<?php
include "db.php";

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 $username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];

if (empty($username) || empty($email) || empty($password)) {
  $message = "All fields are required!";
  $type = "danger";
}

elseif (!preg_match("/^[a-zA-Z0-9_.@!$%-]{3,20}$/", $username)) {
  $message = "Username can contain letters, numbers, and symbols (_, ., @, !, $, %, -)";
  $type = "danger";
}

elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $message = "Invalid email format!";
  $type = "danger";
}

elseif (strlen($password) < 8) {
  $message = "Password must be at least 8 characters!";
  $type = "danger";
}

elseif (!preg_match("/[A-Z]/", $password)) {
  $message = "Password must contain at least 1 uppercase letter!";
  $type = "danger";
}

elseif (!preg_match("/[a-z]/", $password)) {
  $message = "Password must contain at least 1 lowercase letter!";
  $type = "danger";
}

elseif (!preg_match("/[0-9]/", $password)) {
  $message = "Password must contain at least 1 number!";
  $type = "danger";
}

elseif (!preg_match("/[\W]/", $password)) {
  $message = "Password must contain at least 1 special character!";
  $type = "danger";
}

elseif ($password !== $confirm) {
  $message = "Passwords do not match!";
  $type = "danger";
}
else {

  $check = "SELECT * FROM users WHERE email='$email' OR username='$username'";
  $result = $conn->query($check);

  if ($result->num_rows > 0) {
    $message = "Email or Username already exists!";
    $type = "danger";
  } else {

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password)
            VALUES ('$username', '$email', '$hashedPassword')";

    if ($conn->query($sql)) {
      $message = "Account created successfully!";
      $type = "success";
    } else {
      $message = "Something went wrong!";
      $type = "danger";
    }
  }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>

<link rel="stylesheet" href="bootstrap-5.3.8-dist/css/bootstrap.css">
<link rel="stylesheet" href="CSS/register.css">

</head>

<body>

<div class="container-fluid vh-100">
  <div class="row h-100">

    <!-- اليسار -->
    <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center text-center left-side">
      <h1 class="text-white">Welcome 👋</h1>
      <p class="hello">Create your account and start your journey with us</p>
    </div>

    <!-- الفورم -->
    <div class="col-md-6 d-flex justify-content-center align-items-center">

      <div class="register-card">

        <h2 class="mb-4 text-center">Create Account</h2>

        <!-- 🔥 الرسالة -->
        <?php if ($message != ""): ?>
          <div class="alert alert-<?php echo $type; ?> text-center">
            <?php echo $message; ?>
          </div>
        <?php endif; ?>

        <form method="POST">

          <div class="row">
            <div class="mb-3 col-md-6">
              <input name="username" type="text" class="form-control"
placeholder="Username"
value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
required>
            </div>

            <div class="mb-3 col-md-6">
              <input name="email" type="email" class="form-control"
placeholder="Email"
value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
required>
            </div>
          </div>

          <div class="row">
            <div class="mb-3 col-md-6">
              <input name="password" type="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="mb-3 col-md-6">
              <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" required>
            </div>
          </div>

          <button type="submit" class="btn btn-custom w-100">
            Register
          </button>

        </form>

        <p class="mt-3 text-center">
          Already have an account?
          <a href="login.php">Login</a>
        </p>

      </div>

    </div>
  </div>
</div>

<!-- 🔥 animation -->
<script>
setTimeout(() => {
  const alertBox = document.querySelector(".alert");
  if (alertBox) {
    alertBox.classList.add("hide");
  }
}, 3000);
</script>

</body>
</html>
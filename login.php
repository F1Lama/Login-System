<?php
session_start();
include "db.php";

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      header("Location: dashboard.php");
      exit();
    } else {
      $message = "Wrong password!";
      $type = "danger";
    }
  } else {
    $message = "User not found!";
    $type = "danger";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<link rel="stylesheet" href="bootstrap-5.3.8-dist/css/bootstrap.css">
<link rel="stylesheet" href="CSS/main.css">
<link rel="stylesheet" href="CSS/login.css">

</head>

<body>

<div class="login-card text-center">

  <h2 class="mb-4">Login</h2>

  <!-- 🔥 الرسالة -->
  <?php if ($message != ""): ?>
    <div class="alert alert-<?php echo $type; ?> text-center">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>

  <form method="POST">

    <div class="mb-3 text-start">
      <label class="form-label">Email</label>
      <input name="email" type="email" class="form-control" required>
    </div>

    <div class="mb-3 text-start">
      <label class="form-label">Password</label>
      <input name="password" type="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-custom w-100">
      Login
    </button>

  </form>

  <p class="mt-3">
    Don't have an account?
    <a href="index.php">Register</a>
  </p>

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
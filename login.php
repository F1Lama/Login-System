<?php
session_start();
include "db.php";

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();

  $result = $stmt->get_result(); 

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
<title>Login2</title>

<link rel="stylesheet" href="bootstrap-5.3.8-dist/css/bootstrap.css">
<link rel="stylesheet" href="CSS/variables.css">
<link rel="stylesheet" href="CSS/main.css">

</head>

<body>
<div class="container-fluid vh-100">
  <div class="row h-100 justify-content-center align-items-center">

    <div class="col-md-4 col-sm-10">

      <div class="login-card w-100" style="max-width: 400px;">

        <h2 class="mb-4 text-center">Login</h2>

        <?php if ($message != ""): ?>
          <div class="alert alert-<?php echo $type; ?> text-center">
            <?php echo $message; ?>
          </div>
        <?php endif; ?>

        <form method="POST">

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-custom w-100">
            Login
          </button>

        </form>

        <p class="mt-3 text-center">
          Don't have an account?
          <a href="index.php">Register</a>
        </p>

      </div>

    </div>
  </div>
</div>

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
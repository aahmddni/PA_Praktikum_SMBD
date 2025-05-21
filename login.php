<?php
include 'functions.php';

$conn = connect_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password_input = $_POST['password'];

    if (empty($username) || empty($password_input)) {
        $error = "Harap isi semua field.";
    } else {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password_input, $user['password'])) {
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role_user'] = $user['role_user'];

                // Redirect berdasarkan role
                if ($user['role_user'] === 'admin') {
                    header("Location: home.php");
                } else {
                  
                    header("Location: sepatu.php");
                }
                exit();
              } else {
                $error = "Password salah.";
            }
        } else {
            $error = "Username tidak ditemukan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="src/css/output.css" rel="stylesheet" />
  <!-- SweetAlert CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">

  <div class="w-full max-w-sm px-8 py-10 bg-white rounded-lg shadow-md dark:bg-gray-800">
    <h1 class="mb-6 text-2xl font-semibold text-center text-gray-700 dark:text-white">Login</h1>

    <form class="mx-auto" method="post">
      <div class="mb-6">
        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
        <input type="text" id="username" name="username" required
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
               focus:border-blue-500 block w-full p-2.5" placeholder="jhondoe" />
      </div>
      <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password" id="password" name="password" required
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
               focus:border-blue-500 block w-full p-2.5" placeholder="••••••••" />
      </div>
      <button type="submit"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none 
              focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
        Submit
      </button>
    </form>

    <hr class="my-5" />
    <p class="text-center">
      Don't have an account? <a href="register.html" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Register</a>
    </p>
  </div>

  <?php if (!empty($error)): ?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Login Gagal',
      text: '<?= $error ?>',
      confirmButtonColor: '#3085d6'
    });
  </script>
  <?php endif; ?>

</body>
</html>

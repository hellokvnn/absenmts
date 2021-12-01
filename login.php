<?php
include "connect.php";

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="vendor/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <title>PT. Megah Tata Seruni</title>
</head>

<body>

  <div class="container">
    <h4 class="text-center">Silahkan Login!</h4>
    <hr>

    <form method="POST" action="login.php">
      <div class="form-group">
        <label>Username</label>

        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-user"></i></div>
          </div>
          <input type="name" name="nama" placeholder="Masukan Username Anda">
        </div>
      </div>

      <div class="form-group">
        <label>Password</label>

        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
          </div>
          <input type="password" name="password" placeholder="Masukan Password Anda">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <button type="reset" class="btn btn-danger">Reset</button>
      <p class="fail-login">
        <?php
        if (isset($_POST['nama'])) {
          $username = $_POST["nama"];
          $password = md5($_POST["password"]);

          $query = "SELECT * FROM tb_user WHERE
            username='" . $username . "' AND
            password='" . $password . "'";

          $result = mysqli_query($koneksi, $query);
          $row = mysqli_num_rows($result);

          if ($row == 1) {
            session_start();
            $_SESSION["nik"] = $username;
            $fetch = mysqli_fetch_assoc($result);
            if ($fetch["role"] == 'Admin') {
              $_SESSION["role"] = 'Admin';
              header("Location: index.php");
            } else {
              $_SESSION["role"] = 'User';
              header("Location: karyawan.php");
            }
          } else {
            echo "Username atau Password Salah";
          }
        }
        ?>
      </p>
    </form>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>

</html>
<?php
require_once "koneksi.php";

session_start();

if (isset($_POST['btn-regis'])) {

  $formData = [
    "nama" => (strlen($_POST['nama']) !== 0) ? $_POST['nama']  : null,
    "password" => (strlen($_POST['password']) !== 0) ? $_POST['password'] : null,
    "nim" => (strlen($_POST['nim']) !== 0) ? $_POST['nim'] : null,
    "jenis_kelamin" => (isset($_POST['jenis_kelamin'])) ? $_POST['jenis_kelamin'] : null,
    "status" => (isset($_POST['status'])) ? $_POST['status'] : null,
    "keterangan" => (isset($_POST['keterangan'])) ? $_POST['keterangan'] : "",
  ];

  $errField = [
    "nama" => null,
    "password" => null,
    "nim" => null,
    "jenis_kelamin" => null,
    "status" => null,
    "keterangan" => null,
  ];

  $hasError = false;
  array_map(
    function ($data, $key) {
      global $errField;
      global $hasError;
      if (is_null($data)) {
        $errField[$key] = true;
        $hasError = true;
      }
    },
    $formData,
    array_keys($formData)
  );

  function insertData($formData)
  {
    global $conn;
    $regisQuery = $conn->prepare("INSERT INTO regis (nama, password, nim, jurusan, jenis_kelamin, status, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $regisQuery->bind_param(
      "sssssss",
      $nama,
      $password,
      $nim,
      $jurusan,
      $jenisKelamin,
      $status,
      $keterangan,
    );


    $nama = $formData['nama'];
    $password = $formData['password'];
    $nim =  $formData['nim'];
    $jurusan = $_POST['jurusan'];
    $jenisKelamin =   $formData['jenis_kelamin'];
    $status = $formData['status'];
    $keterangan = $formData['keterangan'];

    $regisQuery->execute();
    $regisQuery->close();
    $conn->close();
  }

  if (!$hasError) {
    insertData($formData);

    $_SESSION['daftar'] = true;
    header("Location: login.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form | Native</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,700&display=swap" rel="stylesheet" />
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background-color: #674cab;
    }

    .title-page {
      text-align: center;
      color: white;
      margin-bottom: 30px;
    }

    .container {
      max-width: 1100px;
      margin: 0 auto;
    }

    main {
      padding: 60px 30px;
    }

    form {
      padding: 30px;
      background-color: #9376e0;
      border-radius: 30px;
      color: #f6ffa6;
      box-shadow: 0 4px 7px rgba(29, 29, 29, 0.356);
    }

    form.out {
      border: 7px solid #d95050;
    }

    form span {
      margin-top: 10px;
    }

    form .form-field {
      display: flex;
      flex-direction: column;
      width: 70%;
      margin-bottom: 20px;
    }



    form .form-field input[type="text"],
    form .form-field input[type="number"],
    form .form-field input[type="password"],
    form .form-field select,
    form .form-field textarea {
      padding: 0.5rem 1.25rem;
      border-radius: 15px;
      outline: none;
      border: none;
    }

    /* Chrome, Safari, Edge, Opera */
    form .form-field input::-webkit-outer-spin-button,
    form .form-field input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    form .form-field input[type="number"] {
      -moz-appearance: textfield;
    }

    .form-field div label {
      font-weight: 400;
      font-size: 16px;
      margin-left: 5px;
    }

    form .error-field {
      color: red;
      margin: 5px 0px;
    }

    form input[type="submit"] {
      border: none;
      outline: none;
      padding: 0.5rem 1.5rem;
      background-color: #674cab;
      color: white;
      cursor: pointer;
      border-radius: 10px;
      font-size: 24px;
      font-weight: 600;
      margin-top: 45px;
    }

    form input[type="submit"]:hover {
      background-color: #543a97;
    }

    .form-field span {
      font-size: 14px;
      margin-left: 5px;
    }

    .flex {
      display: flex;
      align-items: flex-end;
    }

    .text-err {
      font-size: 16px;
      font-weight: 600;
      margin-left: 20px;
      color: #d95050;
    }
  </style>
</head>

<body>
  <main class="">
    <div class="container">
      <h1 class="title-page">Registration Form</h1>
      <?php if (isset($errField)) : ?>
        <form action="" method="POST" id="form" class="">
          <div class="form-field">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="input-defaultable" placeholder="John Doe" id="nama" />
            <?php if (!is_null($errField['nama'])) : ?>
              <p class="error-field">Kolom ini tidak boleh kosong</p>
            <?php endif; ?>
            <span>ketuk dua kali pada form untuk nilai default</span>
          </div>
          <div class="form-field">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter your password" id="password" autocomplete="off" />
            <?php if (!is_null($errField['password'])) : ?>
              <p class="error-field">Kolom ini tidak boleh kosong</p>
            <?php endif; ?>
          </div>
          <div class="form-field">
            <label for="nim">NIM</label>
            <input type="number" name="nim" class="input-defaultable" placeholder="0813675123" id="nim" />
            <?php if (!is_null($errField['nim'])) : ?>
              <p class="error-field">Kolom ini tidak boleh kosong</p>
            <?php endif; ?>
            <span>ketuk dua kali pada form untuk nilai default</span>
          </div>
          <div class="form-field">
            <label for="jurusan">Jurusan</label>
            <select name="jurusan" id="jurusan">
              <option value="teknik-informatika">Teknik Informatika</option>
              <option value="sistem-informasi">Sistem Informasi</option>
              <option value="hukum">Hukum</option>
            </select>
          </div>
          <div class="form-field">
            <label for="">Jenis Kelamin</label>
            <div>
              <input type="radio" name="jenis_kelamin" value="pria" id="pria" />
              <label for="pria">Pria</label>
            </div>
            <div>
              <input type="radio" name="jenis_kelamin" value="wanita" id="wanita" />
              <label for="wanita">Wanita</label>
            </div>
            <?php if (!is_null($errField['jenis_kelamin'])) : ?>
              <p class="error-field">Kolom ini tidak boleh kosong</p>
            <?php endif; ?>
          </div>
          <div class="form-field">
            <label for="">Status</label>
            <div>
              <input type="radio" name="status" value="menikah" id="menikah" />
              <label for="menikah">Menikah</label>
            </div>
            <div>
              <input type="radio" name="status" value="belum-menikah" id="belum-menikah" />
              <label for="belum-menikah">Belum Menikah</label>
            </div>
            <?php if (!is_null($errField['status'])) : ?>
              <p class="text-err">Kolom ini tidak boleh kosong</p>
            <?php endif; ?>
          </div>
          <div class="form-field">
            <label for="">Keterangan</label><textarea name="keterangan" id="" cols="30" rows="10"></textarea>
          </div>
          <div class="flex">
            <input type="submit" name="btn-regis" id="button-submit" value="Daftar Sekarang">
          </div>
        </form>
      <?php else : ?>
        <form action="" method="POST" id="form" class="">
          <div class="form-field">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="input-defaultable" placeholder="John Doe" id="nama" />

            <span>ketuk dua kali pada form untuk nilai default</span>
          </div>
          <div class="form-field">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter your password" id="password" autocomplete="off" />

          </div>
          <div class="form-field">
            <label for="nim">NIM</label>
            <input type="number" name="nim" class="input-defaultable" placeholder="0813675123" id="nim" />
            <span>ketuk dua kali pada form untuk nilai default</span>
          </div>
          <div class="form-field">
            <label for="jurusan">Jurusan</label>
            <select name="jurusan" id="jurusan">
              <option value="teknik-informatika">Teknik Informatika</option>
              <option value="sistem-informasi">Sistem Informasi</option>
              <option value="hukum">Hukum</option>
            </select>
          </div>
          <div class="form-field">
            <label for="">Jenis Kelamin</label>
            <div>
              <input type="radio" name="jenis_kelamin" value="pria" id="pria" />
              <label for="pria">Pria</label>
            </div>
            <div>
              <input type="radio" name="jenis_kelamin" value="wanita" id="wanita" />
              <label for="wanita">Wanita</label>
            </div>
          </div>
          <div class="form-field">
            <label for="">Status</label>
            <div>
              <input type="radio" name="status" value="menikah" id="menikah" />
              <label for="menikah">Menikah</label>
            </div>
            <div>
              <input type="radio" name="status" value="belum-menikah" id="belum-menikah" />
              <label for="belum-menikah">Belum Menikah</label>
            </div>
          </div>
          <div class="form-field">
            <label for="">Keterangan</label><textarea name="keterangan" id="" cols="30" rows="10"></textarea>
          </div>
          <div class="flex">
            <input type="submit" name="btn-regis" id="button-submit" value="Daftar Sekarang">
          </div>
        </form>
      <?php endif; ?>

    </div>
  </main>

  <script>
    const form = document.querySelector("form");

    const inputDefault = document.querySelectorAll(".input-defaultable");
    [...inputDefault].map((input) => {
      input.ondblclick = () => {
        const placeholder = input.getAttribute("placeholder");
        input.value = placeholder;
      };
    });
  </script>
</body>

</html>
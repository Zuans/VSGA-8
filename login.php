<?php
session_start();
require_once "koneksi.php";

if (isset($_POST['submit'])) {
    $formData = [
        "nim" =>  strlen($_POST['nim']) !== 0 ? $_POST['nim'] : null,
        "password" => strlen($_POST['password']) !== 0 ? $_POST['password'] : null,
    ];

    $emptyFields = [
        'nim' => false,
        'password' => false,
    ];

    $hasEmpty = false;
    $loginErr = false;

    array_map(
        function ($data, $key) {
            global $hasEmpty;
            global $emptyFields;
            if (is_null($data)) {
                $emptyFields[$key] = true;
                $hasEmpty = true;
            }
        },
        $formData,
        array_keys($formData)
    );

    function checkData($formData)
    {
        global $conn;
        $nimQuery = $conn->prepare("SELECT * FROM regis WHERE nim = ? ");
        $nimQuery->bind_param("s", $nim);
        $nim = $formData['nim'];
        $nimQuery->execute();
        $result = $nimQuery->get_result();

        if ($result->num_rows > 0) {
            // check password
            while ($rows = mysqli_fetch_assoc($result)) {
                if ($rows['password'] === $formData['password']) {
                    return  [
                        'isPasswordCorrect' => true,
                        'errText' => "",
                        'data' => $rows,
                    ];
                }
            }
            return  [
                'isPasswordCorrect' => false,
                'errText' => "Pasword Kamu Salah",
            ];
        } else {
            // tampilin error kalo nim tidak ditemukan
            return  [
                'isPasswordCorrect' => false,
                'errText' => "User tidak ditemukan",
            ];
        }
    }
    if (!$hasEmpty) {
        global $loginErr;
        $user = checkData($formData);
        if (!$user['isPasswordCorrect']) {
            // gagal loginn
            $loginErr = $user['errText'];
        } else {
            // berhasil logim
            $_SESSION['nama'] = $user['data']['nama'];
            $_SESSION['nim'] = $user['data']['nim'];
            header("Location: main.php");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,700&display=swap" rel="stylesheet" />
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-color: #9681EB;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            height: 100vh;
        }

        .form-wrapper {
            border-radius: 15px;
            padding: 60px 40px;
            box-shadow: 0 3px 8px #3f3f3f61;
            background-color: #45CFDD;
        }

        .form-wrapper label {
            color: white;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 20px;
        }

        .alert-success {
            padding: .5rem 1.25rem;
            border-radius: 15px;
            color: white;
            background-color: #27E1C1;
        }

        form .form-field {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-bottom: 20px;
        }


        form .form-field:first-child {
            margin-top: 30px;
        }

        .title-page {
            color: white;
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            color: #9681EB;
        }

        .title-page p {
            font-size: 34px;
            color: white;
        }

        .btn-login {
            margin-top: 30px;
            outline: none;
            border: none;
            color: white;
            border-radius: 10px;
            padding: .5rem 2rem;
            font-weight: 600;
            font-size: 24px;
            width: 100%;
            background-color: #9681EB;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #6527BE;
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
            width: 100%;
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

        .err-text {
            color: #B31312;
            margin-top: 30px;
            font-size: 20px;
            font-weight: 600;
        }

        .form-field .err-text {
            margin-top: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="form-wrapper">
        <h1 class="title-page">Hi, Welcome to <p>Login Page</p>
        </h1>
        <?php if ($_SESSION['daftar'] === true) : ?>
            <p class="alert-success">Kamu sudah berhasil daftar silahkan login</p>
        <?php endif; ?>
        <form method="POST">
            <?php if (isset($hasEmpty) && $hasEmpty) : ?>
                <div class="form-field">
                    <label for="nim">NIM</label>
                    <input type="text" name="nim" placeholder="Enter your NIM" id="nim" autocomplete="off">
                    <?php if (isset($emptyFields['nim']) && $emptyFields['nim'] === true) : ?>
                        <span class="err-text">
                            Kolom ini tidak boleh kosong
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-field">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Enter your password" name="password" id="password" autocomplete="off">
                    <?php if (isset($emptyFields['password']) && $emptyFields['password'] === true) : ?>
                        <span class="err-text">
                            Kolom ini tidak boleh kosong
                        </span>
                    <?php endif; ?>
                </div>
            <?php else : ?>
                <div class="form-field">
                    <label for="nim">NIM</label>
                    <input type="text" name="nim" placeholder="Enter your NIM" id="nim" autocomplete="off">

                </div>
                <div class="form-field">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Enter your password" name="password" id="password" autocomplete="off">
                </div>
            <?php endif; ?>
            <?php if (isset($loginErr)  && $loginErr !== false) : ?>
                <p class="err-text">
                    <?php echo $loginErr; ?>
                </p>
            <?php endif; ?>
            <input type="submit" name="submit" class="btn-login" value="Login">
        </form>
    </div>
</body>

</html>
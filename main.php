<?php

session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Welcome |
        <?php echo $_SESSION['nama']; ?>
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,900;1,700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;

        }

        body {
            background-color: #9681EB;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #8671db;
            padding: 40px 60px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 3px 9px rgba(29, 29, 29, 0.7);
        }

        .title-page p {
            margin-top: 5px;
            font-size: 20px;
            font-weight: 400;
        }

        .success {
            font-size: 24px;
            font-weight: 600;
            color: #45CFDD;
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .date-info-wrapper {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 1fr);
            grid-gap: 1rem;
        }

        .date-info-wrapper * {
            background-color: #45CFDD;
            border-radius: 10px;
            padding: 30px;
            font-size: 24px;
            font-weight: 700;
            box-shadow: 0 3px 10px rgba(31, 31, 31, 0.3);
        }

        .date-info-wrapper .month {
            grid-column: 2 / 3;

        }

        .date-info-wrapper .date {
            grid-column: 1 / 2;
            grid-row: 1 / 2;
        }


        .date-info-wrapper .day {
            grid-column: 1 / 3;
            grid-row: 2 / 3;
        }


        .date-info-wrapper .hour {
            grid-column: 3 / 5;
            grid-row: 1 / 3;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 42px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title-page">
            Selamat Datang <?php echo $_SESSION['nama']; ?>
            <p><?php echo $_SESSION['nim'] ?></p>
        </h1>
        <p class="success">Selamat Kamu Berhasil Login</p>
        <div class="date-info-wrapper">
            <p class="month">Feb</p>
            <p class="day">aefojeof</p>
            <p class="date">akto4w</p>
            <p class="hour">20.12</p>
        </div>
    </div>
    <script>
        const dates = new Date();
        const monthList = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sept',
            'Oct',
            'Nov',
            'Dec'
        ]
        const dayList = [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday'
        ]
        const month = monthList[dates.getMonth()];
        const date = dates.getDate();
        const day = dayList[dates.getDay()];
        const hour = dates.getHours();
        const minute = dates.getMinutes();

        const monthEl = document.querySelector('.month');
        const dateEl = document.querySelector('.date');
        const dayEl = document.querySelector('.day');
        const hourEl = document.querySelector('.hour');
        console.log(dates.getDay());
        monthEl.innerHTML = month;
        dateEl.innerHTML = date;
        dayEl.innerHTML = day;
        hourEl.innerHTML = `${hour}.${minute}`;
    </script>
</body>

</html>
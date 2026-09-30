<!DOCTYPE html>
<html>
    <head>
        <title>ATTENDANCE SYSTEM - SMK TINGGI KLANG TABLE TENNIS CLUB</title>
        <style>
            *{
                margin: 0;
                padding:0;
            }

            body{
                background-color : #008394;
            }

            header{
                background-color : #008394;
                color : white;
                text-align:center;
            }
            footer{
                background-color: #008394;
                color: white;
                text-align:center;
                padding:20px;
                align-content:flex-end;
            }

            article{
                padding:15px;
                text-align:center;
            }

            h3{
                color:black;
            }

            table{
                background-color: white;
                width : 100%;
                border-collapse:collapse;
                border : 5px silver;

            }

            td{
                padding:15px;
            }

            tr:hover{
                background-color:#02ADC1;
                color:black;
            }

            nav{
                background-color: #6F969B;
                padding : 15px;
            }

            a{
                background-color:  #6F969B;
                color: white;
                padding: 10px 10px;
                text-decoration:none;
                display:inline-block;
                border-radius: 18px;
            }
            a:hover{
                background-color:#02ADC1;
            }

            input,
            select,
            button{
                padding : 5px;
                margin-top:10px;
                border-radius:8px;
            }

            input[type=submit]:{
                background-color: white;
                color:white;
            }

            input[type=submit]:hover{
                background-color: #02ADC1;
                color:black;
            }

            .respon{
            width:40%;
            height:auto;
            }
        </style>
    </head>
    <body>

<header>

<img class='respon' src='img/banner4.png'>

</header>

<nav>
<?PHP if(!empty($_SESSION['role']) and $_SESSION['role'] == "Admin") { ?>
    <!-- Admin menu: displayed when admin is logged in -->
    | <a href='index.php'               >Home</a>
    | <a href='profil.php'              >Profile</a>
    | <a href='kehadiran-rekod.php'     >Attendance Counter</a>
    | <a href='senarai-ahli.php'        >Member List</a>
    | <a href='senarai-aktiviti.php'    >Activity List</a>
    | <a href='kehadiran-laporan.php'   >Attendance Report</a>
    | <a href='laporan_ahli.php'        >Member Report</a>
    | <a href='laporan_aktiviti.php'    >Activity Report</a>
    | <a href='logout.php'              >Logout</a>
    | <hr>
<?php } else if(!empty($_SESSION['role']) and $_SESSION['role'] == "Student") { ?>
    <!-- Student menu: displayed when student is logged in -->
    | <a href='index.php'               >Home</a>
    | <a href='profil.php'              >Profile</a>
    | <a href='logout.php'              >Logout</a>
    | <hr>
<?php } else { ?>
    <!-- Home menu: displayed when no one is logged in -->
    | <a href='index.php'               >Home</a>
    | <a href='login-borang.php'        >Member Login</a>

    <hr>
<?php } ?>

</nav>
<article>

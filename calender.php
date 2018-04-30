<?php
    header('Content-type: text/css; charset:UTF-8');
    $primary_color = $_GET['theme'];
    $version = $_GET['ver'];
?>
h1{
    font-family: 'Oxygen', sans-serif;
    font-size: 70px;
    text-align: center;
    position: absolute;
    left: 50%;
    top: 90%;
    }
body{
	background-color: lightgrey;
}
table, th, td{
    border: 2px solid black;
    text-align: center;
    padding: 2px;
}
#rows{
    font-size: 40px;
    font-family: 'Quicksand', sans-serif;
    background-color: gold;
}
#info{
    font-size:20px;
    font-family: 'Quicksand', sans-serif;
}
.banner{
    width: 100%;
    display: block;
}
.banner-image{
    background-image: url("http://chrisrphoto.blogspot.com/2011/11/university-of-missouri-fall-afternoon.html")
    width: 100%;
    display: block;
}
.nav{
    text-align: right;
    padding: 10px 0 10 0;
}
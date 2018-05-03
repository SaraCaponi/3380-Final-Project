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
  	top:-380px;
	color: gold;
}
h4{
    font-family: 'Oxygen', sans-serif;
    font-size: 70px;
    
}
body{
	background-color: lightgrey;
}
table, th, td{
    border: 2px solid black;
    text-align: center;
    padding: 2px;
}
.rows{
    font-size: 40px;
    font-family: 'Quicksand', sans-serif;
    background-color: gold;
}
.info{
    font-size:20px bold;
    font-family: 'Quicksand', sans-serif;
}

.button{
    font-family: 'Quicksand', sans-serif;
    background-color: gold;
    border: 1px solid black;
    font-size: 20px;
}


.nav{
    text-align: right;
    padding: 10px 0 10 0;
}
.body_div{
	position:absolute;
	top:330px;
}
#MET{
position:absolute;
	top:385px;
}
#YE{
	top:-430px;
	color: white;
}

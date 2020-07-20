<?php

$connect = mysqli_connect("localhost", "zuma", "admin", "bloggo");
if(mysqli_connect_errno())
{
    echo "Connection to database failed, please contact admin. <br>".mysli_connect_error();exit;
}
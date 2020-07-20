<?php
session_start();
if(!isset($_SESSION['level']))
{
    header("Location: index.php");
}
include 'database.php';
$id = $_GET['id'];
$name = $_SESSION['name'];
$check = mysqli_query($connect, "SELECT * FROM article WHERE name='$name' AND article_id='$id'");
$check2 = mysqli_num_rows($check);
if($check2<1)
{
    header("Location: manage-article.php");
}else{
    $eksekusi = "<script>document.write(eksekusi)</script>";
    while($d = mysqli_fetch_array($check))
    {
        $status = $d['status'];
    }
    if($status == 'unpublished')
    {
        echo "<script>
            var eksekusi;
            var conf = confirm('Are you sure to Publish?');
            if(conf == true)
            {
                eksekusi = 'yes';
            }else{
                eksekusi = 'no';
            }
            </script>";
        $eksekusi = "<script>document.write(eksekusi)</script>";
        if(!empty($eksekusi))
        {
            header("Location: status-process.php?id".$id."&ekse=".$eksekusi);
        }else{
            echo "f";
        }
    }
}
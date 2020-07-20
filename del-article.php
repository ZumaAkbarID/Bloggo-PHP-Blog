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
        $eks1 = mysqli_query($connect, "DELETE FROM article WHERE article_id='$id'");
        $eks2 = mysqli_query($connect, "DELETE FROM article_details WHERE article_id='$id'");
        echo    "<script>
                    var conf = confirm('Are you sure to delete?');
                    if(conf == true)
                    {
                        var del1 = ".$eks1."
                        var del2 = ".$eks2."
                        if(del2){
                            window.location.href = 'manage-article.php';
                        }
                    }else{
                        var conf2 = confirm('Failed to delete!, Contact admin');
                        if(conf2 == true)
                        {
                            window.location.href = 'manage-article.php';
                        }else{
                            window.location.href = 'manage-article.php';
                        }
                    }
                </script>";
    }
?>

<?php
session_start();
if(!isset($_SESSION['level']))
{
    header("Location: index.php");
}else if($_SESSION['level'] != 'admin')
{
    header("Location: index.php");
}
include 'database.php';
$id = $_GET['id'];
$name = $_SESSION['name'];
$check = mysqli_query($connect, "SELECT * FROM article WHERE article_id='$id'");
$check2 = mysqli_num_rows($check);
if($check2<1)
{
    header("Location: all-article.php");
}else{
    $eksekusi = "<script>document.write(eksekusi)</script>";
    while($d = mysqli_fetch_array($check))
        {
            $status = $d['status'];
        }
        if($status == 'unpublished')
        {
        $update = mysqli_query($connect, "UPDATE article SET status='published' WHERE article_id='$id'");
        if($update)
        {
            echo "<script>
                        var a = confirm('Success to Publish');
                        if(a == true)
                        {
                            window.location.href = 'all-article.php';
                        }else{
                            window.location.href = 'all-article.php';
                        }
                  </script>";
        }else{
            echo "<script>
                    var a = confirm('Failed!! contact admin');
                    if(a == true)
                    {
                        window.location.href = 'contact.php';
                    }else{
                        window.location.href = 'all-article.php';
                    }
                  </script>";
        }
    }else if($status == 'published')
    {
        $update = mysqli_query($connect, "UPDATE article SET status='unpublished' WHERE article_id='$id'");
        if($update)
        {
            echo "<script>
                        var a = confirm('Success to Unpublish');
                        if(a == true)
                        {
                            window.location.href = 'all-article.php';
                        }else{
                            window.location.href = 'all-article.php';
                        }
                  </script>";
        }else{
            echo "<script>
                        var a = confirm('Failed!! contact admin');
                        if(a == true)
                        {
                            window.location.href = 'contact.php';
                        }else{
                            window.location.href = 'all-article.php';
                        }
                  </script>";
        }
    }
}
?>
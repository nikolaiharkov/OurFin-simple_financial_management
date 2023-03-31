<?php
include "database.php";

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    if($password != $repassword) {
        echo "<script>alert('Password yang anda masukkan tidak sama')</script>";
        echo "<script>window.location='../member.php'</script>";
    } else {
        $password = hash('sha256', $password);
        $check_username = mysqli_query($conn, "SELECT * FROM member WHERE username='$username'");
        if(mysqli_num_rows($check_username) > 0) {
            echo "<script>alert('Username sudah ada')</script>";
            echo "<script>window.location='../member.php'</script>";
        } else {
            $insert_member = mysqli_query($conn, "INSERT INTO member (username, password) VALUES ('$username', '$password')");
            if($insert_member) {
                echo "<script>alert('Akun member berhasil dibuat')</script>";
                echo "<script>window.location='../member.php'</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan dalam membuat akun member')</script>";
                echo "<script>window.location='../member.php'</script>";
            }
        }
    }
} elseif(isset($_GET['function']) && $_GET['function'] == "delete" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete_member = mysqli_query($conn, "DELETE FROM member WHERE id='$id'");
    if($delete_member) {
        echo "<script>alert('Akun member sudah dihapus')</script>";
        echo "<script>window.location='../member.php'</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan dalam menghapus akun member')</script>";
        echo "<script>window.location='../member.php'</script>";
    }
} else {
    echo "<script>window.location='../member.php'</script>";
}
?>

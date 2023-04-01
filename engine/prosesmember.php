<?php
require_once "database.php";

if(isset($_POST['username'], $_POST['password'], $_POST['repassword'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $repassword = mysqli_real_escape_string($conn, $_POST['repassword']);

    if($password !== $repassword) {
        echo "<script>alert('Password yang anda masukkan tidak sama')</script>";
    } else {
        $password = hash('sha256', $password);
        $check_username = mysqli_prepare($conn, "SELECT * FROM member WHERE username=?");
        mysqli_stmt_bind_param($check_username, 's', $username);
        mysqli_stmt_execute($check_username);
        $result = mysqli_stmt_get_result($check_username);
        if(mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username sudah ada')</script>";
        } else {
            $insert_member = mysqli_prepare($conn, "INSERT INTO member (username, password) VALUES (?, ?)");
            mysqli_stmt_bind_param($insert_member, 'ss', $username, $password);
            if(mysqli_stmt_execute($insert_member)) {
                echo "<script>alert('Akun member berhasil dibuat')</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan dalam membuat akun member')</script>";
            }
        }
    }
    echo "<script>window.location='../member.php'</script>";
} elseif(isset($_GET['function'], $_GET['id']) && $_GET['function'] === "delete") {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $delete_member = mysqli_prepare($conn, "DELETE FROM member WHERE id=?");
    mysqli_stmt_bind_param($delete_member, 'i', $id);
    if(mysqli_stmt_execute($delete_member)) {
        echo "<script>alert('Akun member sudah dihapus')</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan dalam menghapus akun member')</script>";
    }
    echo "<script>window.location='../member.php'</script>";
} else {
    echo "<script>window.location='../member.php'</script>";
}

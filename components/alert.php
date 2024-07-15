<?php
if (isset($success)) {
    foreach ($success as $msg) {
        echo "<script>swal('Success', '$msg', 'success');</script>";
    }
}
if (isset($warning)) {
    foreach ($warning as $msg) {
        echo "<script>swal('Warning', '$msg', 'warning');</script>";
    }
}
if (isset($info)) {
    foreach ($info as $msg) {
        echo "<script>swal('Info', '$msg', 'info');</script>";
    }
}
if (isset($error)) {
    foreach ($error as $msg) {
        echo "<script>swal('Error', '$msg', 'error');</script>";
    }
}
?>

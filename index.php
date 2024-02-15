<?php
session_start();
if(isset($_SESSION['admin'])){
    echo '
    <script>
    window.location.href = "admin/account/manage-products";
    </script>
    ';
}else{
    echo '
    <script>
    window.location.href = "user-pages/home/";
    </script>
    ';
}
?>
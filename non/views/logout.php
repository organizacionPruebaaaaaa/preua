<?php
if(isset($_GET['logout'])){
    session_start();
    session_destroy();
?>
    <script>window.location.replace("../index.php");</script>
<?php
}
?>
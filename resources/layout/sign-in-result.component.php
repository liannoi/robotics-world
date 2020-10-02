<div class="row mt-5 mb-4">
    <div class="col-sm-12">
        <h2 class="font-weight-bold text-monospace text-success text-center">OK</h2>
    </div>
</div>

<?php

$username = $_POST["user"]["username"];
echo $_POST["user"]["remember"];
$_SESSION["user"] = $username;
setcookie("user", $username, time() + 3600 * 24 * 7);

?>

<script>
  window.location.replace('/');
</script>

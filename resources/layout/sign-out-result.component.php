<?php

session_destroy();

if (isset($_COOKIE["user"])) {
    setcookie("user", "", -1);
}

?>

<script>
  window.location = 'main';
</script>

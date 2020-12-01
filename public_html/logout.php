<?php

session_start();

session_unset();

session_destroy();

header("Location: /index.php");
?>
<html>
<head>
  <meta http-equiv="refresh" content="5; URL="skylarn.sg-host.com" />
</head>
<body>
  <p>If you are not redirected in five seconds, <a href="https://skylarn.sg-host.com">click here</a>.</p>
</body>
</html>
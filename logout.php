<?php

	session_start();
	session_destroy();
	header ('refresh:3; url=index.html');

?>

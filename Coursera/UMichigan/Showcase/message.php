<?php

if (isset($_SESSION['message'])) {
   echo("<p style='color: ".htmlentities($_SESSION['color']).";'>".htmlentities($_SESSION['message'])."</p>\n");
}

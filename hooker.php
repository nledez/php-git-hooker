<?php
$base = __DIR__;
$repo_url = $_GET['repo_url'];

`rm index.html`;

`git clone $repo_url dest`;
`mv dest/* dest/.* $base/`;
`rm hooker.php`;
`rmdir dest`;

?>

<?php
$base = __DIR__;
$filename = __FILE__;
$dest = "dest";
$repo_url = $_GET['repo_url'];

function curPageURL() {
  $pageURL = 'http';
  if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }
  return $pageURL;
}

function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $randomString;
}

header("Content-Type: text/plain");

if ($repo_url == '') {
  echo "Give me a repo_url: \n";
  echo curPageURL() . "?repo_url=http://gitbut/username/repository.git\n";
} elseif(file_exists(".git")) {
  echo "Allready installed\n";
} else {
  echo "git clone $repo_url $dest\n";
  echo `git clone $repo_url $dest 2>&1`;

  if (file_exists("index.html")) {
    echo "rm index.html\n";
    unlink("index.html");
  }

  echo "mv $dest/* $dest/.* $base/\n";
  echo `mv $dest/* $dest/.* $base/`;

  echo "rmdir $dest\n";
  echo `rmdir $dest`;

  echo "rm $filename\n";
  echo `rm $filename`;

  $hooker = 'hooker-' . generateRandomString(41) . '.php';
  echo "Use this URL in repository hook:\n";
  echo 'http://' . $_SERVER["SERVER_NAME"] . '/' . $hooker;

  $content  = '<?php' . "\n";
  $content .= 'header("Content-Type: text/plain");' . "\n";
  $content .= 'echo `/usr/bin/git pull origin master 2>&1`;' . "\n";
  $content .= '?>';

  file_put_contents($hooker, $content);
}

?>

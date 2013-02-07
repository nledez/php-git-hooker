php-git-hooker
==============

php-git-hooker is a simple and stupid installer for a static site. It also and a updater script.

Installation
==============
Clone repository or get script via:
https://raw.github.com/nledez/php-git-hooker/master/hooker.php

Transfer this script on your server (FTP or another method).

lftp -u user,pass ftp.server.tld -e 'cd www ; put hooker.php ; bye'

And call it through HTTP http://server.tld/hooker.php

Fill the form and submit. Script return you:

    git clone https://github.com/nledez/my-wonderfull-static-site.git dest
    Cloning into dest...
    mv dest/* dest/.* /home/mysite/www/
    rmdir dest
    rm /home/mysite/www/hooker.php
    Use this URL in repository hook:
    http://server.tld/hooker-Z1o6k4obhQ2l61vGgTvq8RFc91aUrXjqYIxiMVu4L.php

Put script "http://server.tld/hooker-Z1o6k4obhQ2l61vGgTvq8RFc91aUrXjqYIxiMVu4L.php" in:
Github / Project / Repository Settings / Service Hooks / WebHook URLs / URL

Et voila ! :)
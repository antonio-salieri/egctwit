# egctwit

This is simple ZF2 application which shows last five user tweets.

To install from composer type the following command:
php composer.phar create-project -sdev "antonio-salieri/egc_tweet" <path/to/project/directory>

After that you should create file "egctweet.local.php" in "config/autoload" directory, and put Twitter application access keys. As example for creating "egctweet.local.php" file look at "config/autoload/egctweet.local.php.dist" file.

If you haven't created Twitter app yet go to https://apps.twitter.com and create one, then put keys for application access in "config/autoload/egctweet.local.php" file.

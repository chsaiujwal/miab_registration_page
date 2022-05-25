# Main-In-A-Box registration page
source code of https://salvusmail.com/register.html page.

Just a simple registraiton page with a hcaptcha, using Mail-In-A-Box's in-build api for creating email.


## Installation:

1. Clone the files into your website directory (Your website directory is `/home/user-data/www/default`)
2. edit line numbers 195, 200 (pattern), 214 (data-sitekey) in register.html 
3. edit line 40 (api) in action_page.php
4. create a file .env in `/home/user-data/www` and save your admin accout creds and captcha secret key in it, make sure format is like this:
```
PWDD="PASSWORD_HERE"
EML="EMAILHERE@domain.com"
SEC="hCaptcha secret key here"
```
5. make sure you have composer installed, run `composer install` in website directory.

done, that's it.

if its not working, make sure you enabled php.

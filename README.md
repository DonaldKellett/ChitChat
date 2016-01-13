# ChitChat

## Overview

ChitChat is a simple, multipurpose chat platform developed by [DonaldKellett](https://github.com/DonaldKellett) that includes the following features:

 - A working account registration and login system - made possible by PHP Cookies and an SQL table
 - Simple SVG images (circles) to display the (online/offline) status of every other user using the Service - updated every ```1000ms``` via AJAX (PHP) methods to show you the most up-to-date user statuses (if that is even a word :p)
 - A Global (Community) Chat where the entire community can communicate with each other seamlessly.  Chat contents are updated every ```1000ms``` using AJAX (PHP) methods to ensure there is no delay in delivering messages and to ensure chat is not hindered
 - Ability to create (semi-)private chats between two members of the community
 - Ability to view own profile and other users' profiles
 - A joint Admin/Moderator Panel to promote/demote/ban other users when necessary
 - A page where all chats (including semi-private ones) can be effectively viewed and moderated
 - Ability for Moderators to (1) promote, (2) demote and (3) ban users according to the rules set forth by the owner of the Service

## Instructions

ChitChat is extremely easy to set up, just follow the simple steps below :D

### Part I - Connecting the Platform to the Database (Required)

The PHP code responsible for establishing a connection to the MySQL database is contained in the file ```connect.php``` which is located in the root directory of this application/platform.  In ```connect.php```, you will see the following line of code:

```php
$conn = new mysqli("localhost", "root", "root", "chitchat");
```

To connect the script (and therefore the entire application/platform) to your own database, change ```"localhost"``` to the name of your server (e.g. ```"example.com"```), the first ```"root"``` to a valid username in your SQL server, the second ```"root"``` to the corresponding password of that SQL user and ```"chitchat"``` to the name of the database that you decide to use for this platform.

*Side Note: if the connection to the database fails for any reason, the ```connect.php``` script will ```echo``` an error to the page affected.  However, please also note that the error message may be hidden under the header/navigation panel - you may have to scroll upwards a little to see it.*

### Part II - Creating the (SQL) Tables (Required)

Now that you have successfully linked the platform to your database, you will have to create the SQL tables necessary to make it work.  All of the SQL statements required to create the tables used in this application can be found in ```dbinfo.txt```.  Just copy *everything below the dotted line* in that file to be executed as SQL statements and the platform is ready to go!

### Part III - Creating an Admin account (Highly Recommended, but not required)

If you have decided to use this chat application/platform, you would probably want to make yourself an Administrator of the Service.  To do this, first register for an account via the Register Form (```register.php```).  After you have registered yourself an account, go to phpMyAdmin (or equivalent), select the table ```accounts``` from your database and change the ```rank``` of your account (row) from 2 (default) to 5.

## Copyright

(c) 2016 Donald Leung.  All rights reserved.  [MIT Licensed](LICENSE.txt)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

## Credits

Although I did not use a website template or any external sources of code in the development of this application/platform, I would like to give credit to the following sources:

1. Credits to [Skel](http://skel.io) for its handy 12-unit grid system.  Although I did NOT copy the code directly or use the software without providing attribution/their license, I did try to mimick it (albeit a poor attempt) using some simple CSS.  The grid system provided in my template also consists of 12 units, but instead of being called ```1u```-```12u```, the classes are just called ```one``` to ```twelve``` where ```.one``` divs are 1 unit wide (or rather, one-twelfth of a page wide) and ```.twelve``` divs are 12 units wide (full width).  All such divs collapse and become full-width (even the ```.one``` divs) below ```750px``` screen width.
2. Credits to [CSS Tricks](http://css-tricks.com) for teaching me how to change the color of the highlighting of an ```input``` form field when clicked.  In this case I did actually copy the code directly from their example and changed the color to suit my template.  The full link to that example/article can be found in a comment in the ```main.css``` file.
3. Credits to [W3Schools](http://w3schools.com) for teaching me how AJAX works and how to use it in conjunction with PHP and MySQL.  Without their invaluable resources I would not have known how to create a live chat application/platform.

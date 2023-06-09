# Stationery-Shop-Interface

This interface consists of Login - Create an account - Edit account - Delete account - Edit Reviews - Delete Reviews.
This is built using PHP, HTML and Materilize CSS that are connected to local databases created on Oracle 11g Express Edition. Xampp was used to host the PHP scripts.

## Connecting Oracle 11g Express Edition and PHP

When I worked on this project, it was done on a Windows 10 OS, 64 bit. You may need to go for the more latest versions for the links given below.
Here are some links and tutorials that I used to help me download and connect:
1. Oracle Instant Client - https://www.oracle.com/in/database/technologies/instant-client/winx64-64-downloads.html
2. PECL Package - https://pecl.php.net/package/oci8/3.0.1/windows
3. Youtbe Video with in-depth steps on how to connect - https://youtu.be/_CNM6ie-PwQ
4. A guide on how you use PHP and Oracle Database - https://www.oracle.com/webfolder/technetwork/tutorials/obe/db/oow10/php_db/php_db.htm

The commands to retrive data from the the tables are different from mysql. You can refer to the OCI 8 Manual for these commands: https://www.php.net/manual/en/book.oci8.php

## Tables created for the Interface

Here's the ERD for the entire interface.
![CIA-1 - Copy of ERD v1](https://github.com/SHAlockHolmes/Stationery-Shop-Interface/assets/128177155/583c5822-b471-436b-b9b1-3a4879d5349e)

Tables used are: country, login, customer_details, category, product, review.
In the programs they have been named as cia_country, cia_login, cia_cd, cia_category, cia_product, cia_review,

## About the Stationery Shop Interface

### 1. Login
Page were registered customers can log in to the page to access their account and start shoping. Their accounts will store data like their previous purchases and so on.

### 2. Create Account
If the user doesn't have an account, they can create an account by entering the details required.

### 3. Customer Details
Retrives the data related to the registered customer. Also has the option to delete their account permanently from the shop's databases.

### 4. Reviews
Customers can update or delete their previous stationery product reviews. There is a separate update or delete review pages for these two functions.

## Files

The "pages" folder has all the php webpages where db_connect is an important file to check if the database is connected successfully to the php Admin. Replace with your username and password and if required, even the name of the localhost.
The "templates" folder is required for the header, footer and navigation bar.



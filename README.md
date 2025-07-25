# Apex Builds – Setup Guide

Thanks for downloading Apex Builds – a custom PC builder web app built with PHP and MySQL.

This guide walks you through getting everything up and running. It assumes you have some basic experience with PHP hosting and MySQL databases.

---

## 1. What You'll Need

Make sure your hosting setup includes the following:

- A web server (Apache is fine)
- PHP 7.4 or higher (cURL extension needs to be enabled)
- MySQL 5.7+
- Access to phpMyAdmin or another MySQL admin tool

---

## 2. Setting Up the Database

### Step 1: Create a New Database

1. Log into your control panel (like cPanel).
2. Open phpMyAdmin and create a new database.
3. Create a new MySQL user and give it full access to the database.
4. Take note of the database name, username, and password — you'll need them later.

### Step 2: Add the Tables

1. In phpMyAdmin, select your new database.
2. Go to the **SQL** tab.
3. Copy the contents of `database_schema.sql` into the box and run it.
4. That should create the necessary tables: `users`, `products`, `orders`, and `order_items`.

---

## 3. Connecting the App to Your Database

1. Open `php/db_connect.php` in a code editor.
2. Update the following lines with the DB details you saved earlier:

    ```php
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database";
    ```

3. (Optional) If you want the weather widget to work, grab a free API key from [OpenWeatherMap](https://openweathermap.org/) and plug it into:
    - `js/main.js`
    - `admin/status.php`

---

## 4. Uploading the Files

Upload the full project to your server (usually the `public_html` folder). Make sure you keep the folder structure intact when doing this.

Once it’s uploaded, visit your domain and you should see the homepage. You can register a new user from there.

To turn a user into an admin, go into the `users` table in phpMyAdmin and manually change the `role` field from `customer` to `admin`.

---

Let me know if you hit any issues — this project is still being improved and contributions are welcome!

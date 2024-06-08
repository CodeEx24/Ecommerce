# PHP and MySQL Setup Guide

This guide provides step-by-step instructions to set up a local development environment for PHP and MySQL on Windows, macOS, and Linux using XAMPP, MAMP, and LAMP, respectively.

## Table of Contents
- [Windows Setup](#windows-setup)
- [macOS Setup](#macos-setup)

## Windows Setup

### Step 1: Download XAMPP
1. Go to the [XAMPP website](https://www.apachefriends.org/index.html).
2. Download the XAMPP installer for Windows.

### Step 2: Install XAMPP
1. Run the installer and follow the on-screen instructions.
2. Select the components you want to install (ensure Apache, MySQL, and PHP are selected).
3. Choose the installation directory (default is usually `C:\xampp`).

### Step 3: Start XAMPP
1. Open the XAMPP Control Panel.
2. Start the Apache and MySQL modules.

### Step 4: Test PHP
1. Open your web browser.
2. Navigate to `http://localhost`.
3. You should see the XAMPP dashboard.

### Step 5: Create a PHP File
1. Navigate to `C:\xampp\htdocs`.
2. Create a new file named `test.php`.
3. Add the following PHP code:
    ```php
    <?php
    phpinfo();
    ?>
    ```
4. Save the file.

### Step 6: Run the PHP File
1. In your browser, go to `http://localhost/test.php`.
2. You should see the PHP configuration page.

### Step 7: Access MySQL
1. Open the XAMPP Control Panel.
2. Click on the "Admin" button next to MySQL to open phpMyAdmin.
3. You can manage your MySQL databases from here.

## macOS Setup

### Step 1: Download MAMP
1. Go to the [MAMP website](https://www.mamp.info/en/).
2. Download the MAMP installer for macOS.

### Step 2: Install MAMP
1. Run the installer and follow the on-screen instructions.
2. Drag the MAMP folder to your Applications folder.

### Step 3: Start MAMP
1. Open the MAMP application from your Applications folder.
2. Click "Start Servers."

### Step 4: Test PHP
1. Open your web browser.
2. Navigate to `http://localhost:8888`.
3. You should see the MAMP dashboard.

### Step 5: Create a PHP File
1. Navigate to `/Applications/MAMP/htdocs`.
2. Create a new file named `test.php`.
3. Add the following PHP code:
    ```php
    <?php
    phpinfo();
    ?>
    ```
4. Save the file.

### Step 6: Run the PHP File
1. In your browser, go to `http://localhost:8888/test.php`.
2. You should see the PHP configuration page.

### Step 7: Access MySQL
1. Open MAMP.
2. Click on the "Open WebStart page."
3. Select "phpMyAdmin" from the menu to manage your MySQL databases.

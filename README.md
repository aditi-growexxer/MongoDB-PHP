# MongoDB + PHP CRUD Demo

This is a simple CRUD (Create, Read, Update, Delete) demo using **PHP 8.1** and **MongoDB**.  
It connects to a local MongoDB instance (e.g., MongoDB Compass or MongoDB shell) and allows you to:
- Insert users into the database  
- View user list  
- Edit user details  
- Delete users  

---

## 🧩 Prerequisites

Make sure the following are installed:

1. **PHP 8.1 or higher**
2. **Composer**
3. **MongoDB Community Server**
4. **MongoDB Compass** (optional GUI tool)

---

## ⚙️ Setup Instructions

### 1️⃣ Clone or Create Project Folder

```bash
cd /var/www/html
mkdir MongoDBDemo
cd MongoDBDemo
```

---


### 2️⃣ Install MongoDB PHP Library

```bash
composer require mongodb/mongodb
```
### MongoDB Setup

Create Database and Collection:
1. Open MongoDB Compass
2. Click "Create Database"
     i. Database Name: demo_db
     ii. Collection Name: users
```bash
use demo_db
db.createCollection("users")
```

---

### 💻 Running the App
Start your PHP development server:
```bash
php -S localhost:8000
```
Then open your browser:
```bash
http://localhost:8000/index.php
```

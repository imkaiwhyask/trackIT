# TrackIT - Asset Management & Inventory System

TrackIT is a web-based asset management and inventory system for managing IT assets such as laptops, desktops, and accessories. It supports asset assignment, return tracking, and basic form generation.

---

## 🚀 Features

* Asset inventory management for laptops, desktops, and accessories
* Assign assets to employees
* Track asset returns and separation records
* Generate assignment and return forms
* Accessories tracking such as keyboard, mouse, charger, and others
* Basic dashboard view of assets
* Asset loan record management
* Basic user role setup

---

## 🛠 Tech Stack

* PHP
* MySQL
* Bootstrap
* jQuery
* Docker
* phpMyAdmin

---

## ⚙️ Installation Guide

### 1. Clone the repository

```bash
git clone https://github.com/imkaiwhyask/trackIT.git
cd trackIT
```

### 2. Run using Docker

```bash
docker compose up -d
```

Open the application in your browser:

```txt
http://localhost:8080/it
```

Open phpMyAdmin:

```txt
http://localhost:8081
```

---

## 🗄 Database Setup

This repository only includes a safe database schema:

```txt
database/schema.sql
```

It contains the table structure only and does not include real company data, employee records, asset records, uploaded files, or production database dumps.

### Option 1: Import using phpMyAdmin

1. Open phpMyAdmin:

```txt
http://localhost:8081
```

2. Select or create the database used by the project.

3. Import:

```txt
database/schema.sql
```

### Option 2: Import using terminal

```bash
docker exec -i trackit-db-1 mysql -u root tisamidb < database/schema.sql
```

---

## 🔧 Database Configuration

Check your database configuration in:

```txt
src/config/config.php
```

Make sure the credentials match your Docker/MySQL setup.

Example:

```php
$con = mysqli_connect("db", "root", "", "tisamidb");
```

For Docker, the database host is usually:

```txt
db
```

not:

```txt
localhost
```

---

## 📂 Project Structure

```txt
trackIT/
│
├── database/
│   └── schema.sql          # Safe database structure only
│
├── src/                    # Main application files
│
├── Dockerfile
├── docker-compose.yml
├── README.md
└── LICENSE
```

---

## 🔒 Security Notes

This repository does not include:

* Production database dumps
* Real employee or asset records
* Uploaded CSV, Excel, or PDF files
* Internal company emails or SMTP details
* Private audit files

Do not commit real company data, exported reports, generated forms, database dumps, or uploaded files.

Recommended ignored files include:

```txt
mysql/
*.sql
*.csv
*.xlsx
*.xls
*.pdf
*-audit.txt
```

Only the safe database schema should be committed:

```txt
database/schema.sql
```

---

## ⚠️ Notes

If the app generates PDF files locally, make sure the output folder has write permission.

Example:

```bash
chmod -R 775 src/pdf
```

If needed for local development only:

```bash
chmod -R 777 src/pdf
```

Do not commit generated PDF files.

---

## 📌 Future Improvements

* Role-based access control
* Loan approval workflow
* Better user authentication and password hashing
* Improved UI/UX
* Reporting and analytics
* Safer mail configuration using environment variables
* Cleaner dependency management using Composer/NPM

---

## 📄 License

This project is licensed under the MIT License.

---

## 👨‍💻 Author

Kai Angelo

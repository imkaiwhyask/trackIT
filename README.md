# TrackIT - Asset Management & Inventory System

TrackIT is a web-based asset management system used to manage IT assets such as laptops, desktops, and accessories. It allows assigning assets to employees and generating return and separation forms.

---

## 🚀 Features

* Asset Inventory Management (Laptop/Desktop)
* Assign assets to employees
* Asset assignment and return form generation
* PDF form generation (Assignment & Return)
* Accessories tracking (Keyboard, Mouse, Charger, etc.)
* Basic dashboard view of assets
* Asset loan form (record only)
* Basic role setup (IT = Admin)

---

## 🛠 Tech Stack

* PHP (Native)
* MySQL
* Bootstrap
* jQuery
* Docker

---

## ⚙️ Installation Guide

### 1. Clone the repository

```bash
git clone https://github.com/imkaiwhyask/trackit.git
cd trackit
```

### 2. Run using Docker

```bash
docker-compose up -d
```

Open in browser:
http://localhost:8080/it

---

### 3. Setup Database

1. Open phpMyAdmin:
   http://localhost:8081

2. Create a database named:
   `trackit`

3. Import the SQL file:
   `database/trackit.sql`

---

### 4. Configure Database Connection

Open:
`src/config/config.php`

Make sure this matches your database:

```php
$con = mysqli_connect("localhost","root","","trackit");
```

---

## 📂 Project Structure

```
trackit/
│
├── src/                # Main application files
├── database/           # SQL file (required to run project)
├── Dockerfile
├── docker-compose.yml
└── README.md
```

---

## ⚠️ Notes

Make sure the `pdf` folder has write permission:

```bash
chmod -R 775 src/pdf
```

If it doesn’t work:

```bash
chmod -R 777 src/pdf
```

---

## 📌 Future Improvements

* Role-based access control
* Loan approval workflow
* UI/UX improvements
* Reporting and analytics

---

## 📄 License

This project is licensed under the MIT License.

```
MIT License

Copyright (c) 2026 Kai Angelo

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
```

---

## 👨‍💻 Author

Kai Angelo

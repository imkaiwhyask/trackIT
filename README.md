# TrackIT

TrackIT is a simple IT asset tracking system for managing company devices, asset inventory, assignments, and records.

This repository is intended for development/testing only and does not include production employee data, company asset records, uploaded files, or private database dumps.

---

## Features

- IT asset inventory management
- Asset assignment to employees
- Asset status tracking
- PDF/file upload support
- User login system
- MySQL database using Docker
- phpMyAdmin for local database management
- Safe default dropdown seed data

---

## Tech Stack

- PHP
- MySQL 5.7
- Apache
- Docker
- Docker Compose
- phpMyAdmin

---

## Local Setup

### 1. Clone the repository

```bash
git clone https://github.com/imkaiwhyask/trackIT.git
cd trackit
```

---

### 2. Create `.env`

Create a `.env` file in the project root:

```bash
nano .env
```

Paste this:

```env
MYSQL_ROOT_PASSWORD=TrackITRoot_2026!Secure
MYSQL_DATABASE=trackit_db
MYSQL_USER=trackit_user
MYSQL_PASSWORD=TrackITApp_2026!Secure
```

Save:

```text
CTRL + O
Enter
CTRL + X
```

Important: `.env` is ignored by Git and should not be committed.

---

### 3. Start Docker

```bash
docker compose up -d --build
```

After running, open:

```text
App: http://localhost:8080
phpMyAdmin: http://localhost:8081
```

phpMyAdmin login:

```text
Username: root
Password: TrackITRoot_2026!Secure
```

---

## Database Setup

This repository includes a safe schema and safe default dropdown data.

It does not include real employee records, production asset records, uploaded PDFs, reports, or private company data.

### 1. Import schema

Run this from the project root:

```bash
docker exec -i trackit-db mysql -uroot -pTrackITRoot_2026!Secure trackit_db < database/schema.sql
```

### 2. Import default dropdown/master data

```bash
docker exec -i trackit-db mysql -uroot -pTrackITRoot_2026!Secure trackit_db < database/seeds/001_default_dropdowns.sql
```

The seed file contains only generic values such as:

- Asset types
- Operating systems
- Asset statuses
- Conditions
- Roles
- Accessories
- Default dropdown values

It does not contain confidential or production data.

---

## Test Login

After importing the schema, you may create a local test user in phpMyAdmin.

Go to:

```text
phpMyAdmin → trackit_db → SQL
```

Run:

```sql
INSERT INTO tbl_user
(login, password, role, name, byUser, email, country, icon, status, remarks)
VALUES
('admin', SHA1('admin123'), 'IT', 'Test IT User', 'System', 'admin@test.local', 'Philippines', '', 'Active', '');
```

Then login to the app using:

```text
Username: admin
Password: admin123
```

On first successful login, the system may upgrade the old SHA1 password to a stronger password hash.

---

## Reset Local Database

If you need to reset your local database completely:

```bash
docker compose down
sudo rm -rf mysql
docker compose up -d --build
```

Then import the schema and seed files again.

---

## Security Notes

This project has been updated to avoid common security issues:

- Database credentials are loaded from environment variables.
- `.env` is ignored and should never be committed.
- MySQL root password is no longer blank.
- Login uses prepared statements.
- Passwords should use secure hashing.
- File uploads are renamed safely.
- SQL seed files contain only safe generic dropdown data.
- Local MySQL data folders are ignored by Git.

---

## Files/Folders Not Included in Git

The following should not be committed:

```text
.env
mysql/
mysql_backup/
src/uploads/
src/pdf/
src/csv/
*.csv
*.xlsx
*.xls
*.pdf
*.log
private database dumps
production SQL backups
employee records
company asset records
```

---

## Useful Docker Commands

Start containers:

```bash
docker compose up -d --build
```

Stop containers:

```bash
docker compose down
```

View running containers:

```bash
docker ps
```

View logs:

```bash
docker logs trackit-web
docker logs trackit-db
docker logs trackit-phpmyadmin
```

Open MySQL terminal:

```bash
docker exec -it trackit-db mysql -uroot -p
```

---

## Git Reminder

Before committing, always check:

```bash
git status
```

Make sure these are not included:

```text
.env
mysql/
mysql_backup/
uploaded files
private SQL dumps
```

Commit safe changes only:

```bash
git add .
git commit -m "Apply security fixes and database seed"
git push origin master
```

---

## Disclaimer

This repository is for development and local testing. Before using in production, review the code, database access, authentication, permissions, file uploads, and server configuration carefully.

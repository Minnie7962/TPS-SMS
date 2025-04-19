

# 1. Install Dependencies

```bash
composer install
npm install
```

# 2. Setup Environment

Copy the `.env.example` file to `.env` and update the database configuration:

```bash
cp .env.example .env
```

Update the following in your `.env` file:

```
DB_DATABASE=tamat_primary_school
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

# 3. Generate Application Key

```bash
php artisan key:generate
```

# 4. Run Migrations and Seeders

```bash
php artisan migrate:fresh --seed
```

# 5. Compile Assets

```bash
npm run dev
```

# 6. Start the Application

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Login Information

### Admin Access

- Email: super@tamat.edu.kh
- Password: password

- Email: admin@tamat.edu.kh
- Password: password

### Teacher Access

- Email: bora.hem@tamat.edu.kh 
- Password: password
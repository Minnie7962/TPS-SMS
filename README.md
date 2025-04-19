# System Overview

The system includes the following main components:

1. School information management
2. User management
3. Academic structure
4. Subject management
5. Timetable management
6. Exam and grading system
7. Student records and parent associations

## Setup Instructions

### 1. Install Dependencies

```bash
composer install
npm install
```

### 2. Setup Environment

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

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Run Migrations and Seeders

```bash
php artisan migrate:fresh --seed
```

### 5. Compile Assets

```bash
npm run dev
```

### 6. Start the Application

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## System Structure

### School Information

- Name: Tamat Primary School
- Address, email, phone, and other contact information
- Academic years from 2005 to present
- Current academic year: 2024-2025

### Class Structure

- 7 Class Groups (Grades): Kindergarten, Grade 1-6
- 10 Classes: Class 1-7, Office 1-2, Library
- Sections: A and B for each class

### Users

- Admin: 1 user
- Teachers: 9 users (mix of male and female)
- Students: 250 users (mix of male and female)
- Parents: 250 users (one parent per student)

### Subjects

- Khmer
- Math
- Science
- Social
- English
- PE (Physical Education)

### Grading System

- Very Good: 8-10 points
- Good: 5-7.9 points
- Not Good: 0-4.9 points

### Exams

- Midterm exams
- Final exams
- Each subject has a maximum score of 10 points

## Login Information

### Admin Access

- Email: super@tamat.edu.kh
- Password: password

- Email: admin@tamat.edu.kh
- Password: password

### Teacher Access

- Email: bora.hem@tamat.edu.kh 
- Password: password
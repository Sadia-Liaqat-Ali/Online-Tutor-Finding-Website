# 📘 Online Tutor Finding Application

**Online Tutor Finding Application** is a full-featured, web-based system built to bridge the gap between students/parents and qualified tutors. Designed to streamline the process of finding, selecting, and interacting with tutors, this application empowers administrators to manage tutors and fees, students to explore and connect with educators, and tutors to share classes and quizzes online.

---

## 🧠 Abstract / Introduction

This platform enables **parents/students to search** for tutors based on academic fields like Computer Science, Medical, and Engineering. **Admins manage tutor onboarding**, categories, and finance reports, while **tutors share class schedules, online links, and quizzes** with their registered students.

---

## 🎯 Key Stakeholders & Roles

| Role     | Key Features                                                                 |
|----------|------------------------------------------------------------------------------|
| 👤 Admin | Manage tutors, categories, fee vouchers, expenses, and user verification     |
| 👨‍👩‍👧 Parent/User | Register, search/select tutors, upload vouchers, attend classes & take quizzes |
| 👨‍🏫 Tutor | Share class links, create quizzes, monitor student progress                 |

---

## 🛠️ Features

### 👨‍💼 Admin Panel
- Secure **login/logout**
- Add/update/delete subject **categories**
- Register tutors with complete info (name, qualification, image, fee, etc.)
- **Send credentials** to tutors via email/message
- View/update/delete tutors
- View all **students linked to a tutor**
- Generate and **verify fee vouchers**
- Manage **expenses and profit reports**

### 👨‍👩‍👧 User/Parent Panel
- Register/login/logout
- Update personal profile
- View detailed tutor profiles (qualification, experience, resume, etc.)
- Search tutors by category (CS, Medical, Engineering, etc.)
- Select one or multiple tutors
- **Generate/download/upload fee vouchers**
- View **fee payment status**
- View **class schedule, timings, and online links**
- Take **online quizzes**
- Track **quiz progress and results**

### 👨‍🏫 Tutor Panel
- Admin-approved login only (offline registration)
- Upload/view **resume** (visible to users)
- View list of **assigned students**
- Share **class details** (link, timing)
- **Create quizzes** (MCQs) for students
- Monitor **student quiz progress**
- Secure **logout**

---

## 🧰 Tools & Technologies

| Technology | Purpose                        |
|------------|--------------------------------|
| PHP        | Server-side logic              |
| MySQL      | Database management            |
| HTML/CSS   | Page structure & design        |
| Bootstrap  | Responsive UI components       |
| JavaScript | Client-side interactivity      |
| XAMPP      | Local server environment       |

---

## 🗂️ Project Structure

```bash
📦 online-tutor-finding-app/
├── admin/             # Admin panel and features
├── tutor/             # Tutor dashboard and management
├── user/              # Parent/Student panel
├── img/               # tutor images
├── uploads/           # Uploaded resumes and vouchers
├── db_connection.php  # Database configuration
├── index.php          # Homepage
├── about.php          # About us
└── README.md

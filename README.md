# FreelanceHub – Freelancer Marketplace Platform

## Project Presentation

### Chapter 1: Introduction

FreelanceHub is a modern web-based freelancer marketplace platform developed using the Laravel framework. The system is designed to connect freelancers and clients in a single, organized platform. It allows freelancers to offer their services, clients to discover and hire them, and both parties to communicate and manage orders efficiently.

The platform features a clean, responsive user interface built with Tailwind CSS and Alpine.js. It includes role-based access control (Client, Freelancer, and Admin), secure authentication with Google OAuth, and a complete order management system with pricing transparency (original price + 15% platform fee).

---

### Chapter 2: Problem Statement

Existing freelance platforms often suffer from several limitations:

- Communication is scattered across multiple tools (email, WhatsApp, etc.)
- No centralized system for managing services and orders
- Lack of transparency in pricing and fees
- Difficulty for clients to find reliable freelancers
- Limited tools for administrators to monitor platform activity

**Need:**  
A unified, professional platform that handles service posting, order placement, communication, and admin oversight in one place.

---

### Chapter 3: Aim and Objectives

**Aim:**  
To develop a complete freelancer marketplace system that simplifies the process of hiring freelancers and managing freelance projects.

**Objectives:**
1. Allow freelancers to create and manage services with pricing details
2. Enable clients to browse, search, and place orders on services
3. Implement secure authentication and role-based access
4. Provide real-time messaging between clients and freelancers
5. Build an admin dashboard with user, service, and order management
6. Support Excel export for order reports with proper pricing breakdown
7. Design a modern, responsive, and user-friendly interface

---

### Chapter 4: Methodology & Technologies

**Technologies Used:**
- **Backend:** Laravel 10 (MVC Architecture)
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Database:** MySQL
- **Authentication:** Laravel Breeze + Google OAuth
- **Excel Export:** PhpSpreadsheet

**Development Approach:**
- Database design with proper migrations and relationships
- Role-based access control (Client, Freelancer, Admin)
- Pricing system with `original_price`, `platform_fee`, and `amount`
- Clean separation between admin and user interfaces
- Focus on security, usability, and maintainability

---

### Chapter 5: System Functionality

**1. User Management**
- Registration and login with email/password and Google OAuth
- Role selection during registration (Client/Freelancer)
- Profile management with profile picture upload
- Admin can manage all users (view, activate/deactivate)

**2. Service Management**
- Freelancers can create services with title, description, category, price, and image
- Pricing system stores `original_price` and calculates 15% `platform_fee`
- Services can be in Draft or Published status
- Clients can browse and search services by category

**3. Order Management**
- Clients can place orders with specific requirements
- Order includes original price, platform fee, and total amount
- Status workflow: Pending → In Progress → Completed
- Admin can view all orders and export monthly reports to Excel

**4. Messaging System**
- Real-time chat between clients and freelancers
- Messages are linked to specific orders

**5. Admin Dashboard**
- Overview of users, services, and orders
- Export monthly order reports to Excel (with client & freelancer names)
- Manage users, approve/reject services

---

## Installation Guide

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js & npm
- MySQL

### Installation Steps

1. **Clone the project**
   ```bash
   git clone https://github.com/your-username/freelancer-market.git
   cd freelancer-market
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Update your database settings in `.env`.

4. **Run migrations**
   ```bash
   php artisan migrate
   ```

5. **Seed the database (Recommended)**
   ```bash
   php artisan db:seed
   ```

6. **Build frontend assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit: `http://127.0.0.1:8000`

---

### Default Accounts

| Role        | Email                          | Password         |
|-------------|--------------------------------|------------------|
| Admin       | admin@freelancehub.com         | admin123         |
| Freelancer  | freelancer@freelancehub.com    | freelancer123    |

---

### Important Notes

- Enable PHP extensions `gd` and `zip` for Excel export feature.
- All dates in reports are displayed in **GMT+7**.
- The system automatically applies a 15% platform fee on every service.

---

## License

This project is open-source and licensed under the MIT License.

### 4. Messaging System
- Chat between client and freelancer for each order
- Real-time message updates
- Unread message notifications in navigation bar
- Messages inbox showing all conversations
- Unread messages highlighted
- Auto-scroll to latest messages
- Message timestamps

### 5. User Interface
- Modern, clean design
- Responsive layout (works on mobile, tablet, desktop)
- Dark mode support
- Smooth animations and transitions
- Easy navigation
- Card-based layouts

---

## Chapter 06: Results

**System Outcomes:**

- Users can register and log in securely
- Users can choose role as Client or Freelancer
- Freelancers can create, edit, and delete services
- Clients can browse services and place orders
- Orders have clear status tracking:
  - Pending
  - Accepted
  - In Progress
  - Completed
- Users can communicate through messaging system
- Unread messages shown in navigation bar
- Category filtering for easy service discovery
- Profile pages showing user information and services

---

## Chapter 07: Future Plan

The following features are planned for future improvement of the system:

- Online payment integration (Stripe or PayPal)
- Rating and review system
- Advanced search and filtering
- Mobile application development
- AI-based service recommendations
- Escrow payment system
- Email notifications
- File sharing in chat
- Video call integration

---

## chapter 08: Conclusion

In conclusion, FreelanceHub is a functional and useful freelancer marketplace platform that meets the project objectives. It helps freelancers and clients manage services, orders, and communication in one system. The platform improves organization, reduces confusion, and provides a better user experience. In the future, more advanced features can be added to improve functionality and user satisfaction.

---

## Installation Guide

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL
- Node.js and NPM

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd final-project-practicum
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   - Create a MySQL database
   - Update `.env` file with database credentials:
   ```
   DB_DATABASE=freelancer_market
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Create storage link**
   ```bash
   php artisan storage:link
   ```

7. **Build assets**
   ```bash
   npm run dev
   ```

8. **Start the server**
   ```bash
   php artisan serve
   ```

9. **Access the application**
   - Open browser and go to: `http://localhost:8000`

---

## Technologies Used

- **Laravel 10.x** - PHP Framework
- **MySQL** - Database
- **Tailwind CSS** - CSS Framework
- **Alpine.js** - JavaScript Framework
- **Laravel Breeze** - Authentication Scaffolding

---

## License

This project is open-sourced software licensed under the MIT license.

---

**Thank You!**

For questions or support, please contact the development team.

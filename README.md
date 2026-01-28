# FreelanceHub – Freelancer Marketplace Platform
## Project Presentation

---

## Slide 1: Introduction

FreelanceHub is a web-based freelancer marketplace platform that helps connect freelancers with clients who need services. The system allows users to create accounts, post services, place orders, and communicate in one platform. It is developed using the Laravel framework with a modern and responsive design. FreelanceHub helps improve communication, organization, and efficiency between freelancers and clients.

---

## Slide 2: Problem Statement

**Problems in Current Freelance Systems:**

- Freelancers and clients use different apps to communicate
- Communication is not organized in one place
- Lack of trust and security in some platforms
- Difficult to track order and project status
- Clients find it hard to search for suitable services
- Freelancers struggle to find clients easily
- No clear system to manage services and orders

**Need:**
A single platform to manage services, orders, and communication efficiently

---

## Slide 3: Aim and Objectives

### Aim

The aim of this project is to develop a freelancer marketplace system that makes it easier for freelancers and clients to connect, communicate, and manage projects.

### Objectives

1. To allow freelancers to create and manage their services
2. To allow clients to browse services and place orders
3. To implement secure user login and registration
4. To build an order management system with status tracking
5. To provide a messaging system for communication
6. To design a simple, responsive, and user-friendly interface

---

## Slide 4: Methodology

### Technologies Used:
- **Backend:** Laravel Framework (MVC Architecture)
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Database:** MySQL
- **Authentication:** Email and Password Login + Google OAuth

### Development Process:
1. Requirement analysis and planning
2. Database design using migrations
3. Backend development using controllers and models
4. Frontend design using Blade templates
5. Integration of frontend and backend
6. Testing and bug fixing

---

## Slide 5: System Functionality

**What FreelanceHub Offers:**

### 1. User Management
- User registration and login
- Google OAuth authentication
- Role selection (Client or Freelancer)
- Profile management with image upload
- Email verification

### 2. Service Management
- Freelancers can create services with:
  - Title and description
  - Category selection
  - Price setting
  - Image upload
  - Status (Draft/Published)
- Browse all services with category filtering
- Sidebar filter to find services by category
- Service details page
- Edit and delete services

### 3. Order Management
- Clients can place orders on services
- Order includes:
  - Service details
  - Client requirements
  - Order amount
  - Status tracking
- Order status workflow:
  - **Pending** - Order placed, waiting for freelancer
  - **Accepted** - Freelancer accepted the order
  - **In Progress** - Work is ongoing
  - **Completed** - Work finished
- View order history
- Cancel pending orders

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

## Slide 6: Results

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

## Slide 7: Future Plan

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

## Slide 8: Conclusion

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

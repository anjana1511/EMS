# Employee Management System (Laravel)

This is an **Employee Management System** built using **Laravel**. The system allows **Admin** users to manage employees, roles, locations, salaries, projects, and more, while **Employee** users can view their own details, salary information, assigned tasks, and apply for leave.

## Features

### Admin Panel:
- **Location Management**: Manage location hierarchy (State, District, Taluka, Village).
- **Role & Permission Management**: Create, update, delete roles and permissions, and assign them to employees.
- **Employee Management**: Manage employee profiles, assign designations and departments.
- **Salary Management**: Manage employee salaries (CRUD operations).
- **Advance Payment Management**: Manage employee advance payments.
- **Project & Task Management**: Create, update, and assign projects and tasks to employees.
- **Leave Management**: Approve, reject, or mark leave requests as pending.
- **Communication**: Send emails to employees for leave approvals, task updates, etc.

### Employee Panel:
- **View Profile**: Employees can view their assigned designation and department.
- **Salary Overview**: View and print their salary details.
- **Assigned Projects/Tasks**: View assigned projects and tasks.
- **Leave Management**: Apply for leave and view leave status.

## Tech Stack
- **Backend**: Laravel
- **Frontend**: Blade templates (can be extended with Vue.js or React)
- **Authentication**: Laravel Breeze or Jetstream
- **Database**: MySQL or other relational databases
## Project Requirements

| **Programs** | **Function** | **Versions** |
|--------------|--------------|--------------|
| PHP          | Language     | ^7.2.5       |
| Wamp/Xampp   | Server       | *            |
| Laravel      | Framework    | ^7.0         |
| MySQL        | Database     | 5.7.31 *     |
## Installation

Follow these steps to set up the project locally.

### 1. Clone the repository
```bash
<p>
git clone https://github.com/anjana1511/EMS.git EMS
<br>
cd EMS
composer install
<br>
cp .env.example .env
<br>
php artisan migrate --seed
<br>
php artisan key:generate
<br>
php artisan serve
<br>
</p>

```
<h2>Candidate Login</h2>
<b>Admin Login:</b>admin@gmail.com &nbsp; <b>Password:</b>123456789 <br>
<b>user Login:</b>user@gmail.com &nbsp;<b>Password:</b>123456789

<h2>screenshot :</h2>

![Screenshot 2023-02-03 214118](https://user-images.githubusercontent.com/72943364/216665104-c5c0587f-cee2-48d0-ab65-ac5859f6f8ef.png)

![Screenshot 2023-02-03 214213](https://user-images.githubusercontent.com/72943364/216665156-f32827e9-d06e-4331-b997-58b421d84511.png)

![Screenshot 2023-02-03 214243](https://user-images.githubusercontent.com/72943364/216665253-0e575782-f235-4442-abc2-d8f37acfe944.png)

![Screenshot 2023-02-03 214351](https://user-images.githubusercontent.com/72943364/216665679-24947b86-9d2e-451c-b620-21cd493526ad.png)

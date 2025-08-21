# Laravel Static Authentication App

A simple Laravel application with static user authentication using session-based login.

## Features

- ✅ **Static Authentication**: Predefined user credentials (no database required)
- ✅ **Session Management**: Laravel's built-in session handling
- ✅ **Responsive Design**: Bootstrap 5 with modern UI
- ✅ **Protected Routes**: Middleware-based route protection
- ✅ **Flash Messages**: Success/error notifications
- ✅ **Beautiful UI**: Gradient backgrounds and clean interface

## Demo Credentials

| Role  | Email              | Password    |
|-------|-------------------|-------------|
| Admin | admin@example.com | password123 |
| User  | user@example.com  | userpass    |

## Installation & Setup

1. **Clone or setup the project**
   ```bash
   # If starting fresh
   composer install
   npm install
   ```

2. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Start the development server**
   ```bash
   php artisan serve
   ```

4. **Access the application**
   - Open your browser and go to `http://localhost:8000`
   - You'll be redirected to the login page
   - Use any of the demo credentials above

## Application Structure

### Authentication Flow
1. **Login Page** (`/login`) - Static credential validation
2. **Dashboard** (`/dashboard`) - Protected area for authenticated users
3. **Logout** - Clears session and redirects to login

### Key Files
- `app/Http/Controllers/Auth/LoginController.php` - Handles authentication logic
- `app/Http/Middleware/StaticAuth.php` - Custom middleware for route protection
- `resources/views/auth/login.blade.php` - Login form with demo credentials
- `resources/views/dashboard.blade.php` - Protected dashboard page
- `resources/views/layouts/app.blade.php` - Base layout template

### Routes
```php
GET  /           -> Redirect to login
GET  /login      -> Show login form (guest only)
POST /login      -> Process login
POST /logout     -> Logout user
GET  /dashboard  -> Protected dashboard (auth required)
```

## How It Works

### Static Authentication
The application uses predefined user credentials stored in the `LoginController`:

```php
private const STATIC_USERS = [
    [
        'email' => 'admin@example.com',
        'password' => 'password123',
        'name' => 'Administrator'
    ],
    [
        'email' => 'user@example.com', 
        'password' => 'userpass',
        'name' => 'Regular User'
    ]
];
```

### Session Management
- User data is stored in Laravel sessions after successful login
- Custom middleware (`StaticAuth`) protects routes by checking session data
- Guest middleware prevents authenticated users from accessing login page

### Security Features
- CSRF protection on all forms
- Input validation on login form
- Session-based authentication
- Proper middleware protection

## Customization

### Adding New Users
Edit the `STATIC_USERS` constant in `LoginController.php`:

```php
private const STATIC_USERS = [
    // Add your users here
    [
        'email' => 'newuser@example.com',
        'password' => 'newpassword',
        'name' => 'New User'
    ]
];
```

### Styling
The application uses Bootstrap 5 with custom CSS gradients. Modify the `<style>` section in `layouts/app.blade.php` to customize the appearance.

### Adding Routes
Add new protected routes in `routes/web.php`:

```php
Route::middleware(['static.auth'])->group(function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    // Add more protected routes here
});
```

## Development Notes

- No database connection required for authentication
- Uses Laravel's default session driver (file-based)
- Perfect for simple applications or prototypes
- Easy to extend with additional features

## Production Considerations

- Change default credentials before deployment
- Use environment variables for sensitive data
- Consider implementing proper database authentication for production use
- Add rate limiting for login attempts
- Implement proper password hashing for production

## License

This is a demo application. Use it as a starting point for your Laravel projects.

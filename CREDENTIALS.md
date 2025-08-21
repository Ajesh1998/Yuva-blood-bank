# Laravel Static Authentication - User Credentials

## Current Login Credentials

### Demo Users Available:

| #  | Role          | Username/Email      | Password    | Name         | Access Level |
|----|---------------|---------------------|-------------|--------------|--------------|
| 1  | Administrator | admin@example.com   | password123 | Administrator| Full Access  |
| 2  | Regular User  | user@example.com    | userpass    | Regular User | Standard     |

---

## Login Instructions:

1. **Access the Application:**
   - URL: `http://localhost:8000`
   - You'll be automatically redirected to `/login`

2. **Login Process:**
   - Enter email and password from the table above
   - Click "Sign In" button
   - You'll be redirected to the dashboard upon successful login

3. **Quick Login (Auto-fill):**
   - On the login page, click on either demo credential card
   - The form will auto-fill with the selected credentials
   - Simply click "Sign In" to login

---

## Password Security Notes:

⚠️ **Important Security Reminders:**

- These are **DEMO CREDENTIALS** for development/testing only
- **DO NOT use these credentials in production**
- Change all default passwords before deploying to production
- Consider implementing proper password hashing for production use

---

## Adding New Users:

To add more users, edit the `STATIC_USERS` array in:
**File:** `/app/Http/Controllers/Auth/LoginController.php`

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
    ],
    // Add new users here:
    [
        'email' => 'newuser@example.com',
        'password' => 'newpassword',
        'name' => 'New User Name'
    ]
];
```

---

## User Roles & Permissions:

### Administrator (admin@example.com)
- **Full dashboard access**
- **All application features**
- **System information viewing**
- **User management capabilities** (when implemented)

### Regular User (user@example.com)
- **Dashboard access**
- **Basic application features**
- **Personal profile viewing**
- **Limited system information**

---

## Session Management:

- **Login Duration:** Session-based (until browser closure or manual logout)
- **Auto-logout:** No automatic timeout (session-based)
- **Remember Me:** Not implemented (session only)
- **Concurrent Logins:** Allowed (no restriction)

---

## Testing Scenarios:

### Valid Login Tests:
✅ admin@example.com + password123
✅ user@example.com + userpass

### Invalid Login Tests:
❌ admin@example.com + wrongpassword
❌ wrongemail@example.com + password123
❌ Empty email or password
❌ Invalid email format

---

## Logout Process:

1. Click on user dropdown in navigation
2. Select "Logout" option
3. Session will be cleared
4. Redirected to login page with success message

---

**Last Updated:** August 20, 2025
**Application Status:** ✅ Active - Server running on http://localhost:8000
**Issues Fixed:** 
- ✅ Login redirection issue resolved
- ✅ Route naming conflicts fixed
- ✅ Syntax errors corrected
- ✅ Middleware properly configured
- ✅ Professional dashboard with sidebar implemented

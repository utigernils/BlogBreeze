# Database Configuration

This project uses a centralized database connector to manage all database connections.

## Setup

1. **Copy the environment file template:**
   ```bash
   cp .env.example .env
   ```

2. **Edit the `.env` file with your database credentials:**
   ```
   DB_HOST=localhost
   DB_NAME=your_database_name
   DB_USER=your_username
   DB_PASS=your_password
   ```

3. **Important:** The `.env` file is ignored by git to protect your credentials. Never commit it to version control.

## Usage

### In PHP Files

The database connector is available in all PHP files. Simply include it and get a connection:

```php
<?php
require_once __DIR__ . '/DBConnector.php';

// Get a PDO database connection
$pdo = getDB();

// Use it for queries
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();
?>
```

### Features

- **Singleton Pattern:** Only one database connection is created and reused throughout the application
- **Secure:** Database credentials are stored in `.env` file, not in code
- **PDO with Prepared Statements:** All queries use PDO prepared statements for SQL injection protection
- **Error Handling:** Proper error handling with exceptions
- **UTF-8 Support:** Configured for UTF-8 (utf8mb4) character encoding

### Database Connector Class

The `DBConnector` class provides:
- Automatic `.env` file loading
- Singleton instance management
- PDO configuration with best practices
- Helper function `getDB()` for easy access

### Migration Notes

All PHP files have been updated to use the new database connector:
- `API.php`
- `get_blogs.php`
- `getPosts.php`
- `getUserData.php`
- `loginhandler.php`
- `makeComment.php`
- `makePost.php`
- `makeReaction.php`
- `deletePost.php`

Files converted from **mysqli** to **PDO**:
- `makeReaction.php`
- `deletePost.php`

### Security Best Practices

1. Keep `.env` file outside the web root in production
2. Set proper file permissions: `chmod 600 .env`
3. Use environment variables on production servers
4. Regularly update database credentials
5. Never commit `.env` to version control

### Troubleshooting

**Error: ".env file not found"**
- Make sure you've created the `.env` file from `.env.example`
- Check that the file is in the root directory

**Error: "Database connection failed"**
- Verify your database credentials in `.env`
- Check that the database server is running
- Ensure the database exists

**Connection timeout**
- Check database server status
- Verify network connectivity
- Review firewall settings

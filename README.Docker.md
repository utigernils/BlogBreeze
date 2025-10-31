# BlogBreeze Docker Setup

This document explains how to run BlogBreeze using Docker for development.

## Prerequisites

- Docker installed ([Get Docker](https://docs.docker.com/get-docker/))
- Docker Compose installed (usually comes with Docker Desktop)

## Quick Start

1. **Start the containers:**
   ```bash
   docker-compose up -d
   ```

2. **Access the application:**
   - Website: http://localhost:8080
   - PHPMyAdmin: http://localhost:8081

3. **Stop the containers:**
   ```bash
   docker-compose down
   ```

## Services

### Web Server (PHP + Apache)
- **Port:** 8080
- **URL:** http://localhost:8080
- **Features:**
  - PHP 8.2 with Apache
  - Live reload (files are mounted as volumes)
  - PDO MySQL extension enabled
  - All your project files are accessible

### Database (MariaDB)
- **Port:** 3306
- **Database:** blogbreeze
- **User:** blogbreeze_user
- **Password:** blogbreeze_pass (change in `.env`)
- **Root Password:** root_password_change_me (change in `.env`)

### PHPMyAdmin
- **Port:** 8081
- **URL:** http://localhost:8081
- **Purpose:** Database management interface

## Configuration

Edit the `.env` file to change database credentials:

```env
DB_HOST=db
DB_NAME=blogbreeze
DB_USER=blogbreeze_user
DB_PASS=blogbreeze_pass
DB_ROOT_PASS=root_password_change_me
```

**Important:** Don't commit your actual passwords to git!

## Live Reload

All files in your project directory are mounted into the container. Any changes you make will be immediately reflected:
- PHP files: Changes are instant
- HTML/CSS/JS: Refresh your browser to see changes

No need to rebuild or restart containers for code changes!

## Useful Commands

### View logs
```bash
# All services
docker-compose logs -f

# Specific service
docker-compose logs -f web
docker-compose logs -f db
```

### Restart services
```bash
# Restart all
docker-compose restart

# Restart specific service
docker-compose restart web
```

### Access container shell
```bash
# Web server
docker-compose exec web bash

# Database
docker-compose exec db bash
```

### Run MySQL commands
```bash
docker-compose exec db mysql -u blogbreeze_user -p blogbreeze
# Enter password when prompted
```

### Rebuild containers (after Dockerfile changes)
```bash
docker-compose up -d --build
```

### Stop and remove everything (including volumes)
```bash
docker-compose down -v
```
**Warning:** This will delete your database data!

## Database Initialization

The database is automatically initialized with:
- Tables: users, posts, comments, reactions
- Sample data: 2 users, 2 posts, 2 comments

SQL initialization script: `docker/init.sql`

To reset the database:
```bash
docker-compose down -v
docker-compose up -d
```

## Troubleshooting

### Port already in use
If port 8080 or 3306 is already in use, edit `docker-compose.yml`:
```yaml
ports:
  - "8090:80"  # Change 8080 to 8090
```

### Permission issues
If you get permission errors:
```bash
sudo chown -R $USER:$USER .
```

### Database connection issues
1. Make sure `.env` has `DB_HOST=db` (not `localhost`)
2. Wait a few seconds for the database to fully start
3. Check logs: `docker-compose logs db`

### Can't see changes
1. Make sure you're editing files in the correct directory
2. Try hard refresh: Ctrl+Shift+R (Linux/Windows) or Cmd+Shift+R (Mac)
3. Check if the container is running: `docker-compose ps`

## Development Workflow

1. Start containers: `docker-compose up -d`
2. Open http://localhost:8080 in your browser
3. Edit your PHP/HTML/CSS/JS files
4. Refresh browser to see changes
5. Use PHPMyAdmin at http://localhost:8081 for database work
6. When done: `docker-compose down`

## Production Notes

This Docker setup is optimized for **development** with live reload. For production:
- Remove PHPMyAdmin service
- Use environment-specific `.env` files
- Don't use volume mounts (copy files into container)
- Set proper security headers
- Use HTTPS
- Disable PHP error display

## Additional Resources

- [Docker Documentation](https://docs.docker.com/)
- [MariaDB Documentation](https://mariadb.org/documentation/)
- [PHP Docker Official Image](https://hub.docker.com/_/php)

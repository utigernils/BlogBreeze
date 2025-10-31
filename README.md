# BlogBreeze

BlogBreeze is a simple blogging platform where users can post anything they like. Built primarily with PHP and Bootstrap, it provides a straightforward way to create and share blog posts.

## Features

- **Easy Posting**: Write and publish blog posts effortlessly.
- **Customizable**: Utilizes Bootstrap for easy customization of the look and feel.
- **Open for Contributions**: Anyone is welcome to contribute to the project in any way they see fit.

[try it here](https://blogbreeze.utigernils.ch/)

## Getting Started

To set up BlogBreeze on your local machine, follow these steps:

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/BlogBreeze.git
    ```

2. **Configure the database:**

    ```bash
    # Copy the environment template
    cp .env.example .env
    
    # Edit .env with your database credentials
    nano .env
    ```
    
    Set the following values in your `.env` file:
    ```
    DB_HOST=localhost
    DB_NAME=your_database_name
    DB_USER=your_username
    DB_PASS=your_password
    ```
    
    For detailed database setup instructions, see [DATABASE_CONFIG.md](DATABASE_CONFIG.md).

3. Ensure you have Bootstrap installed. If not, you can download it from the [Bootstrap website](https://getbootstrap.com/).

4. Navigate to the `index.php` file and open it in your preferred browser.

## Contributing

Contributions to BlogBreeze are welcome! Whether you want to fix a bug, improve an existing feature, or add something entirely new, simply fork the repository, make your changes, and submit a pull request. There are no strict guidelines for contributions, so feel free to be creative!

## Future Development

While I am no longer actively working on BlogBreeze, I may consider reskinning it for use in future projects. If you're interested in collaborating on any potential updates or enhancements, please get in touch!

## License

This project is licensed under the [MIT License](LICENSE).

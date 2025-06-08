# E-Commerce Furniture Website

A modern e-commerce website for furniture with shopping cart functionality built with PHP and MySQL.

## Features

- **Product Display**: Browse furniture products with images and descriptions
- **Shopping Cart**: Add products to cart with quantity management
- **Cart Management**: View, update, and remove items from cart
- **Responsive Design**: Mobile-friendly interface
- **Session Management**: Cart persists across browser sessions
- **Product Categories**: Organized product sections (Popular, New Arrivals, Featured)

## Technologies Used

- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework**: Bootstrap 4
- **Icons**: Font Awesome, Linear Icons
- **Carousel**: Owl Carousel

## Installation

1. Clone the repository:
```bash
git clone https://github.com/Mohamed-aroussi1/e-commerce-test-.git
```

2. Set up your web server (Apache/Nginx) with PHP support

3. Create a MySQL database and import the database structure:
```bash
mysql -u root -p < database.sql
```

4. Configure database connection in `config/database.php`:
```php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'your_username');
define('DB_PASSWORD', 'your_password');
define('DB_NAME', 'furniture_shop');
```

5. Start your web server and navigate to the project directory

## Project Structure

```
├── assets/
│   ├── css/           # Stylesheets
│   ├── js/            # JavaScript files
│   ├── images/        # Product and UI images
│   └── fonts/         # Font files
├── config/
│   └── database.php   # Database configuration
├── includes/
│   ├── session.php    # Session management
│   ├── cart_functions.php    # Cart functionality
│   └── product_functions.php # Product operations
├── process/
│   ├── add_to_cart.php       # Add items to cart
│   ├── update_cart.php       # Update cart items
│   ├── remove_from_cart.php  # Remove single item
│   └── clear_cart.php        # Clear entire cart
├── index.php          # Homepage
├── products.php       # Products page
├── cart.php          # Shopping cart page
└── database.sql      # Database structure
```

## Database Schema

The application uses the following main tables:

- `products`: Store product information (id, name, description, price, image, category)
- `cart`: Store cart items (id, user_id, session_id, product_id, quantity)
- `users`: Store user information (for future authentication)
- `orders`: Store order information (for future checkout functionality)

## Features in Detail

### Shopping Cart
- Add products to cart from any page
- View cart contents in dropdown menu
- Update quantities or remove items
- Clear entire cart with confirmation
- Cart persists across browser sessions

### Product Management
- Display products with images and descriptions
- Organized into categories (Popular, New Arrivals, Featured)
- Responsive product grid layout
- Add to cart functionality on all product displays

### User Interface
- Clean, modern design
- Responsive layout for mobile devices
- Smooth animations and transitions
- User-friendly navigation

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Create a Pull Request

## License

This project is open source and available under the [MIT License](LICENSE).

## Contact

- **Developer**: Mohamed Aroussi
- **Email**: aroussi644@gmail.com
- **GitHub**: [@Mohamed-aroussi1](https://github.com/Mohamed-aroussi1)

## Screenshots

### Homepage
The homepage features a carousel slider, popular products, new arrivals, and featured products sections.

### Shopping Cart
The shopping cart displays product images, names, quantities, and prices with options to update or remove items.

### Products Page
Browse all available products with filtering and search capabilities.

## Future Enhancements

- User authentication and registration
- Order management system
- Payment gateway integration
- Product search and filtering
- Admin panel for product management
- Email notifications
- Product reviews and ratings

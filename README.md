# 🍔 FoodExpress – Online Food Ordering Website

A dynamic, database-driven food ordering web application built with **PHP** and **MySQL**. Customers can register, browse the menu, add items to a cart, place orders and track them, while an admin panel lets the restaurant manage the menu and incoming orders.

---

## 📌 Features

### Customer Side
- User registration, login and logout
- Browse the food menu
- Add items to the shopping cart
- Checkout and place an order
- Order confirmation page
- View past orders
- Track an order's status

### Admin Side
- Separate admin section (`admin/` folder)
- Manage food items and view/manage customer orders

---

## 🛠️ Tech Stack

| Layer      | Technology                |
|------------|---------------------------|
| Frontend   | HTML, CSS, JavaScript     |
| Backend    | PHP                       |
| Database   | MySQL                     |
| Server     | Apache (XAMPP / WAMP / LAMP) |

---

## 📁 Project Structure

```
food-ordering-website/
│
├── admin/              # Admin panel files
├── css/                # Stylesheets
├── images/             # Food images, logos and other assets
├── includes/           # Reusable PHP files (shared across pages)
├── js/                 # JavaScript files
│
├── index.php           # Home page
├── register.php        # User registration
├── login.php           # User login
├── logout.php          # User logout
├── menu.php            # Food menu
├── cart.php            # Shopping cart
├── checkout.php        # Checkout page
├── place_order.php     # Handles order placement
├── order_success.php   # Order confirmation page
├── orders.php          # User's order history
├── track_order.php     # Order tracking form
├── track_result.php    # Order tracking result
├── food_order_db.sql   # Database schema and sample data
└── README.md
```

---

## ⚙️ Installation & Setup

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) (or WAMP / LAMP) with Apache and MySQL
- A web browser

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/Pardeep-DS/<your-repo-name>.git
   ```

2. **Move the project to your server folder**
   Copy the project folder into `htdocs` (XAMPP) or `www` (WAMP).

3. **Start Apache and MySQL** from the XAMPP/WAMP control panel.

4. **Create the database**
   - Open **phpMyAdmin** at `http://localhost/phpmyadmin`
   - Create a new database named `food_order_db`
   - Click **Import** and select `food_order_db.sql`

5. **Configure the database connection**
   Open the database connection file (inside `includes/`) and make sure the credentials match your setup:
   ```php
   $host = "localhost";
   $user = "root";
   $password = "";
   $database = "food_order_db";
   ```

6. **Run the project**
   Open your browser and visit:
   ```
   http://localhost/<your-project-folder>/
   ```

---

## 🚀 Usage

1. **Register** a new account and **log in**.
2. Open the **Menu** and add your favourite dishes to the cart.
3. Go to the **Cart**, review items and proceed to **Checkout**.
4. Place the order and note your order ID on the success page.
5. Use **Track Order** to check the status of your order, or view all orders under **My Orders**.
6. Admins can log in through the `admin/` section to manage the menu and orders.

---

## 📸 Screenshots

_Add screenshots of your home page, menu, cart and admin panel here._

```
![Home Page](images/screenshots/home.png)
```

---

## 🔮 Future Improvements

- Online payment gateway integration
- Password hashing and stronger input validation
- Email/SMS order notifications
- Ratings and reviews for dishes
- Responsive design improvements for mobile


---

## 👤 Author

**Pardeep**
GitHub: [@Pardeep-DS](https://github.com/Pardeep-DS)

---

⭐ If you found this project useful, consider giving it a star!

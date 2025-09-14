# Inventory Management Application

This is a simple multi‑branch inventory management system built with **PHP 7.1** and the **CodeIgniter 3.x** framework.  It allows you to manage stock levels in multiple stores and transfer items between branches.  There are three user roles with different permissions:

* **Superadmin** – full access to all data; can manage users, stores, products and perform stock transfers.
* **Owner** – read‑only access to all inventory; can filter by store and export or print reports.
* **Admin** – manages inventory in a single store; can add, edit and delete products for their assigned branch.

## Getting started

1. **Install CodeIgniter**

   Download the official CodeIgniter 3.x release from the project web site and extract it into the root of this repository.  The `system` folder is not included here to keep the repository small.

2. **Configure the application**

   Copy the `application/config/config.php` and `application/config/database.php` files from the CodeIgniter distribution.  Use the versions in this repository as a starting point and update the `base_url`, `encryption_key` and database credentials.

3. **Create the database**

   The file `database.sql` contains the SQL statements needed to create the tables used by the application.  Execute it in your MySQL or MariaDB server:

   ```shell
   mysql -u your_user -p your_database < database.sql
   ```

4. **Set up user accounts**

   After creating the tables, insert at least one superadmin account into the `users` table.  Passwords should be hashed using PHP’s `password_hash()` function.

5. **Run the application**

   Point your web server’s document root to the `inventory_app` folder or configure an alias.  You should now be able to log in at `/auth/login`.

## Directory structure

```
inventory_app/
├── application/
│   ├── config/           # Application and database configuration
│   ├── controllers/      # Controller classes (auth, products, inventory, etc.)
│   ├── models/           # Model classes (User_model, Product_model, etc.)
│   ├── views/            # View templates organised by module
│   └── …
├── database.sql          # SQL schema for the application
├── index.php             # Front controller (entry point) that boots CodeIgniter
└── README.md             # This file
```

The controllers, models and views included here provide a starting point for building out the full feature set described in the specification.  Each file contains comments and stub methods that outline the intended functionality.

## Notes

* This project uses a lightweight **MVC** architecture provided by CodeIgniter.  According to CodeIgniter documentation the framework implements the Model‑View‑Controller pattern, which separates data access, business logic and presentation layers【907651110350654†L1383-L1413】.  Controllers receive user input, interact with models to retrieve or update data, and pass that data to views for display.
* Centralised inventory management makes it easier to track stock levels across multiple branches and supports *seamless stock transfers between locations*【582851972206243†L136-L145】.  A superadmin can initiate a transfer that decrements stock in the source store and increments stock in the destination.
* To keep the system responsive, you may wish to use AJAX (via jQuery) for forms and tables.  DataTables can be added for searchable, paginated listings.

Feel free to expand on these stubs and add features such as authentication, validation, and logging.
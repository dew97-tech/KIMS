# Kandari Inventory Management System (KIMS) 📦📊

Welcome to the Kandari Inventory Management System (KIMS), a comprehensive inventory management solution designed with a focus on responsiveness and ease of use. This system provides a robust platform for managing products, categories, brands, units, suppliers, purchases, orders, and customers, along with sales management. 

## Features 🌟

* **Products**: Manage your product catalog effectively with detailed product information.
* **Category**: Organize your products into various categories for easy retrieval.
* **Brands**: Keep track of different brands associated with your products.
* **Units**: Measure and manage your products in various units.
* **Suppliers**: Maintain records of your suppliers for seamless procurement.
* **Purchases**: Track your purchase activities and manage your inventory accordingly.
* **Orders**: Handle customer orders efficiently and accurately.
* **Customers**: Manage your customer base and their transactions.
* **Sales Management**: Monitor your sales activities and generate reports.
* **User Authentication**: Secure sign-up and sign-in processes.
* **Role Changes**: Assign roles and permissions to users for efficient access control.

## Installation and Usage 🚀

To get started with KIMS, clone the repository from GitHub:
```bash
git clone https://github.com/dew97-tech/KIMS.git
```
Follow the mentioned instructions to run:
1. Open terminal
2. Run: `https://github.com/dew97-tech/KIMS.git`
3. Run: `cd KIMS`
4. Run: `composer install`
5. Run: `cp .env.example .env`
6. Update .env with you database information
7. Run: `php artisan key:generate`
8. Run: `php artisan migrate`
9. Run: `php artisan db:seed --class=UserRoleSeeder`
10. Run: `php artisan serve`
11. Open browser
12. Go to link http://localhost:8000
After cloning the repository, navigate to the project directory and install the required dependencies. You can then run the application locally.

## Contribution 🤝

Contributions are always welcome! Please read the contribution guidelines before getting started.

## License 📄

This project is licensed under the MIT License - see the LICENSE file for details.

For more details about KIMS, visit the [repository](https://github.com/dew97-tech/KIMS).
```

Feel free to use this Markdown content for your project's README.md file.

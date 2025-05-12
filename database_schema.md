# Database Schema Overview

## ERD Diagram
![image alt](https://github.com/nasrulirfan/interview-case-study/blob/nasrul/dev/ERD%20Diagram%20-%20Supplycart%20Interview.png?raw=true)

## 1. Core Entities: Users, Products, and Orders

### `Users` Table
This table is standard for user management. It stores the user's name, email (which is unique), and a hashed password. It also includes `email_verified_at` for email verification and standard Laravel timestamps (`created_at`, `updated_at`).
*   **Consideration:** The email being unique is crucial for login and account identification.

### `Products` Table
This table holds all items for sale. Each product features a name, a slug (for SEO-friendly URLs, also unique), a description, its `price_in_cents`, and `stock_quantity`.
*   **Key Consideration:** Storing `price_in_cents` as an integer avoids floating-point precision issues common with currency, which is a best practice.
The table also links to `Categories` and `Brands` for organization.

### `Orders` Table
When a user makes a purchase, an order is created. It links to the `user_id` who placed it, stores the `total_amount_in_cents` for the entire order, and has a status (e.g., 'pending', 'completed', 'shipped').

### `OrderItems` Table (Pivot Table)
This crucial pivot table links `Orders` and `Products`, managing their many-to-many relationship (an order can have many products, and a product can be in many orders).
For each product in an order, it stores the `quantity` and, importantly, the `price_at_purchase_in_cents`.
*   **Key Consideration:** Storing `price_at_purchase_in_cents` here is vital because product prices can change over time. This ensures a historical record of what the user actually paid for that item in that specific order.

## 2. Product Organization & Details

### `Categories` & `Brands` Tables
These are simple lookup tables to help organize products. A product belongs to one category and one brand, aiding in filtering and site navigation.
They also feature slugs for SEO-friendly URLs for category/brand pages.

### `Attributes` & `AttributeValues` Tables (for Product Variants/Filtering)
This provides a flexible way to define product characteristics beyond just category and brand.
*   **`Attributes` Table:** Defines characteristics like 'Color' or 'Size'.
*   **`AttributeValues` Table:** Lists specific options for attributes, such as 'Red' or 'Blue' for 'Color', or 'Small' or 'Medium' for 'Size'. An attribute value belongs to one attribute (e.g., 'Red' belongs to 'Color').

### `ProductAttributeValues` Table (Pivot Table)
This pivot table links `Products` to `AttributeValues`. A product can have many attribute values (e.g., a T-shirt can be 'Red' AND 'Large'), and an attribute value can be applied to many products.
*   **Consideration:** This design allows for rich product filtering and displaying variants without needing a large number of columns on the `Products` table itself.

## 3. User-Specific & Bonus Features

### `UserActivityLogs` Table
This table is for auditing or tracking user actions, such as 'login', 'order_placed', etc. It stores the `user_id` who performed the action, details about the action in a flexible `jsonb` format, their IP address, and user agent.
*   **Consideration:** Using `jsonb` for details (especially with PostgreSQL) is beneficial due to its schemaless nature and efficient queryability, allowing for varied information storage for different actions.

### `UserProductPrices` Table (Pivot Table)
This table enables differential pricing. It allows setting a specific `price_in_cents` for a particular `product_id` for a specific `user_id`.
*   **Consideration:** This is useful for B2B scenarios, VIP customers, or special promotions targeted at individual users.

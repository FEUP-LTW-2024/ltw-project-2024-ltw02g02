# Project Name

Hand2Hand

## Group ltw02g02

- Gabriel Braga (up202012345) 33.3%
- Guilherme Rego (up202012345) 33.3%
- Diogo Ramos (up202012345) 33.3%

## Install Instructions

    -git clone <https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw02g02.git>
    -git checkout final-delivery-v1
    -sqlite database.db < database.sql
    -wsl
    -php -S localhost:9000


## Screenshots

(2 or 3 screenshots of your website)

## Implemented Features

**General**:

- [✔] Register a new account.
- [✔] Log in and out.
- [✔] Edit their profile, including their name, username, password, and email.

**Sellers**  should be able to:

- [✔] List new items, providing details such as category, brand, model, size, and condition, along with images.
- [✔] Track and manage their listed items.
- [✔] Respond to inquiries from buyers regarding their items and add further information if needed.
- [ ] Print shipping forms for items that have been sold.

**Buyers**  should be able to:

- [✔] Browse items using filters like category, price, and condition.
- [✔] Engage with sellers to ask questions or negotiate prices.
- [✔] Add items to a wishlist or shopping cart.
- [ ] Proceed to checkout with their shopping cart (simulate payment process).

**Admins**  should be able to:

- [ ] Elevate a user to admin status.
- [ ] Introduce new item categories, sizes, conditions, and other pertinent entities.
- [✔] Oversee and ensure the smooth operation of the entire system.

**Security**:
We have been careful with the following security aspects:

- [✔] **SQL injection**
- [✔] **Cross-Site Scripting (XSS)**
- [✔] **Cross-Site Request Forgery (CSRF)**

**Password Storage Mechanism**: password_hash

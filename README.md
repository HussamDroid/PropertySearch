# 🏠 Property Recommendation System - Qatar
**LJMU Computer Science - Individual Project**

A full-stack web application developed to provide data-driven property recommendations in the Qatar real estate market. The system allows users to discover, filter, and save properties in key regions such as Lusail, The Pearl, and West Bay.

---

## 🚀 Core Features
- **Dynamic Search & Filtering:** Filter 18+ properties by location (e.g., Lusail, West Bay, Al Waab) and property type (Villa, Apartment, Penthouse).
- **Recommendation Engine:** Displays properties ranked by a custom recommendation score (1-10) to guide user decision-making.
- **User Personalization:** - Secure Login/Session management.
  - "Favorites" system allowing users to save and remove properties from their profile.
  - Personalized homepage dashboard showing the user's last saved property.
- **Interactive Details:** High-quality image carousels for interior views (Bedrooms, Kitchens, etc.).
- **Responsive Design:** Fully mobile-friendly UI built with Bootstrap 5.

---

## 🛠️ Technical Stack
- **Backend:** PHP 8.x (Procedural with MySQLi)
- **Database:** MySQL / MariaDB (Relational structure with Foreign Keys)
- **Frontend:** HTML5, CSS3, Bootstrap 5.3, Bootstrap Icons
- **Environment:** Developed on XAMPP (Apache Server)
- **Version Control:** Git & GitHub

---

## 📋 Installation & Setup (Local Environment)

**Repository Link:** https://github.com/HussamDroid/PropertySearch

To run this project locally on XAMPP, follow these steps:

1. **Clone the Repository:**
   Place the project folder into your XAMPP `htdocs` directory:
   `C:\xampp\htdocs\PropertyRecommendation`

2. **Database Configuration:**
   - Open **phpMyAdmin** (`localhost/phpmyadmin`).
   - Create a new database named: `property_recommendation`.
   - Click the **Import** tab and select the `property_recommendation.sql` file located in the root of this project.

3. **Asset Setup:**
   - Ensure the `assets/images/` folder contains the property thumbnails (`property1.jpg` to `property18.jpg`).
   - Bootstrap CSS and JS are linked locally in `assets/css` and `assets/js` for **Offline Mode** compatibility.

4. **Launch:**
   - Start Apache and MySQL from the XAMPP Control Panel.
   - Open your browser and navigate to: `http://localhost/PropertyRecommendation/index.php`

---

## 📁 Project Structure
- `index.php` - Homepage with search filters and featured listings.
- `property.php` - Detailed view with image carousels and favorites logic.
- `header.php` / `footer.php` - Global layout and database connection.
- `assets/` - Local copies of Bootstrap, Icons, and Property Images.
- `property_recommendation.sql` - Database schema and sample data export.

---
**Author:** Hussam  

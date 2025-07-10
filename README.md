# Graduate Thesis Scraper Project

This project is a Laravel-based web application that fulfills the following tasks as part of a university assignment:

## Project Overview

The application connects to the website https://stup.ferit.hr/zavrsni-radovi/page/$number/ (where $number is from 2 to 6), scrapes graduate thesis information, and stores it in a MySQL database. The data is then displayed on a web page within the application.

## Main Tasks Completed

- **iRadio Interface:**
  - Created an interface (`iRadio`) with `create`, `save`, and `read` methods.
- **GraduateThesis Class:**
  - Implemented the `iRadio` interface.
  - Contains properties: `work_name`, `work_text`, `work_link`, and `identification_number`.
  - Handles creation, saving, and reading of thesis records.
- **Database Integration:**
  - Created a MySQL table `graduate_theses` with the required fields.
  - Used Laravel migrations for database schema management.
- **Web Scraping:**
  - Used cURL and the `simplehtmldom` library to fetch and parse HTML from the target website.
  - Extracted thesis data from multiple pages (2 to 6).
- **Artisan Command:**
  - Developed a custom Artisan command to automate the scraping and saving process.
- **Web Display:**
  - Added a `/theses` route to display all saved theses in a user-friendly web page using a Blade template.

## How to Use

1. Run the Laravel development server:
   ```
   php artisan serve
   ```
2. Fetch and save thesis data:
   ```
   php artisan app:fetch-theses
   ```
3. View the results in your browser:
   - Go to [http://127.0.0.1:8000/theses](http://127.0.0.1:8000/theses)

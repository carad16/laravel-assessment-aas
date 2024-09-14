# Laravel Position Management

## Setup

### Installation

1. **Clone the Repository**

    - git clone https://github.com/carad16/laravel-assessment-aas.git

    - cd your-repo-name

2. **Install PHP Dependencies**

    - composer install

3. **Install Frontend Dependencies**
    - npm install
        
    - npm run dev

4. **Set Up Environment**
    - Copy `.env.example` to `.env` and update it with your database and application settings:

    - cp .env.example .env

5. **Generate Application Key**
    - php artisan key:generate

6. **Run Migrations**
    - php artisan migrate

7. **Start the Server**
    - php artisan serve or php artisan --host= --port=8080

Visit `http://localhost:8000` in your browser.

## Configuration

Update the following in your `.env` file:

- `DB_DATABASE`: Your database name (organization_chart)
- `DB_USERNAME`: Your database user (root)
- `DB_PASSWORD`: Your database password ()

## Usage

- **Create/Update Position**: Use the form to manage positions.
- **Delete Position**: Click the "Delete" button next to a position.
- **Filter Positions**: Use the dropdown filter.
- **View Chart**: View the organization chart on the page.

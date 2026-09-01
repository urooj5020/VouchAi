# VouchAI 🚀
### AI-Powered Testimonial & Social Proof Platform

Turn client reviews and testimonials into high-converting marketing assets with automated AI sentiment analysis, pull-quote generation, social snippets, and embeddable widgets.

---

## 🌟 Features

- **📨 Dedicated Collection Links:** Send branded, public review forms to clients for verified star ratings, feedback, and photos.
- **🧠 AI Insights & Pull-Quotes:** Automatically extract 1-line catchy quotes and analyze sentiment using AI.
- **📱 Social Media Post Generator:** Automatically drafts copy tailored for LinkedIn and X (Twitter) based on customer reviews.
- **🎨 Embeddable Review Widgets:** Embed beautiful testimonial grids, masonry cards, and carousels onto any website with lightweight code snippets.
- **📊 Interactive Dashboard:** Manage submissions, curate approved reviews, and monitor conversion metrics.
- **🌓 Dark / Light Mode Support:** Built with modern Tailwind CSS and full theme switching support.

---

## 🛠️ Tech Stack

- **Backend:** [Laravel 12](https://laravel.com) (PHP 8.2+)
- **Authentication:** [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)
- **Frontend & Styling:** Blade, [Tailwind CSS](https://tailwindcss.com), [Vite](https://vitejs.dev)
- **Database:** MySQL / SQLite
- **Testing:** [Pest PHP](https://pestphp.com)

---

## 🚀 Getting Started

### Prerequisites

Ensure you have the following installed on your machine:
- **PHP** >= 8.2
- **Composer**
- **Node.js** & **npm**

---

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/urooj5020/VouchAi.git
   cd VouchAi
   ```

2. **Install PHP and Node dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Database Migrations:**
   ```bash
   php artisan migrate
   ```

5. **Start the Development Server:**
   ```bash
   # Run both Laravel and Vite dev servers concurrently:
   npm run dev
   ```
   *(Alternatively: `php artisan serve` in one terminal and `npm run dev` in another)*

6. **Visit the application:**
   Open your browser and navigate to [http://localhost:8000](http://localhost:8000).

---

## 🧪 Running Tests

Run the test suite using [Pest](https://pestphp.com):

```bash
php artisan test
```

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

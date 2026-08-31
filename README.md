# StayKos

## 📌 Description

A modern rental property management and booking platform designed to streamline room discovery and simplify reservation workflows for both tenants and property owners. The platform serves as an all-in-one solution for browsing available accommodations, processing bookings, and managing property listings efficiently.

---

## 🛠️ Tech Stack

| Category                     | Technologies Used         |
| :--------------------------- | :------------------------ |
| 🌐 **Programming Languages** | `PHP`, `JavaScript`       |
| 🔩 **Templating**            | `Blade`                   |
| 🧩 **Frameworks**            | `Laravel`, `Tailwind CSS` |
| ⚛️ **Libraries**             | `Filament`, `Swiper`      |
| 🗄️ **Database**              | `MySQL`                   |
| ⚡ **Tool**                  | `Laragon`                 |
| 💸 **Payment Gateway**       | `Midtrans`                |
| 🔔 **Notification Service**  | `Twilio`                  |
| 🚧 **Tunneling Service**     | `ngrok`                   |

---

## ⚙️ Setup Instructions

1. **Prerequisites**
    - PHP 8.3 installed on your system.
    - Git installed on your system.
    - Composer installed on your system.
    - Apache HTTP Server installed and running on your system.
    - MySQL installed and running on your system.
    - An active [Twilio](https://www.twilio.com/en-us) account and WhatsApp Sandbox.

2. **Twilio Account Setup**
    - Visit the official [Twilio website](https://www.twilio.com/en-us).
    - Sign up for a new account or log in to your existing account.
    - Once redirected to the console dashboard, copy your **Account SID** and **Auth Token** to use during the configuration phase.
    - Navigate to **Messaging > Overview** from the left navigation panel and click **Try WhatsApp**.
    - Follow the prompts to configure your WhatsApp Sandbox and copy the provided Twilio WhatsApp number for environment setup.

3. **Clone the Repository**

```bash
git clone https://github.com/Fikri-Rouzan/staykos.git
cd staykos
```

4. **Install Packages**

```bash
composer install
```

5. **Copy Environment File**

```bash
cp .env.example .env
```

6. **Generate Application Key**

```bash
php artisan key:generate
```

7. **Configure Environment Variables**

    Open the `.env` file and configure the following variables

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=

    TWILIO_ACCOUNT_SID="YOUR_TWILIO_ACCOUNT_SID"
    TWILIO_AUTH_TOKEN="YOUR_TWILIO_AUTH_TOKEN"
    TWILIO_WHATSAPP_NUMBER="whatsapp:+YOUR_TWILIO_WHATSAPP_NUMBER"

    MIDTRANS_SERVER_KEY="YOUR_MIDTRANS_SERVER_KEY"
    MIDTRANS_IS_PRODUCTION=false
    MIDTRANS_IS_SANITIZED=true
    MIDTRANS_IS_3DS=true
    ```

8. **Run Migrations**

```bash
php artisan migrate
```

9. **Create Filament Admin User**

```bash
php artisan make:filament-user
```

10. **Create Storage Link**

```bash
php artisan storage:link
```

11. **Run the Program**

```bash
php artisan serve
```

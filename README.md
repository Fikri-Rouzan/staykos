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
    - An active [Midtrans](https://midtrans.com) account.
    - An active [ngrok](https://ngrok.com/) account and ngrok CLI installed on your system.

2. **Twilio Account Setup**
    - Visit the official [Twilio website](https://www.twilio.com/en-us).
    - Sign up for a new account or log in to your existing account.
    - Once redirected to the console dashboard, copy your **Account SID** and **Auth Token** to use during the configuration phase.
    - Navigate to **Messaging > Overview** from the left navigation panel and click **Try WhatsApp**.
    - Follow the prompts to configure your WhatsApp Sandbox and copy the provided Twilio WhatsApp number for environment setup.

3. **Midtrans Account Setup**
    - Visit the official [Midtrans website](https://midtrans.com).
    - Sign up for a new account or log in to your existing account.
    - Once in the dashboard, locate the **Environment** menu on the left panel and select **Sandbox**.
    - Navigate to **Settings > Access Keys** on the left sidebar.
    - Copy the generated **Server Key** to use during the environment configuration phase.

4. **ngrok CLI & Authtoken Setup**
    - Visit the official [ngrok website](https://ngrok.com).
    - Sign up for a new account or log in to your existing account.
    - Once redirected to the dashboard, select the **Share Localhost** menu, follow the instructional steps, and ensure you select the **Command Line** platform.
    - Follow the installation and setup steps only up to configuring your authtoken in the terminal.

5. **Clone the Repository**

```bash
git clone https://github.com/Fikri-Rouzan/staykos.git
cd staykos
```

6. **Install Packages**

```bash
composer install
```

7. **Copy Environment File**

```bash
cp .env.example .env
```

8. **Generate Application Key**

```bash
php artisan key:generate
```

9. **Configure Environment Variables**

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

10. **Run Migrations**

```bash
php artisan migrate
```

11. **Create Filament Admin User**

```bash
php artisan make:filament-user
```

12. **Create Storage Link**

```bash
php artisan storage:link
```

13. **Run the Program**

```bash
php artisan serve
```

14. **Start ngrok Tunneling**

```bash
ngrok http 8000
```

15. **Midtrans Redirect & Notification URL Setup with ngrok**

- Copy the **Forwarding URL** provided by ngrok.
- Return to the Midtrans Sandbox dashboard, navigate to **Settings > Snap Preferences > System Settings**, and scroll down to **Redirection Settings**.
- Paste your ngrok URL into the **Finish URL** field and save changes. For example:
    ```text
    https://your-subdomain.ngrok-free.app/booking-success
    ```
- Navigate to **Settings > Payment > Notification URL**.
- Paste your ngrok URL into the **Payment notification URL** field and save changes. For example:
    ```text
    https://your-subdomain.ngrok-free.app/api/midtrans-callback
    ```

16. **Midtrans Payment Simulation**

- Visit the official [Midtrans Payment Simulator](https://simulator.sandbox.midtrans.com).
- Select your desired payment channel matching the payment method selected in your application to simulate transactions.

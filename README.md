## PHP Application with Session Management and Authentication

This is a sample PHP application that handles sessions, performs authentication, and serves static files. It features a basic challenge-response mechanism to securely grant access to a protected HTML page (`app.htm`).

### Features

* **Session Management**: Stores user session data on the server using PHP sessions.
* **Challenge-Response Authentication**: Uses a SHA-256 hashed digest to verify credentials.
* **Login Mechanism**: `/login` endpoint processes authentication requests.
* **Access Control**: Grants access to `/webservice.php` only after successful authentication.

### Getting Started

1. Clone or download this repository.
2. Use a web server with PHP support (e.g., Apache, Nginx with PHP-FPM).
3. Create a directory on your web server (e.g., `/login`).
4. Copy the application files into this directory.

### Authentication Flow

* **AppChallenge**:
  `GET /login.php?mt=AppChallenge`
  The server responds with a randomly generated challenge string.

* **AppLogin**:
  `GET /login.php?mt=AppLogin&user=...&response=...`
  The client sends credentials and a hashed response. The server validates it using SHA-256 and returns either a success or failure.

### Endpoints

* **/index.htm**: Login page for your web service.
* **/login.php**:

  * `GET ?mt=AppChallenge`: Initiates the authentication challenge.
  * `GET ?mt=AppLogin`: Validates user login.
* **/phpsession.js**: Client-side JavaScript that handles the authentication process.
* **/webservice.php**: A protected page accessible only after successful login. Returns HTTP 403 if unauthorized.

### Session Management

* `$_SESSION["authenticated"]`: Boolean flag indicating authentication status.
* `$_SESSION[...]`: Can be used to store additional user-related session data for application logic.

### Integration in MyApps / PBX Environment

1. Create a new app object in your PBX system.
2. Define an application name of your choice.
3. Set the shared password (e.g., `pwd`) in both PBX and `login.php`.
4. Use the appropriate web service URL (e.g., `https://192.168.2.100/login/index.htm`), adjusting the IP as needed.

### License

This project is free to use, modify, and distribute without restriction.

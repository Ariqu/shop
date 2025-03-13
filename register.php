<?php
require 'database/db.php'; // Plik do połączenia z bazą danych

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa_uzytkownika = $_POST['username'];
    $haslo = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "INSERT INTO uzytkownicy (nazwa_uzytkownika, haslo, email) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nazwa_uzytkownika, $haslo, $email]);

    header("Location: login.php");
    exit(); // Dodaj exit() po nagłówkach
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <?php include 'style/required_style.php'; ?>
    <style>
      /* Kontener dla całej strony */
      .container {
        display: flex;
        height: 100vh;
        margin: 0; /* Dodaj margines 0, aby uniknąć dodatkowych odstępów */
      }

      /* Lewe tło z napisem */
      .left-side {
        width: 50%; /* Szerokość lewej strony ustawiona na 50% */
        background-color: black;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
      }

      /* Prawe tło z formularzem */
      .right-side {
        width: 50%; /* Szerokość prawej strony ustawiona na 50% */
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f9f9f9;
      }

      /* Formularz */
      .form-container {
        background-color: white;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
      }

      /* Styl dla komunikatu o błędzie */
      .error-message {
        color: red;
        margin-top: 1rem;
      }
    </style>
</head>
<body>
<?php include 'components/navbar.php'; ?>
  <div class="container">
    <!-- Lewe tło: czarne z napisem "REJESTRACJA" -->
    <div class="left-side">
      <h1 class="text-4xl font-bold">REJESTRACJA</h1>
    </div>

    <!-- Prawe tło: formularz rejestracji -->
    <div class="right-side">
      <form action="register.php" method="POST" class="form-container">
        <div class="mb-5">
          <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Nazwa użytkownika</label>
          <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Twoja nazwa użytkownika" required />
        </div>
        <div class="mb-5">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Hasło</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Twoje hasło" required />
        </div>
        <div class="mb-5">
          <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
          <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Twój email" required />
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Zarejestruj się</button>
      </form>
    </div>
  </div>
  <?php include 'components/required_scripts.php'; ?>
</body>
</html>

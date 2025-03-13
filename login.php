<?php
session_start();
require 'database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa_uzytkownika = $_POST['username'];
    $haslo = $_POST['password'];

    $sql = "SELECT * FROM uzytkownicy WHERE nazwa_uzytkownika = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nazwa_uzytkownika]);
    $uzytkownik = $stmt->fetch();

    if ($uzytkownik && password_verify($haslo, $uzytkownik['haslo'])) {
        $_SESSION['user_id'] = $uzytkownik['id'];
        header("Location: index.php");
        exit(); // Dodaj exit() po nagłówkach
    } else {
        $error_message = "Błędna nazwa użytkownika lub hasło.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
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
<body class="bg-gray-100">
<?php include 'components/navbar.php'; ?>

    <div class="container">
    <!-- Lewe tło: czarne z napisem "LOGOWANIE" -->
    <div class="left-side">
      <h1 class="text-4xl font-bold">LOGOWANIE</h1>
    </div>

    <!-- Prawe tło: formularz logowania -->
    <div class="right-side">
      <form action="login.php" method="POST" class="form-container">
        <div class="mb-5">
          <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Nazwa użytkownika</label>
          <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Twoja nazwa użytkownika" required />
        </div>
        <div class="mb-5">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Hasło</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Twoje hasło" required />
        </div>
        <div class="flex items-start mb-5">
          <div class="flex items-center h-5">
            <input id="remember" type="checkbox" name="remember" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" />
          </div>
          <label for="remember" class="ms-2 text-sm font-medium text-gray-900">Zapamiętaj mnie</label>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Zaloguj się</button>
        <?php if (isset($error_message)) : ?>
          <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
      </form>
    </div>
  </div>
  <?php include 'components/required_scripts.php'; ?>
</body>
</html>

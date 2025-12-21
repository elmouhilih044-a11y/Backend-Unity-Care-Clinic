<?php
require_once "db.php";
require_once "auth.php";

if (isLoggedIn()) {
    header("Location: index.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        if ($password === $user['password']) {
            login($user['user_id'], $user['username']);
            header("Location: index.php");
            exit();
        }
    }
    
    $error = "Nom d'utilisateur ou mot de passe incorrect";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Unity Care | Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    
<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-3xl font-bold text-blue-900 mb-2 text-center">Unity Care</h1>
    <p class="text-gray-600 text-center mb-6">Connexion</p>
    
    <?php if ($error): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Nom d'utilisateur</label>
            <input type="text" name="username" required 
                   class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 mb-2">Mot de passe</label>
            <input type="password" name="password" required 
                   class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        
        <button type="submit" 
                class="w-full bg-blue-900 text-white py-2 rounded hover:bg-blue-800 transition">
            Se connecter
        </button>
    </form>
    
    <p class="text-sm text-gray-600 mt-4 text-center">
    admin / password
    </p>
</div>

</body>
</html>
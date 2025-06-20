<?php
// Database connection details
$host = "localhost";
$user = "root";
$password = ""; // Dir password dyalek ila 3ndek chi wa7ed l root, sinon khelliha khawya
$database = "efm"; // ⬅️ Make sure this is your DB name

// Lma3lomat dyal l admin li bghiti tzid (KAYTنفذ Mلي الصفحة تفتح)
$admin_email_to_add = 'yasmine@example.com'; // <<< BDEL HADA B EMAIL L7A9I9I DYALEK
$admin_password_plain_to_add = '123'; // <<< BDEL HADA B PASSWORD L7A9I9I DYALEK
$admin_profil_to_add = 'admin';

$admin_password_hashed = password_hash($admin_password_plain_to_add, PASSWORD_DEFAULT);

$add_admin_message = '';
$add_admin_message_type = ''; // 'success' or 'error'

// Kanحاولوا نزيدوا Admin (هاد الجزء كيتنفذ مرة واحدة ملي الصفحة تفتح أول مرة)
// Ila bghiti texecutih ghi mera o safi, dir had lcode f comments من بعد أول تنفيذ ناجح
// اولا دير شي شرط باش ميبقاش ديما كيحاول يزيد نفس الأدمن
// مثال: if (!isset($_SESSION['admin_added_flag'])) { ... $_SESSION['admin_added_flag'] = true; }
// (وخاص تكون session_start() فبداية الملف)

try {
    $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $password, $options);

    $sql = "INSERT INTO utilisateur (email_utilisateur, password_utilisateur, profil) VALUES (:email, :password, :profil)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $admin_email_to_add);
    $stmt->bindParam(':password', $admin_password_hashed);
    $stmt->bindParam(':profil', $admin_profil_to_add);
    $stmt->execute();

    $add_admin_message = "L'admin '" . htmlspecialchars($admin_email_to_add) . "' tzad b naja7!";
    $add_admin_message_type = 'success';

} catch (\PDOException $e) {
    $add_admin_message_type = 'error';
    if ($e->getCode() == 23000 || (isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062)) {
        $add_admin_message = "Mochkil f ajout: Had l'email (" . htmlspecialchars($admin_email_to_add) . ") déja mstakhdem.";
    } else {
        $add_admin_message = "Khata2 تقني f l'ajout dyal l'admin: " . htmlspecialchars($e->getMessage());
    }
}
// Fin dyal code ajout d'admin

// Hna ghadi yji l code dyal verification dyal login FORM ila tsubmitat
// Walakin hna ghadi n affichiw ghi l form. L verification ghadi tkon f "login_process.php"
// اولا تقدر ديرها ف نفس الصفحة ila bghiti tkhli l action dyal l form khawya
// <form action="" method="POST">
// w tdir l verification hna: if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_submit_button_name'])) { ... }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utilisateur.css">
    <title>Gestion Admin & Connexion</title>
    
</head>
<body>
    <!-- Section pour afficher le résultat de l'ajout d'admin -->
    <div class="container">
        <h1>Opération d'Ajout d'Admin (Automatique)</h1>
        <?php if (!empty($add_admin_message)): ?>
            <div class="message <?php echo htmlspecialchars($add_admin_message_type); ?>">
                <?php echo htmlspecialchars($add_admin_message); ?>
            </div>
        <?php else: ?>
            <p>Aucune opération d'ajout d'admin n'a été exécutée ou aucun message à afficher.</p>
        <?php endif; ?>
    </div>

    <!-- Section pour le formulaire de connexion -->
    <div class="login-container">
        <h2>تسجيل الدخول (Connexion)</h2>

        <!-- Hna fin ghadi yban message d lkhata2 dyal LOGIN ila bghiti t affichih b PHP mn login_process.php -->
        <?php
        // Par exemple, si login_process.php redirige avec un paramètre d'erreur:
        // if (isset($_GET['login_error'])) {
        // echo '<div class="login-error-message">' . htmlspecialchars($_GET['login_error']) . '</div>';
        // }
        ?>

        <form action="login_process.php" method="POST">
            <!--
                action="login_process.php": Hada howa l fichier PHP li ghadi ysta9bel lma3lomat
                                           dyal email w password bach ydir l verification.
                                           Khass tkriyi had l fichier.
            -->
            <div class="form-group">
                <label for="login_email">البريد الإلكتروني (Email):</label>
                <input type="email" id="login_email" name="email_utilisateur" placeholder="دخل الإيميل ديالك" required>
            </div>

            <div class="form-group">
                <label for="login_password">كلمة المرور (Password):</label>
                <input type="password" id="login_password" name="password_utilisateur" placeholder="دخل كلمة المرور ديالك" required>
            </div>

            <button type="submit" name="login_submit" class="login-button">دخول (Se Connecter)</button>
        </form>
    </div>

</body>
</html>
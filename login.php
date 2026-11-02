<?php
session_start();
require_once __DIR__ . '/includes/functions.php';

if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cfg  = getConfig();
    $user = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';

    if ($user === ($cfg['username'] ?? 'admin') && $pass === ($cfg['password'] ?? 'admin123')) {
        $_SESSION['logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Username atau password salah.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Link Canva</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --bg:        #F9FAFB;
      --surface:   #FFFFFF;
      --border:    #E5E7EB;
      --text:      #111827;
      --muted:     #6B7280;
      --accent:    #2563EB;
      --accent-h:  #1D4ED8;
      --danger:    #DC2626;
      --radius:    12px;
    }

    body {
      font-family: 'Inter', system-ui, sans-serif;
      background: var(--bg);
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 24px;
    }

    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 44px 40px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.04);
    }

    /* Header */
    .header {
      margin-bottom: 32px;
    }
    .header-logo {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 44px;
      background: var(--accent);
      border-radius: 10px;
      margin-bottom: 20px;
    }
    .header-logo svg {
      width: 22px;
      height: 22px;
      fill: none;
      stroke: #fff;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }
    .header h1 {
      font-size: 1.35rem;
      font-weight: 700;
      color: var(--text);
      letter-spacing: -.3px;
    }
    .header p {
      font-size: .875rem;
      color: var(--muted);
      margin-top: 4px;
    }

    /* Form */
    .form-group {
      margin-bottom: 18px;
    }
    label {
      display: block;
      font-size: .8rem;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 6px;
      letter-spacing: .01em;
    }
    input {
      width: 100%;
      padding: 10px 13px;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 8px;
      color: var(--text);
      font-family: inherit;
      font-size: .9rem;
      outline: none;
      transition: border-color .15s, box-shadow .15s;
    }
    input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(37,99,235,.12);
    }
    input::placeholder {
      color: #C4C9D4;
    }

    /* Error */
    .error {
      display: flex;
      align-items: center;
      gap: 8px;
      background: #FEF2F2;
      border: 1px solid #FECACA;
      color: var(--danger);
      border-radius: 8px;
      padding: 10px 13px;
      font-size: .85rem;
      font-weight: 500;
      margin-bottom: 20px;
    }

    /* Button */
    .btn {
      display: block;
      width: 100%;
      padding: 11px;
      background: var(--accent);
      color: #fff;
      border: none;
      border-radius: 8px;
      font-family: inherit;
      font-size: .9rem;
      font-weight: 600;
      cursor: pointer;
      margin-top: 6px;
      transition: background .15s;
      letter-spacing: .01em;
    }
    .btn:hover { background: var(--accent-h); }
    .btn:active { transform: scale(.99); }
  </style>
</head>
<body>

  <div class="card">
    <div class="header">
      <div class="header-logo">
        <!-- link icon -->
        <svg viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
      </div>
      <h1>Link Canva</h1>
      <p>Masuk untuk mengakses daftar link</p>
    </div>

    <?php if ($error): ?>
      <div class="error">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <?= h($error) ?>
      </div>
    <?php endif; ?>

    <form method="POST" novalidate>
      <div class="form-group">
        <label for="username">Username</label>
        <input
          type="text"
          id="username"
          name="username"
          value="<?= h($_POST['username'] ?? '') ?>"
          placeholder="Masukkan username"
          autocomplete="username"
          required
        >
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="••••••••"
          autocomplete="current-password"
          required
        >
      </div>
      <button type="submit" class="btn">Masuk</button>
    </form>
  </div>

</body>
</html>

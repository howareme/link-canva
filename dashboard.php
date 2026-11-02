<?php
session_start();
require_once __DIR__ . '/includes/functions.php';
requireLogin();

$links = getLinks();
$cfg   = getConfig();
$title    = h($cfg['title']    ?? 'Link Canva');
$subtitle = h($cfg['subtitle'] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --bg:       #F9FAFB;
      --surface:  #FFFFFF;
      --border:   #E5E7EB;
      --text:     #111827;
      --muted:    #6B7280;
      --subtle:   #9CA3AF;
      --accent:   #2563EB;
      --accent-h: #1D4ED8;
      --danger:   #DC2626;
      --radius:   10px;
    }

    body {
      font-family: 'Inter', system-ui, sans-serif;
      background: var(--bg);
      min-height: 100vh;
      color: var(--text);
    }

    /* ── Topbar ─────────────────────────────────────── */
    .topbar {
      background: var(--surface);
      border-bottom: 1px solid var(--border);
      padding: 0 24px;
      height: 56px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .topbar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .brand-icon {
      width: 32px;
      height: 32px;
      background: var(--accent);
      border-radius: 8px;
      display: grid;
      place-items: center;
    }
    .brand-icon svg {
      width: 16px; height: 16px;
      fill: none; stroke: #fff;
      stroke-width: 2.2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }
    .brand-name {
      font-size: .95rem;
      font-weight: 700;
      letter-spacing: -.2px;
      color: var(--text);
    }

    .logout-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 7px 14px;
      background: none;
      border: 1px solid var(--border);
      border-radius: 7px;
      color: var(--muted);
      font-family: inherit;
      font-size: .8rem;
      font-weight: 500;
      cursor: pointer;
      text-decoration: none;
      transition: border-color .15s, color .15s;
    }
    .logout-btn:hover {
      border-color: var(--danger);
      color: var(--danger);
    }
    .logout-btn svg {
      width: 14px; height: 14px;
      fill: none; stroke: currentColor;
      stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
    }

    /* ── Page ────────────────────────────────────────── */
    .page {
      max-width: 600px;
      margin: 0 auto;
      padding: 40px 24px 64px;
    }

    /* ── Page header ─────────────────────────────────── */
    .page-header {
      margin-bottom: 28px;
    }
    .page-header h1 {
      font-size: 1.5rem;
      font-weight: 700;
      letter-spacing: -.4px;
      color: var(--text);
    }
    .page-header p {
      font-size: .875rem;
      color: var(--muted);
      margin-top: 4px;
    }

    /* ── Divider label ───────────────────────────────── */
    .section-label {
      font-size: .7rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: .08em;
      color: var(--subtle);
      margin-bottom: 10px;
    }

    /* ── Link list ───────────────────────────────────── */
    .link-list {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .link-item {
      display: flex;
      align-items: center;
      gap: 14px;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 13px 16px;
      text-decoration: none;
      color: var(--text);
      transition: border-color .15s, box-shadow .15s;
    }
    .link-item:hover {
      border-color: #BFDBFE;
      box-shadow: 0 0 0 3px rgba(37,99,235,.07);
    }

    .link-num {
      font-size: .75rem;
      font-weight: 600;
      color: var(--subtle);
      width: 20px;
      text-align: right;
      flex-shrink: 0;
    }

    .link-icon {
      font-size: 1.2rem;
      width: 36px;
      height: 36px;
      background: var(--bg);
      border: 1px solid var(--border);
      border-radius: 8px;
      display: grid;
      place-items: center;
      flex-shrink: 0;
    }

    .link-body {
      flex: 1;
      min-width: 0;
    }
    .link-title {
      font-size: .9rem;
      font-weight: 600;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .link-url {
      font-size: .75rem;
      color: var(--subtle);
      margin-top: 2px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .link-arrow {
      width: 28px;
      height: 28px;
      display: grid;
      place-items: center;
      border-radius: 6px;
      flex-shrink: 0;
      transition: background .15s;
    }
    .link-item:hover .link-arrow {
      background: #EFF6FF;
    }
    .link-arrow svg {
      width: 14px; height: 14px;
      fill: none;
      stroke: var(--subtle);
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
      transition: stroke .15s;
    }
    .link-item:hover .link-arrow svg {
      stroke: var(--accent);
    }

    /* ── Footer ──────────────────────────────────────── */
    .footer {
      text-align: center;
      margin-top: 48px;
      font-size: .78rem;
      color: var(--subtle);
    }
  </style>
</head>
<body>

  <!-- Topbar -->
  <header class="topbar">
    <div class="topbar-brand">
      <div class="brand-icon">
        <svg viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
      </div>
      <span class="brand-name"><?= $title ?></span>
    </div>

    <a href="logout.php" class="logout-btn">
      <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      Keluar
    </a>
  </header>

  <!-- Content -->
  <main class="page">

    <div class="page-header">
      <h1><?= $title ?></h1>
      <?php if ($subtitle): ?>
        <p><?= $subtitle ?></p>
      <?php endif; ?>
    </div>

    <p class="section-label"><?= count($links) ?> link tersedia</p>

    <div class="link-list">
      <?php foreach ($links as $i => $link): ?>
        <a
          href="<?= h($link['url']) ?>"
          target="_blank"
          rel="noopener noreferrer"
          class="link-item"
        >
          <span class="link-num"><?= $i + 1 ?></span>

          <div class="link-icon"><?= h($link['icon'] ?? '🔗') ?></div>

          <div class="link-body">
            <div class="link-title"><?= h($link['title']) ?></div>
            <div class="link-url"><?= h($link['url']) ?></div>
          </div>

          <div class="link-arrow">
            <svg viewBox="0 0 24 24"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <div class="footer">
      &copy; <?= date('Y') ?> <?= $title ?> &mdash; Temu Ramah Himate
    </div>

  </main>

</body>
</html>

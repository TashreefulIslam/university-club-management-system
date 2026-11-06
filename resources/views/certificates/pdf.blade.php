<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Certificate {{ $certificateNumber }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #0f172a; }
        .page { border: 8px solid #1d4ed8; padding: 48px; text-align: center; }
        .title { font-size: 28px; font-weight: 700; letter-spacing: .15em; color: #1d4ed8; }
        .name { font-size: 36px; font-weight: 700; margin: 32px 0 8px; }
        .meta { font-size: 14px; color: #475569; margin-top: 18px; }
    </style>
</head>
<body>
    <div class="page">
        <div class="title">University Club Management System</div>
        <p class="meta">Certificate of Participation</p>
        <p>This certifies that</p>
        <div class="name">{{ $user->name }}</div>
        <p>successfully participated in</p>
        <div class="name" style="font-size: 28px;">{{ $event->title }}</div>
        <p class="meta">Certificate Number: {{ $certificateNumber }}</p>
        <p class="meta">Issued on {{ now()->format('d M Y') }}</p>
    </div>
</body>
</html>
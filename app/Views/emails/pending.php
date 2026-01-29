<p>Dear <?= esc($appointment['customer_name']) ?>,</p>

<p>Your appointment request has been received and is currently <strong>pending confirmation</strong>.</p>

<ul>
    <li><strong>Date:</strong> <?= esc($appointment['date']) ?></li>
    <li><strong>Time:</strong> <?= esc($appointment['time']) ?></li>
</ul>

<p>We will notify you once your appointment is confirmed. Thank you for choosing our salon!</p>

<p><strong>Salon Team</strong></p>

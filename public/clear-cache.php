<?php
echo "Clearing caches...<br>";
echo shell_exec('cd /var/www/html/clickneat && php artisan route:clear');
echo "<br>";
echo shell_exec('cd /var/www/html/clickneat && php artisan config:clear');
echo "<br>";
echo shell_exec('cd /var/www/html/clickneat && php artisan cache:clear');
echo "<br>";
echo shell_exec('cd /var/www/html/clickneat && php artisan view:clear');
echo "<br>";
echo shell_exec('cd /var/www/html/clickneat && php artisan optimize:clear');
echo "<br>";
echo "All caches cleared!";

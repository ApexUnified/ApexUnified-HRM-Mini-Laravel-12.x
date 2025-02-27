@echo off
echo Switching to Laravel project directory...
cd "C:\ZK_Bio(Naveed_Zioltech_Final)\Human-Resource-System (HRM)"

echo Clearing cache...
php artisan cache:clear

echo Clearing configuration cache...
php artisan config:clear

echo Clearing route cache...
php artisan route:clear

echo Clearing view cache...
php artisan view:clear

echo Running optimize...
php artisan optimize

echo Clearing optimization...
php artisan optimize:clear

echo All Artisan commands executed successfully!
pause

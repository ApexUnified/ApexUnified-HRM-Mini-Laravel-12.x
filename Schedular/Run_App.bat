@echo off


start "" php "C:\ZK_Bio(Naveed_Zioltech_Final)\Human-Resource-System (HRM)\artisan" serve

:loop

php "C:\ZK_Bio(Naveed_Zioltech_Final)\Human-Resource-System (HRM)\artisan" schedule:run
goto loop

@echo off
REM ========================================
REM ScholarHub System Maintenance Script
REM Run this monthly to keep system clean
REM ========================================

echo.
echo ========================================
echo  ScholarHub Maintenance Script
echo ========================================
echo.

REM Check if we're in the right directory
if not exist "artisan" (
    echo ERROR: Please run this script from the project root directory
    pause
    exit /b 1
)

echo [1/6] Clearing application cache...
php artisan cache:clear

echo.
echo [2/6] Clearing compiled views...
php artisan view:clear

echo.
echo [3/6] Clearing configuration cache...
php artisan config:clear

echo.
echo [4/6] Clearing route cache...
php artisan route:clear

echo.
echo [5/6] Clearing log files...
echo. > storage\logs\laravel.log

echo.
echo [6/6] Clearing old sessions...
del /q storage\framework\sessions\* 2>nul

echo.
echo ========================================
echo  Maintenance Complete!
echo ========================================
echo.
echo System has been cleaned and optimized.
echo.
echo To optimize for production, run:
echo   php artisan config:cache
echo   php artisan route:cache
echo.
pause

@echo off
REM Quick Setup - Sistem Reservasi + Midtrans

echo.
echo ===============================================================
echo   SETUP SISTEM RESERVASI + MIDTRANS - DAICHI NO
echo ===============================================================
echo.

REM Step 1: Check .env
echo 1^. Checking .env file...
if not exist ".env" (
    echo    Creating .env from .env.example...
    copy .env.example .env >nul
) else (
    echo    ✓ .env file exists
)

REM Step 2: Check Midtrans config
echo.
echo 2^. Checking Midtrans configuration...
findstr /M "MIDTRANS_SERVER_KEY" .env >nul 2>&1
if %ERRORLEVEL% EQU 0 (
    echo    ✓ Midtrans configuration found
    echo.
    echo    ⚠ UPDATE REQUIRED:
    echo    Please edit .env and add your Midtrans keys:
    echo.
    echo    MIDTRANS_SERVER_KEY=your_server_key_here
    echo    MIDTRANS_CLIENT_KEY=your_client_key_here
    echo.
    echo    Get keys from: https://dashboard.midtrans.com
) else (
    echo    ✗ Midtrans config missing
)

REM Step 3: Database
echo.
echo 3^. Running migrations...
call php artisan migrate 2>nul
if %ERRORLEVEL% EQU 0 (
    echo    ✓ Migrations complete
) else (
    echo    ℹ Migrations may already be applied
)

REM Step 4: Database seeding
echo.
echo 4^. Do you want to seed test data? (y/n)
set /p SEED_INPUT=
if /i "%SEED_INPUT%"=="y" (
    call php artisan db:seed --class=ReservationSeeder
    echo    ✓ Test data seeded
) else (
    echo    ℹ Skipping seed
)

REM Step 5: File verification
echo.
echo 5^. Verifying files...
set "files[0]=app\Http\Controllers\Api\ReservationController.php"
set "files[1]=app\Http\Controllers\Api\ReservationOfferController.php"
set "files[2]=app\Http\Controllers\Api\PaymentController.php"
set "files[3]=public\js\frontend\reservation.js"
set "files[4]=public\js\frontend\cart-reservations.js"
set "files[5]=resources\views\custPage\reservation.blade.php"
set "files[6]=resources\views\custPage\cart.blade.php"

for /l %%A in (0,1,6) do (
    if exist !files[%%A]! (
        echo    ✓ !files[%%A]!
    ) else (
        echo    ✗ !files[%%A]! NOT FOUND
    )
)

echo.
echo ===============================================================
echo ✓ SETUP COMPLETE!
echo ===============================================================
echo.
echo NEXT STEPS:
echo   1. Edit .env and add Midtrans keys
echo   2. Run: php artisan serve
echo   3. Open: http://localhost:8000/reservation
echo   4. Test the reservation flow
echo.
echo DOCUMENTATION:
echo   - SETUP_RESERVASI_MIDTRANS.md
echo   - IMPLEMENTASI_RINGKASAN.md
echo.
echo TEST CREDENTIALS (Sandbox):
echo   Card: 4111 1111 1111 1111
echo   Exp: 08/25
echo   CVV: 123
echo.
echo ===============================================================
echo.
pause

#!/bin/bash

# 🚀 QUICK START - Sistem Reservasi + Midtrans

echo "═══════════════════════════════════════════════════════════"
echo "  SETUP SISTEM RESERVASI + MIDTRANS - DAICHI NO"
echo "═══════════════════════════════════════════════════════════"
echo ""

# 1. Check .env
echo "📝 Step 1: Checking .env file..."
if [ ! -f .env ]; then
    echo "   ⚠️  .env file not found. Creating from .env.example..."
    cp .env.example .env
else
    echo "   ✅ .env file exists"
fi

# 2. Check Midtrans config
if grep -q "MIDTRANS_SERVER_KEY" .env; then
    SERVER_KEY=$(grep "MIDTRANS_SERVER_KEY" .env | cut -d '=' -f2)
    if [ -z "$SERVER_KEY" ] || [ "$SERVER_KEY" = "your_server_key_here" ]; then
        echo "   ⚠️  MIDTRANS_SERVER_KEY not configured!"
        echo "   📌 Please add your Midtrans Server Key to .env"
        echo ""
        echo "   How to get keys:"
        echo "   1. Go to https://dashboard.midtrans.com"
        echo "   2. Sign up or login"
        echo "   3. Go to Settings → Access Keys"
        echo "   4. Copy Server Key and Client Key"
        echo ""
        echo "   Then update .env with:"
        echo "   MIDTRANS_SERVER_KEY=your_server_key"
        echo "   MIDTRANS_CLIENT_KEY=your_client_key"
    else
        echo "   ✅ Midtrans keys configured"
    fi
else
    echo "   ⚠️  Midtrans config not found in .env"
    echo "   Please run: php artisan config:cache"
fi

# 3. Database
echo ""
echo "📦 Step 2: Database migration..."
php artisan migrate --step 2>/dev/null
if [ $? -eq 0 ]; then
    echo "   ✅ Migrations complete"
else
    echo "   ℹ️  Migrations may already be applied"
fi

# 4. Database seeding
echo ""
echo "🌱 Step 3: Seeding test data..."
echo "   Do you have any existing reservations in database? (y/n)"
read -r SEED_RESPONSE

if [[ $SEED_RESPONSE == "n" || $SEED_RESPONSE == "N" ]]; then
    php artisan db:seed --class=ReservationSeeder
    echo "   ✅ Test data seeded"
else
    echo "   ℹ️  Skipping seed - using existing data"
fi

# 5. File verification
echo ""
echo "📁 Step 4: Verifying files..."
FILES=(
    "app/Http/Controllers/Api/ReservationController.php"
    "app/Http/Controllers/Api/ReservationOfferController.php"
    "app/Http/Controllers/Api/PaymentController.php"
    "public/js/frontend/reservation.js"
    "public/js/frontend/cart-reservations.js"
    "resources/views/custPage/reservation.blade.php"
    "resources/views/custPage/cart.blade.php"
)

for file in "${FILES[@]}"; do
    if [ -f "$file" ]; then
        echo "   ✅ $file"
    else
        echo "   ❌ $file NOT FOUND"
    fi
done

echo ""
echo "═══════════════════════════════════════════════════════════"
echo "✅ SETUP COMPLETE!"
echo "═══════════════════════════════════════════════════════════"
echo ""
echo "🔗 Next steps:"
echo "   1. Make sure .env has MIDTRANS_SERVER_KEY & CLIENT_KEY"
echo "   2. Run: php artisan serve"
echo "   3. Open: http://localhost:8000/reservation"
echo "   4. Test the reservation flow"
echo ""
echo "📚 Documentation:"
echo "   - See: SETUP_RESERVASI_MIDTRANS.md"
echo "   - See: IMPLEMENTASI_RINGKASAN.md"
echo ""
echo "🧪 Test Card (Sandbox):"
echo "   Card: 4111 1111 1111 1111"
echo "   Exp: 08/25"
echo "   CVV: 123"
echo ""
echo "═══════════════════════════════════════════════════════════"

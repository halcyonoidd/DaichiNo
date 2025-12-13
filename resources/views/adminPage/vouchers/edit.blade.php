<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Voucher - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/adminPage/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="welcome-card">
            <div class="level">
                <div class="level-left">
                    <div>
                        <h1 class="title is-2">Edit Voucher</h1>
                    </div>
                </div>
                <div class="level-right">
                    <a href="{{ route('admin.vouchers.index') }}" class="button is-info mr-2">
                        <span class="icon is-small">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span>Kembali</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="button is-logout">
                            <span class="icon is-small">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if($errors->any())
            <div class="notification is-danger">
                <button class="delete"></button>
                <strong>Please fix the following errors:</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="field">
                    <label class="label">Voucher Code</label>
                    <div class="control">
                        <input class="input" type="text" name="code" value="{{ old('code', $voucher->code) }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Voucher Name</label>
                    <div class="control">
                        <input class="input" type="text" name="name" value="{{ old('name', $voucher->name) }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Description</label>
                    <div class="control">
                        <textarea class="textarea" name="description">{{ old('description', $voucher->description) }}</textarea>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Discount Type</label>
                    <div class="control">
                        <div class="select">
                            <select name="discount_type" required>
                                <option value="">Select type</option>
                                <option value="percentage" @selected(old('discount_type', $voucher->discount_type) === 'percentage')>Percentage (%)</option>
                                <option value="fixed" @selected(old('discount_type', $voucher->discount_type) === 'fixed')>Fixed Amount ($)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Discount Value</label>
                    <div class="control">
                        <input class="input" type="number" name="discount_value" step="0.01" value="{{ old('discount_value', $voucher->discount_value) }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Validity (Days)</label>
                    <div class="control">
                        <input class="input" type="number" name="validity_days" value="{{ old('validity_days', $voucher->validity_days) }}" required>
                    </div>
                </div>

                <div class="field">
                    <label class="checkbox">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $voucher->is_active))>
                        Active
                    </label>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-success">
                            <span class="icon is-small">
                                <i class="fas fa-save"></i>
                            </span>
                            <span>Update Voucher</span>
                        </button>
                    </div>
                    <div class="control">
                        <a href="{{ route('admin.vouchers.index') }}" class="button is-light">
                            <span>Cancel</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/adminPage/dashboard.js') }}"></script>
</body>
</html>

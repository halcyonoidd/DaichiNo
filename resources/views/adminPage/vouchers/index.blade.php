<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vouchers - Admin Dashboard</title>
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
                        <h1 class="title is-2">Manage Vouchers</h1>
                    </div>
                </div>
                <div class="level-right">
                    <a href="{{ route('admin.vouchers.create') }}" class="button is-success mr-2">
                        <span class="icon is-small">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span>Add Voucher</span>
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="button is-info mr-2">
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
        @if(session('status'))
            <div class="notification is-success">
                <button class="delete"></button>
                {{ session('status') }}
            </div>
        @endif

        <!-- Vouchers Table -->
        <div style="background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            @if($vouchers->count() > 0)
                <div class="table-wrapper">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Discount</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vouchers as $voucher)
                                <tr>
                                    <td><strong>{{ $voucher->code }}</strong></td>
                                    <td>{{ $voucher->name }}</td>
                                    <td>
                                        @if($voucher->discount_type === 'percentage')
                                            <span class="tag is-warning">{{ $voucher->discount_value }}%</span>
                                        @else
                                            <span class="tag is-warning">${{ number_format($voucher->discount_value, 2) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $voucher->validity_days }} days</td>
                                    <td>
                                        @if($voucher->is_active)
                                            <span class="tag is-success">Active</span>
                                        @else
                                            <span class="tag is-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="button is-small is-info">
                                            <span class="icon is-small">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                            <span>Edit</span>
                                        </a>
                                        <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button is-small is-danger" onclick="return confirm('Yakin ingin menghapus voucher ini?')">
                                                <span class="icon is-small">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $vouchers->links() }}
                </div>
            @else
                <div class="has-text-centered" style="padding: 2rem;">
                    <p class="subtitle is-5">Tidak ada voucher yang ditemukan</p>
                    <a href="{{ route('admin.vouchers.create') }}" class="button is-success mt-3">
                        <span class="icon is-small">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span>Buat Voucher Pertama</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script src="{{ asset('js/adminPage/dashboard.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product - Admin Dashboard</title>
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
                        <h1 class="title is-2">Create Product</h1>
                    </div>
                </div>
                <div class="level-right">
                    <a href="{{ route('admin.products.index') }}" class="button is-info">
                        <span class="icon is-small">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span>Back</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div style="background: white; border-radius: 8px; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.05); max-width: 600px; margin: 0 auto;">
            @if($errors->any())
                <div class="notification is-danger">
                    <button class="delete"></button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="field">
                    <label class="label">Product Name</label>
                    <div class="control">
                        <input class="input @error('name') is-danger @enderror" type="text" name="name" value="{{ old('name') }}" required>
                    </div>
                    @error('name')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div class="field">
                    <label class="label">Category</label>
                    <div class="control">
                        <div class="select @error('category') is-danger @enderror">
                            <select name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="sushi_and_sashimi" @selected(old('category') === 'sushi_and_sashimi')>Sushi & Sashimi</option>
                                <option value="ramen_and_noodles" @selected(old('category') === 'ramen_and_noodles')>Ramen & Noodles</option>
                                <option value="grilled_specialties" @selected(old('category') === 'grilled_specialties')>Grilled Specialties</option>
                                <option value="appetizer" @selected(old('category') === 'appetizer')>Appetizer</option>
                                <option value="dessert" @selected(old('category') === 'dessert')>Dessert</option>
                                <option value="drink" @selected(old('category') === 'drink')>Drink</option>
                            </select>
                        </div>
                    </div>
                    @error('category')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="field">
                    <label class="label">Description</label>
                    <div class="control">
                        <textarea class="textarea @error('description') is-danger @enderror" name="description" rows="4">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div class="field">
                    <label class="label">Product Image</label>
                    <div class="control">
                        <input class="input @error('image_path') is-danger @enderror" type="file" name="image_path" accept="image/*">
                    </div>
                    @error('image_path')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Available -->
                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="is_available" value="1" @checked(old('is_available', true))>
                            Available
                        </label>
                    </div>
                </div>

                <!-- Submit -->
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-success">
                            <span class="icon is-small">
                                <i class="fas fa-save"></i>
                            </span>
                            <span>Create Product</span>
                        </button>
                    </div>
                    <div class="control">
                        <a href="{{ route('admin.products.index') }}" class="button is-light">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/adminPage/dashboard.js') }}"></script>
</body>
</html>

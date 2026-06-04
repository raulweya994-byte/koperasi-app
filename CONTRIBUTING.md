# 🤝 Panduan Kontribusi

Terima kasih atas minat Anda untuk berkontribusi pada proyek DISPERINDAGKOP Tolikara! Dokumen ini berisi panduan untuk berkontribusi pada proyek ini.

## 📋 Daftar Isi
- [Code of Conduct](#code-of-conduct)
- [Cara Berkontribusi](#cara-berkontribusi)
- [Development Setup](#development-setup)
- [Coding Standards](#coding-standards)
- [Commit Guidelines](#commit-guidelines)
- [Pull Request Process](#pull-request-process)
- [Bug Reports](#bug-reports)
- [Feature Requests](#feature-requests)

---

## Code of Conduct

Proyek ini mengadopsi [Contributor Covenant Code of Conduct](https://www.contributor-covenant.org/). Dengan berpartisipasi, Anda diharapkan untuk menjunjung kode etik ini.

### Perilaku yang Diharapkan
- Gunakan bahasa yang ramah dan inklusif
- Hormati sudut pandang dan pengalaman yang berbeda
- Terima kritik konstruktif dengan baik
- Fokus pada yang terbaik untuk komunitas
- Tunjukkan empati terhadap anggota komunitas lainnya

### Perilaku yang Tidak Dapat Diterima
- Penggunaan bahasa atau gambar seksual
- Trolling, komentar menghina, atau serangan pribadi
- Pelecehan publik atau pribadi
- Mempublikasikan informasi pribadi orang lain tanpa izin
- Perilaku tidak profesional lainnya

---

## Cara Berkontribusi

Ada banyak cara untuk berkontribusi pada proyek ini:

### 1. 🐛 Melaporkan Bug
Jika menemukan bug, silakan buat issue dengan:
- Deskripsi jelas tentang bug
- Langkah-langkah untuk mereproduksi
- Expected behavior vs actual behavior
- Screenshots (jika relevan)
- Environment details (OS, PHP version, dll)

### 2. 💡 Mengusulkan Fitur Baru
Untuk mengusulkan fitur baru:
- Buat issue dengan label "enhancement"
- Jelaskan fitur yang diusulkan
- Jelaskan mengapa fitur ini berguna
- Berikan contoh use case

### 3. 📝 Memperbaiki Dokumentasi
- Perbaiki typo atau kesalahan
- Tambahkan contoh yang lebih jelas
- Terjemahkan dokumentasi
- Tambahkan tutorial atau guide

### 4. 💻 Menulis Kode
- Perbaiki bug yang ada
- Implementasi fitur baru
- Refactor kode
- Tambahkan test

---

## Development Setup

### 1. Fork Repository
Klik tombol "Fork" di halaman GitHub repository.

### 2. Clone Fork Anda
```bash
git clone https://github.com/YOUR-USERNAME/DISPERINDAGKOP_Tolikara.git
cd DISPERINDAGKOP_Tolikara
```

### 3. Add Upstream Remote
```bash
git remote add upstream https://github.com/raulweya994-byte/DISPERINDAGKOP_Tolikara.git
```

### 4. Install Dependencies
```bash
composer install
npm install
```

### 5. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 6. Setup Database
```bash
php artisan migrate
php artisan db:seed
```

### 7. Buat Branch Baru
```bash
git checkout -b feature/nama-fitur
# atau
git checkout -b fix/nama-bug
```

---

## Coding Standards

### PHP Coding Standards
Proyek ini mengikuti [PSR-12 Coding Standard](https://www.php-fig.org/psr/psr-12/).

#### Contoh:
```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(15);

        return view('users.index', compact('users'));
    }
}
```

### Laravel Best Practices

#### 1. Gunakan Eloquent ORM
```php
// Good ✅
$users = User::where('active', true)->get();

// Bad ❌
$users = DB::select('SELECT * FROM users WHERE active = 1');
```

#### 2. Gunakan Route Model Binding
```php
// Good ✅
Route::get('/users/{user}', [UserController::class, 'show']);

public function show(User $user)
{
    return view('users.show', compact('user'));
}

// Bad ❌
public function show($id)
{
    $user = User::findOrFail($id);
    return view('users.show', compact('user'));
}
```

#### 3. Gunakan Form Request untuk Validasi
```php
// Good ✅
public function store(StoreUserRequest $request)
{
    User::create($request->validated());
}

// Bad ❌
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
    ]);
}
```

#### 4. Gunakan Resource untuk API Response
```php
// Good ✅
return UserResource::collection($users);

// Bad ❌
return response()->json($users);
```

### Blade Template Standards

```blade
{{-- Good ✅ --}}
@extends('layouts.app')

@section('title', 'User List')

@section('content')
    <div class="container">
        @foreach($users as $user)
            <div class="user-card">
                <h3>{{ $user->name }}</h3>
                <p>{{ $user->email }}</p>
            </div>
        @endforeach
    </div>
@endsection

{{-- Bad ❌ --}}
<html>
<body>
<?php foreach($users as $user): ?>
    <div><?= $user->name ?></div>
<?php endforeach; ?>
</body>
</html>
```

### JavaScript Standards
Gunakan ES6+ syntax:
```javascript
// Good ✅
const fetchUsers = async () => {
    try {
        const response = await fetch('/api/users');
        const users = await response.json();
        return users;
    } catch (error) {
        console.error('Error fetching users:', error);
    }
};

// Bad ❌
function fetchUsers() {
    $.ajax({
        url: '/api/users',
        success: function(data) {
            console.log(data);
        }
    });
}
```

### CSS Standards
Gunakan class naming yang konsisten:
```css
/* Good ✅ - BEM Methodology */
.user-card {
    padding: 20px;
}

.user-card__title {
    font-size: 18px;
}

.user-card__title--highlighted {
    color: red;
}

/* Bad ❌ */
.userCard {
    padding: 20px;
}

.title {
    font-size: 18px;
}
```

---

## Commit Guidelines

### Commit Message Format
```
<type>(<scope>): <subject>

<body>

<footer>
```

### Types
- **feat**: Fitur baru
- **fix**: Bug fix
- **docs**: Perubahan dokumentasi
- **style**: Perubahan formatting (tidak mengubah kode)
- **refactor**: Refactoring kode
- **test**: Menambah atau memperbaiki test
- **chore**: Perubahan build process atau tools

### Contoh Commit Messages

```bash
# Good ✅
feat(auth): add two-factor authentication
fix(user): resolve email validation bug
docs(readme): update installation instructions
style(css): format user dashboard styles
refactor(controller): simplify user query logic
test(user): add unit tests for user model
chore(deps): update laravel to 11.x

# Bad ❌
update
fixed bug
changes
wip
```

### Commit Message Body (Opsional)
```
feat(auth): add two-factor authentication

- Implement TOTP-based 2FA
- Add QR code generation
- Create backup codes system
- Update user settings page

Closes #123
```

---

## Pull Request Process

### 1. Update Fork Anda
```bash
git fetch upstream
git checkout main
git merge upstream/main
```

### 2. Rebase Branch Anda
```bash
git checkout feature/nama-fitur
git rebase main
```

### 3. Push ke Fork Anda
```bash
git push origin feature/nama-fitur
```

### 4. Buat Pull Request
1. Buka repository di GitHub
2. Klik "New Pull Request"
3. Pilih branch Anda
4. Isi deskripsi PR dengan detail:
   - Apa yang diubah
   - Mengapa perubahan diperlukan
   - Bagaimana cara testing
   - Screenshots (jika UI changes)

### 5. PR Template
```markdown
## Description
Brief description of changes

## Type of Change
- [ ] Bug fix
- [ ] New feature
- [ ] Breaking change
- [ ] Documentation update

## Testing
How to test these changes

## Screenshots (if applicable)
Add screenshots here

## Checklist
- [ ] Code follows project style guidelines
- [ ] Self-review completed
- [ ] Comments added for complex code
- [ ] Documentation updated
- [ ] No new warnings generated
- [ ] Tests added/updated
- [ ] All tests passing
```

### 6. Code Review
- Tunggu review dari maintainer
- Tanggapi feedback dengan konstruktif
- Lakukan perubahan jika diminta
- Update PR sesuai feedback

### 7. Merge
Setelah approved, PR akan di-merge oleh maintainer.

---

## Bug Reports

### Template Bug Report
```markdown
**Describe the bug**
A clear description of the bug

**To Reproduce**
Steps to reproduce:
1. Go to '...'
2. Click on '...'
3. Scroll down to '...'
4. See error

**Expected behavior**
What you expected to happen

**Screenshots**
If applicable, add screenshots

**Environment:**
- OS: [e.g. Windows 10]
- Browser: [e.g. Chrome 120]
- PHP Version: [e.g. 8.2]
- Laravel Version: [e.g. 11.0]

**Additional context**
Any other context about the problem
```

---

## Feature Requests

### Template Feature Request
```markdown
**Is your feature request related to a problem?**
A clear description of the problem

**Describe the solution you'd like**
A clear description of what you want to happen

**Describe alternatives you've considered**
Alternative solutions or features you've considered

**Additional context**
Any other context or screenshots about the feature request
```

---

## Testing

### Run Tests
```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=UserTest

# Run with coverage
php artisan test --coverage
```

### Writing Tests
```php
<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_created(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }
}
```

---

## Questions?

Jika ada pertanyaan, silakan:
- Buat issue dengan label "question"
- Email: raulweya994@gmail.com
- Diskusi di GitHub Discussions

---

## License

Dengan berkontribusi, Anda setuju bahwa kontribusi Anda akan dilisensikan di bawah MIT License.

---

**Terima kasih atas kontribusi Anda! 🎉**

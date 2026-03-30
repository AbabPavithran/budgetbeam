@extends('layouts.app')

@section('content')
<div class="row g-4">

    <!-- LEFT NAV -->
    <div class="col-md-3">
        <div class="card p-3">
            <h6 class="fw-bold mb-4">Settings</h6>

            <ul class="list-group list-group-flush">
                <li class="list-group-item active fw-semibold">Profile</li>
         
                <li class="list-group-item text-danger fw-semibold">Delete Account</li>
            </ul>
        </div>
    </div>

    <!-- RIGHT CONTENT -->
    <div class="col-md-9">
        <div class="card p-4">

            <!-- HEADER -->
            <h5 class="fw-bold mb-1">Profile</h5>
            <p class="text-muted mb-4">
                View and update your account information.
            </p>

            {{-- Success --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- PROFILE FORM -->
            <form method="POST"
      action="/settings/profile"
      enctype="multipart/form-data">
    @csrf

                <!-- PROFILE SUMMARY -->
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div>
                        <img src="{{ auth()->user()->avatar ? \Illuminate\Support\Facades\Storage::url(auth()->user()->avatar) : 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 100 100\"><rect width=\"100\" height=\"100\" fill=\"#0d6efd\"/><text x=\"50\" y=\"50\" font-family=\"Arial\" font-size=\"40\" fill=\"#fff\" text-anchor=\"middle\" dominant-baseline=\"central\">' . strtoupper(substr(auth()->user()->name, 0, 1)) . '</text></svg>') }}"
                             class="rounded-circle"
                             style="width:72px;height:72px;object-fit:cover;">
                    </div>

                    <div>
                        <p class="fw-bold mb-0">{{ auth()->user()->name }}</p>
                        <p class="text-muted mb-0">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <!-- AVATAR UPLOAD (EDIT ONLY) -->
                <div class="mb-4 d-none" id="avatarUpload">
                    <label class="form-label">Profile Picture</label>
                    <input type="file"
                           name="avatar"
                           class="form-control"
                           accept="image/*">
                    <small class="text-muted">PNG or JPG, max 2MB</small>
                </div>
                

                <!-- BASIC INFO -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text"
                               name="name"
                               class="form-control profile-field"
                               value="{{ auth()->user()->name }}"
                               disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control profile-field"
                               value="{{ auth()->user()->email }}"
                               disabled>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="mt-4">
                    <button type="button"
                            class="btn btn-primary"
                            id="editBtn"
                            onclick="enableEdit()">
                        Edit Profile
                    </button>

                    <button type="submit"
                            class="btn btn-success d-none"
                            id="saveBtn">
                        Save Changes
                    </button>

                    <button type="button"
                            class="btn btn-outline-secondary d-none ms-2"
                            id="cancelBtn"
                            onclick="cancelEdit()">
                        Cancel
                    </button>
                </div>
            </form>

            <!-- APPEARANCE -->
            <hr class="my-5">
            <h6 class="fw-bold mb-3">Appearance</h6>
            <p class="text-muted">Choose how BudgetBeam looks for you.</p>

            <div class="d-flex align-items-center justify-content-between">
                <span>Dark Mode</span>
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           type="checkbox"
                           id="themeSwitch"
                           onchange="toggleThemeFromSettings()">
                </div>
            </div>

            <!-- DANGER ZONE -->
            <hr class="my-5">
            <div class="border border-danger rounded p-3">
                <h6 class="fw-bold text-danger mb-2">Danger Zone</h6>
                <p class="text-muted mb-3">
                    Deleting your account is permanent and cannot be undone.
                </p>
                <form method="POST" action="{{ route('account.destroy') }}" onsubmit="return confirm('Are you completely sure you want to permanently delete your account? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Delete Account
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
function enableEdit() {
    document.querySelectorAll('.profile-field')
        .forEach(el => el.disabled = false);

    document.getElementById('avatarUpload').classList.remove('d-none');

    document.getElementById('editBtn').classList.add('d-none');
    document.getElementById('saveBtn').classList.remove('d-none');
    document.getElementById('cancelBtn').classList.remove('d-none');
}

function cancelEdit() {
    window.location.reload();
}

// Sync appearance switch
const themeSwitch = document.getElementById('themeSwitch');
if (themeSwitch) {
    themeSwitch.checked = document.body.classList.contains('dark');
}

function toggleThemeFromSettings() {
    const toggle = document.getElementById('themeToggle');
    if (toggle) toggle.click();
}
</script>
@endsection
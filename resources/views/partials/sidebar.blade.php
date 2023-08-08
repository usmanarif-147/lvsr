<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo mb-4">
        <a href="/admin/dashboard" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('logo.png') }}" class="img-fluid" width="140" alt="Logo here">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ url('admin/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('admin/users') ? 'active' : '' }}">
            <a href="{{ url('admin/users') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div>Users</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/platforms') ? 'active' : '' }}">
            <a href="{{ url('admin/platforms') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-shape-square"></i>
                <div>Platforms</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/links') ? 'active' : '' }}">
            <a href="{{ url('admin/links') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-link"></i>
                <div>Links</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/background-colors') ? 'active' : '' }}">
            <a href="{{ url('admin/background-colors') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-brush"></i>
                <div>Background Colors</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/button-colors') ? 'active' : '' }}">
            <a href="{{ url('admin/button-colors') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-palette"></i>
                <div>Button Colors</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/font-styles') ? 'active' : '' }}">
            <a href="{{ url('admin/font-styles') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-font"></i>
                <div>Font Styles</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/templates') ? 'active' : '' }}">
            <a href="{{ url('admin/templates') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-minus-back"></i>
                <div>Templates</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/stripe-plans') ? 'active' : '' }}">
            <a href="{{ url('admin/stripe-plans') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-coin-stack"></i>
                <div>Stripe Plan</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/cards') ? 'active' : '' }}">
            <a href="{{ url('admin/cards') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card-alt"></i>
                <div>Cards</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0)" onclick="changePassword()" class="menu-link">
                <i class="menu-icon tf-icons bx bx-key"></i>
                <div>Change Password</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/logs') ? 'active' : '' }}">
            <a href="{{ url('admin/logs') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-plus-medical"></i>
                <div>Logs</div>
            </a>
        </li>
    </ul>
</aside>

<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savePassword()">Update</button>
            </div>
        </div>
    </div>
</div>

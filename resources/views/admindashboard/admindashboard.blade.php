<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-purple: #E6E6FA;
            --secondary-purple: #D8BFD8;
            --accent-purple: #DDA0DD;
            --dark-purple: #9370DB;
        }

        body {
            background: linear-gradient(135deg, var(--primary-purple) 0%, #ffffff 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(90deg, var(--dark-purple) 0%, var(--accent-purple) 100%);
            box-shadow: 0 2px 10px rgba(147, 112, 219, 0.3);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(147, 112, 219, 0.2);
            background: white;
            margin-bottom: 20px;
        }

        .card-header {
            background: linear-gradient(135deg, var(--secondary-purple) 0%, var(--primary-purple) 100%);
            border-radius: 15px 15px 0 0 !important;
            color: var(--dark-purple);
            font-weight: 600;
            padding: 15px 20px;
        }

        .btn-primary {
            background: var(--dark-purple);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--accent-purple);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(147, 112, 219, 0.4);
        }

        .btn-success {
            background: #28a745;
            border: none;
            border-radius: 8px;
        }

        .btn-success:hover {
            background: #218838;
        }

        .btn-danger {
            background: #DC143C;
            border: none;
            border-radius: 8px;
        }

        .btn-info {
            background: var(--accent-purple);
            border: none;
            border-radius: 8px;
            color: white;
        }

        .btn-warning {
            background: #FFD700;
            border: none;
            border-radius: 8px;
            color: #333;
        }

        .form-control, .form-select {
            border: 2px solid var(--primary-purple);
            border-radius: 8px;
            padding: 10px;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--dark-purple);
            box-shadow: 0 0 0 0.2rem rgba(147, 112, 219, 0.25);
        }

        .table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background: var(--secondary-purple);
            color: var(--dark-purple);
        }

        .table tbody tr:hover {
            background: var(--primary-purple);
            transition: all 0.3s;
        }

        .badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
        }

        .stats-card {
            background: linear-gradient(135deg, var(--dark-purple) 0%, var(--accent-purple) 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .modal-content {
            border-radius: 15px;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--secondary-purple) 0%, var(--primary-purple) 100%);
            border-radius: 15px 15px 0 0;
            color: var(--dark-purple);
        }

        .nav-tabs .nav-link {
            color: var(--dark-purple);
            border: none;
            border-bottom: 3px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: var(--dark-purple);
            border-bottom: 3px solid var(--dark-purple);
            background: transparent;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .admin-badge {
            background: linear-gradient(90deg, #FF6B6B, #FF8E53);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shield-alt me-2"></i>Admin Dashboard
                <span class="admin-badge ms-2">ADMINISTRATOR</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#users"><i class="fas fa-users me-1"></i>Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#events"><i class="fas fa-calendar me-1"></i>Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#registrations"><i class="fas fa-clipboard-list me-1"></i>Registrations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reports"><i class="fas fa-chart-line me-1"></i>Reports</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <form method="POST" action="/logout" class="m-0 p-0" style="display:inline;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="nav-link btn btn-link text-danger p-0" style="background:none; border:none; line-height: 1.5;">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Alert Messages -->
        <div id="alertContainer"></div>

        <!-- Statistics Summary -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <i class="fas fa-users-cog fa-3x mb-3"></i>
                    <div class="stats-number" id="totalUsers">0</div>
                    <div>Total Users</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                    <div class="stats-number" id="totalEvents">0</div>
                    <div>Total Events</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <i class="fas fa-user-check fa-3x mb-3"></i>
                    <div class="stats-number" id="totalRegistrations">0</div>
                    <div>Total Registrations</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <i class="fas fa-calendar-check fa-3x mb-3"></i>
                    <div class="stats-number" id="upcomingEvents">0</div>
                    <div>Upcoming Events</div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs mb-4" id="mainTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button">
                    <i class="fas fa-users-cog me-2"></i>User Management
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="events-tab" data-bs-toggle="tab" data-bs-target="#events" type="button">
                    <i class="fas fa-calendar-alt me-2"></i>Events Management
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="registrations-tab" data-bs-toggle="tab" data-bs-target="#registrations" type="button">
                    <i class="fas fa-clipboard-list me-2"></i>Registration Records
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button">
                    <i class="fas fa-chart-line me-2"></i>System Reports
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="mainTabContent">
            <!-- User Management Tab -->
            <div class="tab-pane fade show active" id="users" role="tabpanel">
                <!-- Create New User Form -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user-plus me-2"></i>Create New User Account
                    </div>
                    <div class="card-body">
                        <form id="createUserForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="userName" required placeholder="Enter full name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="userEmail" required placeholder="Enter email address">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Username *</label>
                                    <input type="text" class="form-control" id="userUsername" required placeholder="Enter username">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">User Role *</label>
                                    <select class="form-select" id="userRole" required>
                                        <option value="">Select Role</option>
                                        <option value="organizer">Event Organizer</option>
                                        <option value="admin">Administrator</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password *</label>
                                    <input type="password" class="form-control" id="userPassword" required placeholder="Enter password">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="userPhone" placeholder="Enter phone number (optional)">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Create User
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Users List -->
                <div class="card mt-4">
                    <div class="card-header">
                        <i class="fas fa-users me-2"></i>All Users
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="usersTableBody">
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="fas fa-users-slash fa-3x mb-3"></i>
                                            <p>No users found. Create your first user above!</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events Management Tab -->
            <div class="tab-pane fade" id="events" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-calendar-alt me-2"></i>All Events
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Venue</th>
                                        <th>Capacity</th>
                                        <th>Registered</th>
                                        <th>Organizer</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="eventsTableBody">
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                            <p>No events found in the system.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Registration Records Tab -->
            <div class="tab-pane fade" id="registrations" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-clipboard-list me-2"></i>All Registration Records
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Participant Name</th>
                                        <th>Email</th>
                                        <th>Event</th>
                                        <th>Event Date</th>
                                        <th>Registration Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="registrationsTableBody">
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="fas fa-clipboard fa-3x mb-3"></i>
                                            <p>No registration records found.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Reports Tab -->
            <div class="tab-pane fade" id="reports" role="tabpanel">
                <!-- Upcoming Events Report -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-calendar-plus me-2"></i>Upcoming Events
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Event Title</th>
                                        <th>Date</th>
                                        <th>Venue</th>
                                        <th>Capacity</th>
                                        <th>Registered</th>
                                        <th>Available</th>
                                        <th>Fill Rate</th>
                                    </tr>
                                </thead>
                                <tbody id="upcomingEventsTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Past Events Report -->
                <div class="card mt-4">
                    <div class="card-header">
                        <i class="fas fa-history me-2"></i>Past Events
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Event Title</th>
                                        <th>Date</th>
                                        <th>Venue</th>
                                        <th>Capacity</th>
                                        <th>Total Attended</th>
                                        <th>Attendance Rate</th>
                                    </tr>
                                </thead>
                                <tbody id="pastEventsTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-edit me-2"></i>Edit User Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="editUserId">
                        <div class="mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="editUserName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="editUserEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username *</label>
                            <input type="text" class="form-control" id="editUserUsername" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">User Role *</label>
                            <select class="form-select" id="editUserRole" required>
                                <option value="organizer">Event Organizer</option>
                                <option value="admin">Administrator</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="editUserPhone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select class="form-select" id="editUserStatus" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="saveUserBtn">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Event Modal -->
    <div class="modal fade" id="editEventModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editEventForm">
                        <input type="hidden" id="editEventId">
                        <div class="mb-3">
                            <label class="form-label">Event Title *</label>
                            <input type="text" class="form-control" id="editEventTitle" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Date *</label>
                            <input type="date" class="form-control" id="editEventDate" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Venue *</label>
                            <input type="text" class="form-control" id="editEventVenue" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Capacity *</label>
                            <input type="number" class="form-control" id="editEventCapacity" required min="1">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="saveEventBtn">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Registration Modal -->
    <div class="modal fade" id="editRegistrationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Registration Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editRegistrationForm">
                        <input type="hidden" id="editRegEventId">
                        <input type="hidden" id="editRegParticipantIndex">
                        <div class="mb-3">
                            <label class="form-label">Participant Name *</label>
                            <input type="text" class="form-control" id="editRegName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="editRegEmail" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="saveRegistrationBtn">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="deleteMessage"></p>
                    <p class="text-muted mt-3"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash me-2"></i>Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data storage
        let users = [];
        let events = [];
        let userIdCounter = 1;
        let deleteCallback = null;

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadData();
            renderAllTables();
            updateStatistics();
        });

        // Show alert message
        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alertContainer');
            const alert = document.createElement('div');
            alert.className = `alert alert-${type} alert-dismissible fade show`;
            alert.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            alertContainer.appendChild(alert);
            setTimeout(() => alert.remove(), 5000);
        }

        // Save data to localStorage
        function saveData() {
            localStorage.setItem('adminUsers', JSON.stringify(users));
            localStorage.setItem('organizerEvents', JSON.stringify(events));
        }

        // Load data from localStorage
        function loadData() {
            const storedUsers = localStorage.getItem('adminUsers');
            const storedEvents = localStorage.getItem('organizerEvents');
            
            if (storedUsers) {
                users = JSON.parse(storedUsers);
                if (users.length > 0) {
                    userIdCounter = Math.max(...users.map(u => u.id)) + 1;
                }
            }
            
            if (storedEvents) {
                events = JSON.parse(storedEvents);
            }
        }

        // Create new user
        document.getElementById('createUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('userEmail').value;
            const username = document.getElementById('userUsername').value;
            
            // Check for duplicates
            if (users.some(u => u.email === email)) {
                showAlert('Email address already exists!', 'danger');
                return;
            }
            if (users.some(u => u.username === username)) {
                showAlert('Username already exists!', 'danger');
                return;
            }
            
            const newUser = {
                id: userIdCounter++,
                name: document.getElementById('userName').value,
                email: email,
                username: username,
                role: document.getElementById('userRole').value,
                password: document.getElementById('userPassword').value,
                phone: document.getElementById('userPhone').value,
                status: 'active',
                createdAt: new Date().toISOString()
            };

            users.push(newUser);
            saveData();
            renderUsersTable();
            updateStatistics();
            this.reset();
            showAlert(`User "${newUser.name}" has been created successfully!`, 'success');
        });

        // Render all tables
        function renderAllTables() {
            renderUsersTable();
            renderEventsTable();
            renderRegistrationsTable();
            renderReports();
        }

        // Render users table
        function renderUsersTable() {
            const tbody = document.getElementById('usersTableBody');
            
            if (users.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-users-slash fa-3x mb-3"></i>
                            <p>No users found. Create your first user above!</p>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = users.map(user => {
                const roleColor = user.role === 'admin' ? 'danger' : 'primary';
                const statusColor = user.status === 'active' ? 'success' : 'secondary';
                
                return `
                    <tr>
                        <td>${user.id}</td>
                        <td><strong>${user.name}</strong></td>
                        <td>${user.email}</td>
                        <td>${user.username}</td>
                        <td><span class="badge bg-${roleColor}">${user.role.toUpperCase()}</span></td>
                        <td><span class="badge bg-${statusColor}">${user.status.toUpperCase()}</span></td>
                        <td>${new Date(user.createdAt).toLocaleDateString()}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editUser(${user.id})" title="Edit User">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})" title="Delete User">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // Edit user
        function editUser(userId) {
            const user = users.find(u => u.id === userId);
            if (!user) return;

            document.getElementById('editUserId').value = user.id;
            document.getElementById('editUserName').value = user.name;
            document.getElementById('editUserEmail').value = user.email;
            document.getElementById('editUserUsername').value = user.username;
            document.getElementById('editUserRole').value = user.role;
            document.getElementById('editUserPhone').value = user.phone || '';
            document.getElementById('editUserStatus').value = user.status;

            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        }

        // Save edited user
        document.getElementById('saveUserBtn').addEventListener('click', function() {
            const userId = parseInt(document.getElementById('editUserId').value);
            const userIndex = users.findIndex(u => u.id === userId);

            if (userIndex !== -1) {
                users[userIndex].name = document.getElementById('editUserName').value;
                users[userIndex].email = document.getElementById('editUserEmail').value;
                users[userIndex].username = document.getElementById('editUserUsername').value;
                users[userIndex].role = document.getElementById('editUserRole').value;
                users[userIndex].phone = document.getElementById('editUserPhone').value;
                users[userIndex].status = document.getElementById('editUserStatus').value;

                saveData();
                renderUsersTable();
                bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
                showAlert('User updated successfully!', 'success');
            }
        });

        // Delete user
        function deleteUser(userId) {
            const user = users.find(u => u.id === userId);
            if (!user) return;

            document.getElementById('deleteMessage').textContent = `Are you sure you want to delete user "${user.name}"?`;
            deleteCallback = function() {
                const userIndex = users.findIndex(u => u.id === userId);
                if (userIndex !== -1) {
                    users.splice(userIndex, 1);
                    saveData();
                    renderUsersTable();
                    updateStatistics();
                    showAlert('User deleted successfully!', 'success');
                }
            };

            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        // Render events table
        function renderEventsTable() {
            const tbody = document.getElementById('eventsTableBody');
            
            if (events.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                            <p>No events found in the system.</p>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = events.map(event => {
                const eventDate = new Date(event.date);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const isPast = eventDate < today;
                const registrations = event.participants?.length || 0;

                return `
                    <tr>
                        <td>${event.id}</td>
                        <td><strong>${event.title}</strong></td>
                        <td>${new Date(event.date).toLocaleDateString()}</td>
                        <td>${event.venue}</td>
                        <td>${event.capacity}</td>
                        <td><span class="badge bg-info">${registrations}</span></td>
                        <td>${event.organizerId ? users.find(u => u.id === event.organizerId)?.name || 'Unknown' : 'System'}</td>
                        <td><span class="badge bg-${isPast ? 'secondary' : 'success'}">${isPast ? 'PAST' : 'UPCOMING'}</span></td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="viewEventDetails(${event.id})" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="editEvent(${event.id})" title="Edit Event">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteEvent(${event.id})" title="Delete Event">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // View event details
        function viewEventDetails(eventId) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;
            
            let details = `Event: ${event.title}\nDate: ${new Date(event.date).toLocaleDateString()}\nVenue: ${event.venue}\nCapacity: ${event.capacity}\nRegistered: ${event.participants?.length || 0}`;
            if (event.description) details += `\nDescription: ${event.description}`;
            
            alert(details);
        }

        // Edit event
        function editEvent(eventId) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;

            document.getElementById('editEventId').value = event.id;
            document.getElementById('editEventTitle').value = event.title;
            document.getElementById('editEventDate').value = event.date;
            document.getElementById('editEventVenue').value = event.venue;
            document.getElementById('editEventCapacity').value = event.capacity;

            new bootstrap.Modal(document.getElementById('editEventModal')).show();
        }

        // Save edited event
        document.getElementById('saveEventBtn').addEventListener('click', function() {
            const eventId = parseInt(document.getElementById('editEventId').value);
            const eventIndex = events.findIndex(e => e.id === eventId);

            if (eventIndex !== -1) {
                events[eventIndex].title = document.getElementById('editEventTitle').value;
                events[eventIndex].date = document.getElementById('editEventDate').value;
                events[eventIndex].venue = document.getElementById('editEventVenue').value;
                events[eventIndex].capacity = parseInt(document.getElementById('editEventCapacity').value);

                saveData();
                renderEventsTable();
                renderReports();
                updateStatistics();
                bootstrap.Modal.getInstance(document.getElementById('editEventModal')).hide();
                showAlert('Event updated successfully!', 'success');
            }
        });

        // Delete event
        function deleteEvent(eventId) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;

            document.getElementById('deleteMessage').textContent = `Are you sure you want to delete event "${event.title}"?`;
            deleteCallback = function() {
                const eventIndex = events.findIndex(e => e.id === eventId);
                if (eventIndex !== -1) {
                    events.splice(eventIndex, 1);
                    saveData();
                    renderAllTables();
                    updateStatistics();
                    showAlert('Event deleted successfully!', 'success');
                }
            };

            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        // Render registrations table
        function renderRegistrationsTable() {
            const tbody = document.getElementById('registrationsTableBody');
            const registrations = [];

            events.forEach(event => {
                if (event.participants && event.participants.length > 0) {
                    event.participants.forEach((participant, index) => {
                        registrations.push({
                            eventId: event.id,
                            participantIndex: index,
                            participantName: participant.name,
                            participantEmail: participant.email,
                            eventTitle: event.title,
                            eventDate: event.date,
                            registeredAt: participant.registeredAt,
                            status: new Date(event.date) < new Date() ? 'Completed' : 'Active'
                        });
                    });
                }
            });

            if (registrations.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fas fa-clipboard fa-3x mb-3"></i>
                            <p>No registration records found.</p>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = registrations.map((reg, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td><strong>${reg.participantName}</strong></td>
                    <td>${reg.participantEmail}</td>
                    <td>${reg.eventTitle}</td>
                    <td>${new Date(reg.eventDate).toLocaleDateString()}</td>
                    <td>${new Date(reg.registeredAt).toLocaleDateString()}</td>
                    <td><span class="badge bg-${reg.status === 'Active' ? 'success' : 'secondary'}">${reg.status}</span></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editRegistration(${reg.eventId}, ${reg.participantIndex})" title="Edit Record">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteRegistration(${reg.eventId}, ${reg.participantIndex})" title="Delete Record">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        // Edit registration
        function editRegistration(eventId, participantIndex) {
            const event = events.find(e => e.id === eventId);
            if (!event || !event.participants[participantIndex]) return;

            const participant = event.participants[participantIndex];
            document.getElementById('editRegEventId').value = eventId;
            document.getElementById('editRegParticipantIndex').value = participantIndex;
            document.getElementById('editRegName').value = participant.name;
            document.getElementById('editRegEmail').value = participant.email;

            new bootstrap.Modal(document.getElementById('editRegistrationModal')).show();
        }

        // Save edited registration
        document.getElementById('saveRegistrationBtn').addEventListener('click', function() {
            const eventId = parseInt(document.getElementById('editRegEventId').value);
            const participantIndex = parseInt(document.getElementById('editRegParticipantIndex').value);
            const event = events.find(e => e.id === eventId);

            if (event && event.participants[participantIndex]) {
                event.participants[participantIndex].name = document.getElementById('editRegName').value;
                event.participants[participantIndex].email = document.getElementById('editRegEmail').value;

                saveData();
                renderRegistrationsTable();
                bootstrap.Modal.getInstance(document.getElementById('editRegistrationModal')).hide();
                showAlert('Registration record updated successfully!', 'success');
            }
        });

        // Delete registration
        function deleteRegistration(eventId, participantIndex) {
            const event = events.find(e => e.id === eventId);
            if (!event || !event.participants[participantIndex]) return;

            const participant = event.participants[participantIndex];
            document.getElementById('deleteMessage').textContent = `Are you sure you want to delete registration for "${participant.name}" from event "${event.title}"?`;
            
            deleteCallback = function() {
                event.participants.splice(participantIndex, 1);
                saveData();
                renderAllTables();
                updateStatistics();
                showAlert('Registration record deleted successfully!', 'success');
            };

            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        // Confirm delete button
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteCallback) {
                deleteCallback();
                deleteCallback = null;
                bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
            }
        });

        // Render reports
        function renderReports() {
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            const upcomingEvents = events.filter(e => new Date(e.date) >= today);
            const pastEvents = events.filter(e => new Date(e.date) < today);

            // Upcoming events
            const upcomingTBody = document.getElementById('upcomingEventsTableBody');
            if (upcomingEvents.length === 0) {
                upcomingTBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <p>No upcoming events found.</p>
                        </td>
                    </tr>
                `;
            } else {
                upcomingTBody.innerHTML = upcomingEvents.map(event => {
                    const registered = event.participants?.length || 0;
                    const available = event.capacity - registered;
                    const fillRate = event.capacity > 0 ? ((registered / event.capacity) * 100).toFixed(1) : 0;
                    
                    return `
                        <tr>
                            <td><strong>${event.title}</strong></td>
                            <td>${new Date(event.date).toLocaleDateString()}</td>
                            <td>${event.venue}</td>
                            <td>${event.capacity}</td>
                            <td><span class="badge bg-primary">${registered}</span></td>
                            <td>${available}</td>
                            <td><span class="badge bg-${fillRate >= 80 ? 'success' : fillRate >= 50 ? 'warning' : 'secondary'}">${fillRate}%</span></td>
                        </tr>
                    `;
                }).join('');
            }

            // Past events
            const pastTBody = document.getElementById('pastEventsTableBody');
            if (pastEvents.length === 0) {
                pastTBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <p>No past events found.</p>
                        </td>
                    </tr>
                `;
            } else {
                pastTBody.innerHTML = pastEvents.map(event => {
                    const attended = event.participants?.length || 0;
                    const attendanceRate = event.capacity > 0 ? ((attended / event.capacity) * 100).toFixed(1) : 0;
                    
                    return `
                        <tr>
                            <td><strong>${event.title}</strong></td>
                            <td>${new Date(event.date).toLocaleDateString()}</td>
                            <td>${event.venue}</td>
                            <td>${event.capacity}</td>
                            <td><span class="badge bg-info">${attended}</span></td>
                            <td><span class="badge bg-${attendanceRate >= 80 ? 'success' : attendanceRate >= 50 ? 'warning' : 'secondary'}">${attendanceRate}%</span></td>
                        </tr>
                    `;
                }).join('');
            }
        }

        // Update statistics
        function updateStatistics() {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            const totalRegistrations = events.reduce((sum, event) => sum + (event.participants?.length || 0), 0);
            const upcomingEventsCount = events.filter(e => new Date(e.date) >= today).length;

            document.getElementById('totalUsers').textContent = users.length;
            document.getElementById('totalEvents').textContent = events.length;
            document.getElementById('totalRegistrations').textContent = totalRegistrations;
            document.getElementById('upcomingEvents').textContent = upcomingEventsCount;
        }
    </script>
</body>
</html>
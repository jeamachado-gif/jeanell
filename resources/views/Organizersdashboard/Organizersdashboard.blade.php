<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Organizer Dashboard</title>
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
            background: #9370DB;
            border: none;
            border-radius: 8px;
        }

        .btn-success:hover {
            background: #7B68EE;
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

        .event-card {
            transition: all 0.3s;
            cursor: pointer;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(147, 112, 219, 0.3);
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

        .section-title {
            color: var(--dark-purple);
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid var(--secondary-purple);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-calendar-alt me-2"></i>Event Organizer Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#events"><i class="fas fa-calendar me-1"></i>Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reports"><i class="fas fa-chart-bar me-1"></i>Reports</a>
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
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <i class="fas fa-calendar-check fa-3x mb-3"></i>
                    <div class="stats-number" id="totalEvents">0</div>
                    <div>Total Events</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <div class="stats-number" id="totalParticipants">0</div>
                    <div>Total Participants</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <i class="fas fa-chair fa-3x mb-3"></i>
                    <div class="stats-number" id="totalCapacity">0</div>
                    <div>Total Capacity</div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs mb-4" id="mainTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="events-tab" data-bs-toggle="tab" data-bs-target="#events" type="button">
                    <i class="fas fa-calendar me-2"></i>Events Management
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports" type="button">
                    <i class="fas fa-chart-bar me-2"></i>Summary Reports
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="mainTabContent">
            <!-- Events Management Tab -->
            <div class="tab-pane fade show active" id="events" role="tabpanel">
                <!-- Create New Event Form -->
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-plus-circle me-2"></i>Create New Event
                    </div>
                    <div class="card-body">
                        <form id="createEventForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Event Title *</label>
                                    <input type="text" class="form-control" id="eventTitle" name="title" required placeholder="Enter event title">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Event Date *</label>
                                    <input type="date" class="form-control" id="eventDate" name="date" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Venue *</label>
                                    <input type="text" class="form-control" id="eventVenue" name="venue" required placeholder="Enter venue location">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Capacity *</label>
                                    <input type="number" class="form-control" id="eventCapacity" name="capacity" required min="1" placeholder="Maximum participants">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" id="eventDescription" name="description" rows="3" placeholder="Event description (optional)"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Create Event
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Events List -->
                <div class="card mt-4">
                    <div class="card-header">
                        <i class="fas fa-list me-2"></i>Events List
                    </div>
                    <div class="card-body">
                        <div id="eventsList" class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Venue</th>
                                        <th>Capacity</th>
                                        <th>Registrations</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="eventsTableBody">
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                            <p>No events created yet. Create your first event above!</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reports Tab -->
            <div class="tab-pane fade" id="reports" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-2"></i>Summary Reports - Total Registrants Per Event
                    </div>
                    <div class="card-body">
                        <div id="reportsContent" class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Event Title</th>
                                        <th>Date</th>
                                        <th>Venue</th>
                                        <th>Total Capacity</th>
                                        <th>Total Registrants</th>
                                        <th>Available Slots</th>
                                        <th>Fill Rate</th>
                                    </tr>
                                </thead>
                                <tbody id="reportsTableBody">
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fas fa-chart-bar fa-3x mb-3"></i>
                                            <p>No event data available for reports.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Participants Modal -->
    <div class="modal fade" id="participantsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-users me-2"></i>Registered Participants</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 id="modalEventTitle" class="mb-3"></h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Registration Date</th>
                                </tr>
                            </thead>
                            <tbody id="participantsTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Event Modal -->
    <div class="modal fade" id="editEventModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Update Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editEventForm">
                        <input type="hidden" id="editEventId" name="eventId">
                        <div class="mb-3">
                            <label class="form-label">Event Title *</label>
                            <input type="text" class="form-control" id="editTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Date *</label>
                            <input type="date" class="form-control" id="editDate" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Venue *</label>
                            <input type="text" class="form-control" id="editVenue" name="venue" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Capacity *</label>
                            <input type="number" class="form-control" id="editCapacity" name="capacity" required min="1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="saveEditBtn">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteEventModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Delete Event</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this event?</p>
                    <h6 id="deleteEventTitle" class="text-danger"></h6>
                    <p class="text-muted mt-3"><small>This action cannot be undone.</small></p>
                    <input type="hidden" id="deleteEventId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash me-2"></i>Delete Event
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data storage
        let events = [];
        let eventIdCounter = 1;

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadEvents();
            renderEvents();
            updateStatistics();
            updateReports();
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
            
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }

        // Save events to localStorage
        function saveEvents() {
            localStorage.setItem('organizerEvents', JSON.stringify(events));
        }

        // Load events from localStorage
        function loadEvents() {
            const stored = localStorage.getItem('organizerEvents');
            if (stored) {
                events = JSON.parse(stored);
                if (events.length > 0) {
                    eventIdCounter = Math.max(...events.map(e => e.id)) + 1;
                }
            }
        }

        // Create new event
        document.getElementById('createEventForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newEvent = {
                id: eventIdCounter++,
                title: document.getElementById('eventTitle').value,
                date: document.getElementById('eventDate').value,
                venue: document.getElementById('eventVenue').value,
                capacity: parseInt(document.getElementById('eventCapacity').value),
                description: document.getElementById('eventDescription').value,
                participants: [],
                createdAt: new Date().toISOString()
            };

            events.push(newEvent);
            saveEvents();
            renderEvents();
            updateStatistics();
            updateReports();
            
            this.reset();
            showAlert(`Event "${newEvent.title}" has been created successfully!`, 'success');
        });

        // Render events table
        function renderEvents() {
            const tbody = document.getElementById('eventsTableBody');
            
            if (events.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                            <p>No events created yet. Create your first event above!</p>
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
                const registrations = event.participants.length;
                const hasRegistrations = registrations > 0;

                let statusBadge = '';
                if (isPast) {
                    statusBadge = '<span class="badge bg-secondary">Completed</span>';
                } else {
                    statusBadge = '<span class="badge bg-success">Upcoming</span>';
                }

                return `
                    <tr>
                        <td><strong>${event.title}</strong></td>
                        <td>${new Date(event.date).toLocaleDateString()}</td>
                        <td>${event.venue}</td>
                        <td>${event.capacity}</td>
                        <td><span class="badge bg-info">${registrations}</span></td>
                        <td>${statusBadge}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="viewParticipants(${event.id})" title="View Participants">
                                <i class="fas fa-users"></i>
                            </button>
                            ${!isPast ? `
                                <button class="btn btn-sm btn-warning" onclick="editEvent(${event.id})" title="Edit Event">
                                    <i class="fas fa-edit"></i>
                                </button>
                            ` : ''}
                            ${!hasRegistrations ? `
                                <button class="btn btn-sm btn-danger" onclick="deleteEvent(${event.id})" title="Delete Event">
                                    <i class="fas fa-trash"></i>
                                </button>
                            ` : ''}
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // View participants
        function viewParticipants(eventId) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;

            document.getElementById('modalEventTitle').textContent = `Event: ${event.title}`;
            const tbody = document.getElementById('participantsTableBody');

            if (event.participants.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                            <p>No participants registered yet.</p>
                        </td>
                    </tr>
                `;
            } else {
                tbody.innerHTML = event.participants.map((p, index) => `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${p.name}</td>
                        <td>${p.email}</td>
                        <td>${new Date(p.registeredAt).toLocaleDateString()}</td>
                    </tr>
                `).join('');
            }

            new bootstrap.Modal(document.getElementById('participantsModal')).show();
        }

        // Edit event
        function editEvent(eventId) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;

            document.getElementById('editEventId').value = event.id;
            document.getElementById('editTitle').value = event.title;
            document.getElementById('editDate').value = event.date;
            document.getElementById('editVenue').value = event.venue;
            document.getElementById('editCapacity').value = event.capacity;
            document.getElementById('editDescription').value = event.description || '';

            new bootstrap.Modal(document.getElementById('editEventModal')).show();
        }

        // Save edited event
        document.getElementById('saveEditBtn').addEventListener('click', function() {
            const eventId = parseInt(document.getElementById('editEventId').value);
            const eventIndex = events.findIndex(e => e.id === eventId);

            if (eventIndex !== -1) {
                events[eventIndex].title = document.getElementById('editTitle').value;
                events[eventIndex].date = document.getElementById('editDate').value;
                events[eventIndex].venue = document.getElementById('editVenue').value;
                events[eventIndex].capacity = parseInt(document.getElementById('editCapacity').value);
                events[eventIndex].description = document.getElementById('editDescription').value;

                saveEvents();
                renderEvents();
                updateStatistics();
                updateReports();

                bootstrap.Modal.getInstance(document.getElementById('editEventModal')).hide();
                showAlert('Event updated successfully!', 'success');
            }
        });

        // Delete event
        function deleteEvent(eventId) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;

            if (event.participants.length > 0) {
                showAlert('Cannot delete event with active registrations!', 'danger');
                return;
            }

            document.getElementById('deleteEventId').value = eventId;
            document.getElementById('deleteEventTitle').textContent = event.title;

            new bootstrap.Modal(document.getElementById('deleteEventModal')).show();
        }

        // Confirm delete
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            const eventId = parseInt(document.getElementById('deleteEventId').value);
            const eventIndex = events.findIndex(e => e.id === eventId);

            if (eventIndex !== -1) {
                const eventTitle = events[eventIndex].title;
                events.splice(eventIndex, 1);
                saveEvents();
                renderEvents();
                updateStatistics();
                updateReports();

                bootstrap.Modal.getInstance(document.getElementById('deleteEventModal')).hide();
                showAlert(`Event "${eventTitle}" has been deleted successfully!`, 'success');
            }
        });

        // Update statistics
        function updateStatistics() {
            const totalEvents = events.length;
            const totalParticipants = events.reduce((sum, event) => sum + event.participants.length, 0);
            const totalCapacity = events.reduce((sum, event) => sum + event.capacity, 0);

            document.getElementById('totalEvents').textContent = totalEvents;
            document.getElementById('totalParticipants').textContent = totalParticipants;
            document.getElementById('totalCapacity').textContent = totalCapacity;
        }

        // Update reports
        function updateReports() {
            const tbody = document.getElementById('reportsTableBody');

            if (events.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-chart-bar fa-3x mb-3"></i>
                            <p>No event data available for reports.</p>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = events.map(event => {
                const registrants = event.participants.length;
                const available = event.capacity - registrants;
                const fillRate = event.capacity > 0 ? ((registrants / event.capacity) * 100).toFixed(1) : 0;

                let fillRateBadge = '';
                if (fillRate >= 80) {
                    fillRateBadge = `<span class="badge bg-success">${fillRate}%</span>`;
                } else if (fillRate >= 50) {
                    fillRateBadge = `<span class="badge bg-warning">${fillRate}%</span>`;
                } else {
                    fillRateBadge = `<span class="badge bg-secondary">${fillRate}%</span>`;
                }

                return `
                    <tr>
                        <td><strong>${event.title}</strong></td>
                        <td>${new Date(event.date).toLocaleDateString()}</td>
                        <td>${event.venue}</td>
                        <td>${event.capacity}</td>
                        <td><span class="badge bg-primary">${registrants}</span></td>
                        <td>${available}</td>
                        <td>${fillRateBadge}</td>
                    </tr>
                `;
            }).join('');
        }
    </script>
</body>
</html>
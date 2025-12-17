<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participant Portal</title>
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
            transition: all 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(147, 112, 219, 0.3);
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

        .badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
        }

        .event-card {
            border-left: 5px solid var(--dark-purple);
        }

        .event-card .card-title {
            color: var(--dark-purple);
            font-weight: bold;
        }

        .stats-card {
            background: linear-gradient(135deg, var(--dark-purple) 0%, var(--accent-purple) 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            text-align: center;
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

        .event-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .event-info i {
            color: var(--dark-purple);
            margin-right: 10px;
            width: 20px;
        }

        .registration-card {
            border-left: 5px solid #28a745;
        }

        .status-badge-large {
            font-size: 1rem;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-user-circle me-2"></i>Participant Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#events"><i class="fas fa-calendar me-1"></i>Available Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#myRegistrations"><i class="fas fa-clipboard-check me-1"></i>My Registrations</a>
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
                <div class="stats-card">
                    <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                    <div class="stats-number" id="totalAvailableEvents">0</div>
                    <div>Available Events</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                    <div class="stats-number" id="myRegistrationsCount">0</div>
                    <div>My Registrations</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <i class="fas fa-calendar-day fa-3x mb-3"></i>
                    <div class="stats-number" id="upcomingEventsCount">0</div>
                    <div>Upcoming Events</div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs mb-4" id="mainTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="events-tab" data-bs-toggle="tab" data-bs-target="#events" type="button">
                    <i class="fas fa-calendar-alt me-2"></i>Available Events
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="myRegistrations-tab" data-bs-toggle="tab" data-bs-target="#myRegistrations" type="button">
                    <i class="fas fa-clipboard-check me-2"></i>My Registrations
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="mainTabContent">
            <!-- Available Events Tab -->
            <div class="tab-pane fade show active" id="events" role="tabpanel">
                <div class="row" id="eventsContainer">
                    <div class="col-12 text-center text-muted py-5">
                        <i class="fas fa-calendar-times fa-4x mb-3"></i>
                        <p>No events available at the moment.</p>
                    </div>
                </div>
            </div>

            <!-- My Registrations Tab -->
            <div class="tab-pane fade" id="myRegistrations" role="tabpanel">
                <div class="row" id="myRegistrationsContainer">
                    <div class="col-12 text-center text-muted py-5">
                        <i class="fas fa-clipboard fa-4x mb-3"></i>
                        <p>You haven't registered for any events yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div class="modal fade" id="eventDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i>Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="eventDetailsBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Register for Event Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Register for Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6 id="registerEventTitle" class="mb-3 text-center"></h6>
                    <form id="registerForm">
                        <input type="hidden" id="registerEventId">
                        <div class="mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="registerName" required placeholder="Enter your full name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="registerEmail" required placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control" id="registerPhone" required placeholder="Enter your phone number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Additional Notes (Optional)</label>
                            <textarea class="form-control" id="registerNotes" rows="2" placeholder="Any special requirements or notes"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmRegisterBtn">
                        <i class="fas fa-check me-2"></i>Register Now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Registration Modal -->
    <div class="modal fade" id="updateRegistrationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Update Registration Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="updateRegistrationForm">
                        <input type="hidden" id="updateEventId">
                        <input type="hidden" id="updateParticipantEmail">
                        <div class="mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="updateName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="updateEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control" id="updatePhone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Additional Notes</label>
                            <textarea class="form-control" id="updateNotes" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="confirmUpdateBtn">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Registration Modal -->
    <div class="modal fade" id="cancelRegistrationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Cancel Registration</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel your registration for this event?</p>
                    <h6 id="cancelEventTitle" class="text-danger"></h6>
                    <p class="text-muted mt-3"><small>This action cannot be undone. You will need to register again if you change your mind.</small></p>
                    <input type="hidden" id="cancelEventId">
                    <input type="hidden" id="cancelParticipantEmail">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keep Registration</button>
                    <button type="button" class="btn btn-danger" id="confirmCancelBtn">
                        <i class="fas fa-times me-2"></i>Yes, Cancel Registration
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data storage
        let events = [];
        let currentUserEmail = localStorage.getItem('participantEmail') || '';

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Check if user has set their email
            if (!currentUserEmail) {
                promptForEmail();
            }
            loadEvents();
            renderAvailableEvents();
            renderMyRegistrations();
            updateStatistics();
        });

        // Prompt for user email (simple identification)
        function promptForEmail() {
            const email = prompt('Welcome! Please enter your email address to continue:');
            if (email && email.includes('@')) {
                currentUserEmail = email;
                localStorage.setItem('participantEmail', email);
            } else {
                alert('Invalid email. Please refresh and try again.');
            }
        }

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

        // Load events from localStorage
        function loadEvents() {
            const stored = localStorage.getItem('organizerEvents');
            if (stored) {
                events = JSON.parse(stored);
            }
        }

        // Save events to localStorage
        function saveEvents() {
            localStorage.setItem('organizerEvents', JSON.stringify(events));
        }

        // Render available events
        function renderAvailableEvents() {
            const container = document.getElementById('eventsContainer');
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            // Filter upcoming events only
            const upcomingEvents = events.filter(e => new Date(e.date) >= today);

            if (upcomingEvents.length === 0) {
                container.innerHTML = `
                    <div class="col-12 text-center text-muted py-5">
                        <i class="fas fa-calendar-times fa-4x mb-3"></i>
                        <p>No upcoming events available at the moment.</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = upcomingEvents.map(event => {
                const registrations = event.participants?.length || 0;
                const availableSlots = event.capacity - registrations;
                const isFull = availableSlots <= 0;
                const isRegistered = event.participants?.some(p => p.email === currentUserEmail) || false;

                return `
                    <div class="col-md-6 col-lg-4">
                        <div class="card event-card">
                            <div class="card-body">
                                <h5 class="card-title">${event.title}</h5>
                                ${event.description ? `<p class="card-text text-muted">${event.description}</p>` : ''}
                                <div class="event-info">
                                    <i class="fas fa-calendar"></i>
                                    <span>${new Date(event.date).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</span>
                                </div>
                                <div class="event-info">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>${event.venue}</span>
                                </div>
                                <div class="event-info">
                                    <i class="fas fa-users"></i>
                                    <span>${registrations} / ${event.capacity} registered</span>
                                </div>
                                <div class="event-info">
                                    <i class="fas fa-chair"></i>
                                    <span class="${availableSlots <= 5 ? 'text-danger' : 'text-success'} fw-bold">
                                        ${availableSlots} slots available
                                    </span>
                                </div>
                                <div class="mt-3">
                                    ${isRegistered ? 
                                        '<span class="badge bg-success status-badge-large w-100"><i class="fas fa-check-circle me-2"></i>Already Registered</span>' :
                                        isFull ? 
                                        '<span class="badge bg-danger status-badge-large w-100"><i class="fas fa-times-circle me-2"></i>Event Full</span>' :
                                        `<button class="btn btn-primary w-100" onclick="openRegisterModal(${event.id})">
                                            <i class="fas fa-user-plus me-2"></i>Register Now
                                        </button>`
                                    }
                                </div>
                                <button class="btn btn-info w-100 mt-2" onclick="viewEventDetails(${event.id})">
                                    <i class="fas fa-info-circle me-2"></i>View Details
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // View event details
        function viewEventDetails(eventId) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;

            const registrations = event.participants?.length || 0;
            const availableSlots = event.capacity - registrations;
            const isRegistered = event.participants?.some(p => p.email === currentUserEmail) || false;

            const detailsBody = document.getElementById('eventDetailsBody');
            detailsBody.innerHTML = `
                <h4 class="mb-4">${event.title}</h4>
                ${event.description ? `<p class="lead">${event.description}</p><hr>` : ''}
                <div class="row">
                    <div class="col-md-6">
                        <h6><i class="fas fa-calendar text-purple me-2"></i>Event Date</h6>
                        <p>${new Date(event.date).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</p>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-map-marker-alt text-purple me-2"></i>Venue</h6>
                        <p>${event.venue}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h6><i class="fas fa-users text-purple me-2"></i>Capacity</h6>
                        <p>${event.capacity} participants</p>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-user-check text-purple me-2"></i>Current Registrations</h6>
                        <p>${registrations} registered</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h6><i class="fas fa-chair text-purple me-2"></i>Available Slots</h6>
                        <p class="${availableSlots <= 5 ? 'text-danger' : 'text-success'} fw-bold">${availableSlots} slots remaining</p>
                    </div>
                </div>
                ${isRegistered ? `
                    <div class="alert alert-success mt-3">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>You are registered for this event!</strong>
                    </div>
                ` : ''}
            `;

            new bootstrap.Modal(document.getElementById('eventDetailsModal')).show();
        }

        // Open register modal
        function openRegisterModal(eventId) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;

            document.getElementById('registerEventId').value = eventId;
            document.getElementById('registerEventTitle').textContent = event.title;
            document.getElementById('registerForm').reset();
            
            new bootstrap.Modal(document.getElementById('registerModal')).show();
        }

        // Confirm registration
        document.getElementById('confirmRegisterBtn').addEventListener('click', function() {
            const eventId = parseInt(document.getElementById('registerEventId').value);
            const event = events.find(e => e.id === eventId);
            
            if (!event) return;

            const name = document.getElementById('registerName').value.trim();
            const email = document.getElementById('registerEmail').value.trim();
            const phone = document.getElementById('registerPhone').value.trim();
            const notes = document.getElementById('registerNotes').value.trim();

            if (!name || !email || !phone) {
                showAlert('Please fill in all required fields!', 'warning');
                return;
            }

            // Check if already registered
            if (event.participants?.some(p => p.email === email)) {
                showAlert('You are already registered for this event!', 'warning');
                return;
            }

            // Check capacity
            const registrations = event.participants?.length || 0;
            if (registrations >= event.capacity) {
                showAlert('Sorry, this event is already full!', 'danger');
                return;
            }

            // Add participant
            if (!event.participants) {
                event.participants = [];
            }

            event.participants.push({
                name: name,
                email: email,
                phone: phone,
                notes: notes,
                registeredAt: new Date().toISOString()
            });

            saveEvents();
            renderAvailableEvents();
            renderMyRegistrations();
            updateStatistics();

            bootstrap.Modal.getInstance(document.getElementById('registerModal')).hide();
            showAlert(`Successfully registered for "${event.title}"!`, 'success');
        });

        // Render my registrations
        function renderMyRegistrations() {
            const container = document.getElementById('myRegistrationsContainer');
            const myRegistrations = [];

            events.forEach(event => {
                const participant = event.participants?.find(p => p.email === currentUserEmail);
                if (participant) {
                    myRegistrations.push({
                        event: event,
                        participant: participant
                    });
                }
            });

            if (myRegistrations.length === 0) {
                container.innerHTML = `
                    <div class="col-12 text-center text-muted py-5">
                        <i class="fas fa-clipboard fa-4x mb-3"></i>
                        <p>You haven't registered for any events yet.</p>
                        <button class="btn btn-primary mt-3" onclick="document.getElementById('events-tab').click()">
                            <i class="fas fa-calendar-plus me-2"></i>Browse Available Events
                        </button>
                    </div>
                `;
                return;
            }

            container.innerHTML = myRegistrations.map(reg => {
                const eventDate = new Date(reg.event.date);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const isPast = eventDate < today;
                const canModify = !isPast;

                return `
                    <div class="col-md-6 col-lg-4">
                        <div class="card registration-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title">${reg.event.title}</h5>
                                    <span class="badge bg-${isPast ? 'secondary' : 'success'}">${isPast ? 'COMPLETED' : 'UPCOMING'}</span>
                                </div>
                                <div class="event-info">
                                    <i class="fas fa-calendar"></i>
                                    <span>${new Date(reg.event.date).toLocaleDateString()}</span>
                                </div>
                                <div class="event-info">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>${reg.event.venue}</span>
                                </div>
                                <hr>
                                <h6 class="mb-2">Your Registration Details:</h6>
                                <div class="event-info">
                                    <i class="fas fa-user"></i>
                                    <span>${reg.participant.name}</span>
                                </div>
                                <div class="event-info">
                                    <i class="fas fa-envelope"></i>
                                    <span>${reg.participant.email}</span>
                                </div>
                                <div class="event-info">
                                    <i class="fas fa-phone"></i>
                                    <span>${reg.participant.phone}</span>
                                </div>
                                ${reg.participant.notes ? `
                                    <div class="event-info">
                                        <i class="fas fa-sticky-note"></i>
                                        <span>${reg.participant.notes}</span>
                                    </div>
                                ` : ''}
                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-clock me-1"></i>Registered on ${new Date(reg.participant.registeredAt).toLocaleDateString()}
                                </small>
                                ${canModify ? `
                                    <div class="mt-3">
                                        <button class="btn btn-warning btn-sm w-100 mb-2" onclick="openUpdateModal(${reg.event.id}, '${reg.participant.email}')">
                                            <i class="fas fa-edit me-2"></i>Update Details
                                        </button>
                                        <button class="btn btn-danger btn-sm w-100" onclick="openCancelModal(${reg.event.id}, '${reg.participant.email}')">
                                            <i class="fas fa-times me-2"></i>Cancel Registration
                                        </button>
                                    </div>
                                ` : `
                                    <div class=\"mt-3\">
                                        <button class=\"btn btn-danger btn-sm w-100\" disabled>
                                            <i class=\"fas fa-times me-2\"></i>Cannot Cancel (Event Passed)
                                        </button>
                                    </div>
                                `}
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Open update modal
        function openUpdateModal(eventId, participantEmail) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;

            const participant = event.participants.find(p => p.email === participantEmail);
            if (!participant) return;

            document.getElementById('updateEventId').value = eventId;
            document.getElementById('updateParticipantEmail').value = participantEmail;
            document.getElementById('updateName').value = participant.name;
            document.getElementById('updateEmail').value = participant.email;
            document.getElementById('updatePhone').value = participant.phone;
            document.getElementById('updateNotes').value = participant.notes || '';
            new bootstrap.Modal(document.getElementById('updateRegistrationModal')).show();
        }
        // Confirm update
        document.getElementById('confirmUpdateBtn').addEventListener('click', function()
        {
            const eventId = parseInt(document.getElementById('updateEventId').value);
            const participantEmail = document.getElementById('updateParticipantEmail').value;
            const event = events.find(e => e.id === eventId);
            
            if (!event) return;

            const participant = event.participants.find(p => p.email === participantEmail);
            if (!participant) return;

            const name = document.getElementById('updateName').value.trim();
            const email = document.getElementById('updateEmail').value.trim();
            const phone = document.getElementById('updatePhone').value.trim();
            const notes = document.getElementById('updateNotes').value.trim();

            if (!name || !email || !phone) {
                showAlert('Please fill in all required fields!', 'warning');
                return;
            }

            // Update participant details
            participant.name = name;
            participant.email = email;
            participant.phone = phone;
            participant.notes = notes;

            saveEvents();
            renderAvailableEvents();
            renderMyRegistrations();
            updateStatistics();

            bootstrap.Modal.getInstance(document.getElementById('updateRegistrationModal')).hide();
            showAlert(`Your registration details for "${event.title}" have been updated!`, 'success');
        });
        // Open cancel modal
        function openCancelModal(eventId, participantEmail) {
            const event = events.find(e => e.id === eventId);
            if (!event) return;

            document.getElementById('cancelEventId').value = eventId;
            document.getElementById('cancelParticipantEmail').value = participantEmail;
            document.getElementById('cancelEventTitle').textContent = event.title;
            new bootstrap.Modal(document.getElementById('cancelRegistrationModal')).show();
        }
        // Confirm cancellation
        document.getElementById('confirmCancelBtn').addEventListener('click', function() {
            const eventId = parseInt(document.getElementById('cancelEventId').value);
            const participantEmail = document.getElementById('cancelParticipantEmail').value;
            const event = events.find(e => e.id === eventId);
            
            if (!event) return;

            // Remove participant
            event.participants = event.participants.filter(p => p.email !== participantEmail);

            saveEvents();
            renderAvailableEvents();
            renderMyRegistrations();
            updateStatistics();

            bootstrap.Modal.getInstance(document.getElementById('cancelRegistrationModal')).hide();
            showAlert(`Your registration for "${event.title}" has been cancelled.`, 'info');
        });
        // Update statistics
        function updateStatistics() {
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            const totalAvailableEvents = events.filter(e => new Date(e.date) >= today).length;
            const myRegistrationsCount = events.reduce((count, event) => {
                return count + (event.participants?.some(p => p.email === currentUserEmail) ? 1 : 0);
            }, 0);
            const upcomingEventsCount = events.reduce((count, event) => {
                const eventDate = new Date(event.date);
                if (eventDate >= today && event.participants?.some(p => p.email === currentUserEmail)) {
                    return count + 1;
                }
                return count;
            }, 0);

            document.getElementById('totalAvailableEvents').textContent = totalAvailableEvents;
            document.getElementById('myRegistrationsCount').textContent = myRegistrationsCount;
            document.getElementById('upcomingEventsCount').textContent = upcomingEventsCount;
        }
    </script>
</body>
</html>
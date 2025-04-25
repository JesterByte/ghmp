<style>
  /* Light mode defaults */
  .dropdown-header.text-muted {
    font-size: 0.85rem;
    font-weight: 600;
    background-color: #f8f9fa;
    color: #6c757d;
    padding: 0.5rem 1rem;
    border-top: 1px solid #dee2e6;
  }

  /* === Dark Mode Enhancements === */
  [data-bs-theme="dark"] .dropdown-header.text-muted {
    background-color: #1f1f1f;
    color: #b0b0b0;
    border-top: 1px solid #3a3a3a;
  }

  /* Optional: rounded edges or other tweaks */
  [data-bs-theme="dark"] .dropdown-header.text-muted:first-of-type {
    border-top: none;
  }

  /* Mark as Read button */
  .mark-read {
    font-size: 0.75rem;
    transition: all 0.2s ease-in-out;
  }

  .mark-read:hover {
    background-color: #e6f4ea;
    color: #198754 !important;
  }

  /* === Dark Mode Overrides === */
  [data-bs-theme="dark"] .dropdown-menu {
    background-color: #1f1f1f;
    color: #e0e0e0;
  }

  [data-bs-theme="dark"] .dropdown-item {
    color: #e0e0e0;
  }

  [data-bs-theme="dark"] .dropdown-item:hover,
  [data-bs-theme="dark"] .dropdown-item:focus {
    background-color: #2c2c2c;
    color: #ffffff;
  }

  [data-bs-theme="dark"] .dropdown-header.text-muted {
    color: #b0b0b0;
    background-color: #1f1f1f;
    border-bottom: 1px solid #2d2d2d;
  }

  [data-bs-theme="dark"] .mark-read:hover {
    background-color: #2a4330;
    color: #5fff9d !important;
  }

  [data-bs-theme="dark"] .btn-light {
    background-color: #2e2e2e;
    color: #ffffff;
    border-color: #444;
  }

  [data-bs-theme="dark"] .dropdown-divider {
    border-top-color: #444;
  }

  [data-bs-theme="dark"] .dropdown-menu::-webkit-scrollbar {
    width: 6px;
  }

  [data-bs-theme="dark"] .dropdown-menu::-webkit-scrollbar-thumb {
    background-color: #555;
    border-radius: 3px;
  }
</style>



<header class="navbar sticky-top bg-primary flex-md-nowrap p-0 shadow" data-bs-theme="auto">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">GHMP</a>

  <!-- Notification Bell Icon with Dropdown -->
  <ul class="navbar-nav ms-auto me-3">
    <li class="nav-item dropdown">
      <a class="nav-link text-white position-relative me-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="notificationBell">
        <i class="bi bi-bell" id="bellIcon"></i>
        <!-- Notification Count Badge -->
        <span id="notificationCount" class="position-absolute top-0 start-100 translate-top badge rounded-circle bg-danger">
        </span>
      </a>
      <!-- Notification Dropdown (Responsive Width) -->
      <ul class="dropdown-menu dropdown-menu-end shadow position-absolute"
        style="
          top: 40px; right: 0;
          width: 70vw;          /* Default for small screens (mobile) */
          max-width: 500px;     /* Limit the maximum width */
          max-height: 300px; 
          overflow-y: auto;
        " id="notificationList">
        <li class="dropdown-header">Notifications</li>
        <li>
          <div class="dropdown-item">Loading...</div>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
      </ul>
    </li>
  </ul>

  <ul class="navbar-nav flex-row d-md-none">
    <li class="nav-item text-nowrap">
      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list"></i>
      </button>
    </li>
  </ul>
</header>

<script>
  window.addEventListener("DOMContentLoaded", () => {
    const adminId = <?= (int) $userId ?>;

    if (adminId) {
      fetchNotifications(adminId);
    }
  });

  function fetchNotifications(adminId) {
    fetch(`<?= BASE_URL . "/notification/fetchNotifications/" ?>${adminId}`)
      .then(response => {
        if (!response.ok) {
          throw new Error("Failed to fetch notifications.");
        }
        return response.json();
      })
      .then(grouped => {
        const notificationList = document.getElementById("notificationList");
        const notificationCount = document.getElementById("notificationCount");

        notificationList.innerHTML = `<li class="dropdown-header">Notifications</li>`;
        let totalCount = 0;

        for (const groupTitle in grouped) {
          const groupItems = grouped[groupTitle];
          if (groupItems.length === 0) continue;

          notificationList.innerHTML += `
            <li><h6 class="dropdown-header text-muted border-top mt-2 px-3">${groupTitle}</h6></li>
          `;

          groupItems.forEach(notification => {
            notificationList.innerHTML += `
        <li class="d-flex justify-content-between align-items-center">
          <a class="dropdown-item text-wrap" href="<?= BASE_URL . "/" ?>${notification.link}" style="white-space: normal;">
            ${notification.message}
          </a>
          <button class="btn btn-sm btn-light border-0 mark-read" data-bs-toggle="tooltip" data-bs-placement="left" title="Mark as read" onclick="markAsRead(${notification.id})">
            <i class="bi bi-check-circle text-success"></i>
          </button>
        </li>
      `;
            totalCount++;
          });
        }

        if (totalCount > 0) {
          notificationCount.textContent = totalCount > 99 ? "99" : totalCount;
          notificationCount.style.display = "block";
          notificationList.innerHTML += `
      <li><hr class="dropdown-divider"></li>
      <li><button class="dropdown-item text-center" onclick="markAllAsRead(${adminId})">Mark All as Read</button></li>
    `;
        } else {
          notificationList.innerHTML += `<li class="dropdown-item">No new notifications</li>`;
          notificationCount.style.display = "none";
        }
      })

      .catch(error => console.error("Error fetching notifications:", error));
  }

  function markAsRead(notificationId) {
    fetch(`<?= BASE_URL . '/notification/markAsRead/' ?>${notificationId}`)
      .then(response => {
        if (!response.ok) {
          throw new Error("Failed to mark notification as read.");
        }
        return response.json();
      })
      .then(data => {
        if (data.status === "success") {
          const adminId = <?= (int) $userId ?>;
          fetchNotifications(adminId); // Refresh notifications
        }
      })
      .catch(error => console.error("Error marking notification as read:", error));
  }

  function markAllAsRead(adminId) {
    fetch(`<?= BASE_URL . '/notification/markAllAsRead/' ?>${adminId}`)
      .then(response => {
        if (!response.ok) {
          throw new Error("Failed to mark all notifications as read.");
        }
        return response.json();
      })
      .then(data => {
        if (data.status === "success") {
          fetchNotifications(adminId); // Refresh notifications
        }
      })
      .catch(error => console.error("Error marking all notifications as read:", error));
  }
</script>

<!-- JavaScript to toggle bell icon and mark as read -->
<script>
  const bellIcon = document.getElementById('bellIcon');
  const notificationBell = document.getElementById('notificationBell');
  const markReadButtons = document.querySelectorAll('.mark-read');
  const notificationCount = document.getElementById('notificationCount');

  notificationBell.addEventListener('show.bs.dropdown', () => {
    bellIcon.classList.remove('bi-bell');
    bellIcon.classList.add('bi-bell-fill');
  });

  notificationBell.addEventListener('hide.bs.dropdown', () => {
    bellIcon.classList.remove('bi-bell-fill');
    bellIcon.classList.add('bi-bell');
  });

  markReadButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();
      const notificationItem = button.closest('li');
      notificationItem.remove();

      // Update notification count
      let count = parseInt(notificationCount.textContent);
      if (count > 1) {
        notificationCount.textContent = count - 1;
      } else {
        notificationCount.style.display = 'none'; // Hide if no more notifications
      }
    });
  });
</script>
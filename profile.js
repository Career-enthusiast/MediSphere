// Sidebar Navigation - Active State Highlight
const sidebarItems = document.querySelectorAll('.sidebar nav ul li');
sidebarItems.forEach(item => {
    item.addEventListener('click', () => {
        document.querySelector('.sidebar nav ul .active').classList.remove('active');
        item.classList.add('active');
    });
});

// Save Profile Functionality
const saveProfileButton = document.querySelector('.save-btn');
saveProfileButton.addEventListener('click', () => {
    saveProfileButton.textCo// Sidebar Navigation - Active State Highlight
    const sidebarItems = document.querySelectorAll('.sidebar nav ul li');
    sidebarItems.forEach(item => {
        item.addEventListener('click', () => {
            document.querySelector('.sidebar nav ul .active').classList.remove('active');
            item.classList.add('active');
        });
    });
    
    // Save Profile Functionality
    const saveProfileButton = document.querySelector('.save-btn');
    const editProfileButton = document.querySelector('.edit-btn');
    const profileFields = document.querySelectorAll('.profile-info input');
    
    // Toggle Edit Profile Mode
    let isEditing = false;
    
    editProfileButton.addEventListener('click', () => {
        isEditing = !isEditing;
    
        if (isEditing) {
            editProfileButton.textContent = "Cancel";
            profileFields.forEach(field => field.removeAttribute("readonly"));
        } else {
            editProfileButton.textContent = "Edit Profile";
            profileFields.forEach(field => field.setAttribute("readonly", true));
        }
    });
    
    // Save Profile with Delay
    saveProfileButton.addEventListener('click', () => {
        saveProfileButton.textContent = "Saving...";
        
        setTimeout(() => {
            alert("Profile changes saved successfully!");
            saveProfileButton.textContent = "Save Profile";
    
            // Revert to non-editable state after saving
            isEditing = false;
            editProfileButton.textContent = "Edit Profile";
            profileFields.forEach(field => field.setAttribute("readonly", true));
        }, 1000);
    });
    
    // Toggle SMS Alerts
    const smsAlertsButton = document.querySelector('.sms-alerts-btn');
    smsAlertsButton.addEventListener('click', () => {
        if (smsAlertsButton.textContent === "Activate SMS Alerts") {
            smsAlertsButton.textContent = "Deactivate SMS Alerts";
            alert("SMS Alerts have been activated.");
        } else {
            smsAlertsButton.textContent = "Activate SMS Alerts";
            alert("SMS Alerts have been deactivated.");
        }
    });
    ntent = "Saving...";
    setTimeout(() => {
        alert("Profile changes saved successfully!");
        saveProfileButton.textContent = "Save Profile";
    }, 1000); // Simulate save delay
});

// Toggle SMS Alerts
const smsAlertsButton = document.querySelector('.sms-alerts-btn');
smsAlertsButton.addEventListener('click', () => {
    if (smsAlertsButton.textContent === "Activate SMS Alerts") {
        smsAlertsButton.textContent = "Deactivate SMS Alerts";
        alert("SMS Alerts have been activated.");
    } else {
        smsAlertsButton.textContent = "Activate SMS Alerts";
        alert("SMS Alerts have been deactivated.");
    }
});

// View Prescription Details
const viewButtons = document.querySelectorAll('.view-btn');
viewButtons.forEach(button => {
    button.addEventListener('click', () => {
        alert("Prescription details are being fetched...");
        // Here you could add code to dynamically fetch and display details
    });
});

// Refill Status Functionality
const refillButtons = document.querySelectorAll('.refill-due-btn, .refill-done-btn');
refillButtons.forEach(button => {
    button.addEventListener('click', () => {
        if (button.classList.contains('refill-due-btn')) {
            alert("Refill reminder: This medication needs a refill.");
        } else if (button.classList.contains('refill-done-btn')) {
            alert("Medication has been successfully refilled.");
        }
    });
});

// Sample data loader for user profile information (future enhancement)
function loadUserProfile() {
    // Mock function: fetch data and populate profile fields
    console.log("Loading user profile data...");
}

// Initialize the page
document.addEventListener("DOMContentLoaded", () => {
    loadUserProfile(); // Load user profile data
});

// Function to show additional input fields and enable save button after all fields are filled
function previewImage(event) {
    const preview = document.getElementById('profile-pic-preview');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result; // Set the source of the preview image to the file's data
        preview.style.display = 'block'; // Show the preview image
    };

    if (file) {
        reader.readAsDataURL(file); // Read the selected file as a data URL
    } else {
        preview.src = ''; // Reset the preview image if no file is selected
        preview.style.display = 'none'; // Hide the preview image
    }
}

import "./bootstrap";
//apine JS
import Alpine from "alpinejs";

window.Alpine = Alpine;

// Register your Alpine component before Alpine.start()
Alpine.data("formSubmit", () => ({
    submit() {
        this.$refs.btn.disabled = true;
        this.$refs.btn.classList.remove("bg-indigo-600", "hover:bg-indigo-700");
        this.$refs.btn.classList.add("bg-gray-400", "cursor-not-allowed");
        this.$refs.btn.innerHTML = `
      <svg class="animate-spin h-4 w-4 text-white inline mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"></path>
      </svg>
      Please wait...
    `;

        // Submit the actual form
        this.$el.submit();
    },
}));

Alpine.start();

// sidebar
// Sidebar toggle functionality
const toggleSidebar = document.getElementById("toggleSidebar");
const sidebar = document.getElementById("sidebar");
const overlay = document.getElementById("overlay");

// Profile dropdown functionality
const profileDropdown = document.getElementById("profileDropdown");
const profileMenu = document.getElementById("profileMenu");

function openSidebar() {
    sidebar.classList.remove("-translate-x-full");
    overlay.classList.remove("hidden");
}

function closeSidebar() {
    sidebar.classList.add("-translate-x-full");
    overlay.classList.add("hidden");
}

function toggleProfileMenu() {
    profileMenu.classList.toggle("hidden");
}

// Event listeners
toggleSidebar.addEventListener("click", openSidebar);
overlay.addEventListener("click", closeSidebar);
profileDropdown.addEventListener("click", toggleProfileMenu);

// Close sidebar when clicking outside on mobile
document.addEventListener("click", function (event) {
    const isClickInsideSidebar = sidebar.contains(event.target);
    const isClickOnToggle = toggleSidebar.contains(event.target);

    if (
        !isClickInsideSidebar &&
        !isClickOnToggle &&
        window.innerWidth < 1024 &&
        !sidebar.classList.contains("-translate-x-full")
    ) {
        closeSidebar();
    }
});

// Set active menu item
document.querySelectorAll("#sidebar a").forEach((item) => {
    item.addEventListener("click", function () {
        document.querySelectorAll("#sidebar a").forEach((i) => {
            i.classList.remove("active-menu-item");
        });
        this.classList.add("active-menu-item");
    });
});

// Close profile menu when clicking outside
document.addEventListener("click", function (event) {
    if (
        !profileDropdown.contains(event.target) &&
        !profileMenu.contains(event.target)
    ) {
        profileMenu.classList.add("hidden");
    }
});

// Handle window resize
window.addEventListener("resize", function () {
    if (window.innerWidth >= 1024) {
        sidebar.classList.remove("-translate-x-full");
        overlay.classList.add("hidden");
    } else {
        closeSidebar();
    }
});

// Close sidebar when clicking on sidebar menu items on mobile
const sidebarLinks = document.querySelectorAll("#sidebar a");
sidebarLinks.forEach((link) => {
    link.addEventListener("click", function () {
        if (window.innerWidth < 1024) {
            closeSidebar();
        }
    });
});

// Add new product - Form Validation
let currentStep = 1;
const totalSteps = 3;

// DOM Elements
const stepText = document.getElementById("stepText");
const stepTitle = document.getElementById("stepTitle");
const progressBar = document.getElementById("progressBar");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const submitBtn = document.getElementById("submitBtn");
const stepContents = document.querySelectorAll(".step-content");
const dragDropArea = document.getElementById("dragDropArea");
const fileInput = document.getElementById("fileInput");
const uploadedFiles = document.getElementById("uploadedFiles");

// Store uploaded files
let uploadedFilesList = [];

// Step titles for each step
const stepTitles = ["Basic Information", "Pricing & Quantity", "Product Media"];

// Validation rules for each step
const validationRules = {
    1: [
        {
            name: "product_name",
            required: true,
            message: "Product name is required",
        },
        {
            name: "category_id",
            required: true,
            message: "Product category is required",
        },
        {
            name: "sales_type",
            required: true,
            message: "Sales type is required",
        },
        {
            name: "sales_niche",
            required: true,
            message: "Sales niche is required",
        },
    ],
    2: [
        {
            name: "price",
            required: true,
            type: "number",
            message: "Price per unit is required",
        },
        { name: "currency", required: true, message: "Currency is required" },
        {
            name: "quantity_available",
            required: true,
            type: "number",
            message: "Quantity available is required",
        },
        { name: "location", required: true, message: "Location is required" },
        {
            name: "shipping",
            required: true,
            message: "Shipping option is required",
        },
    ],
    3: [
        {
            name: "images",
            required: true,
            type: "file",
            min: 3,
            max: 5,
            message: "Please upload 3-5 product images",
        },
        {
            name: "description",
            required: true,
            message: "Product description is required",
        },
        {
            name: "specifications",
            required: true,
            message: "Product specifications are required",
        },
    ],
};

// Initialize the form
function initForm() {
    updateStepDisplay();

    // Event listeners
    prevBtn.addEventListener("click", goToPreviousStep);
    nextBtn.addEventListener("click", goToNextStep);
    submitBtn.addEventListener("click", submitForm);

    // Drag and drop functionality
    setupDragAndDrop();
}

// Clear error message
function clearError(fieldName) {
    const field = document.querySelector(`[name="${fieldName}"]`);
    if (field) {
        const errorElement =
            field.parentElement.querySelector(".error-message");
        if (errorElement) {
            errorElement.remove();
        }
        field.classList.remove("border-red-500");
        field.classList.add("border-green-200");
    }
}

// Show error message
function showError(fieldName, message) {
    const field = document.querySelector(`[name="${fieldName}"]`);
    if (field) {
        // Remove existing error if any
        clearError(fieldName);

        // Add error styling
        field.classList.remove("border-green-200");
        field.classList.add("border-red-500");

        // Create and add error message
        const errorElement = document.createElement("span");
        errorElement.className =
            "error-message text-red-500 text-sm mt-1 block";
        errorElement.textContent = message;
        field.parentElement.appendChild(errorElement);
    }
}

// Validate current step
function validateStep(step) {
    let isValid = true;
    const rules = validationRules[step];

    rules.forEach((rule) => {
        // Clear previous errors
        clearError(rule.name);

        if (rule.type === "file") {
            // Validate uploaded files
            if (
                uploadedFilesList.length < rule.min ||
                uploadedFilesList.length > rule.max
            ) {
                showError("images", rule.message);
                isValid = false;
            }
        } else {
            const field = document.querySelector(`[name="${rule.name}"]`);

            if (rule.required) {
                let value;

                // Handle radio buttons
                if (field && field.type === "radio") {
                    value = document.querySelector(
                        `[name="${rule.name}"]:checked`
                    )?.value;
                } else if (field) {
                    value = field.value.trim();
                }

                if (!value) {
                    showError(rule.name, rule.message);
                    isValid = false;
                } else if (rule.type === "number" && parseFloat(value) <= 0) {
                    showError(
                        rule.name,
                        "Please enter a valid positive number"
                    );
                    isValid = false;
                }
            }
        }
    });

    return isValid;
}

// Update step display
function updateStepDisplay() {
    // Update step text and title
    stepText.textContent = `Step ${currentStep} of ${totalSteps}`;
    stepTitle.textContent = stepTitles[currentStep - 1];

    // Update progress bar
    const progressPercentage = (currentStep / totalSteps) * 100;
    progressBar.style.width = `${progressPercentage}%`;

    // Show/hide step content
    stepContents.forEach((step, index) => {
        step.classList.toggle("hidden", index !== currentStep - 1);
    });

    // Show/hide navigation buttons
    prevBtn.classList.toggle("hidden", currentStep === 1);
    nextBtn.classList.toggle("hidden", currentStep === totalSteps);
    submitBtn.classList.toggle("hidden", currentStep !== totalSteps);

    // Update next button text on last step
    if (currentStep === totalSteps) {
        nextBtn.classList.add("hidden");
    }
}

// Go to next step
function goToNextStep() {
    // Validate current step before moving forward
    if (!validateStep(currentStep)) {
        return;
    }

    if (currentStep < totalSteps) {
        currentStep++;
        updateStepDisplay();
        window.scrollTo({ top: 0, behavior: "smooth" });
    }
}

// Go to previous step
function goToPreviousStep() {
    if (currentStep > 1) {
        currentStep--;
        updateStepDisplay();
        window.scrollTo({ top: 0, behavior: "smooth" });
    }
}

// Submit form
function submitForm() {
    // Validate final step
    if (!validateStep(currentStep)) {
        return;
    }

    // If validation passes, manually build FormData with all accumulated files
    const form = document.getElementById("productForm");
    const formData = new FormData(form);
    
    // Remove any existing image files from FormData
    formData.delete('images[]');
    
    // Add all files from our uploadedFilesList
    uploadedFilesList.forEach((file, index) => {
        formData.append('images[]', file);
    });
    
    // Submit the form using fetch
    const submitButton = document.getElementById('submitBtn');
    submitButton.disabled = true;
    submitButton.textContent = 'Publishing...';
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        },
        redirect: 'follow'
    })
    .then(async response => {
        if (response.ok) {
            // Check if it's JSON or redirect
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                const data = await response.json();
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    window.location.href = '/dashboard/products';
                }
            } else {
                // Follow redirect
                window.location.href = '/dashboard/products';
            }
        } else if (response.status === 302 || response.status === 301) {
            window.location.href = '/dashboard/products';
        } else {
            const text = await response.text();
            alert('Error submitting form. Please check all fields and try again.');
            submitButton.disabled = false;
            submitButton.textContent = 'Publish Product';
        }
    })
    .catch(error => {
        console.error('Submit error:', error);
        alert('Error submitting form. Please try again.');
        submitButton.disabled = false;
        submitButton.textContent = 'Publish Product';
    });
}

// Setup drag and drop functionality
function setupDragAndDrop() {
    // Click to upload
    dragDropArea.addEventListener("click", () => {
        fileInput.click();
    });

    // Handle file selection
    fileInput.addEventListener("change", handleFileSelect);

    // Drag and drop events
    ["dragenter", "dragover", "dragleave", "drop"].forEach((eventName) => {
        dragDropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ["dragenter", "dragover"].forEach((eventName) => {
        dragDropArea.addEventListener(eventName, highlight, false);
    });

    ["dragleave", "drop"].forEach((eventName) => {
        dragDropArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
        dragDropArea.classList.add("border-green-500", "bg-green-50");
    }

    function unhighlight() {
        dragDropArea.classList.remove("border-green-500", "bg-green-50");
    }

    // Handle dropped files
    dragDropArea.addEventListener("drop", handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }
}

// Handle file selection from input
function handleFileSelect(e) {
    const files = e.target.files;
    handleFiles(files);
}

// Validate file
function validateFile(file) {
    const maxSize = 5 * 1024 * 1024; // 5MB in bytes
    const allowedTypes = [
        "image/jpeg",
        "image/jpg",
        "image/png",
        "image/gif",
        "image/webp",
    ];

    if (!allowedTypes.includes(file.type)) {
        alert(
            `${file.name} is not a valid image format. Please upload JPEG, PNG, GIF, or WebP images.`
        );
        return false;
    }

    if (file.size > maxSize) {
        alert(`${file.name} is too large. Maximum file size is 5MB.`);
        return false;
    }

    return true;
}

// Update file input with accumulated files
function updateFileInput() {
    // Create a new DataTransfer object to hold our files
    const dataTransfer = new DataTransfer();
    
    // Add all files from our array to the DataTransfer object
    uploadedFilesList.forEach(file => {
        dataTransfer.items.add(file);
    });
    
    // Update the file input with our accumulated files
    fileInput.files = dataTransfer.files;
}

// Process selected files
function handleFiles(files) {
    // Clear any existing image errors
    clearError("images");

    // Check if adding these files would exceed the limit
    const remainingSlots = 5 - uploadedFilesList.length;

    if (files.length > remainingSlots) {
        alert(
            `You can only upload ${remainingSlots} more image(s). Maximum is 5 images.`
        );
        return;
    }

    if (files.length > 0) {
        uploadedFiles.classList.remove("hidden");

        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            // Validate file
            if (!validateFile(file)) {
                continue;
            }

            // Add to uploaded files list
            uploadedFilesList.push(file);

            // Create preview for images
            if (file.type.match("image.*")) {
                const reader = new FileReader();

                reader.onload = (function (theFile, fileIndex) {
                    return function (e) {
                        const preview = document.createElement("div");
                        preview.className = "relative group";
                        preview.dataset.fileIndex =
                            uploadedFilesList.length - files.length + fileIndex;
                        preview.innerHTML = `
                            <img src="${
                                e.target.result
                            }" class="w-full h-32 object-cover rounded-lg" alt="${
                            theFile.name
                        }">
                            <div class="absolute top-1 right-1 bg-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button type="button" class="remove-image bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="absolute bottom-1 left-1 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                ${(theFile.size / 1024 / 1024).toFixed(2)} MB
                            </div>
                        `;

                        // Add remove functionality
                        const removeBtn =
                            preview.querySelector(".remove-image");
                        removeBtn.addEventListener("click", function (e) {
                            e.stopPropagation();
                            const fileIndex = parseInt(
                                preview.dataset.fileIndex
                            );
                            uploadedFilesList.splice(fileIndex, 1);
                            preview.remove();

                            // Update remaining preview indices
                            document
                                .querySelectorAll("#uploadedFiles > div")
                                .forEach((div, idx) => {
                                    div.dataset.fileIndex = idx;
                                });

                            if (uploadedFilesList.length === 0) {
                                uploadedFiles.classList.add("hidden");
                            }

                            // Update the file input with remaining files
                            updateFileInput();
                        });

                        uploadedFiles.appendChild(preview);
                    };
                })(file, i);

                reader.readAsDataURL(file);
            }
        }
        
        // Update the file input with all accumulated files
        updateFileInput();
    }
}

// Initialize the form when the page loads
document.addEventListener("DOMContentLoaded", initForm);

// Image gallery functionality
function changeMainImage(src) {
    document.getElementById("mainImage").src = src;

    // Update thumbnail borders
    const thumbnails = document.querySelectorAll(
        '[onclick*="changeMainImage"]'
    );
    thumbnails.forEach((thumb) => {
        thumb.classList.remove("border-green-500");
        thumb.classList.add("border-transparent");
    });

    // Add border to clicked thumbnail
    event.target.classList.remove("border-transparent");
    event.target.classList.add("border-green-500");
}

// Tab functionality
function showTab(tabName) {
    // Hide all tab contents
    const tabContents = document.querySelectorAll(".tab-content");
    tabContents.forEach((content) => {
        content.classList.add("hidden");
    });

    // Remove active state from all tab buttons
    const tabButtons = document.querySelectorAll(".tab-button");
    tabButtons.forEach((button) => {
        button.classList.remove("active", "text-green-600", "border-green-500");
        button.classList.add("text-gray-500", "border-transparent");
    });

    // Show selected tab content
    document.getElementById(tabName + "-content").classList.remove("hidden");

    // Add active state to selected tab button
    const activeButton = document.getElementById(tabName + "-tab");
    activeButton.classList.remove("text-gray-500", "border-transparent");
    activeButton.classList.add("active", "text-green-600", "border-green-500");
}

// my order

let currentDate = new Date(2025, 7, 13); // August 13, 2025

function getDaysInMonth(date) {
    const year = date.getFullYear();
    const month = date.getMonth();
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const daysInMonth = lastDay.getDate();
    const startingDayOfWeek = firstDay.getDay();

    const days = [];

    // Previous month's days
    const prevMonthLastDay = new Date(year, month, 0).getDate();
    for (let i = startingDayOfWeek - 1; i >= 0; i--) {
        days.push({ day: prevMonthLastDay - i, disabled: true });
    }

    // Current month's days
    for (let i = 1; i <= daysInMonth; i++) {
        days.push({
            day: i,
            disabled: false,
            selected:
                i === currentDate.getDate() &&
                month === currentDate.getMonth() &&
                year === currentDate.getFullYear(),
        });
    }

    // Next month's days
    const remainingDays = 42 - days.length; // 6 rows * 7 days
    for (let i = 1; i <= remainingDays; i++) {
        days.push({ day: i, disabled: true });
    }

    return days;
}

function renderCalendar() {
    const cal = document.getElementById("calendar");
    const monthYear = document.getElementById("monthYear");

    const monthNames = [
        "JANUARY",
        "FEBRUARY",
        "MARCH",
        "APRIL",
        "MAY",
        "JUNE",
        "JULY",
        "AUGUST",
        "SEPTEMBER",
        "OCTOBER",
        "NOVEMBER",
        "DECEMBER",
    ];

    monthYear.innerHTML = `
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">${
                    monthNames[currentDate.getMonth()]
                }</span>
                <span class="text-xl font-bold text-gray-900">${currentDate.getFullYear()}</span>
            `;

    const days = getDaysInMonth(currentDate);

    cal.innerHTML = days
        .slice(0, 35)
        .map(
            (d) => `
                <div class="calendar-day text-center py-1 sm:py-2.5 rounded-md text-xs sm:text-sm font-medium cursor-pointer ${
                    d.selected ? "selected" : d.disabled ? "disabled" : ""
                }">
                    ${d.day}
                </div>
            `
        )
        .join("");
}

function changeMonth(direction) {
    currentDate.setMonth(currentDate.getMonth() + direction);
    renderCalendar();
}

renderCalendar();


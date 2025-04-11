<!-- Add Burial Reservation Modal -->
<div class="modal fade" id="add-burial-reservation-modal" tabindex="-1" aria-labelledby="add-burial-reservation-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="add-burial-reservation-modal-label">Add New Burial Reservation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL . '/burial-reservations/add-reservation' ?>" id="add-burial-reservation" method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                    <!-- Select Customer -->
                    <div class="form-floating mb-3">
                        <select name="customer" id="customer" class="form-select" required>
                            <option value="" selected></option>
                            <?php if (!empty($formattedOwners)): ?>
                            <?php foreach ($formattedOwners as $row): ?>
                                <option value="<?= $row["owner_id"] ?>"><?= $row["customer"] ?></option>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>No customers available</option>
                            <?php endif; ?>
                        </select>
                        <label for="customer">Customer</label>
                    </div>

                    <!-- Select Asset (Dynamically Populated) -->
                    <div class="form-floating mb-3">
                        <select name="asset" id="asset" class="form-select" required>
                            <option value="" selected></option>
                        </select>
                        <label for="asset">Asset</label>
                    </div>

                    <!-- Personal Information -->
                    <div class="mb-3">
                        <p class="form-text fw-bold">Your Relationship to the Deceased</p>
                        <div class="form-floating">
                            <select name="relationship" id="relationshipSelect" class="form-select" required>
                                <option value="" disabled selected></option>
                                <option value="Spouse">Spouse</option>
                                <option value="Child">Child</option>
                                <option value="Parent">Parent</option>
                                <option value="Sibling">Sibling</option>
                                <option value="Other">Other (Please Specify)</option>
                            </select>
                            <label for="relationship">Relationship</label>
                        </div>

                        <!-- Show input field if "Other" is selected -->
                        <div id="otherRelationshipInput" class="mt-3" style="display: none;">
                            <div class="form-floating">
                                <input type="text" name="other_relationship" placeholder="Specify your relationship" id="otherRelationship" class="form-control">
                                <label for="otherRelationship">Specify Your Relationship</label>
                            </div>
                        </div>
                    </div>

                    <!-- Deceased Information -->
                    <p class="form-text fw-bold">Deceased's Information</p>
                    <div class="form-floating mb-3">
                        <input type="text" name="first_name" placeholder="Enter first name" required id="firstName" class="form-control">
                        <label for="firstName">First Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="middle_name" placeholder="Enter middle name (if applicable)" id="middleName" class="form-control">
                        <label for="middleName">Middle Name (Optional)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="last_name" placeholder="Enter last name" required id="lastName" class="form-control">
                        <label for="lastName">Last Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select name="suffix" id="suffix" class="form-select">
                            <option value="" selected>No Suffix</option>
                            <option value="Sr.">Sr.</option>
                            <option value="Jr.">Jr.</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                        </select>
                        <label for="suffix">Suffix</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" name="date_of_birth" id="dateOfBirth" class="form-control">
                        <label for="dateOfBirth">Date of Birth (Cannot be in the future)</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" name="date_of_death" id="dateOfDeath" class="form-control">
                        <label for="dateOfDeath">Date of Death (Cannot be in the future)</label>
                    </div>

                    <div class="form-floating">
                        <textarea name="obituary" required placeholder="Share a short message" id="obituary" class="form-control" style="height: 100px"></textarea>
                        <label for="obituary">Obituary (Brief Message)</label>
                    </div>

                    <!-- Burial Details -->
                    <p class="form-text fw-bold">Burial Details</p>

                    <div class="form-floating mb-3">
                        <select name="burial_type" id="burialTypeSelect" class="form-select" required>
                            <option value="" selected disabled></option>
                        </select>
                        <label for="burialTypeSelect">Burial Type (Based on asset type)</label>
                    </div>

                    <input type="hidden" name="burial_price" id="burialPrice">

                    <div class="form-floating">
                        <input type="datetime-local" name="datetime" placeholder="Select date & time" required id="datetime" class="form-control">
                        <label for="datetime">Burial Date & Time (At least 3 days from today)</label>
                    </div>

                    <!-- Receipt Upload -->
                    <p class="form-text fw-bold mt-3">Upload Payment Receipt</p>
                    <div class="mb-3">
                        <input type="file" name="receipt" id="receipt" class="form-control"
                            accept=".png,.jpg,.jpeg,.gif,.bmp,.webp" required>
                        <small class="form-text text-muted">Accepted formats: PNG, JPG, JPEG, GIF, BMP, WEBP (Max size: 5MB)</small>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="add-burial-reservation">Add Reservation</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Validate File Size & Type -->
<script>
    document.getElementById("receipt").addEventListener("change", function() {
        const file = this.files[0];
        const allowedExtensions = ["png", "jpg", "jpeg", "gif", "bmp", "webp"]; // Image extensions

        if (file) {
            const fileSize = file.size / (1024 * 1024); // Convert to MB
            const fileExtension = file.name.split('.').pop().toLowerCase();

            // Check file extension
            if (!allowedExtensions.includes(fileExtension)) {
                alert("Invalid file type. Please upload a valid image format (PNG, JPG, JPEG, GIF, BMP, WEBP).");
                this.value = ""; // Reset input
                return;
            }

            // Check file size (max 5MB)
            if (fileSize > 5) {
                alert("File size exceeds 5MB. Please upload a smaller file.");
                this.value = ""; // Reset input
            }
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const relationshipSelect = document.getElementById("relationshipSelect");
        const otherRelationshipInput = document.getElementById("otherRelationshipInput");
        const otherRelationshipField = document.getElementById("otherRelationship");

        relationshipSelect.addEventListener("change", function() {
            otherRelationshipInput.style.display = relationshipSelect.value === "Other" ? "block" : "none";
            otherRelationshipField.toggleAttribute("required", relationshipSelect.value === "Other");
        });
    });
</script>

<!-- JavaScript to Load Assets Dynamically -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const customerSelect = document.getElementById("customer");
        const assetSelect = document.getElementById("asset");
        const burialTypeSelect = document.getElementById("burialTypeSelect");

        // Fetch assets when customer is selected
        customerSelect.addEventListener("change", function() {
            const customerId = this.value;
            assetSelect.innerHTML = '<option value="" disabled selected>Loading...</option>';
            burialTypeSelect.innerHTML = '<option value="" selected disabled></option>'; // Reset burial types

            if (customerId) {
                fetch(`<?= BASE_URL . '/burial-reservations/get-assets/' ?>${customerId}`)
                    .then(response => {
                        // Check if the response is ok (status code 200-299)
                        if (!response.ok) {
                            throw new Error('Failed to fetch assets');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Clear the dropdown first
                        assetSelect.innerHTML = '';

                        // Check if there are assets
                        if (data.length > 0) {
                            assetSelect.innerHTML = '<option value="" disabled selected></option>';
                            data.forEach(asset => {
                                assetSelect.innerHTML += `<option value="${asset.asset_id}" data-bs-type="${asset.asset_type}">${asset.asset_type} - ${asset.asset_id}</option>`;
                            });
                        } else {
                            // No assets available, show "No available assets"
                            assetSelect.innerHTML = '<option value="" disabled selected>No available assets</option>';
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching assets:", error);
                        assetSelect.innerHTML = '<option value="" disabled selected>Error loading assets</option>';
                    });
            }
        });



        assetSelect.addEventListener("change", function() {
            const selectedOption = assetSelect.options[assetSelect.selectedIndex];
            const assetType = selectedOption.getAttribute("data-bs-type"); // Get asset type
            const burialPriceHidden = document.getElementById("burialPrice");

            burialTypeSelect.innerHTML = '<option value="" selected disabled>Loading burial types...</option>'; // Reset burial types

            if (assetType) {
                fetch(`<?= BASE_URL . '/burial-reservations/get-burial-types/' ?>${assetType}`)
                    .then(response => response.json())
                    .then(data => {
                        burialTypeSelect.innerHTML = '<option value="" selected disabled>Select Burial Type</option>';
                        if (data.length > 0) {
                            data.forEach(type => {
                                const formattedPrice = Number(type.price).toLocaleString("en-US"); // Add commas for display
                                burialTypeSelect.innerHTML += `<option value="${type.burial_type}" data-bs-price="${type.price}">${type.burial_type} (₱${formattedPrice})</option>`;
                            });
                        } else {
                            burialTypeSelect.innerHTML = '<option value="" disabled selected>No burial types available</option>';
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching burial types:", error);
                        burialTypeSelect.innerHTML = '<option value="" disabled selected>Error loading burial types</option>';
                    });
            }
        });

        // When the burial type is selected, assign the price to the hidden input
        burialTypeSelect.addEventListener("change", function() {
            const selectedOption = burialTypeSelect.options[burialTypeSelect.selectedIndex];
            const burialPrice = selectedOption.getAttribute("data-bs-price");

            if (burialPrice) {
                document.getElementById("burialPrice").value = burialPrice; // Set the hidden input field to the selected price
            }
        });

    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dateOfBirth = document.getElementById("dateOfBirth");
        const dateOfDeath = document.getElementById("dateOfDeath");
        const datetime = document.getElementById("datetime");

        const today = new Date().toISOString().split("T")[0];
        dateOfBirth.setAttribute("max", today);
        dateOfDeath.setAttribute("max", today);

        // Set minimum and maximum burial date
        let minBurialDate = new Date();
        minBurialDate.setDate(minBurialDate.getDate() + 3);
        
        let maxBurialDate = new Date();
        maxBurialDate.setDate(maxBurialDate.getDate() + 14); // Allow booking up to 14 days ahead

        datetime.setAttribute("min", minBurialDate.toISOString().slice(0, 16));
        datetime.setAttribute("max", maxBurialDate.toISOString().slice(0, 16));

        // Add validation for burial date selection
        datetime.addEventListener("change", function() {
            const selectedDate = new Date(this.value);
            if (selectedDate < minBurialDate || selectedDate > maxBurialDate) {
                alert("Burial date must be between 3 and 14 days from today");
                this.setCustomValidity("Invalid burial date");
            } else {
                this.setCustomValidity("");
            }
        });

        // Event listener for validating the relationship between birth and death dates
        dateOfBirth.addEventListener("change", function() {
            // Ensure that the birth date cannot be later than the death date
            if (dateOfDeath.value && dateOfBirth.value > dateOfDeath.value) {
                dateOfBirth.setCustomValidity("Date of Birth cannot be later than Date of Death.");
            } else {
                dateOfBirth.setCustomValidity(""); // Clear custom validity if condition is met
            }

            // Update the minimum allowed date for death (cannot be earlier than birth date)
            dateOfDeath.setAttribute("min", dateOfBirth.value || "");
        });

        dateOfDeath.addEventListener("change", function() {
            // Ensure that the death date is not earlier than the birth date
            if (dateOfBirth.value && dateOfDeath.value < dateOfBirth.value) {
                alert("Date of Death cannot be earlier than Date of Birth.");
                dateOfDeath.setCustomValidity("Date of Death cannot be earlier than Date of Birth.");
            } else {
                dateOfDeath.setCustomValidity(""); // Clear custom validity if condition is met
            }
        });
    });
</script>
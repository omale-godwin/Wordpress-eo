jQuery(document).ready(function ($) {
    const fullNameInput = $("#full-name");
    const emailInput = $("#email");
    const subscribeButton = $(".subscribe-button");

    // Disable the button by default
    subscribeButton.prop("disabled", true).addClass("disabled");

    function validateFullName() {
        const fullName = fullNameInput.val().trim();
        const nameError = $("#name-error");
        const nameParts = fullName.split(" ").filter(word => word.length > 0);

        if (fullName === "" || nameParts.length < 2) {
            nameError.text("Please enter full name");
            fullNameInput.css("border-color", "#F6432C");
            return false;
        } else {
            nameError.text(""); // Clear error if valid
            fullNameInput.css("border-color", "#86FF46"); // #86FF46 border for valid input
            return true;
        }
    }

    function validateEmail() {
        const email = emailInput.val().trim();
        const emailError = $("#email-error");
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!emailPattern.test(email)) {
            emailError.text("Please enter correct work mail id");
            emailInput.css("border-color", "#F6432C");
            return false;
        } else {
            emailError.text(""); // Clear error if valid
            emailInput.css("border-color", "#86FF46"); // #86FF46 border for valid input
            return true;
        }
    }

    function checkFormValidity() {
        if (validateFullName() && validateEmail()) {
            subscribeButton.prop("disabled", false).removeClass("disabled"); // Enable button
        } else {
            subscribeButton.prop("disabled", true).addClass("disabled"); // Disable button
        }
    }

    // Trigger validation when user types or leaves the input field
    fullNameInput.on("input blur", function () {
        validateFullName();
        checkFormValidity();
    });

    emailInput.on("input blur", function () {
        validateEmail();
        checkFormValidity();
    });

    // Prevent form submission if validation fails
    $("#subscriptionForm").on("submit", function (event) {
        if (!validateFullName() || !validateEmail()) {
            event.preventDefault();
        }
    });
});

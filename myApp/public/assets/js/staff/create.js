// document.addEventListener('DOMContentLoaded', () => {
//     // Hiển thị hình ảnh đại diện khi người dùng chọn
//     const avatarInput = document.getElementById('avt');
//     const avatarPreview = document.getElementById('avatarPreview');
//
//     avatarInput.addEventListener('change', function() {
//         const file = this.files[0];
//         if (file) {
//             const reader = new FileReader();
//             reader.onload = function(e) {
//                 avatarPreview.src = e.target.result; // Cập nhật hình ảnh xem trước
//             }
//             reader.readAsDataURL(file); // Đọc file dưới dạng URL
//         } else {
//             avatarPreview.src = '/images/staff/default-product.png'; // Đặt lại hình ảnh mặc định nếu không có file
//         }
//     });
// });
// document.addEventListener('DOMContentLoaded', () => {
//     const passwordSelect = document.getElementById('Password');
//     const manualPasswordInput = document.getElementById('manualPassword');
//
//     passwordSelect.addEventListener('change', function() {
//         if (this.value === 'manual') {
//             manualPasswordInput.style.display = 'block'; // Hiển thị ô nhập mật khẩu
//         } else {
//             manualPasswordInput.style.display = 'none'; // Ẩn ô nhập mật khẩu
//             manualPasswordInput.value = ''; // Xóa giá trị ô nhập mật khẩu
//         }
//     });
// });

document.getElementById('avatar').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('avatarPreview');
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block'; // Show the preview
    }

    if (file) {
        reader.readAsDataURL(file); // Read the file as a data URL
    }
});

// Check Error
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const fullName = document.getElementById("fullName");
    const roleId = document.getElementById("roleId");
    const dateOfBirth = document.getElementById("dateOfBirth");
    const email = document.getElementById("email");
    const phone = document.getElementById("phone");
    const address = document.getElementById("address");
    const passwordOption = document.getElementById("password");
    const manualPassword = document.getElementById("manualPassword");
    const avatar = document.getElementById("avatar");
    const avatarPreview = document.getElementById("avatarPreview");

    function showError(element, message) {
        let errorDiv = element.parentNode.querySelector(".error-message");
        if (!errorDiv) {
            errorDiv = document.createElement("div");
            errorDiv.className = "error-message";
            errorDiv.style.color = "red";
            errorDiv.style.marginTop = "5px";
            element.parentNode.appendChild(errorDiv);
        }
        errorDiv.textContent = message;
    }

    function clearError(element) {
        let errorDiv = element.parentNode.querySelector(".error-message");
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    // Kiểm tra họ và tên
    fullName.addEventListener("input", function () {
        const nameRegex = /^[A-Za-zÀ-ỹ]+(?:\s[A-Za-zÀ-ỹ]+)*$/;
        const trimmedValue = this.value.trim(); // Xóa khoảng trắng đầu/cuối
        if (!nameRegex.test(trimmedValue)) {
            showError(this, "Họ và tên không hợp lệ (chỉ chứa chữ và khoảng trắng).");
        } else {
            clearError(this);
        }
    });


    // Kiểm tra số điện thoại
    phone.addEventListener("input", function () {
        const phoneRegex = /^[0-9]{10,11}$/;
        this.value = this.value.replace(/[^0-9]/g, ""); // Chỉ cho phép nhập số

        if (!phoneRegex.test(this.value)) {
            showError(this, "Số điện thoại phải có 10 hoặc 11 số.");
        } else {
            clearError(this);
        }
    });

    // Kiểm tra email tồn tại
    email.addEventListener("blur", function () {
        fetch("/staff/checkmail", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({ email: email.value }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.exists) {
                    showError(email, "Email đã tồn tại.");
                } else {
                    clearError(email);
                }
            });
    });

    // Kiểm tra ngày sinh không để trống
    dateOfBirth.addEventListener("blur", function () {
        if (!this.value) {
            showError(this, "Ngày sinh không được để trống.");
        } else {
            clearError(this);
        }
    });

    // Kiểm tra địa chỉ không để trống
    address.addEventListener("input", function () {
        if (this.value.trim() === "") {
            showError(this, "Địa chỉ không được để trống.");
        } else {
            clearError(this);
        }
    });

    // Kiểm tra mật khẩu khi chọn nhập thủ công
    passwordOption.addEventListener("change", function () {
        if (this.value === "manual") {
            manualPassword.style.display = "block";
            manualPassword.required = true;
        } else {
            manualPassword.style.display = "none";
            manualPassword.required = false;
            manualPassword.value = "";
            clearError(manualPassword);
        }
    });

    // Kiểm tra mật khẩu nhập thủ công
    manualPassword.addEventListener("input", function () {
        if (passwordOption.value === "manual" && this.value.trim() === "") {
            showError(this, "Mật khẩu không được để trống.");
        } else {
            clearError(this);
        }
    });

    // Xử lý ảnh đại diện
    avatar.addEventListener("change", function (event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            avatarPreview.src = e.target.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });

    // Kiểm tra toàn bộ form khi submit
    form.addEventListener("submit", function (event) {
        let isValid = true;
        let firstErrorElement = null;

        function checkAndFocus(input, message) {
            if (input.value.trim() === "") {
                showError(input, message);
                if (!firstErrorElement) firstErrorElement = input;
                isValid = false;
            }
        }

        checkAndFocus(fullName, "Họ và tên không được để trống.");
        checkAndFocus(dateOfBirth, "Ngày sinh không được để trống.");
        checkAndFocus(email, "Email không được để trống.");
        checkAndFocus(phone, "Số điện thoại không được để trống.");
        checkAndFocus(address, "Địa chỉ không được để trống.");
        checkAndFocus(roleId, "Vui lòng chọn vai trò.");

        if (passwordOption.value === "manual" && manualPassword.value.trim() === "") {
            showError(manualPassword, "Mật khẩu không được để trống.");
            if (!firstErrorElement) firstErrorElement = manualPassword;
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault(); // Ngăn form gửi nếu có lỗi
            firstErrorElement.focus();
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const passwordSelect = document.getElementById("Password");
    const manualPassword = document.getElementById("manualPassword");

    passwordSelect.addEventListener("change", function () {
        if (this.value === "manual") {
            manualPassword.style.display = "block";
            manualPassword.setAttribute("required", "required");
        } else {
            manualPassword.style.display = "none";
            manualPassword.removeAttribute("required");
        }
    });
});









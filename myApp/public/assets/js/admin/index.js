function showDeleteModal(event, formId) {
    event.preventDefault();  // Prevent the default form submission
    const form = document.getElementById(formId);

    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Hành động này không thể hoàn tác!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy',
        reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
            // Submit the form if the user confirms the deletion
            form.submit();
        }
    });
}
document.addEventListener('DOMContentLoaded', () => {
    if(successMessage)
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: successMessage,
            confirmButtonText: 'OK'
    });
});

//Role
//All checkbox
// document.addEventListener('DOMContentLoaded', function() {
//     document.getElementById('select_all_users').addEventListener('click', function() {
//         const checkboxes = document.querySelectorAll('.permission-group input[type="checkbox"]');
//         checkboxes.forEach(function(checkbox) {
//             checkbox.checked = true;
//         });
//     });
// });
// document.addEventListener('DOMContentLoaded', function() {
//     document.getElementById('deselect_all_users').addEventListener('click', function () {
//         const checkboxes = document.querySelectorAll('.permission-group input[type="checkbox"]');
//         checkboxes.forEach(function (checkbox) {
//             checkbox.checked = false;
//         });
//     });
// });

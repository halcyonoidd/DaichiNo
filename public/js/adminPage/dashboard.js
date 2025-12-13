document.addEventListener('DOMContentLoaded', () => {
    // Fungsi untuk menutup notifikasi
    (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
        const $notification = $delete.parentNode;
        $delete.addEventListener('click', () => {
            $notification.parentNode.removeChild($notification);
        });
    });
});
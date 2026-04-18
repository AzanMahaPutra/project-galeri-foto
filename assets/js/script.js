function openModal(img, title, desc, user, likes) {
    const modal = document.getElementById('modal');
    
    document.getElementById('modal-img').src = 'upload/' + img; 
    document.getElementById('modal-title').innerText = title;
    document.getElementById('modal-desc').innerText = desc || 'Tidak ada deskripsi.';
    
    document.getElementById('modal-user').innerText = '@' + user;
    document.getElementById('modal-likes').innerText = likes;
    
    modal.classList.remove('opacity-0', 'pointer-events-none');
    document.body.style.overflow = 'hidden';
    
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

function closeModal() {
    const modal = document.getElementById('modal');
    modal.classList.add('opacity-0', 'pointer-events-none');
    document.body.style.overflow = 'auto';
}

document.addEventListener('DOMContentLoaded', function() {
    const originalOpenModal = openModal;
    openModal = function(img, title, desc, user, likes) {
        originalOpenModal(img, title, desc, user, likes);
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    };
});


function alertLogin(event) {
     event.stopPropagation(); 
    
    Swal.fire({
        title: 'Mau Like Foto?',
        text: 'Silakan login terlebih dahulu untuk memberikan apresiasi!',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#2563eb',
        cancelButtonColor: '#9ca3af',
        confirmButtonText: 'Login Sekarang',
        cancelButtonText: 'Nanti Saja'
    }).then((result) => {
        if (result.isConfirmed) {
             window.location.href = 'login.php';
        }
    });
}
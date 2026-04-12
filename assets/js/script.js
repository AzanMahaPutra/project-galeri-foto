function openModal(img, title, desc, user, likes) {
    document.getElementById('modal-img').src = 'upload/' + img;
    document.getElementById('modal-title').innerText = title;
    document.getElementById('modal-desc').innerText = desc || 'Tidak ada deskripsi.';
    document.getElementById('modal-user').innerText = '👤 Diposting oleh: @' + user;
    document.getElementById('modal-likes').innerText = '❤️ ' + likes + ' Like';
    
    const modal = document.getElementById('modal');
    modal.classList.remove('opacity-0', 'pointer-events-none');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('modal');
    modal.classList.add('opacity-0', 'pointer-events-none');
    document.body.style.overflow = 'auto';
}
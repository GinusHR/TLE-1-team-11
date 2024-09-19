document.querySelectorAll('.webcam-container').forEach(container => {
    const video = container.querySelector('video');

    container.addEventListener('mouseenter', () => {
        video.play();
    });

    container.addEventListener('mouseleave', () => {
        video.pause();
        video.currentTime = 0; 
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const modals = document.querySelectorAll('.webcam');
    const modal = document.getElementById('modal');
    const modalVideo = document.getElementById('modal-video');
    const modalText = document.getElementById('modal-text');
    const closeModal = document.querySelector('.close');

    modals.forEach((webcam) => {
        webcam.addEventListener('click', () => {
            const videoSource = webcam.getAttribute('data-video');
            const naam = webcam.getAttribute('data-naam');
            const leeftijd = webcam.getAttribute('data-leeftijd');
            const email = webcam.getAttribute('data-email');
            const bloedgroep = webcam.getAttribute('data-bloedgroep');
            const notities = webcam.getAttribute('data-notities');
            const wachtwoord = webcam.getAttribute('data-wachtwoord');

            if (videoSource) {
                modalVideo.querySelector('source').setAttribute('src', videoSource);
                modalVideo.setAttribute('loop', 'loop');  // Zorg ervoor dat loop is ingesteld
                modalVideo.load();
                modalVideo.play();
            }

            const infoList = `
                <ul>
                    <li><strong>Name:</strong> ${naam}</li>
                    <li><strong>Age:</strong> ${leeftijd}</li>
                    <li><strong>Email:</strong> ${email}</li>
                    <li><strong>Bloodtype:</strong> ${bloedgroep}</li>
                    <li><strong>Notes:</strong> ${notities}</li>
                    <li><strong>Password:</strong> ${wachtwoord}</li>
                </ul>
            `;

            modalText.innerHTML = infoList;
            modal.style.display = 'block';
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
        modalVideo.pause();
        modalVideo.currentTime = 0;
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
            modalVideo.pause();
            modalVideo.currentTime = 0;
        }
    });
});

document.querySelectorAll('.webcam-container').forEach(container => {
    const video = container.querySelector('video');

    container.addEventListener('mouseenter', () => {
        video.play();
    });

    container.addEventListener('mouseleave', () => {
        video.pause();
        video.currentTime = 0; // Zet de video terug naar het begin
    });
});

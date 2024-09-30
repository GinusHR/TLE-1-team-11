document.addEventListener('DOMContentLoaded', () => {
    // Hover effect to play/pause video on hover
    document.querySelectorAll('.webcam-container').forEach(container => {
        const video = container.querySelector('video');
        
        // Zorg ervoor dat controls worden verwijderd
        video.removeAttribute('controls'); 

        container.addEventListener('mouseenter', () => {
            if (video) {
                video.play();
            }
        });

        container.addEventListener('mouseleave', () => {
            if (video) {
                video.pause();
                video.currentTime = 0; // Zet de video terug naar het begin
            }
        });
    });

    // Modal functionality
    const modals = document.querySelectorAll('.webcam');
    const modal = document.getElementById('modal');
    const modalVideo = document.getElementById('modal-video');
    const modalText = document.getElementById('modal-text');
    const closeModal = document.querySelector('.close');
    const modals2 = document.querySelectorAll('.webcam2');
    const modal2 = document.getElementById('modal2');
    const modal2Text = document.getElementById('modal2-text');
    const closeModal2 = document.querySelector('.close');

    modals.forEach((webcam) => {
        webcam.addEventListener('click', () => {
            const videoSource = webcam.getAttribute('data-video');
            const naam = webcam.getAttribute('data-naam');
            const leeftijd = webcam.getAttribute('data-leeftijd');
            const email = webcam.getAttribute('data-email');
            const bloedgroep = webcam.getAttribute('data-bloedgroep');
            const notities = webcam.getAttribute('data-notities');
            const wachtwoord = webcam.getAttribute('data-wachtwoord');
            const adres = webcam.getAttribute('data-adres');
            const postcode = webcam.getAttribute('data-postcode')

            if (videoSource) {
                modalVideo.querySelector('source').setAttribute('src', videoSource);
                modalVideo.removeAttribute('controls');  // Verwijder controls hier ook
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
                    <li><strong>Adress:</strong> ${adres}</li>
                    <li><strong>Zipcode:</strong> ${postcode}</li>
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

    modals2.forEach((webcam2) => {
        webcam2.addEventListener('click', () => {
            const naam2 = webcam2.getAttribute('data-naam');
            const leeftijd2 = webcam2.getAttribute('data-leeftijd');
            const email2 = webcam2.getAttribute('data-email');
            const bloedgroep2 = webcam2.getAttribute('data-bloedgroep');
            const notities2 = webcam2.getAttribute('data-notities');
            const wachtwoord2 = webcam2.getAttribute('data-wachtwoord');

            const infoList2 = `
                <ul>
                    <li><strong>Name:</strong> ${naam2}</li>
                    <li><strong>Age:</strong> ${leeftijd2}</li>
                    <li><strong>Email:</strong> ${email2}</li>
                    <li><strong>Bloodtype:</strong> ${bloedgroep2}</li>
                    <li><strong>Notes:</strong> ${notities2}</li>
                    <li><strong>Password:</strong> ${wachtwoord2}</li>
                </ul>
            `;

            modal2Text.innerHTML = infoList2;
            modal2.style.display = 'block';
        });
    });

    closeModal2.addEventListener('click', () => {
        modal2.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
            modalVideo.pause();
            modalVideo.currentTime = 0;
        }

        if (event.target === modal2) {
            modal2.style.display = 'none';
            // modalVideo.pause();
            // modalVideo.currentTime = 0;
        }
    });

    });
    
    
    document.addEventListener('DOMContentLoaded', function() {
        let paymentForm = document.getElementById('payment-form');
        
        // Controleer of het formulier bestaat voordat je een event listener toevoegt
        if (paymentForm) {
            paymentForm.addEventListener('submit', function(event) {
                event.preventDefault();
                let form = event.target;
    
                // Maak een FormData object aan voor de formuliergegevens
                let formData = new FormData(form);
    
                // Stuur het formulier via AJAX
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    // Bij succesvolle betaling wordt de pagina vernieuwd om de blur te verwijderen
                    window.location.reload(); 
                })
                .catch(error => console.error('Error:', error));
            });
        }
        
        // Controleer of de paywall popup aanwezig is
        let popup = document.querySelector('.paywall-popup');
        if (popup) {
            console.log("Popup is aanwezig en zou zichtbaar moeten zijn.");
        } else {
            console.log("Popup is niet aanwezig.");
        }
    }); 
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Document is fully loaded");
        let popup = document.querySelector('.paywall-popup');
        if (popup) {
            console.log("Popup is present and should be visible.");
        } else {
            console.log("Popup is not present.");
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const userPreviews = document.querySelectorAll('.user-preview');
        const userModal = document.getElementById('user-modal');
        const closeModalBtn = document.querySelector('.close-btn');
    
        userPreviews.forEach(preview => {
            preview.addEventListener('click', () => {
                // Vul de modal met de gegevens van de gebruiker
                document.getElementById('modal-name').textContent = preview.dataset.naam;
                document.getElementById('modal-age').textContent = preview.dataset.leeftijd;
                document.getElementById('modal-email').textContent = preview.dataset.email;
                document.getElementById('modal-password').textContent = preview.dataset.wachtwoord;
                document.getElementById('modal-blood-type').textContent = preview.dataset.bloedgroep;
                document.getElementById('modal-address').textContent = preview.dataset.adres;
                document.getElementById('modal-zipcode').textContent = preview.dataset.postcode;
                document.getElementById('modal-notes').textContent = preview.dataset.notities;
    
                // Toon de modal
                userModal.style.display = 'block';
            });
        });
    
        // Sluit de modal
        closeModalBtn.addEventListener('click', () => {
            userModal.style.display = 'none';
        });
    
        // Sluit de modal als er buiten wordt geklikt
        window.addEventListener('click', (event) => {
            if (event.target == userModal) {
                userModal.style.display = 'none';
            }
        });
    });
    
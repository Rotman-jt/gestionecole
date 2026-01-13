// fonction toggel
// const LoginBtn = document.getElementById('LoginBtn');
// const loginplace = document.getElementById('loginplace');

// LoginBtn.addEventListener('click', function() {
//     toggleLogin();
// });

// function toggleLogin() {
//     if (loginplace.style.display === 'none' || loginplace.style.display === '') {
//         loginplace.style.display = 'block';
//     } else {
//         loginplace.style.display = 'none';
//     }
// }

// const LoginBtn = document.getElementById('LoginBtn');
// const loginplace = document.getElementById('loginplace');

// LoginBtn.addEventListener('click', function() {
//     loginplace.style.display = 'block';
// });

// const fermer_LoginBtn = document.getElementById('fermer_LoginBtn');
// fermer_LoginBtn.addEventListener('click', function() {
//     loginplace.style.display = 'none';
// });


document.addEventListener('DOMContentLoaded', () => {
    const loginPlace = document.getElementById('loginplace');
    const overlay = loginPlace.querySelector('.overlay1');
    const closeBtn = document.getElementById('fermer_LoginBtn');
    const openBtn = document.getElementById('LoginBtn');

    // Au départ cacher le loginplace
    loginPlace.style.display = 'none';

    // Fonction pour ouvrir
    function openLogin() {
        loginPlace.style.display = 'block';
    }

    // Fonction pour fermer
    function closeLogin() {
        loginPlace.style.display = 'none';
    }

    // Ecouteurs d'événements
    openBtn.addEventListener('click', openLogin);
    closeBtn.addEventListener('click', closeLogin);
    // overlay.addEventListener('click', closeLogin);

        

           
   if (localStorage.getItem('USER')) {
        
        loginPlace.style.display='none';
        overlay.style.display='none';

    }
   
});


// document.addEventListener('DOMContentLoaded', function() {
//     const hamburger = document.querySelector('.hamburger');
//     const primaryMenu = document.querySelector('.primary-menu');

//     if (hamburger && primaryMenu) {
//         hamburger.addEventListener('click', function() {
//             primaryMenu.classList.toggle('open');
//         });
//     } else {
//         console.error('Hamburger or primaryMenu not found');
//     }
// });

// document.addEventListener('DOMContentLoaded', function() {
//     const hamburger = document.querySelector('.hamburger');
//     const primaryMenu = document.querySelector('.primary-menu');

//     hamburger.addEventListener('click', function() {
//         primaryMenu.classList.toggle('open');
//     });
// });
document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const primaryMenu = document.querySelector('.primary-menu');

    if (hamburger && primaryMenu) {
        hamburger.addEventListener('click', function() {
            console.log('Hamburger clicked'); // This should log when you click the hamburger
            primaryMenu.classList.toggle('open'); /* Toggle the menu visibility */
        });
    }
});

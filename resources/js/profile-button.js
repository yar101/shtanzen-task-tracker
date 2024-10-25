let profileButton = document.getElementById('profile-button');
let profileMenu = document.getElementById('profile-menu');
profileButton.addEventListener('click', () => {
    profileMenu.classList.toggle('hidden');
});

window.onclick = function(event) {
    if (!event.target.matches('#profile-button')) {
        profileMenu.classList.add('hidden');
    }
}
// profileButton.addEventListener('mouseleave', () => {
//     profileMenu.classList.add('hidden');
// });

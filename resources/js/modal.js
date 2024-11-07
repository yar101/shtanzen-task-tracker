// Modal
window.openModal = function (modalId, parentID =  null) {
    document.getElementById(modalId).style.display = 'block'
    document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
}

window.closeModal = function (modalId) {
    document.getElementById(modalId).style.display = 'none'
    document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
}

// Erors

const closeErrorsButton = document.getElementById('close-errors-button');
const errorsWindow = document.getElementById('errors-window');


if (errorsWindow) {
    setTimeout(() => {
        errorsWindow.classList.add('hidden');
    }, 10000);
}

if (closeErrorsButton) {
    closeErrorsButton.addEventListener('click', () => {
        errorsWindow.classList.add('hidden');
    });
}

const createContractorButton = document.getElementById('create-contractor-button');
const createContractorForm = document.getElementById('create-contractor-form');
const contractorsWrapper = document.getElementById('contractors-wrapper');
const contractorCreateErrors = document.getElementById('contractor-create-errors');
const closeErrorsButton = document.getElementById('close-errors-button');

createContractorButton.addEventListener('click', () => {

    console.log('ok')

    createContractorForm.classList.toggle('hidden');

    if (createContractorForm.classList.contains('hidden')) {
        contractorsWrapper.classList.remove('grid-cols-[1fr,4fr]', 'grid');
    } else {
        contractorsWrapper.classList.add('grid-cols-[1fr,4fr]', 'grid');
    }
});

if (closeErrorsButton) {
    closeErrorsButton.addEventListener('click', () => {
        contractorCreateErrors.classList.add('hidden');
    });
}

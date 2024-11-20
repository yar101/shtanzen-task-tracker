window.openCreateTaskModal = function (modalId, parentID =  null, parentContractorID = null, parentManagerID = null, parentTitle = null) {
    document.getElementById(modalId).style.display = 'block';
    document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden');

    const formWrapper = document.getElementById('create-task-form');
    const formWrapperHeader = formWrapper.querySelector('#create-task-form-header');
    const formWrapperContractorInput = formWrapper.querySelector('input[name="contractor_id"]');
    const ContractorSelect = document.getElementById('contractor-select');
    const parentIDInput = formWrapper.querySelector('input[name="parent_id"]');
    const selectManagerID = formWrapper.querySelector('select[name="manager_id"]');
    const titleInput = formWrapper.querySelector('input[name="title"]');


    if (parentID) {
        formWrapperHeader.textContent = 'Создание подзадачи';
    }

    if (parentIDInput) {
        parentIDInput.value = parentID;
    }

    if (parentIDInput.value != null) {
        formWrapperContractorInput.value = parentContractorID;
        ContractorSelect.value = parentContractorID;
        selectManagerID.value = parentManagerID;
        selectManagerID.disabled = true;
        titleInput.value = parentTitle;
    }
}

window.closeCreateTaskModal = function (modalId) {
    document.getElementById(modalId).style.display = 'none';
    document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden');
}

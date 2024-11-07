window.openCreateTaskModal = function (modalId, parentID =  null) {
    document.getElementById(modalId).style.display = 'block';
    document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden');

    const formWrapper = document.getElementById('create-task-form');
    const formWrapperHeader = formWrapper.querySelector('#create-task-form-header');

    const parentIDInput = formWrapper.querySelector('input[name="parent_id"]');

    if (parentID) {
        formWrapperHeader.textContent = 'Создание подзадачи';
    }

    if (parentIDInput) {
        parentIDInput.value = parentID;
    }
}

window.closeCreateTaskModal = function (modalId) {
    document.getElementById(modalId).style.display = 'none';
    document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden');
}

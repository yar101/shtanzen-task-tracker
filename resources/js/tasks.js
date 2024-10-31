const createTaskButton = document.getElementById('create-task-button');
const createTaskForm = document.getElementById('create-task-form');
const tasksWrapper = document.getElementById('tasks-wrapper');
const taskCreateErrors = document.getElementById('task-create-errors');
const closeErrorsButton = document.getElementById('close-errors-button');
// const editTaskButtons = document.querySelectorAll('.edit-task-button');
// const editTaskForm = document.getElementById('edit-task-form');

createTaskButton.addEventListener('click', () => {

    createTaskForm.classList.toggle('hidden');

    if (createTaskForm.classList.contains('hidden')) {
        tasksWrapper.classList.remove('grid-cols-[1fr,4fr]', 'grid');
    } else {
        tasksWrapper.classList.add('grid-cols-[1fr,4fr]', 'grid');
    }
});

if (closeErrorsButton) {
    closeErrorsButton.addEventListener('click', () => {
        taskCreateErrors.classList.add('hidden');
    });
}

// Edit
//
// editTaskButtons.forEach(button => {
//     button.addEventListener('click', () => {
//         editTaskForm.classList.toggle('hidden');
//         if (createTaskForm.classList.contains('hidden')) {
//             tasksWrapper.classList.add('grid-cols-[4fr,1fr]', 'grid');
//         } else {
//             tasksWrapper.classList.add('grid-cols-[1fr,4fr,1fr]', 'grid');
//         }
//     });
// });

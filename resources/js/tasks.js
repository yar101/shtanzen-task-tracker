const tasks = document.getElementById('create-task-button');
const createTaskForm = document.getElementById('create-task-form');
const tasksWrapper = document.getElementById('tasks-wrapper');
const taskCreateErrors = document.getElementById('task-create-errors');
const closeErrorsButton = document.getElementById('close-errors-button');

tasks.addEventListener('click', () => {

    createTaskForm.classList.toggle('hidden');

    if (createTaskForm.classList.contains('hidden')) {
        tasksWrapper.classList.remove('grid-cols-[1fr,4fr]', 'grid');
        tasks.classList.remove('bg-violet-400', 'text-neutral-900', 'hover:bg-violet-500', 'hover:text-neutral-950');
    } else {
        tasksWrapper.classList.add('grid-cols-[1fr,4fr]', 'grid');
        tasks.classList.add('bg-violet-400', 'text-neutral-900', 'hover:bg-violet-500', 'hover:text-neutral-950');
    }
});

closeErrorsButton.addEventListener('click', () => {
    taskCreateErrors.classList.add('hidden');
});

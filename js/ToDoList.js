document.addEventListener('DOMContentLoaded', () => {
    const taskInput = document.getElementById('new-task');
    const addTaskBtn = document.getElementById('add-task-btn');
    const taskList = document.getElementById('task-list');

    addTaskBtn.addEventListener('click', () => {
        const taskText = taskInput.value.trim();

        if (taskText !== '') {
            addTask(taskText);
            taskInput.value = '';
        }
    });

    function addTask(taskText) {
        const taskItem = document.createElement('li');
        taskItem.classList.add('list-group-item');


        const taskTextNode = document.createElement('span');
        taskTextNode.textContent = taskText;

        const completeBtn = document.createElement('button');
        completeBtn.innerHTML = '<i class="fa fa-check"></i>';
        completeBtn.classList.add('complete-btn');
        completeBtn.addEventListener('click', () => {
            taskItem.classList.toggle('completed');
        });

        
        const deleteBtn = document.createElement('button');
        deleteBtn.innerHTML = '<i class="fa fa-trash"></i>';
        deleteBtn.classList.add('delete-btn');
        deleteBtn.addEventListener('click', () => {
            taskList.removeChild(taskItem);
        });

        
        taskItem.appendChild(taskTextNode);
        taskItem.appendChild(completeBtn);
        taskItem.appendChild(deleteBtn);
        
        taskList.appendChild(taskItem);
    }
});

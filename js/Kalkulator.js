const lightModeBtn = document.getElementById('light-mode-btn');
const darkModeBtn = document.getElementById('dark-mode-btn');
const body = document.body;

const display = document.getElementById("display");

lightModeBtn.addEventListener('click', () => {
    body.classList.remove('dark-mode');
    body.classList.add('light-mode');
    lightModeBtn.disabled = true;
    darkModeBtn.disabled = false;
});


darkModeBtn.addEventListener('click', () => {
    body.classList.remove('light-mode');
    body.classList.add('dark-mode');
    darkModeBtn.disabled = true;
    lightModeBtn.disabled = false;
});



function appendToDisplay(input) {
    display.textContent += input;
}

function clearDisplay() {
    display.textContent = "";
}

function calculate() {
    try {
        display.textContent = eval(display.textContent);
    } catch {
        display.textContent = "Error";
    }
}
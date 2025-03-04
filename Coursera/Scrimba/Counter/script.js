let count = 0;

document.getElementById("increment").addEventListener("click", () => { count++; document.getElementById("counter").innerHTML = count; });
document.getElementById("decrement").addEventListener("click", () => { count--; document.getElementById("counter").innerHTML = count; });
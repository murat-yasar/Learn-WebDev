// Elementz
const inputField = document.querySelector("#input-el");
const saveBtn = document.querySelector("#btn-save");
const listField = document.querySelector("#list-el");

// Variables
let linkList = [];

// Functions
saveBtn.addEventListener("click", ()=>{
   linkList.push(inputField.value);
   listField.textContent = "";
   
   linkList.forEach(el => {
      listField.innerHTML += `<li>${el}</li>`;
   });

   inputField.value = "";
});


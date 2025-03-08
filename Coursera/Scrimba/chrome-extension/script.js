// Elementz
const inputField = document.querySelector("#input-el");
const saveBtn = document.querySelector("#btn-save");
const listField = document.querySelector("#list-el");

// Variables
let listItems = [];

// Functions
saveBtn.addEventListener("click", ()=>{
   links.push(inputField.value);
   inputField.value = "";
   itemList = "";
   
   links.forEach(el => {
      // Alternative Solution
      // const liEl = document.createElement("li");
      // liEl.textContent = el;
      // listField.append(liEl);
      itemList += `<li>${el}</li>`;
   });

   listField.innerHTML = itemList;
});


// Elementz
const inputField = document.querySelector("#input-el");
const saveBtn = document.querySelector("#btn-save");
const listField = document.querySelector("#list-el");

// Variables
let links = [];

// Functions
const renderList = () => {
   inputField.value = "";
   itemList = "";
   
   links.forEach(el => {
      itemList += `<li><a href="${el}" target="_blank">${el}</a></li>`;
      // Alternative Solution
      // const liEl = document.createElement("li");
      // liEl.textContent = el;
      // listField.append(liEl);
   });
   listField.innerHTML = itemList;
}

saveBtn.addEventListener("click", ()=>{
   links.push(inputField.value);
   renderList();
});


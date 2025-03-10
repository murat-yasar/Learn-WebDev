// Elements
const inputField = document.querySelector("#input-el");
const saveBtn = document.querySelector("#btn-save");
const listField = document.querySelector("#list-el");

// Variables
let links = [];

// Events
saveBtn.addEventListener("click", ()=>{
   links.push(inputField.value);
   inputField.value = "";
   
   renderList();
});

inputField.addEventListener("keypress", ()=> {
   if (event.key === "Enter") {
      event.preventDefault();
      document.querySelector("#btn-save").click();
   }
});


// Functions
const renderList = () => {
   itemList = "";
   
   links.forEach(el => {
      itemList += `<li><a href="${el}" target="_blank">${el}</a></li>`;
      //** Alternative Solution
      // const liEl = document.createElement("li");
      // liEl.textContent = el;
      // listField.append(liEl); 
   });
   listField.innerHTML = itemList;
}




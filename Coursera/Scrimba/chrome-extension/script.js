//* Elements
const inputField = document.querySelector("#input-el");
const saveBtn = document.querySelector("#btn-save");
const listField = document.querySelector("#list-el");


//* Variables
let links = [];


//* Events
// Trigger SAVE button by pressing enter key on keyboard
inputField.addEventListener("keypress", ()=> {
   if (event.key === "Enter") {
      event.preventDefault();
      document.querySelector("#btn-save").click();
   }
});

// Save by clicking SAVE button
saveBtn.addEventListener("click", ()=>{
   if (inputField.value) {
      // Reset input-field after saving
      links.push(inputField.value);
      inputField.value = "";

      storeData();
      renderList();
   }
});


// Functions
// Store data in localStorage
const storeData = () => {
   localStorage.setItem("favLinks", JSON.stringify(links));
   console.log(localStorage.getItem("favLinks"));
}

// Print data on browser
const renderList = () => {
   let itemList = "";

   links = JSON.parse(localStorage.getItem("favLinks"));
   
   links.forEach(el => {
      itemList += `<li><a href="${el}" target="_blank">${el}</a></li>`;
      //** Alternative Solution
      // const liEl = document.createElement("li");
      // liEl.textContent = el;
      // listField.append(liEl); 
   });
   listField.innerHTML = itemList;
}




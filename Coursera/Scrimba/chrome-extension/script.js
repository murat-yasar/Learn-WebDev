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
      getData();
      storeData();
      renderList();
   }
});


// Functions
const start = () => {
   getData();
   renderList();
}

// Call data from localStorage
const getData = () => {
   if (JSON.parse(localStorage.getItem("favLinks"))) {
      links = JSON.parse(localStorage.getItem("favLinks"));
      renderList();
   }
}

// Store data in localStorage
const storeData = () => {
   links.push(inputField.value);
   inputField.value = "";

   localStorage.setItem("favLinks", JSON.stringify(links));
   // console.log(localStorage.getItem("favLinks"));
}

// Print data on browser
const renderList = () => {
   let itemList = "";

   links.forEach(el => {
      itemList += `<li><a href="${el}" target="_blank">${el}</a></li>`;
      //** Alternative Solution
      // const liEl = document.createElement("li");
      // liEl.textContent = el;
      // listField.append(liEl); 
   });
   listField.innerHTML = itemList;
}

start();
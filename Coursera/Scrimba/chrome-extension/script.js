//* Elements
const inputField = document.querySelector("#input-el");
const saveBtn = document.querySelector("#btn-save");
const delBtn = document.querySelector("#btn-del");
const listField = document.querySelector("#list-el");


//* Variables
const storageKey = "favLinks";
let arr = [];


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
      getData(storageKey);
      storeData(storageKey);
      renderList(arr);
   }
});

// Clear localStorage by clicking DELETE button
delBtn.addEventListener("click", ()=>{
   clearData(storageKey);
   renderList(arr);
});


//* Functions
// Run application
const start = () => {
   getData(storageKey);
   renderList(arr);
}

// Call data from localStorage
const getData = (storageKey) => {
   if (JSON.parse(localStorage.getItem(storageKey))) {
      arr = JSON.parse(localStorage.getItem(storageKey));
      renderList(arr);
   }
}

// Store data in localStorage
const storeData = (storageKey) => {
   arr.push(inputField.value);
   inputField.value = "";

   localStorage.setItem(storageKey, JSON.stringify(arr));
}

// Empty localStorage
const clearData = (storageKey) => {
   arr = [];
   localStorage.clear(storageKey);
}

// Get an array and print them as a list on browser
const renderList = (arr) => {
   let items = "";

   arr.forEach(el => {
      items += `<li><a href="${el}" target="_blank">${el}</a></li>`;
      //** Alternative Solution
      // const liEl = document.createElement("li");
      // liEl.textContent = el;
      // listField.append(liEl); 
   });
   listField.innerHTML = items;
}

start();
/*  //* 01 - Total Savory Items
Use reduce() to total the groceries. 
Then find a method that will round the total to 2 decimal places.

Example output: 73.44
*/
import shoppingCart from "../assets/data-07.js";

function total(arr){
    const total = arr.reduce((acc, curr) => {
        return acc + curr.price;
    }, 0);
    
   return total.toFixed(2);
}

// Test Cases
console.log(total(shoppingCart));



/*  //* 02 - Holiday Gift Shopping
    You're online shopping for holiday gifts, but money is tight
    so we need to look at the cheapest items first. 
    Use the built in sort() method to write a function that returns a new array of
    products sorted by price, cheapest to most expensive. 
    
    Then log the item and the price to the console: 
    
    💕,0
    🍬,0.89
    🍫,0.99
    🧁,0.99
    📚,0.99
    ... continued
*/
import products from "../assets/data-09.js";
function sortProducts(data){
    return data.sort((a,b) => a.price-b.price);
}

// Test Cases
const listByCheapest = sortProducts(products);
console.log(listByCheapest);
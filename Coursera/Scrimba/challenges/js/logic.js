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



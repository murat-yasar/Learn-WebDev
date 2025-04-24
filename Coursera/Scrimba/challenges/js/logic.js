/*  //* 01 - Total Savory Items
Use reduce() to total the groceries. 
Then find a method that will round the total to 2 decimal places.

Example output: 73.44
*/
import shoppingCart from "../assets/data-03.js";

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
import products from "../assets/data-05.js";

function sortProducts(data){
    return data.sort((a,b) => a.price-b.price);
}

// Test Cases
const listByCheapest = sortProducts(products);
console.log(listByCheapest);



/* //* 03 - Collect Unique Genre Tags
Find All Unique Tags 

As a software dev at ScrimFlix, you're working on a feature 
to let users browse TV shows by tag. The first step is to collect all 
the tags from our data into a new array. Then we'll need 
to filter out the duplicate tags. 

Write a function that takes in the media data and returns
a flat array of unique tags.

Expected output: 
["supernatural", "horror", "drama",
"fantasy", "reality", "home improvement", "comedy", "sci-fi", "adventure"]

*/ 
import mediaData from "../assets/data-06.js";

function getUniqueTags(data){
    
    const tags = data.map(item => item.tags).flat(); // Flatten the array of tags
    return [...new Set(tags)];  // Using Set to remove duplicates
}

// Test Cases
console.log(getUniqueTags(mediaData));

/* //* 01 - Chef Mario's Recipe Book 
Chef Mario was in the middle of writing his cookbook masterpiece
when he spilled coffee on his keyboard! Now all his recipes have repeat
ingredients.

Help save Chef Mario's cookbook by writing a function that takes in an array 
and returns a new array with all the duplicates removed. 

Example input: ["🌈 rainbow", "🦄 unicorn", "🍭 lollipops", "🦄 unicorn", "🍭 lollipops"];
Example output: ["🌈 rainbow", "🦄 unicorn", "🍭 lollipops"];
*/ 

const eggScrambleRecipe = [
   "🥓 bacon",
   "🥓 bacon", 
   "🍳 eggs",
   "🫑 green peppers",
   "🧀 cheese",
   "🌶️ hot sauce",
   "🥓 bacon",
   "🥦 broccoli", 
   "🧀 cheese",
   "🥦 broccoli", 
   "🌶️ hot sauce"
]

function removeDupesFromArray(arr){
   // const uniqueItems = {};

   // return arr.filter(item => {
   //    if (!uniqueItems[item]){
   //       uniqueItems[item] = true;
   //       return true;
   //    }
   //    return false;
   // });

   // ALTERNATIVE SOLUTION
   // The Set object lets you store unique values of any type, whether primitive values or object references.
   return [...new Set(arr)];
}

// Test Cases
console.log("01 - Chef Mario's Recipe Book:");
console.log(removeDupesFromArray(eggScrambleRecipe));




/* //* 02 - Pumpkin's Prizes
Scrimba mascot Pumpkin has won the grand prize at an international 
cat show. Below are Pumpkin's scores from the judges, as well as all the 
prizes he's won. In all the excitement of victory,
they've become a jumbled mess of nested arrays. Let's 
help Pumpkin by sorting it out. 

Write a function to flatten nested arrays of strings or
numbers into a single array. There's a method
for this, but pratice both doing it manually and using the method. 

Example input: [1, [4,5], [4,7,6,4], 3, 5]
Example output: [1, 4, 5, 4, 7, 6, 4, 3, 5]
*/

const kittyScores = [
   [39, 99, 76], 89, 98, [87, 56, 90], 
   [96, 95], 40, 78, 50, [63]
];

const kittyPrizes = [
   ["💰", "🐟", "🐟"], "🏆", "💐", "💵", ["💵", "🏆"],
   ["🐟","💐", "💐"], "💵", "💵", ["🐟"], "🐟"
];


function flatten(arr){
   // Solution.1
   return arr.flat();
   
   // Solution.2
   // const uniqueItems = [];
   // arr.forEach(item =>{
   //     if (Array.isArray(item)) {
   //         item.forEach(el => {
   //             if (!uniqueItems.includes(el)) uniqueItems.push(el);
   //         })
   //     } else {
   //       if (!uniqueItems.includes(item)) uniqueItems.push(item);
   //     }
   // });
   // return uniqueItems;
}

// Test Cases
console.log("02 - Pumpkin's Prizes:");
console.log(flatten(kittyPrizes));
console.log(flatten(kittyScores));



/* //* 03 - Count the Scrimba Students
Alex from Scrimba wants to know how many new students have attended 
Scrimba's weekly Town Hall event this year. 

He has an array of first-time attendees for each month of the year. 
Help him find the total number of attendees! Your function should
take in an array and return a number representing the total number
of new attendees. 

Example input: [1,2,3]
Example output: 6
 */

const studentCount = [50,53,61,67,60,70,78,80,80,81,90,110];

function sumArray(arr){
   // Solution.1
   // return arr.reduce((acc, curr) => acc + curr, 0);

   // Solution.2
   let total = 0;
   arr.forEach(el => total += el);
   return total;
}

// Test Cases
console.log("03 - Count the Scrimba Students:");
console.log(sumArray(studentCount));



/* //* 04 - Pizza Night? 
It's the weekend and you and your friends can't agree on 
what to order for dinner, so you put it to a vote. 

Write a function to find the food with the highest number of votes. 

Your function should take in a food object and find the food
with the most votes. It should log the winner, along with 
how many votes it received.  

Example input: {"🐈 cats": 19, "🐕 dogs": 17} 
Example output: The winner is 🐈 cats with 19 votes!
*/ 

const gameNightFood = {
   "🍕 pizza": 3, 
   "🌮 tacos": 10, 
   "🥗 salads": 7,
   "🍝 pasta": 5
}

function findTheWinner(obj){
   let winKey = "";
   let winVal = 0;
   
   for (const [key, val] of Object.entries(obj)){
       if (val >= winVal) {
           winKey = key;
           winVal = val;
       }
   }
   
   return `The winner is ${winKey} with ${winVal} votes!`;
}

// Test Cases
console.log(findTheWinner(gameNightFood));




/* //* 05 - Totally Private Data Farm 

Good news, renown advertising firm Evil Corp. wants to purchase our 
private user data! 

We'd never do this in real life of course, but just for practice 
let's pretend we're unethical web hackers and transform the data 
in the way Evil Corp. has requested. They're quite particular and
just want an array of users with a fullname and human readable
birthday.   

Write a function that maps through the current data and returns
a new an array of objects with only two properties: 
fullName and birthday. Each result in your 
array should look like this when you're done: 

{
   fullName: "Levent Busser", 
   birthday: "Fri Aug 20 1971"
   }
   
   Read about toDateString() for info on formatting a readable date. 
*/
import userData from "./assets/data-05.js";

function transformData(data){
//     let output = [];
//     for (let item of data) {
//         let date = new Date(item.dob.date);
//         output.push({
//            fullName: `${item.name.first} ${item.name.last}`,
//            birthday: `${date.toDateString()}`
//        }); 
//     }
//     return output;
// }

// ALTERNATIVE SOLUTION
   return data.map(item => ({
       fullName: `${item.name.first} ${item.name.last}`,
       birthday: new Date(item.dob.date).toDateString()
   }));
}

// Test Cases
console.log(transformData(userData));



import podcasts from "./assets/data-06.js";
/* //* 06- Find Free Podcasts 

We have a list of podcasts and need the ability to filter by only
podcasts which are free.

Write a function that takes in the podcast data and returns an new
array of only those podcasts which are free.

Additionally, your new array should return only 
objects containing only the podcast title, rating, and whether or 
not it is paid. 

Expected output: 
[
    {title: "Scrimba Podcast", rating: 10, paid: false}, 
    {title: "Something about Witches", rating: 8, paid: false}, 
    {title: "Coding Corner", rating: 9, paid: false}
]
*/

function getFreePodcasts(data){
    return data
        .filter(item => item.paid === false)
        .map(item => {
            return {
                title: item.title,
                rating: item.rating,
                paid: item.paid
            }
        });
}

// Test Cases
console.log(getFreePodcasts(podcasts))



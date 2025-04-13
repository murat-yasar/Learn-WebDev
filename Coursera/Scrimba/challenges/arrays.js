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
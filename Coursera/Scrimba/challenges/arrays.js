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

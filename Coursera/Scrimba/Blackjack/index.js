let firstCard = Math.floor(Math.random() * (11 - 2 + 1)) + 2; 
let secondCard = Math.floor(Math.random() * (11 - 2 + 1)) + 2;
let sum = firstCard + secondCard;

if (sum < 21) console.log(sum + ": Do you want to draw a new card?");
else if (sum == 21) console.log(sum + ": You win! Blackjack!");
else console.log(sum + ": You lost!");




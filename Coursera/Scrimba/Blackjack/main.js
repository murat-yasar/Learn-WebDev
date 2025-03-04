let firstCard = Math.floor(Math.random() * (11 - 2 + 1)) + 2; 
let secondCard = Math.floor(Math.random() * (11 - 2 + 1)) + 2;
let sum = firstCard + secondCard;
let hasBlackJack = false;
let isAlive = true;
let message = "";


function startGame() {
   if (sum === 21) {
      hasBlackJack = true;
      message = "You win! Blackjack!";
   } else if (sum < 21) {
      message = "Do you want to draw a new card?";
   } else {
      message = "You lost!";
      isAlive = false;
   }

   console.log(message);
}

startGame();
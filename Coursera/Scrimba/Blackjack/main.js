// Selectors
let messageEl = document.querySelector("#messageEl");
let cardsEl = document.querySelector("#cardsEl");
let sumEl = document.querySelector("#sumEl");
let startButton = document.querySelector("#startButton");

// Variables
let hasBlackJack = false;
let isAlive = true;
let message = "Want to play a round?";
let cards = []; 
let sum = 0;

// Functions
let getRandomCard = () =>  Math.floor(Math.random() * (11 - 2 + 1)) + 2;

let buildBoard = () => {
   cards = [];
   cards.push(getRandomCard());
   cards.push(getRandomCard());
   sum = cards.reduce((a, b) => a + b, 0);
}

function startGame() {
   buildBoard();
   renderGame();
}

function renderGame() {
   cardsEl.textContent = "Cards: ";

   if (sum === 21) {
      hasBlackJack = true;
      message = "You win! Blackjack!";
   } else if (sum < 21) {
      message = "Do you want to draw a new card?";
   } else {
      message = "You lost!";
      isAlive = false;
   }

   cards.forEach((card) => {cardsEl.textContent += card + " ";});
   messageEl.textContent = message;
   sumEl.textContent = "Sum: " + sum;
}

let newCard = () => {
   cards.push(getRandomCard());
   sum += cards[cards.length - 1];
   renderGame();
}
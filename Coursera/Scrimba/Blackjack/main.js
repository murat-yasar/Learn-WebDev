// Selectors
let messageEl = document.querySelector("#message-el");
let cardsEl = document.querySelector("#cards-el");
let sumEl = document.querySelector("#sum-el");
let startButton = document.querySelector("#btn-start");

// Variables
let hasBlackJack = false;
let isAlive = true;
let message = "Want to play a round?";
let cards = []; 
let sum = 0;

// Functions
let getRandomCard = () =>  {
   let card = Math.floor(Math.random() * 13) + 1;

   switch(card) {
      case 1:  return "A";
      case 11: return "J";
      case 12: return "Q";
      case 13: return "K";
      default: return card;
   }
}

let calculateSum = () => {
   let sum = 0;
   cards.forEach((card) => {
      if (card === "A") {
         sum += 11;
      } else if (card < 10) {
         sum += card;
      } else {
         sum += 10;
      }
   });
   return sum;
}

let initBoard = () => {
   cards = [];
   cards.push(getRandomCard());
   cards.push(getRandomCard());
   sum = calculateSum();
}

function startGame() {
   initBoard();
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
   if (isAlive && !hasBlackJack) cards.push(getRandomCard());
   sum = calculateSum();
   renderGame();
}
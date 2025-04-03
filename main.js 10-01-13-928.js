// Simple Calculator in JavaScript

// Function to add two numbers
function add(a, b) {
   return a + b;
}

// Function to subtract two numbers
function subtract(a, b) {
   return a - b;
}

// Function to multiply two numbers
function multiply(a, b) {
   return a * b;
}

// Function to divide two numbers
function divide(a, b) {
   if (b === 0) {
      return "Error: Division by zero is not allowed.";
   }
   return a / b;
}

// Example usage
console.log("Addition: ", add(5, 3)); // Output: 8
console.log("Subtraction: ", subtract(5, 3)); // Output: 2
console.log("Multiplication: ", multiply(5, 3)); // Output: 15
console.log("Division: ", divide(5, 3)); // Output: 1.666...
console.log("Division by zero: ", divide(5, 0)); // Output: Error: Division by zero is not allowed.
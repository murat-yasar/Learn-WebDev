/* Panic function 
Write a PANIC! function. The function should take in a sentence and return the same
sentence in all caps with an exclamation point (!) at the end. Use JavaScript's
built in string methods. 

If the string is a phrase or sentence, add a 😱 emoji in between each word. 

Example input: "Hello"
Example output: "HELLO!"

Example input: "I'm almost out of coffee"
Example output: "I'M 😱 ALMOST 😱 OUT 😱 OF 😱 COFFEE!"
*/

function panic(str){
   return str
       .split(' ')
       .join(' 😱 ')
       .toUpperCase() + "!";
}

// Test Cases
console.log(panic("I'm almost out of coffee")); 
console.log(panic("winter is coming"))



/* Whispering function 
Write a function `whisper` that takes in a sentence 
and returns a new sentence in all lowercase letters with
"shh..." at the beginning. 

The function should also remove an exclamation point
at the end of the sentence, if there is one. 

Example 
input: "The KITTENS are SLEEPING!"
output: "shh... the kittens are sleeping"
*/

function whisper(str){
    if(str.endsWith("!")){
        // scrimba!
        return "shh... " + str.slice(0, -1).toLowerCase();
    }
    return "shh... " + str.toLowerCase();
}

// Test Cases
console.log(whisper("PLEASE STOP SHOUTING."));
console.log(whisper("MA'AM, this is a Wendy's!"));



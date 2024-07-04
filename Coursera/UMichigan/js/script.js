/*
const photos = [
  ["home-office.jpg", "laptop.jpg", "meeting.jpg", "office.jpg", "strategy.jpg", "web-design.jpg"],
  ["athens.jpg", "aztec.jpg", "cappadocia.jpg", "great-wall.jpg", "kremlin.jpg", "kyoto.jpg", "paris.jpg", "petra.jpg", "pisa.jpg", "pyramid.jpg", "taj-mahal.jpg", "venice.jpg"]
]
*/

const photos = {
  work: ["home-office.jpg", "laptop.jpg", "meeting.jpg", "office.jpg", "strategy.jpg", "web-design.jpg"],
  travel: ["athens.jpg", "aztec.jpg", "cappadocia.jpg", "great-wall.jpg", "kremlin.jpg", "kyoto.jpg", "paris.jpg", "petra.jpg", "pisa.jpg", "pyramid.jpg", "taj-mahal.jpg", "venice.jpg"]
}


function pickImage(page){
  let imgNum = (page === 'work') ? 6 : (page === 'travel') ? 12 : 0; 
  let randNum = Math.floor(Math.random() * imgNum);
  
  randImg = `images/${page}/${photos[page][randNum]}`;
  console.log(randImg);
  headImg = document.querySelector('#header-img');
  headImg.setAttribute('src', randImg);
  headImg.setAttribute('alt', '');
}
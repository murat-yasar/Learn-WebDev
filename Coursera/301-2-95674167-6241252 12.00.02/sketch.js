/*
The case of the Python Syndicate
Stage 3


Officer: 6241252
CaseNum: 301-2-95674167-6241252

Right kid let’s work out which of our ‘friends’ is connected to the syndicate.

- An object for Cecil karpinski has been declared and initialised
- Modify the x and y parameters of each image command using the x and y
properties from the Cecil karpinski object so the images remain at their correct
positions on the board.
- To do this you will need to combine add and subtract operators with the
relevant property for each parameter



*/

var photoBoard;
var countess_hamilton_img;
var pawel_karpinski_img;
var lina_lovelace_img;
var bones_karpinski_img;
var cecil_karpinski_img;
var rocky_kray_img;

var cecil_karpinski_obj;




function preload()
{
	photoBoard = loadImage('photoBoard.png');
	countess_hamilton_img = loadImage("countessHamilton.png");
	pawel_karpinski_img = loadImage("karpinskiBros2.png");
	lina_lovelace_img = loadImage("lina.png");
	bones_karpinski_img = loadImage("karpinskiDog.png");
	cecil_karpinski_img = loadImage("karpinskiBros1.png");
	rocky_kray_img = loadImage("krayBrothers1.png");

}

function setup()
{
	createCanvas(photoBoard.width, photoBoard.height);
	cecil_karpinski_obj = {
		x: 408,
		y: 309,
		image: cecil_karpinski_img
	};
}

function draw()
{
	image(photoBoard, 0, 0);

	//And update these image commands with your x and y coordinates.
	image(cecil_karpinski_obj.image, cecil_karpinski_obj.x, cecil_karpinski_obj.y);

	//image(countess_hamilton_img, 115, 40);
	//image(pawel_karpinski_img, 408, 40);
	//image(lina_lovelace_img, 701, 40);
	//image(bones_karpinski_img, 115, 309);
	//image(rocky_kray_img, 701, 309);

}
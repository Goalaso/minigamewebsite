function create_line_break()
{
	const d = document.createElement("br");
	document.body.appendChild(d);
}

function create_button()
{
	const btn = document.createElement("button");
	btn.style.height = "25px";
	btn.style.width = "25px";
	btn.style.background = "url('assets/empty.png')";
	btn.style.backgroundSize = "100%";
	btn.style.fontSize = "0px";
	btn.value = "0";
	document.body.appendChild(btn);
	
	return btn;
}

function avoid_image_loading_delay()
{
	// PLACE YOUR CODE IN HERE
	
}

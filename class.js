class Minesweeper
{
	static get SIZE()  { return 15; }
	static get BOMB()  { return "B"; }
	static get EMPTY() { return "E"; }
	
	bombs = 0;
	cells = [];
	rows = 0;
	cols = 0;
	
    constructor(rows = Minesweeper.SIZE, columns = Minesweeper.SIZE, probability_chance = 0.1)
    {
		this.rows = rows;
		this.cols = columns;
		this.prob = probability_chance;
    }
    
    init_board()
    {
	    for (let i = 0; i < this.rows; i++) {
			this.cells[i] = []
			for (let j = 0; j < this.cols; j++) {
				this.cells[i].push(create_button());
				let btn = this.cells[i][j];
				btn.x = i;
				btn.y = j;
				btn.board = this;
				btn.onclick = this._open;
				btn.oncontextmenu = this._flag;
				
				let rand = Math.random();
				if (rand <= this.prob) {
					btn.className = "B";
					this.bombs++;
				}
			}
			create_line_break();
		}
		this.lock();
		let startbtn = document.getElementById("start");
		startbtn.board = this;
		startbtn.onclick = this.unlock;
	}
	
	flood_fill()
	{
		for(let i = 0; i < this.rows; i++) {
			for (let j = 0; j < this.cols; j++) {
				let btn = this.cells[i][j];
				if (btn.className == "B") {
					for (let k = i - 1; k <= i + 1; k++) {
						for (let l = j - 1; l <= j + 1; l++) {
							if (k >= 0 && l >= 0 && k < this.rows && l < this.cols) {
								this.cells[k][l].value = Number(this.cells[k][l].value) + 1;
							}
						}
					}
				}
			}
		}
	}
	
	lock()
	{
		for(let i = 0; i < this.rows; i++) {
			for(let j = 0; j < this.cols; j++) {
				let btn = this.cells[i][j];
				btn.disabled = true;
			}
		}
	}
	
	unlock()
	{
		if (this.innerHTML == "Start") {
			for(let i = 0; i < this.board.rows; i++) {
				for(let j = 0; j < this.board.cols; j++) {
					this.board.cells[i][j].removeAttribute("disabled");
				}
			}
			this.innerHTML = "Reset";
		} else if (this.innerHTML == "Reset") {
			for(let i = 0; i < this.board.rows; i++) {
				for(let j = 0; j < this.board.cols; j++) {
					let btn = this.board.cells[i][j];
					if(btn.className == "R") {
						btn.removeAttribute("class");
					}
					btn.style.background = "url('assets/empty.png')";
					btn.style.backgroundSize = "100%";
					btn.disabled = true;
				}
			}
			this.innerHTML = "Start";
			let gameover = document.getElementById("game_over");
			gameover.style.display = "none";
			this.board.lock();
		}
	}
	
	_flag(event)
	{
		event.preventDefault();
		let btn = this;
		if (!btn.className.includes("F") && !btn.className.includes("R")) {
			btn.className += "F";
			btn.style.background = "url('assets/flag.png')";
			btn.style.backgroundSize = "100%";
		} else if (!btn.className.includes("R")) {
			btn.className = btn.className.replace("F", "");
			btn.style.background = "url('assets/empty.png')";
			btn.style.backgroundSize = "100%";
		}
	}
	
	_open()
	{
		let btn = this.board.cells[this.x][this.y];
		let numBombs = Number(btn.value);
		let gameover = document.getElementById("game_over");
		if (btn.className.includes("B")) {
			btn.style.background = "url('assets/bomb.png')";
			btn.style.backgroundSize = "100%";
			this.board.lock();
			gameover.style.display = "inline";
			gameover.style.color = "red";
			gameover.innerHTML = "You lost!";
		} else if (btn.value != "0") {
			btn.className = "R";
			btn.style.background = "url('assets/" + numBombs + ".png')";
			btn.style.backgroundSize = "100%";
			btn.disabled = true;
		} else {
			this.board.explore(this.x, this.y);
		}
		
		if(this.board.is_winning_choice()) {
			gameover.style.display = "inline";
			gameover.style.color = "green";
			gameover.innerHTML = "You won!";
			this.board.lock();
		}
	}
	
	explore(x, y)
	{
		if (x < 0 || y < 0 || x >= this.rows || y >= this.cols || this.cells[x][y].className == "R") {
			return;
		}
		let btn = this.cells[x][y];
		let numBombs = Number(btn.value);
		if (btn.value != "0") {
			btn.className = "R";
			btn.style.background = "url('assets/" + numBombs + ".png')";
			btn.style.backgroundSize = "100%";
			btn.disabled = true;
			return;
		}
		btn.className = "R";
		btn.style.background = "url('assets/" + numBombs + ".png')";
		btn.style.backgroundSize = "100%";
		btn.disabled = true;
		for (let i = x - 1; i <= x + 1; i++) {
			for (let j = y - 1; j <= y + 1; j++) {
				if (!(i == x && j == y)) {
					this.explore(i, j);
				}
			}
		}
	}
	
	is_winning_choice()
	{
		let numRevealed = 0;
		for(let i = 0; i < this.rows; i++) {
			for(let j = 0; j < this.cols; j++) {
				if(this.cells[i][j].className == "R") numRevealed++;
			}
		}
		let won = numRevealed == (this.rows * this.cols - this.bombs);
		return won;
	}
}


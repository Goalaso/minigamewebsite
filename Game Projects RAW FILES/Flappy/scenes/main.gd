extends Node

@export var pipe_scene : PackedScene

var game_running : bool
var game_over : bool
var scroll
var score : int
var high_score : int
const SCROLL_SPEED : int = 300
var screen_size : Vector2i
var ground_height : int
var pipes : Array
const PIPE_DELAY : int = 100
const PIPE_RANGE : int = 200

# Called when the node enters the scene tree for the first time.
func _ready():
	screen_size = get_window().size
	ground_height = $Ground.get_node("Sprite2D").texture.get_height()
	new_game()

func new_game():
	#reset variables
	game_running = false
	game_over = false
	score = 0
	scroll = 0
	$ScoreLabel.text = "SCORE: " + str(score)
	$HighScoreLabel.text = "HIGH SCORE: " + str(high_score)
	$GameOver.hide()
	$HighScoreGameOver.hide()
	$SubmittedLabel.hide()
	get_tree().call_group("pipes", "queue_free")
	pipes.clear()
	#generate starting pipes
	generate_pipes()
	$Bird.reset()
	
func _input(event):
	if game_over == false:
		if event is InputEventMouseButton:
			if event.button_index == MOUSE_BUTTON_LEFT and event.pressed:
				if game_running == false:
					start_game()
				else:
					if $Bird.flying:
						$Bird.flap()
						check_top()

func start_game():
	game_running = true
	$Bird.flying = true
	$Bird.flap()
	#start pipe timer
	$PipeTimer.start()

# Called every frame. 'delta' is the elapsed time since the previous frame.
func _process(delta):
	if game_running:
		scroll += SCROLL_SPEED * delta
		#reset scroll
		if scroll >= screen_size.x:
			scroll = 0
		#move ground node
		$Ground.position.x = -scroll
		#move pipes
		for pipe in pipes:
			pipe.position.x -= SCROLL_SPEED * delta


func _on_pipe_timer_timeout():
	generate_pipes()
	
func generate_pipes():
	var pipe = pipe_scene.instantiate()
	pipe.position.x = screen_size.x + PIPE_DELAY
	pipe.position.y = (screen_size.y - ground_height) / 2  + randi_range(-PIPE_RANGE, PIPE_RANGE)
	pipe.hit.connect(bird_hit)
	pipe.scored.connect(scored)
	add_child(pipe)
	pipes.append(pipe)
	
func scored():
	score += 100
	$ScoreLabel.text = "SCORE: " + str(score)
	if score > high_score:
		$HighScoreLabel.text = "HIGHSCORE: " + str(score)

func check_top():
	if $Bird.position.y < 0:
		$Bird.falling = true
		stop_game()

func stop_game():
	$PipeTimer.stop()
	$Bird.flying = false
	game_running = false
	if score > high_score:
		high_score = score
		$HighScoreGameOver.show()
	else:
		$GameOver.show()
	game_over = true
	
	
func bird_hit():
	if game_running:
		$Bird.falling = true
		stop_game()

func _on_ground_hit():
	if game_running:
		$Bird.falling = false
		stop_game()
	else:
		$Bird.falling = false

func _on_game_over_restart():
	new_game()

func _on_high_score_game_over_restart():
	new_game()

func _on_high_score_game_over_submit():
	$SubmittedLabel.show()
	_on_high_score_menu_save_score()

func _on_high_score_menu_save_score():
	var myurl = "/score.php"
	var dict = {"game": "flappybird", "score": high_score}
	_make_post_request(myurl, dict)

func _make_post_request(url, data_to_send):
	#Convert data to json string:
	var query = JSON.stringify(data_to_send)
	#Add 'Content-Type' header:
	var headers = ["Content-Type: application/json"]
	var http = HTTPClient.new()
	http.connect_to_host("localhost", 80)
	while http.get_status() == HTTPClient.STATUS_CONNECTING or http.get_status() == HTTPClient.STATUS_RESOLVING:
		http.poll()
		print("Connecting...")
		await get_tree().process_frame
		http.request(HTTPClient.METHOD_POST, url, headers, query)

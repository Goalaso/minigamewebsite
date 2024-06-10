extends CanvasLayer
var cur_high_score
#Notifies 'Main' node that the button has been pressed
signal start_game

# Called when the node enters the scene tree for the first time.
func _ready():
	pass # Replace with function body.


# Called every frame. 'delta' is the elapsed time since the previous frame.
func _process(delta):
	pass

func show_message(text):
	$Message.text = text
	$Message.show()
	$MessageTimer.start()
	
func show_game_over():
	show_message("Game Over")
	# Wait until the MessageTimer has counted down.
	await $MessageTimer.timeout
	
	$Message.text = "Dodge the Creeps!"
	$Message.show()
	# Make a one-shot timer and wait for it to finish.
	await get_tree().create_timer(1.0).timeout
	$StartButton.show()

func show_high_score_game_over():
	show_message("Game Over, New High Score!")
	await $MessageTimer.timeout
	$SubmitMessage.show()
	$SubmitButton.show()
	$RestartButton.show()
	
	
func update_score(score):
	$ScoreLabel.text = "Score: " + str(score)

func update_high_score(score):
	cur_high_score = score
	$HighScoreLabel.text = "High Score: "+ str(score)

func _on_start_button_pressed():
	$StartButton.hide()
	start_game.emit()
	
func _on_message_timer_timeout():
	$Message.hide()

func hide_submit():
	$SubmitButton.hide()

func _on_submit_button_pressed():
	$SubmitMessage.hide()
	$SubmitButton.hide()
	$RestartButton.hide()
	_on_high_score_menu_save_score()
	show_message("Score Saved!")
	
	await $MessageTimer.timeout
	
	$Message.text = "Dodge the Creeps!"
	$Message.show()
	# Make a one-shot timer and wait for it to finish.
	await get_tree().create_timer(1.0).timeout
	$StartButton.show()

func _on_high_score_menu_save_score():
	var myurl = "/score.php"
	var dict = {"game": "creeps", "score": cur_high_score}
	_make_post_request(myurl, dict)

func _make_post_request(url, data_to_send):
	# Convert data to json string:
	var query = JSON.stringify(data_to_send)
	# Add 'Content-Type' header:
	var headers = ["Content-Type: application/json"]
	var http = HTTPClient.new()
	http.connect_to_host("localhost", 80)
	while http.get_status() == HTTPClient.STATUS_CONNECTING or http.get_status() == HTTPClient.STATUS_RESOLVING:
		http.poll()
		print("Connecting...")
		await get_tree().process_frame
		http.request(HTTPClient.METHOD_POST, url, headers, query)


func _on_restart_button_pressed():
	$SubmitMessage.hide()
	$SubmitButton.hide()
	$RestartButton.hide()
	show_message("Restarting")
	
	await $MessageTimer.timeout
	
	$Message.text = "Dodge the Creeps!"
	$Message.show()
	# Make a one-shot timer and wait for it to finish.
	await get_tree().create_timer(1.0).timeout
	$StartButton.show()

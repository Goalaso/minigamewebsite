extends CanvasLayer

var life_texture = preload("res://Assets/Player/Player.png")

@onready var lifes_ui_container = $MarginContainer/HBoxContainer

@onready var center_container = %CenterContainer
@onready var points_label = $MarginContainer/Points
@onready var points_counter = $"../PointsCounter" as PointsCounter
@onready var label = $MarginContainer/CenterContainer/GameOverBox/Label
@onready var restart_button = $MarginContainer/CenterContainer/GameOverBox/Button
@onready var submit_button = $MarginContainer/CenterContainer/GameOverBox/Submit
@onready var highpoints_label = $MarginContainer/HighPoints

@export var invader_spawner: InvaderSpawner
@export var life_manager: LifeManager

func _ready():
	points_label.text = "SCORE: %d" % 0
	points_counter.on_points_increased.connect(points_increased)
	invader_spawner.game_lost.connect(on_game_lost)
	invader_spawner.game_won.connect(on_game_won)
	restart_button.pressed.connect(on_restart_button_press)
	life_manager.on_life_lost.connect(on_life_lost)
	submit_button.pressed.connect(on_submit_button_press)
	
	var lifes_count = life_manager.lifes
	
	for i in range(lifes_count):
		var life_texture_rect = TextureRect.new()
		life_texture_rect.expand_mode = TextureRect.EXPAND_KEEP_SIZE
		life_texture_rect.custom_minimum_size = Vector2(40, 25)
		life_texture_rect.texture_filter = CanvasItem.TEXTURE_FILTER_NEAREST
		life_texture_rect.texture = life_texture
		lifes_ui_container.add_child(life_texture_rect)
	

func points_increased(points: int):
	points_label.text = "SCORE: %d" % points
	highpoints_label.text = "HIGHSCORE: %d" % points_counter.highscore
	
func on_game_lost():
	center_container.visible = true
	submit_button.disabled = false
	
func on_game_won():
	label.text = "You won!"
	label.add_theme_color_override("font_color", Color.GREEN)
	center_container.visible = true

func on_restart_button_press():
	get_tree().reload_current_scene()
	
func on_submit_button_press():
	submit_button.disabled = true
	var myurl = "/score.php"
	var dict = {"game": "space", "score": points_counter.highscore}
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

func on_life_lost(lifes_left:int):
	print_debug(lifes_left)
	if lifes_left != 0:
		var life_texture_rect: TextureRect =  lifes_ui_container.get_child(lifes_left)
		life_texture_rect.queue_free()
	else:
		on_game_lost()

	


extends Node

@export var mob_scene: PackedScene
var score
var high_score : int = 0
var new_high_score = false
# Called when the node enters the scene tree for the first time.
func _ready():
	pass

# Called every frame. 'delta' is the elapsed time since the previous frame.
func _process(delta):
	pass


func _on_player_hit():
	pass 

func game_over():
	$ScoreTimer.stop()
	$MobTimer.stop()
	if new_high_score:
		$HUD.show_high_score_game_over()
	else:
		$HUD.show_game_over()
	
func new_game():
	score = 0
	new_high_score = false
	$HUD.hide_submit()
	$Player.start($StartPosition.position)
	$StartTimer.start()
	$HUD.update_score(score)
	$HUD.show_message("Get Ready")
	get_tree().call_group("mobs", "queue_free")


func _on_mob_timer_timeout():
	# Create a new instance of the Mob scene.
	var mob = mob_scene.instantiate()

	# Choose a random location on Path2D.
	var mob_spawn_location = $MobPath/MobSpawnLocation
	mob_spawn_location.progress_ratio = randf()

	# Set the mob's direction perpendicular to the path direction.
	var direction = mob_spawn_location.rotation + PI / 2

	# Set the mob's position to a random location.
	mob.position = mob_spawn_location.position

	# Add some randomness to the direction.
	direction += randf_range(-PI / 4, PI / 4)
	mob.rotation = direction

	# Choose the velocity for the mob.
	var velocity = Vector2(randf_range(150.0, 250.0), 0.0)
	mob.linear_velocity = velocity.rotated(direction)

	# Spawn the mob by adding it to the Main scene.
	add_child(mob)


func _on_score_timer_timeout():
	score += 100
	$HUD.update_score(score)
	if score > high_score:
		new_high_score = true
		high_score = score
		$HUD.update_high_score(high_score)

func _on_start_timer_timeout():
	$MobTimer.start()
	$ScoreTimer.start()

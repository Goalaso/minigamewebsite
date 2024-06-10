extends Node

class_name PointsCounter

signal on_points_increased(points: int)

var points = 0
var highscore = 0

@onready var invader_spawner = $"../InvaderSpawner" as InvaderSpawner

func _ready():
	invader_spawner.invader_destroyed.connect(increase_points)

func increase_points(points_to_add: int):
	points += points_to_add
	if points > highscore:
		highscore = points
	on_points_increased.emit(points)


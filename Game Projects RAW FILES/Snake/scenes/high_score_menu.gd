extends CanvasLayer

signal new_game
signal save_score

func _on_restart_button_pressed():
	new_game.emit()

func _on_save_score_pressed():
	$SaveScoreButton.disabled = true
	$ScoreSavedLabel.show()
	save_score.emit()

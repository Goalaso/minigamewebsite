extends CanvasLayer

signal restart
signal submit

func _on_restart_button_pressed():
	restart.emit()


func _on_submit_button_pressed():
	submit.emit()

package controller

import (
	"github.com/fatih/color"
	socketio "github.com/graarh/golang-socketio"
	"github.com/koushamad/goro/app/service"
	"strconv"
)

func Connect (c *socketio.Channel) {
	color.Blue("Connected SId: " + c.Id() )
	c.Join("Rashma")
}

func Disconnet (c *socketio.Channel) {
	color.Yellow("Connected Disconnet: " + c.Id() )
	service.Disconnect(c.Id())
	c.Leave("Rashma")
}

func Error (c *socketio.Channel) {
	color.Red("Connected Error: " + c.Id() )
	c.Leave("Rashma")
}

func Auth(c *socketio.Channel, auth service.Auth) string {
	profileId := auth.Check(c.Id())
	color.Green("Auth SId: " + c.Id() + " ProfileId: " + strconv.Itoa(int(profileId)))
	c.Join(string(profileId))
	return "OK"
}

func Join(c *socketio.Channel, quiz service.Quiz ) string {
	color.Blue("Join SId: " + c.Id() + " QuizId: " + quiz.QuizId)
	if quiz.Join() {
		c.Join(quiz.QuizId)
	}
	return "OK"
}

func Leave(c *socketio.Channel, quiz service.Quiz ) string {
	color.Blue("Leave SId: " + c.Id() + " QuizId: " + quiz.QuizId)
	if quiz.Leave() {
		c.Leave(quiz.QuizId)
	}
	return "OK"
}

func Send(c *socketio.Channel, msg service.MessageSend) string {
	color.Blue("Send SId: " + c.Id() + " QuizId: " + msg.QuizId)
	if service.Connect(c.Id()){
		profile := service.Profile(c.Id())
		err, message :=  msg.Send(profile.ID)
		if err == nil {
			color.Blue("Receive SId: " + c.Id() + " QuizId: " + msg.QuizId)
			c.Emit("receive", message)
			c.BroadcastTo(msg.QuizId, "receive", message)
		}
	}
	return "OK"
}
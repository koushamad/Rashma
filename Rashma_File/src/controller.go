package main

import (
	"encoding/json"
	"log"
	"net/http"
)

type Response struct {
	Success  bool              `json:"status"`
	Code     int               `json:"code"`
	Messages []Message         `json:"messages"`
	Data     map[string]string `json:"data"`
}

type Message struct {
	Text string `json:"text"`
	Code string `json:"type"`
}

func Upload(w http.ResponseWriter, r *http.Request)  {
	r.Body = http.MaxBytesReader(w, r.Body, MAX_UPLOAD_SIZE)
	if err := r.ParseMultipartForm(MAX_UPLOAD_SIZE); err != nil {
		log.Print("ERROR_CONTROLLER_01")
		returnError(w, "FILE_IS_TO_LARGE", http.StatusBadRequest)
		return
	}

	file, _, err := r.FormFile("file")

	if err != nil {
		log.Print("ERROR_CONTROLLER_02")
		returnError(w, "FILE_IS_INVALID", http.StatusBadRequest)
		return
	}

	err, fileName := UploadFile(file)

	if err != nil {
		log.Print("ERROR_CONTROLLER_03")
		returnError(w, "CAN_NOT_UPLOAD_FILE", http.StatusBadRequest)
		return
	}

	returnSuccess(w, fileName)
}

func returnSuccess(w http.ResponseWriter, fileName string) {
	data := map[string]string{"imageId":fileName}
	messages := make([]Message,0)
	response := Response{true,200,messages,data}

	js, err := json.Marshal(response)

	if err != nil {
		log.Print(err.Error())
		return
	}

	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(js)
}

func returnError(w http.ResponseWriter, message string, statusCode int) {
	data := make(map[string]string)
	messages := make([]Message, 0)
	messages = append(messages, Message{Code: "error", Text: message})
	response := Response{false, 200, messages, data}

	js, err := json.Marshal(response)

	if err != nil {
		log.Print(err.Error())
		return
	}

	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(http.StatusOK)
	w.Write(js)
}
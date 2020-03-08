package main

import (
	"log"
	"net/http"
)

const MAX_UPLOAD_SIZE = 10 * 1024 * 1024 // 10 mb
const UPLOAD_PATH = "/app/tmp/files"

func main()  {
	http.HandleFunc("/upload", Upload)
	http.Handle("/download/", http.StripPrefix("/download/", http.FileServer(http.Dir(UPLOAD_PATH))))

	log.Print("Server started")
	log.Fatal(http.ListenAndServe(":8080", nil))
}

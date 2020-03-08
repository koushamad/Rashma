package main

import (
	"fmt"
	"io/ioutil"
	"log"
	"mime/multipart"
	"os"
	"path/filepath"
	"crypto/rand"
)

func UploadFile(file multipart.File)(error, string){
	defer file.Close()
	fileBytes, err := ioutil.ReadAll(file)

	if err != nil {
		log.Print("ERROR_ADAPTER_01")
		return err, ""
	}

	fileName := randToken(64)
	newPath := filepath.Join(UPLOAD_PATH, fileName)
	newFile, err := os.Create(newPath)

	if err != nil {
		log.Print("ERROR_ADAPTER_02")
		return err, ""
	}

	defer newFile.Close()

	if _, err := newFile.Write(fileBytes); err != nil {
		log.Print("ERROR_ADAPTER_03")
		return err, ""
	}

	return nil, fileName
}

func randToken(len int) string {
	b := make([]byte, len)
	rand.Read(b)
	return fmt.Sprintf("%x", b)
}

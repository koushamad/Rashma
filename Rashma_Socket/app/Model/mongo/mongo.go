package mongo

import (
	"github.com/go-bongo/bongo"
	"log"
	"sync"
)
var(
	config = &bongo.Config{
		ConnectionString: "185.165.42.193",
		Database:         "rashma",
	}
	once sync.Once
	mongo *Mongo
)

type(
	Mongo struct {
		*bongo.Connection
	}
)
func Init() *Mongo {
	once.Do(func() {
		connection, err := bongo.Connect(config)
		if err != nil {
			log.Fatal(err)
		}
		mongo = &Mongo{connection}
	})
	return mongo
}

func (mongo Mongo)Kill()  {

}
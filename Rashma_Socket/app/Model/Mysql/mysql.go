package mysql

import (
	"github.com/jinzhu/gorm"
	_ "github.com/jinzhu/gorm/dialects/mysql"
	"os"
	"sync"
)

type(
	Mysql struct {
		*gorm.DB
	}
)

var (
	mysql *Mysql
	once sync.Once
)

func Init() *Mysql {
	once.Do(func() {
		db, err := gorm.Open(os.Getenv("DB_CONNECTION"), os.Getenv("DB_HOST"))
		if err != nil {panic(err.Error())}
		mysql = &Mysql{db}
	})
	return mysql
}

func (m Mysql) Kill() {
	defer m.Close()
}

package main

import (
	"fmt"
	"time"
)

type Product struct {
	name  string
	price int
}

func main() {
	t1 := time.Now()

	products := initProducts()

	in := make(chan Product)
	go generator(in, products)

	done := make(chan interface{})
	out := make(chan string)

	go func() {
		for range 4 {
			go process(done, in, out)
		}
	}()

	go func() {
		for range 4 {
			<-done
		}

		close(out)
	}()

	for result := range out {
		fmt.Printf(result)
	}

	t2 := time.Now()
	diff := t2.Sub(t1)
	fmt.Println(diff)
}

func generator(in chan Product, p []Product) {
	for _, product := range p {
		in <- product
	}

	close(in)
}

func process(done chan interface{}, in chan Product, out chan string) {
	for p := range in {
		out <- p.Save()
	}
	done <- struct{}{}
}

func initProducts() []Product {
	return []Product{
		{
			name:  "ring",
			price: 100,
		},
		{
			name:  "chain",
			price: 200,
		},
		{
			name:  "bag",
			price: 500,
		},
		{
			name:  "ball",
			price: 600,
		},
	}
}

func (r Product) Save() string {
	time.Sleep(1 * time.Second)
	return fmt.Sprintf("saved: %s %d \n", r.name, r.price)
}
